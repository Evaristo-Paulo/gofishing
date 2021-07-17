<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\Sold;
use App\Models\Brade;
use App\Models\Month;
use App\Models\Order;
use App\Models\Photo;
use App\Models\Stock;
use App\Models\Client;
use App\Models\People;
use App\Models\Product;
use App\Models\Category;
use App\Models\RoleUser;
use Illuminate\Support\Str;
use App\Models\Collaborator;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginStoreRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PainelController extends Controller
{

    public function home(Request $request)
    {
        $year = $request->all() ? $request->input('year') : Carbon::now()->year;

        $function = new User();
        if ($function->isClient()) {
            return redirect()->route('store.products');
        }
        $function_stats = new Sold();
        $statsActivities = $function_stats->statsActivities($year);

        $qtd_products = \DB::table('products')
            ->join('categories', function ($join) {
                $join->on('categories.id', '=', 'products.category_id')
                    ->where([['categories.active', '=', 1], ['products.active', '=', 1]]);
            })
            ->select('products.*')
            ->get()->count();

        $qtd_collabs = Collaborator::where('active', 1)->get()->count();

        $qtd_clients = \DB::table('clients')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'clients.user_id')
                    ->where([['clients.active', '=', 1], ['users.active', '=', 1]]);
            })
            ->join('people', function ($join) {
                $join->on('people.id', '=', 'users.people_id')
                    ->where([['people.active', '=', 1]]);
            })
            ->join('genders', 'genders.id', '=', 'people.gender_id')
            ->select('people.id as people_id', 'people.name', 'users.email', 'genders.type as gender')
            ->get()->count();

        $photos = Photo::all();
        $function = new Stock();

        $stocks = $function->stocks();
        $months = DB::table('months')->pluck('name');

        $bestSell = \DB::table('solds')
            ->join('products', function ($join) {
                $join->on('products.id', '=', 'solds.product_id')
                    ->where([['products.active', '=', 1]]);
            })
            ->selectRaw('solds.product_id, sum(solds.qty) as qty, products.name, products.category_id')
            ->groupBy('solds.product_id', 'products.name', 'products.category_id')
            ->orderBy('qty', 'desc')
            ->limit(5)
            ->get();

        if ($request->all()) {
            $request->session()->flash('success', 'Filtro aplicado com sucesso');

            if (session('success')) {
                Alert::toast(session('success'), 'success');
            }
        }

        return view('painel.home', compact('qtd_products', 'year', 'qtd_clients', 'qtd_collabs', 'stocks', 'photos', 'bestSell'))->with(
            'months',
            json_encode($months, JSON_NUMERIC_CHECK)
        )->with(
            'statsActivities',
            json_encode($statsActivities, JSON_NUMERIC_CHECK)
        )->with(
            'year',
            json_encode($year, JSON_NUMERIC_CHECK)
        );
    }

    public function login()
    {
        return view('painel.login');
    }

    public function loginStore(LoginStoreRequest $request)
    {

        try {

            $function = new User();
            $user = $function->user($request->input('email'));

            if (count($user)) {
                $credentials = [
                    'email' => $request->input('email'),
                    'password' => $request->input('password')
                ];

                if (Auth::attempt($credentials)) {
                    Auth::logoutOtherDevices($request->input('password'));
                    /* Fez autenticação */
                    $user = auth()->user();
                    Auth::login($user);

                    return redirect()->route('painel.home');
                }
            }
            return redirect()->back()->with('error', 'Email ou senha não encontrada')->withInput($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    public function workerProfile($id)
    {
        try {
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $id = decrypt($id);
            $person = People::find($id);
            return view('painel.workers.profile', compact('person'));
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function workerProfileUpdateSave(Request $request, $id)
    {
        try {
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|String|min:3',
                'gender' => 'required',
                'bi' => 'required',
                'adress' => 'required',
                'phone' => 'required|numeric',
                'birthday' => 'required',
                'email' => 'required|email',
            ], [
                'name.required' => 'Preenche o campo nome',
                'name.min' => 'Informe um nome válido',
                'gender.required' => 'Preenche o campo gênero',
                'bi.required' => 'Preenche o campo BI',
                'adress.required' => 'Preenche o campo endereço',
                'phone.required' => 'Preenche o campo telefone',
                'birthday.required' => 'Preenche o campo data de nascimento',
                'email.required' => 'Preenche o campo email',
                'email.email' => 'Informe um email valido',
            ]);

            if ($validator->fails()) {
                session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back()->withErrors($validator->errors())->withInput();
            } else {
                $id = decrypt($id);
                $nameFile = People::find($id)->photo;

                if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                    $name = uniqid(date('HisYmd'));
                    $extension = $request->photo->extension();
                    $nameFile = "{$name}.{$extension}";
                    $upload = $request->photo->storeAs('people', $nameFile);

                    if (!$upload) {
                    }
                }

                $person = [
                    'name' => $request->input('name'),
                    'gender_id' => $request->input('gender'),
                    'birthday' => $request->input('birthday'),
                    'bi' => $request->input('bi'),
                    'photo' => $nameFile,
                    'phone' => $request->input('phone'),
                    'adress' => $request->input('adress'),
                ];

                \DB::table('people')
                    ->where('id', $id)
                    ->update($person);

                $user = [
                    'email' => $request->input('email'),
                    'people_id' => $id,
                ];

                $aux_user = User::where('people_id', $id)->first();

                \DB::table('users')
                    ->where('id', $aux_user->id)
                    ->update($user);

                $request->session()->flash('success', 'Dados actualizado com sucesso');

                if (session('success')) {
                    Alert::toast(session('success'), 'success');
                }

                return redirect()->back();
            }
        } catch (\Exception $e) {
            $request->session()->flash('error', 'Ops! Verifique os dados e tenta novamente');

            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }



    public function workerProfileUpdatePasswordSave(Request $request, $id)
    {
        try {
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $id = decrypt($id);

            $validator = Validator::make($request->all(), [
                'newPassword' => 'required|min:6',
                'confiPassword' => 'required|min:6|same:newPassword',
                'email' => 'required|email',
            ], [
                'newPassword.required' => 'Preenche o campo nova senha',
                'newPassword.min' => 'Nova senha deve ter no mínimo 6 caracteres',
                'confiPassword.min' => 'Confirma senha deve ter no mínimo 6 caracteres',
                'confiPassword.same' => 'Confirma senha deve ser igual a senha',
                'confiPassword.required' => 'Preenche o campo confirma senha',
                'email.required' => 'Preenche o campo email',
                'email.email' => 'Informe um email valido',
            ]);

            if ($validator->fails()) {
                session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back()->withErrors($validator->errors())->withInput();
            } else {

                if ($request->input('newPassword') != $request->input('confiPassword')) {
                    return redirect()->back()->with('warning', 'Senhas não coencidem');
                }

                $user = [
                    'password' => Hash::make($request->input('newPassword')),
                ];

                $aux_user = User::where('people_id', $id)->first();

                \DB::table('users')
                    ->where('id', $aux_user->id)
                    ->update($user);

                $request->session()->flash('success', 'Senha actualizada com sucesso');

                if (session('success')) {
                    Alert::toast(session('success'), 'success');
                }

                return redirect()->back();
            }
        } catch (\Exception $e) {

            dd('Estoou aqui');
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }


    public function workerRegister()
    {
        if (Gate::denies('only-admin')) {
            session()->flash('error', 'Não tem permissão para acessar');

            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
        return view('painel.workers.register');
    }

    public function workerRegisterStore(Request $request)
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|String|min:3',
                'gender' => 'required',
                'bi' => 'required',
                'adress' => 'required',
                'ocupation' => 'required',
                'phone' => 'required|numeric',
                'birthday' => 'required',
                'email' => 'required|email|unique:users,email',
            ], [
                'name.required' => 'Preenche o campo nome',
                'name.min' => 'Informe um nome válido',
                'gender.required' => 'Preenche o campo gênero',
                'bi.required' => 'Preenche o campo BI',
                'adress.required' => 'Preenche o campo endereço',
                'ocupation.required' => 'Preenche o campo área funcional',
                'phone.required' => 'Preenche o campo telefone',
                'birthday.required' => 'Preenche o campo data de nascimento',
                'email.required' => 'Preenche o campo email',
                'email.email' => 'Informe um email valido',
                'email.unique' => 'Este email já foi registado no sistema',
            ]);

            if ($validator->fails()) {
                session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return response()->json($validator->errors(), 422);
            } {
                $person = [
                    'name' => $request->input('name'),
                    'gender_id' => $request->input('gender'),
                    'birthday' => $request->input('birthday'),
                    'bi' => $request->input('bi'),
                    'phone' => $request->input('phone'),
                    'adress' => $request->input('adress'),
                    'ocupation_id' => $request->input('ocupation'),
                ];
                $aux_person = People::create($person);
                $user = [
                    'email' => $request->input('email'),
                    'password' => Hash::make('goshopping'),
                    'people_id' => $aux_person->id,
                ];
                $aux_user = User::create($user);
                $roleUser = new RoleUser();
                $role_id = Role::where('type', 'user')->first()->id;
                $roleUser->user_id = $aux_user->id;
                $roleUser->role_id = $role_id;
                $roleUser->save();

                session()->flash('success', 'Dados registado com sucesso');
                if (session('success')) {
                    Alert::toast(session('success'), 'success');
                }
                return response()->json($request);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function products()
    {


            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $result = \DB::table('products')
                ->join('photos', function ($join) {
                    $join->on('products.id', '=', 'photos.product_id')
                        ->where([['products.active', '=', 1]]);
                })
                ->join('categories', function ($join) {
                    $join->on('categories.id', '=', 'products.category_id')
                        ->where([['categories.active', '=', 1]]);
                })
                ->join('stocks', function ($join) {
                    $join->on('products.id', '=', 'stocks.product_id')
                        ->where([['products.active', '=', 1]]);
                })
                ->select('products.*', 'photos.photo', 'stocks.qty as stock')
                ->get();

            $function = new Product();
            $products = $function->productsGroupByID($result);

            return view('painel.products.list', compact('products'));
        
    }


    public function productRegister()
    {
        if (Gate::denies('only-admin')) {
            session()->flash('error', 'Não tem permissão para acessar');

            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
        return view('painel.products.register');
    }


    public function productRegisterStore(Request $request)
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }


            $validator = Validator::make($request->all(), [
                'name' => 'required|String',
                'category' => 'required',
                'brade' => 'required',
                'style' => 'required',
                'price' => 'required|numeric',
                'collaborator' => 'required',
                'size' => 'required',
                'specification' => 'required|min:15|max:255',
                'description' => 'required|min:15|max:255',
                'photo[]' => 'mimes:jpeg,png,jpg,webp',
                'onsale' => 'required',
                'condition' => 'required',
                'stock' => 'required|numeric',
            ], [
                'name.required' => 'Preenche o campo nome',
                'category.required' => 'Preenche o campo categoria',
                'brade.required' => 'Preenche o campo marca',
                'style.required' => 'Preenche o campo estilo',
                'price.numeric' => 'Informe um preço unitário válido',
                'stock.numeric' => 'Informe uma qty. fornecida válida',
                'price.required' => 'Preenche o campo preço unitário',
                'collaborator.required' => 'Preenche o campo fornecedor',
                'size.required' => 'Preenche o campo tamanho',
                'specification.required' => 'Preenche o campo introdução',
                'specification.min' => 'Especificação deve ter no mínimo 15 caracteres',
                'specification.max' => 'Especificação deve ter no máximo 255 caracteres',
                'description.min' => 'Descrição deve ter no mínimo 15 caracteres',
                'description.max' => 'Descrição deve ter no máximo 255 caracteres',
                'description.required' => 'Preenche o campo descrição',
                'photo[].mimes' => 'Informe um fotografias válidas (.jpeg, .jpg, .png, .webp)',
                'onsale.required' => 'Preenche o campo promoção',
                'condition.required' => 'Preenche o campo condição',
                'stock.required' => 'Preenche o campo qty. fornecida',
            ]);

            if ($validator->fails()) {
                session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return response()->json($validator->errors(), 422);
            } else {
                if ($request->hasFile('photo')) {

                    $product = [
                        'name' => $request->input('name'),
                        'slug' => Str::slug($request->input('name')),
                        'category_id' => $request->input('category'),
                        'brade_id' => $request->input('brade'),
                        'style_id' => $request->input('style'),
                        'size' => $request->input('size'),
                        'price' => $request->input('price'),
                        'descount' => ($request->input('descount') == null) ? 0 : $request->input('descount'),
                        'collaborator_id' => $request->input('collaborator'),
                        'sale_id' => $request->input('onsale'),
                        'condition_id' => $request->input('condition'),
                        'description' => $request->input('description'),
                        'specification' => $request->input('specification'),
                    ];
                    $aux_product = Product::create($product);

                    /* Store stock */
                    $stock = new Stock();
                    $stock->product_id = $aux_product->id;
                    $stock->collaborator_id = $request->input('collaborator');
                    $stock->qty = $request->input('stock');
                    $stock->save();

                    foreach ($request->file('photo') as $file) {
                        if ($file->isValid()) {
                            $nameFile = null;
                            $name = uniqid(date('HisYmd'));
                            $extension = $file->extension();
                            $nameFile = "{$name}.{$extension}";
                            $upload = $file->storeAs('products', $nameFile);

                            if (!$upload) {
                            }

                            $foto = new Photo();
                            $foto->product_id = $aux_product->id;
                            $foto->photo = $nameFile;
                            $foto->save();
                        }
                    }

                    session()->flash('success', 'Dados registado com sucesso');
                    if (session('success')) {
                        Alert::toast(session('success'), 'success');
                    }
                    return response()->json($request);
                }
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function productUpdate($id)
    {
        try {
            if (Gate::denies('just-admin-and-manager')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            $id = decrypt($id);

            $product = Product::find($id);
            return view('painel.products.update', compact('product'));
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }
    public function productRemove($id)
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $id = decrypt($id);

            $product = Product::find($id);
            $product->active = 0;
            $product->save();


            if (Session::has('cart')) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $products = $cart->items;

                foreach ($products as $innerProduct) {
                    if ($innerProduct['item']['id'] == $id) {
                        $cart->removeItem($product->id);
                        if (count($cart->items) > 0) {
                            Session::put('cart', $cart);
                        } else {
                            Session::forget('cart');
                        }
                    }
                }
            }

            session()->flash('warning', 'Dados removido com sucesso');

            if (session('warning')) {
                Alert::toast(session('warning'), 'warning');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function productUpdateSave(Request $request)
    {
        try {

            if (Gate::denies('just-admin-and-manager')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $id = $request->input('id');

            $validator = Validator::make($request->all(), [
                'name' => 'required|String',
                'category' => 'required',
                'brade' => 'required',
                'style' => 'required',
                'price' => 'required|numeric',
                'size' => 'required',
                'specification' => 'required|min:15|max:255',
                'description' => 'required|min:15|max:255',
                'photo[]' => 'mimes:jpeg,png,jpg,webp',
                'onsale' => 'required',
                'condition' => 'required',
            ], [
                'name.required' => 'Preenche o campo nome',
                'category.required' => 'Preenche o campo categoria',
                'brade.required' => 'Preenche o campo marca',
                'style.required' => 'Preenche o campo estilo',
                'price.numeric' => 'Informe um preço unitário válido',
                'price.required' => 'Preenche o campo preço unitário',
                'size.required' => 'Preenche o campo tamanho',
                'specification.required' => 'Preenche o campo introdução',
                'specification.min' => 'Especificação deve ter no mínimo 15 caracteres',
                'specification.max' => 'Especificação deve ter no máximo 255 caracteres',
                'description.min' => 'Descrição deve ter no mínimo 15 caracteres',
                'description.max' => 'Descrição deve ter no máximo 255 caracteres',
                'description.required' => 'Preenche o campo descrição',
                'photo[].mimes' => 'Informe um fotografias válidas (.jpeg, .jpg, .png, .webp)',
                'onsale.required' => 'Preenche o campo promoção',
                'condition.required' => 'Preenche o campo condição',
            ]);

            if ($validator->fails()) {
                session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return response()->json($validator->errors(), 422);
            } else {
                $product = [
                    'name' => $request->input('name'),
                    'slug' => Str::slug($request->input('name')),
                    'category_id' => $request->input('category'),
                    'brade_id' => $request->input('brade'),
                    'style_id' => $request->input('style'),
                    'size' => $request->input('size'),
                    'price' => $request->input('price'),
                    'descount' => $request->input('descount'),
                    'sale_id' => $request->input('onsale'),
                    'condition_id' => $request->input('condition'),
                    'description' => $request->input('description'),
                    'specification' => $request->input('specification'),
                ];

                \DB::table('products')
                    ->where('id', $id)
                    ->update($product);

                if ($request->hasFile('photo')) {
                    foreach ($request->file('photo') as $file) {
                        if ($file->isValid()) {
                            $nameFile = null;
                            $name = uniqid(date('HisYmd'));
                            $extension = $file->extension();
                            $nameFile = "{$name}.{$extension}";
                            $upload = $file->storeAs('products', $nameFile);

                            if (!$upload) {
                            }

                            if (Photo::where('product_id', $id)->get()->count() < 3) {
                                /* Pode aumentar nº fotos do produto sem apagar as que já existem rotuladas ao produto */
                                $foto = new Photo();
                                $foto->product_id = $id;
                                $foto->photo = $nameFile;
                                $foto->save();
                            } else {
                                $aux = Photo::where('product_id', $id)->first();
                                \DB::table('photos')
                                    ->where('id', $aux->id)
                                    ->delete();
                                /* Apagar a foto mais recente  rotulada ao produto e só depois adiciona a nova, visto que já existiam 3 fotos do produto */
                                $foto = new Photo();
                                $foto->product_id = $id;
                                $foto->photo = $nameFile;
                                $foto->save();
                            }
                        }
                    }
                }

                if (Session::has('cart')) {
                    $oldCart = Session::get('cart');
                    $cart = new Cart($oldCart);
                    $products = $cart->items;

                    $product = Product::find($id);

                    foreach ($products as $innerProduct) {
                        if ($innerProduct['item']['id'] == $id) {
                            $cart->removeItem($product->id);
                            if (count($cart->items) > 0) {
                                Session::put('cart', $cart);
                            } else {
                                Session::forget('cart');
                            }
                        }
                    }
                }

                session()->flash('success', 'Dados actualizado com sucesso');
                if (session('success')) {
                    Alert::toast(session('success'), 'success');
                }
                return response()->json($request);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }


    public function workers()
    {
        try {
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $workers = \DB::table('people')
                ->join('users', function ($join) {
                    $join->on('users.people_id', '=', 'people.id')
                        ->where([['users.active', '=', 1]]);
                })
                ->join('genders', 'genders.id', '=', 'people.gender_id')
                ->join('role_users', 'role_users.user_id', '=', 'users.id')
                ->join('roles', function ($join) {
                    $join->on('roles.id', '=', 'role_users.role_id')
                        ->where([['roles.type', '!=', 'client']]);
                })
                ->join('ocupations', 'ocupations.id', '=', 'people.ocupation_id')
                ->select('people.*', 'people.name', 'genders.type as gender', 'people.phone', 'users.email', 'ocupations.type as ocupation')
                ->get();
            return view('painel.workers.list', compact('workers'));
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }


    public function workerUpdate($id)
    {
        if (Gate::denies('just-admin-and-manager')) {
            session()->flash('error', 'Não tem permissão para acessar');

            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
        $id = decrypt($id);
        $person = People::where('id', $id)->first();

        return view('painel.workers.update', compact('person'));
    }

    public function workerUpdateSave(Request $request)
    {
        try {
            if (Gate::denies('just-admin-and-manager')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $id = $request->input('id');


            $validator = Validator::make($request->all(), [
                'name' => 'required|String|min:3',
                'gender' => 'required',
                'bi' => 'required',
                'adress' => 'required',
                'ocupation' => 'required',
                'phone' => 'required|numeric',
                'birthday' => 'required',
                'email' => 'required|email',
            ], [
                'name.required' => 'Preenche o campo nome',
                'name.min' => 'Informe um nome válido',
                'gender.required' => 'Preenche o campo gênero',
                'bi.required' => 'Preenche o campo BI',
                'adress.required' => 'Preenche o campo endereço',
                'ocupation.required' => 'Preenche o campo área funcional',
                'phone.required' => 'Preenche o campo telefone',
                'birthday.required' => 'Preenche o campo data de nascimento',
                'email.required' => 'Preenche o campo email',
                'email.email' => 'Informe um email valido',
            ]);

            if ($validator->fails()) {
                session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return response()->json($validator->errors(), 422);
            } else {
                $person = [
                    'name' => $request->input('name'),
                    'gender_id' => $request->input('gender'),
                    'birthday' => $request->input('birthday'),
                    'bi' => $request->input('bi'),
                    'phone' => $request->input('phone'),
                    'adress' => $request->input('adress'),
                    'ocupation_id' => $request->input('ocupation'),
                ];


                \DB::table('people')
                    ->where('id', $id)
                    ->update($person);

                $user = [
                    'email' => $request->input('email'),
                    'people_id' => $id,
                ];

                $aux_user = User::where('people_id', $id)->first();

                \DB::table('users')
                    ->where('id', $aux_user->id)
                    ->update($user);

                $request->session()->flash('success', 'Dados actualizado com sucesso');

                if (session('success')) {
                    Alert::toast(session('success'), 'success');
                }
                return response()->json($request);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function collaborators()
    {
        $function = new User();
        if ($function->isClient()) {
            return redirect()->route('store.products');
        }

        $all_collaborators = \DB::table('products')
            ->join('categories', function ($join) {
                $join->on('categories.id', '=', 'products.category_id')
                    ->where([['categories.active', '=', 1], ['products.active', '=', 1]]);
            })
            ->join('stocks', 'stocks.product_id', '=', 'products.id')
            ->join('collaborators', 'collaborators.id', '=', 'stocks.collaborator_id')
            ->selectRaw('stocks.collaborator_id, sum(qty) as qty, collaborators.id, collaborators.name, collaborators.description')
            ->groupBy('stocks.collaborator_id', 'collaborators.name', 'collaborators.id', 'collaborators.description')
            ->get();

        $function = new Collaborator();
        $all_collaborators = $function->collaboratorsGroupByID($all_collaborators);

        return view('painel.collaborators.list', compact('all_collaborators'));
    }

    public function orders()
    {
        $function = new User();
        if ($function->isClient()) {
            return redirect()->route('store.products');
        }

        $orders = \DB::table('orders')
            ->join('clients', function ($join) {
                $join->on('clients.id', '=', 'orders.client_id')
                    ->where([['orders.active', '=', 1]]);
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'clients.user_id')
                    ->where([['users.active', '=', 1]]);
            })
            ->join('people', 'people.id', '=', 'users.people_id')
            ->select('orders.*', 'people.name as client')
            ->get();

        return view('painel.orders.list', compact('orders'));
    }

    public function order($id)
    {
        $function = new User();
        if ($function->isClient()) {
            return redirect()->route('store.products');
        }

        $id = decrypt($id);

        $orders = \DB::table('orders')
            ->join('clients', function ($join) use ($id) {
                $join->on('clients.id', '=', 'orders.client_id')
                    ->where([['orders.state', '=', 'WA'], ['orders.active', '=', 1], ['orders.id', '=', $id]]);
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'clients.user_id')
                    ->where([['users.active', '=', 1]]);
            })
            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->join('products', 'products.id', '=', 'order_products.product_id')
            ->join('people', 'people.id', '=', 'users.people_id')
            ->select('order_products.*', 'products.name as product', 'products.descount', 'people.name as client')
            ->get();

        return view('painel.orders.order', compact('orders'));
    }


    public function orderDone($id)
    {
        $function = new User();
        if ($function->isClient()) {
            return redirect()->route('store.products');
        }

        $id = decrypt($id);

        $order = Order::find($id);

        $order->state = 'PA';
        $order->active = 0;
        $order->save();

        $order_products = OrderProduct::where('order_id', $order->id)->get();

        foreach ($order_products as $order_product) {
            $order_product->state = 'PA';
            $order_product->active = 0;
            $order_product->save();
        }

        session()->flash('success', 'Pedido finalizado com sucesso');
        if (session('error')) {
            Alert::toast(session('success'), 'success');
        }
        return redirect()->route('painel.orders');
    }

    public function categories()
    {
        $function = new User();
        if ($function->isClient()) {
            return redirect()->route('store.products');
        }

        $all_categories = \DB::table('products')
            ->join('categories', function ($join) {
                $join->on('categories.id', '=', 'products.category_id')
                    ->where([['categories.active', '=', 1], ['products.active', '=', 1]]);
            })
            ->join('stocks', 'stocks.product_id', '=', 'products.id')
            ->selectRaw('stocks.product_id, sum(qty) as qty,categories.cover, categories.name, categories.id, categories.description')
            ->groupBy('stocks.product_id', 'categories.name', 'categories.cover', 'categories.id', 'categories.description')
            ->get();

        $function = new Category();
        $all_categories = $function->categoriesGroupByID($all_categories);

        return view('painel.categories.list', compact('all_categories'));
    }



    public function categoryUpdateSave(Request $request, $id)
    {
        try {
            if (Gate::denies('just-admin-and-manager')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            Session::forget('cart');


            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $id = decrypt($id);

            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            $nameFile = Category::find($id)->cover;

            if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
                $name = uniqid(date('HisYmd'));
                $extension = $request->cover->extension();
                $nameFile = "{$name}.{$extension}";
                $upload = $request->cover->storeAs('categories', $nameFile);

                if (!$upload) {
                }
            }

            $category = [
                'name' => $request->input('name'),
                'slug' => Str::slug($request->input('name')),
                'cover' => $nameFile,
                'description' => $request->input('description'),
            ];

            \DB::table('categories')
                ->where('id', $id)
                ->update($category);

            $request->session()->flash('success', 'Dados actualizado com sucesso');

            if (session('success')) {
                Alert::toast(session('success'), 'success');
            }


            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function categoryRemove($id)
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            Session::forget('cart');

            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            $id = decrypt($id);

            $category = Category::find($id);
            $category->active = 0;
            $category->save();

            session()->flash('warning', 'Dados removido com sucesso');

            if (session('warning')) {
                Alert::toast(session('warning'), 'warning');
            }

            return redirect()->route('painel.categories');
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }


    public function bradeRegisterStore(Request $request)
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            $brade = new Brade();
            $brade->name = $request->input('name');
            $brade->slug = Str::slug($request->input('name'));
            $brade->description = $request->input('description');
            $brade->save();

            return response()->json($request);
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }


    public function categoryRegisterStore(Request $request)
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }


            $validator = Validator::make($request->all(), [
                'name' => 'required|String',
                'description' => 'required|min:15|max:255',
                'photo[]' => 'mimes:jpeg,png,jpg',
            ], [
                'name.required' => 'Preenche o campo nome',
                'description.min' => 'Descrição deve ter no mínimo 15 caracteres',
                'description.max' => 'Descrição deve ter no máximo 255 caracteres',
                'description.required' => 'Preenche o campo descrição',
                'photo[].mimes' => 'Informe um fotografias válidas (.jpeg, .jpg, .png)',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            } else {

                $nameFile = 'default.jpg';

                if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
                    $name = uniqid(date('HisYmd'));
                    $extension = $request->cover->extension();
                    $nameFile = "{$name}.{$extension}";
                    $upload = $request->cover->storeAs('categories', $nameFile);

                    if (!$upload) {
                    }
                }

                $category = new Category();
                $category->name = $request->input('name');
                $category->slug = Str::slug($request->input('name'));
                $category->cover = $nameFile;
                $category->description = $request->input('description');
                $category->save();

                return response()->json($request);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function collaboratorRegisterStore(Request $request)
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }


            $validator = Validator::make($request->all(), [
                'name' => 'required|String',
                'description' => 'required|min:15|max:255',
                'photo[]' => 'mimes:jpeg,png,jpg',
            ], [
                'name.required' => 'Preenche o campo nome',
                'description.min' => 'Descrição deve ter no mínimo 15 caracteres',
                'description.max' => 'Descrição deve ter no máximo 255 caracteres',
                'description.required' => 'Preenche o campo descrição',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            } else {
                $collaborator = new Collaborator();
                $collaborator->name = $request->input('name');
                $collaborator->description = $request->input('description');
                $collaborator->save();
                return response()->json($request);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }


    public function collaboratorUpdateSave(Request $request, $id)
    {
        try {
            if (Gate::denies('just-admin-and-manager')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $id = decrypt($id);

            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            $collaborator = [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ];

            \DB::table('collaborators')
                ->where('id', $id)
                ->update($collaborator);

            $request->session()->flash('success', 'Dados actualizado com sucesso');

            if (session('success')) {
                Alert::toast(session('success'), 'success');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function collaboratorRemove($id)
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            $id = decrypt($id);

            $collaborator = Collaborator::find($id);
            $collaborator->active = 0;
            $collaborator->save();

            session()->flash('warning', 'Dados removido com sucesso');

            if (session('warning')) {
                Alert::toast(session('warning'), 'warning');
            }

            return redirect()->route('painel.collaborators');
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }



    public function users()
    {
        try {
            if (Gate::denies('just-admin-and-manager')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            $users = \DB::table('role_users')
                ->join('users', function ($join) {
                    $join->on('users.id', '=', 'role_users.user_id')
                        ->where([['users.active', '=', 1]]);
                })
                ->join('roles', function ($join) {
                    $join->on('roles.id', '=', 'role_users.role_id')
                        ->where([['roles.type', '!=', 'client']]);
                })
                ->join('people', 'people.id', '=', 'users.people_id')
                ->join('genders', 'genders.id', '=', 'people.gender_id')
                ->select('people.id', 'people.photo', 'people.name', 'genders.type as gender', 'users.email', 'roles.type as role')
                ->get();

            return view('painel.users.list', compact('users'));
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function userUpdate($id)
    {
        if (Gate::denies('only-admin')) {
            session()->flash('error', 'Não tem permissão para acessar');

            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
        $id = decrypt($id);
        $people = People::where('id', $id)->first();
        return view('painel.users.update', compact('people'));
    }

    public function userUpdateSave(Request $request, $id)
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $id = decrypt($id);

            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            $people = [
                'name' => $request->input('name'),
                'gender_id' => $request->input('gender'),
            ];

            \DB::table('people')
                ->where('id', $id)
                ->update($people);


            $user = [
                'email' => $request->input('email'),
            ];

            $aux_people = People::find($id);


            \DB::table('users')
                ->where('people_id', $aux_people->id)
                ->update($user);

            $aux_user = User::where('people_id', $aux_people->id)->first();

            \DB::table('role_users')
                ->where('user_id', $aux_user->id)
                ->delete();

            $roleUser = new RoleUser();
            $role_id = Role::where('id', $request->input('role'))->first()->id;
            $roleUser->user_id = $aux_user->id;
            $roleUser->role_id = $role_id;
            $roleUser->save();

            $request->session()->flash('success', 'Dados actualizado com sucesso');

            if (session('success')) {
                Alert::toast(session('success'), 'success');
            }

            return redirect()->route('painel.users');
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function userRemove($id)
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            $id = decrypt($id);

            $user = User::where('people_id', $id)->first();
            $user->active = 0;
            $user->save();

            $people = People::find($id);
            $people->active = 0;
            $people->save();

            session()->flash('warning', 'Dados removido com sucesso');

            if (session('warning')) {
                Alert::toast(session('warning'), 'warning');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }



    public function stock()
    {
        try {

            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $photos = Photo::all();
            $function = new Stock();

            $stocks = $function->stocks();

            return view('painel.stock.list', compact('photos', 'stocks'));
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function stockUpdate(Request $request, $id)
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            Session::forget('cart');

            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            $id = decrypt($id);

            $aux_stock = Stock::find($id);
            $collab_id = $request->input('collaborator');

            $collab_exist = \DB::table('stocks')
                ->join('products', function ($join) use ($aux_stock) {
                    $join->on('products.id', '=', 'stocks.product_id')
                        ->where([['products.active', '=', 1], ['products.id', '=', $aux_stock->product_id]]);
                })
                ->join('categories', function ($join) {
                    $join->on('categories.id', '=', 'products.category_id')
                        ->where([['categories.active', '=', 1]]);
                })
                ->join('collaborators', function ($join) use ($collab_id) {
                    $join->on('collaborators.id', '=', 'stocks.collaborator_id')
                        ->where([['collaborators.active', '=', 1], ['collaborators.id', '=', $collab_id]]);
                })
                ->select('stocks.id')
                ->get();

            if (count($collab_exist)) {
                $stock = [
                    'product_id' => $aux_stock->product_id,
                    'collaborator_id' => $request->input('collaborator'),
                    'qty' => Stock::where('id', $collab_exist[0]->id)->first()->qty + $request->input('stock')
                ];

                \DB::table('stocks')
                    ->where('id', $collab_exist[0]->id)
                    ->update($stock);
            } else {
                $stock = new Stock();
                $stock->product_id = $aux_stock->product_id;
                $stock->collaborator_id = $request->input('collaborator');
                $stock->qty = $request->input('stock');
                $stock->save();
            }

            $request->session()->flash('success', 'Dados actualizado com sucesso');

            if (session('success')) {
                Alert::toast(session('success'), 'success');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }


    public function clientRemove($id)
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }
            Session::forget('cart');

            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            $id = decrypt($id);

            $user = User::where('people_id', $id)->first();
            $user->active = 0;
            $user->save();

            $people = People::find($id);
            $people->active = 0;
            $people->save();

            $client = Client::where('user_id', $user->id)->first();
            $client->active = 0;
            $client->save();

            session()->flash('warning', 'Dados removido com sucesso');

            if (session('warning')) {
                Alert::toast(session('warning'), 'warning');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function clients()
    {
        $function = new User();
        if ($function->isClient()) {
            return redirect()->route('store.products');
        }
        $clients = \DB::table('clients')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'clients.user_id')
                    ->where([['clients.active', '=', 1], ['users.active', '=', 1]]);
            })
            ->join('people', function ($join) {
                $join->on('people.id', '=', 'users.people_id')
                    ->where([['people.active', '=', 1]]);
            })
            ->join('genders', 'genders.id', '=', 'people.gender_id')
            ->select('people.id as people_id', 'people.name', 'people.photo', 'users.email', 'genders.type as gender')
            ->get();

        return view('painel.clients.list', compact('clients'));
    }

    public function categoryRepport()
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            session()->flash('success', 'Relatório emitido com sucesso');
            if (session('success')) {
                Alert::toast(session('success'), 'success');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function clientRepport()
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            session()->flash('success', 'Relatório emitido com sucesso');
            if (session('success')) {
                Alert::toast(session('success'), 'success');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function workerRepport()
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            session()->flash('success', 'Relatório emitido com sucesso');
            if (session('success')) {
                Alert::toast(session('success'), 'success');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function collaboratorRepport()
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            session()->flash('success', 'Relatório emitido com sucesso');
            if (session('success')) {
                Alert::toast(session('success'), 'success');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function productRepport()
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            session()->flash('success', 'Relatório emitido com sucesso');
            if (session('success')) {
                Alert::toast(session('success'), 'success');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function productByCategoryRepport()
    {
        try {
            if (Gate::denies('only-admin')) {
                session()->flash('error', 'Não tem permissão para acessar');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            session()->flash('success', 'Relatório emitido com sucesso');
            if (session('success')) {
                Alert::toast(session('success'), 'success');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }
}
