<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Role;
use App\Models\Brade;
use App\Models\Photo;
use App\Models\Stock;
use App\Models\Client;
use App\Models\People;
use App\Models\Product;
use App\Models\Category;
use App\Models\RoleUser;
use App\Models\Collaborator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PainelController extends Controller
{

    public function home()
    {
        //Session::forget('cart');
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

        return view('painel.home', compact('qtd_products', 'qtd_clients', 'qtd_collabs'));
    }

    public function login()
    {
        return view('painel.login');
    }

    public function loginStore(Request $request)
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
            return redirect()->back()->with('errorMessage', 'Email ou senha não encontrada')->withInput($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', $e->getMessage());
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
            return $e->getMessage();
        }
    }

    public function workerProfileUpdateSave(Request $request, $id)
    {
        try {
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $id = decrypt($id);
            $nameFile = 'default.png';

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

            return redirect()->back()->with('success', 'Dados actualizado com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
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

            return redirect()->back()->with('success', 'Senha actualizada com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function workerRegister()
    {
        if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
        return view('painel.workers.register');
    }

    public function workerRegisterStore(Request $request)
    {
        try {
            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
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
                'password' => Hash::make('goshoping'),
                'people_id' => $aux_person->id,
            ];

            $aux_user = User::create($user);

            $roleUser = new RoleUser();
            $role_id = Role::where('type', 'user')->first()->id;
            $roleUser->user_id = $aux_user->id;
            $roleUser->role_id = $role_id;
            $roleUser->save();

            return response()->json($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function products()
    {

        try {

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
                ->select('products.*', 'photos.photo')
                ->get();

            $function = new Product();
            $products = $function->productsGroupByID($result);

            return view('painel.products.list', compact('products'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function productRegister()
    {
        if (Gate::denies('only-admin')) {
            return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
        }
        return view('painel.products.register');
    }


    public function productRegisterStore(Request $request)
    {
        try {
            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }

            if ($request->hasFile('photo')) {

                $product = [
                    'name' => $request->input('name'),
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
                return response()->json($request);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function productUpdate($id)
    {
        try {
            if (Gate::denies('just-admin-and-manager')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }

            Session::forget('cart');

            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }

            $id = decrypt($id);

            $product = Product::find($id);
            return view('painel.products.update', compact('product'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function productRemove($id)
    {
        try {
            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }

            Session::forget('cart');
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            $id = decrypt($id);

            $product = Product::find($id);
            $product->active = 0;
            $product->save();

            return redirect()->back()->with('success', 'Dados removido com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function productUpdateSave(Request $request)
    {
        try {
            
            if (Gate::denies('just-admin-and-manager')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            Session::forget('cart');

            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $id = $request->input('id');

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }


            $product = [
                'name' => $request->input('name'),
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

                return response()->json($request);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
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
            return $e->getMessage();
        }
    }


    public function workerUpdate($id)
    {
        if (Gate::denies('just-admin-and-manager')) {
            return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
        }
        $id = decrypt($id);
        $person = People::where('id', $id)->first();

        return view('painel.workers.update', compact('person'));
    }

    public function workerUpdateSave(Request $request)
    {
        try {
            if (Gate::denies('just-admin-and-manager')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $id = $request->input('id');

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }

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

            return response()->json($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function collaborators()
    {
        $function = new User();
        if ($function->isClient()) {
            return redirect()->back();
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

    public function categories()
    {
        $function = new User();
        if ($function->isClient()) {
            return redirect()->back();
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
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            Session::forget('cart');
            

            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $id = decrypt($id);

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
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
                'cover' => $nameFile,
                'description' => $request->input('description'),
            ];

            \DB::table('categories')
                ->where('id', $id)
                ->update($category);

            return redirect()->back()->with('success', 'Dados actualizado com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function categoryRemove($id)
    {
        try {
            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            Session::forget('cart');

            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            $id = decrypt($id);

            $category = Category::find($id);
            $category->active = 0;
            $category->save();

            return redirect()->route('painel.categories')->with('success', 'Dados removido com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function bradeRegisterStore(Request $request)
    {
        try {
            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }

            $brade = new Brade();
            $brade->name = $request->input('name');
            $brade->description = $request->input('description');
            $brade->save();

            return response()->json($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function categoryRegisterStore(Request $request)
    {
        try {
            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }

            $nameFile = null;

            if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
                $name = uniqid(date('HisYmd'));
                $extension = $request->cover->extension();
                $nameFile = "{$name}.{$extension}";
                $upload = $request->cover->storeAs('categories', $nameFile);

                if (!$upload) {
                }

                $category = new Category();
                $category->name = $request->input('name');
                $category->cover = $nameFile;
                $category->description = $request->input('description');
                $category->save();
            }

            return response()->json($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function collaboratorRegisterStore(Request $request)
    {
        try {
            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }

            $collaborator = new Collaborator();
            $collaborator->name = $request->input('name');
            $collaborator->description = $request->input('description');
            $collaborator->save();
            return response()->json($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function collaboratorUpdateSave(Request $request, $id)
    {
        try {
            if (Gate::denies('just-admin-and-manager')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $id = decrypt($id);

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }

            $collaborator = [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ];

            \DB::table('collaborators')
                ->where('id', $id)
                ->update($collaborator);

            return redirect()->back()->with('success', 'Dados actualizado com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function collaboratorRemove($id)
    {
        try {
            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            $id = decrypt($id);

            $collaborator = Collaborator::find($id);
            $collaborator->active = 0;
            $collaborator->save();

            return redirect()->route('painel.collaborators')->with('success', 'Dados removido com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



    public function users()
    {
        try {
            if (Gate::denies('just-admin-and-manager')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }

            $users = \DB::table('role_users')
                ->join('users', function ($join) {
                    $join->on('users.id', '=', 'role_users.user_id')
                        ->where([['users.active', '=', 1]]);
                })
                ->join('roles', 'role_users.role_id', '=', 'roles.id')
                ->join('people', 'people.id', '=', 'users.people_id')
                ->join('genders', 'genders.id', '=', 'people.gender_id')
                ->select('people.id', 'people.photo', 'people.name', 'genders.type as gender', 'users.email', 'roles.type as role')
                ->get();

            return view('painel.users.list', compact('users'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function userUpdate($id)
    {
        if (Gate::denies('only-admin')) {
            return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
        }
        $id = decrypt($id);
        $people = People::where('id', $id)->first();
        return view('painel.users.update', compact('people'));
    }

    public function userUpdateSave(Request $request, $id)
    {
        try {
            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $id = decrypt($id);

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
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

            return redirect()->route('painel.users')->with('success', 'Usuário actualizado com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function userRemove($id)
    {
        try {
            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }

            $id = decrypt($id);

            $user = User::where('people_id', $id)->first();
            $user->active = 0;
            $user->save();

            $people = People::find($id);
            $people->active = 0;
            $people->save();

            return redirect()->back()->with('success', 'Colaborador removido com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



    public function stock()
    {
        try {

            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            $stockq = \DB::table('stocks')
                ->join('products', function ($join) {
                    $join->on('products.id', '=', 'stocks.product_id')
                        ->where([['products.active', '=', 1]]);
                })
                ->join('categories', function ($join) {
                    $join->on('categories.id', '=', 'products.category_id')
                        ->where([['categories.active', '=', 1]]);
                })
                ->join('collaborators', function ($join) {
                    $join->on('collaborators.id', '=', 'stocks.collaborator_id')
                        ->where([['collaborators.active', '=', 1]]);
                })
                ->select('stocks.*', 'products.name as product', 'products.id as product_id', 'collaborators.name as collaborator')
                ->get();

            $photos = Photo::all();

            $function = new Stock();
            $stocks = $function->stocksGroupByID($stockq);

            return view('painel.stock.list', compact('photos', 'stocks'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function stockUpdate(Request $request, $id)
    {
        try {
            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            Session::forget('cart');

            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
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

            return redirect()->back()->with('success', 'Colaborador removido com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function clientRemove($id)
    {
        try {
            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
            }
            Session::forget('cart');

            $function = new User();
            if ($function->isClient()) {
                return redirect()->back();
            }

            if (Gate::denies('only-admin')) {
                return redirect()->back()->with('warning', 'Não tem permissão para realizar esta acção');
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

            return redirect()->back()->with('success', 'Colaborador removido com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function clients()
    {
        $function = new User();
        if ($function->isClient()) {
            return redirect()->back();
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
}
