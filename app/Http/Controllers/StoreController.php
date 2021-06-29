<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use App\Models\Role;
use App\Models\Stock;
use App\Models\Client;
use App\Models\People;
use App\Models\Product;
use App\Models\Category;
use App\Models\RoleUser;
use App\Models\Ocupation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class StoreController extends Controller
{
    public function home()
    {
        return redirect()->route('store.products');
    }

    public function registerStore(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|min:3',
                'gender' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6',
            ], [
                'name.required' => 'Preenche o campo nome completo',
                'name.min' => 'Nome completo deve ter no mínimo 3 caracteres',
                'password.min' => 'Senha deve ter no mínimo 6 caracteres',
                'gender.required' => 'Preenche o campo gênero',
                'email.required' => 'Preenche o campo email',
                'email.email' => 'Informe um email válido',
                'password.required' => 'Preenche o campo senha',
            ]);

            if ($validator->fails()) {
                session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            } else {

                $person = [
                    'name' => $request->input('name'),
                    'gender_id' => $request->input('gender'),
                    'ocupation_id' => Ocupation::where('type', 'Outros')->first()->id,
                ];

                $aux_person = People::create($person);

                $user = [
                    'email' => $request->input('email'),
                    'people_id' => $aux_person->id,
                    'password' => Hash::make($request->input('password')),
                ];

                $aux_user = User::create($user);

                $client = new Client();
                $client->user_id = $aux_user->id;
                $client->save();

                $roleUser = new RoleUser();
                $role_id = Role::where('type', 'client')->first()->id;
                $roleUser->user_id = $aux_user->id;
                $roleUser->role_id = $role_id;
                $roleUser->save();

                $request->session()->flash('success', 'Cliente registado com sucesso');

                if (session('success')) {
                    Alert::toast(session('success'), 'success');
                }

                return redirect()->back();
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function loginStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ], [
                'email.required' => 'Preenche o campo email',
                'email.email' => 'Informe um email válido',
                'password.required' => 'Preenche o campo senha',
            ]);

            if ($validator->fails()) {
                session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            } else {
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

                        session()->flash('success', 'Login efectuado com sucesso');
                        if (session('success')) {
                            Alert::toast(session('success'), 'success');
                        }
                        return redirect()->back();
                    }
                }
                session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back()->with('lerror', 'Email ou senha não encontrado')->withInput($request->all());
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', $e->getMessage());
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('store.products');
    }

    public function products()
    {
        $products = \DB::table('products')
            ->join('categories', function ($join) {
                $join->on('categories.id', '=', 'products.category_id')
                    ->where([['categories.active', '=', 1], ['products.active', '=', 1], ['products.condition_id', '=', 1]]);
            })
            ->select('products.*')
            ->SimplePaginate(9);

        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $hproducts = $cart->items;
            $totalPrice = $cart->totalPrice;

            foreach ($hproducts as $hproduct) {
                if ($hproduct['item']['sale_id'] == 1 && $hproduct['item']['descount'] > 0) {
                    $totalPrice -= ($hproduct['item']['price'] - (($hproduct['item']['price'] * $hproduct['item']['descount']) / 100));
                }
            }
        } else {
            $totalPrice = 0;
            $hproducts = [];
        }
        $filterCategory = $filterBrand = 'todas';

        return view('store.products', compact('products', 'hproducts', 'totalPrice', 'filterCategory', 'filterBrand'));
    }

    public function productFilterByCategory($slug)
    {
        $filterCategory = $slug;
        $filterBrand ='todas';
        
        $products = \DB::table('products')
            ->join('categories', function ($join) use ($slug) {
                $join->on('categories.id', '=', 'products.category_id')
                    ->where([['categories.active', '=', 1], ['categories.slug', '=', $slug], ['products.active', '=', 1], ['products.condition_id', '=', 1]]);
            })
            ->select('products.*')
            ->SimplePaginate(9);

        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $hproducts = $cart->items;
            $totalPrice = $cart->totalPrice;

            foreach ($hproducts as $hproduct) {
                if ($hproduct['item']['sale_id'] == 1 && $hproduct['item']['descount'] > 0) {
                    $totalPrice -= ($hproduct['item']['price'] - (($hproduct['item']['price'] * $hproduct['item']['descount']) / 100));
                }
            }
        } else {
            $totalPrice = 0;
            $hproducts = [];
        }

        session()->flash('success', 'Filtro aplicado com sucesso');
        if (session('success')) {
            Alert::toast(session('success'), 'success');
        }
        return view('store.products', compact('products', 'hproducts', 'totalPrice', 'filterCategory','filterBrand'));
    }

    public function productFilterByBrand($slug)
    {
        $filterBrand = $slug;
        $filterCategory ='todas';
        
        $products = \DB::table('products')
            ->join('categories', function ($join) {
                $join->on('categories.id', '=', 'products.category_id')
                    ->where([['categories.active', '=', 1], ['products.active', '=', 1], ['products.condition_id', '=', 1]]);
            })
            ->join('brades', function ($join) use ($slug) {
                $join->on('brades.id', '=', 'products.brade_id')
                    ->where([['brades.slug', '=', $slug ]]);
            })
            ->select('products.*')
            ->SimplePaginate(9);

        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $hproducts = $cart->items;
            $totalPrice = $cart->totalPrice;

            foreach ($hproducts as $hproduct) {
                if ($hproduct['item']['sale_id'] == 1 && $hproduct['item']['descount'] > 0) {
                    $totalPrice -= ($hproduct['item']['price'] - (($hproduct['item']['price'] * $hproduct['item']['descount']) / 100));
                }
            }
        } else {
            $totalPrice = 0;
            $hproducts = [];
        }

        session()->flash('success', 'Filtro aplicado com sucesso');
        if (session('success')) {
            Alert::toast(session('success'), 'success');
        }
        return view('store.products', compact('products', 'hproducts', 'totalPrice', 'filterCategory','filterBrand'));
    }

    public function productDetails($id)
    {
        try {
            $id = decrypt($id);

            $product = \DB::table('products')
                ->join('photos', function ($join) use ($id) {
                    $join->on('products.id', '=', 'photos.product_id')
                        ->where([['products.active', '=', 1], ['products.id', '=', $id], ['products.condition_id', '=', 1]]);
                })
                ->join('categories', function ($join) {
                    $join->on('categories.id', '=', 'products.category_id')
                        ->where([['categories.active', '=', 1]]);
                })
                ->select('products.*', 'photos.photo')
                ->get();

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
                ->select('stocks.*', 'products.name as product', 'categories.name as category', 'products.id as product_id', 'collaborators.name as collaborator')
                ->get();

            $function = new Stock();
            $stocks = $function->stocksGroupByID($stockq);
            $qtd_stock = 0;
            foreach ($stocks as $item) {
                if ($product[0]->id == $item['product_id']) {
                    $qtd_stock = $item['qty'];
                }
            }

            $aux_category = Category::where('id', $product[0]->category_id)->first();

            /* Products you may like */
            $youMayLike = \DB::table('products')
                ->join('photos', function ($join) use ($id) {
                    $join->on('products.id', '=', 'photos.product_id')
                        ->where([['products.active', '=', 1], ['products.id', '!=', $id], ['products.condition_id', '=', 1]]);
                })
                ->join('categories', function ($join) use ($aux_category) {
                    $join->on('categories.id', '=', 'products.category_id')
                        ->where([['categories.active', '=', 1],  ['category_id', '=', $aux_category->id]]);
                })
                ->select('products.*', 'photos.photo')
                ->limit(4)
                ->get();

            $function = new Product();
            $youMayLike = $function->productsGroupByID($youMayLike);

            if (Session::has('cart')) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $hproducts = $cart->items;
                $totalPrice = $cart->totalPrice;

                foreach ($hproducts as $hproduct) {
                    if ($hproduct['item']['sale_id'] == 1 && $hproduct['item']['descount'] > 0) {
                        $totalPrice -= ($hproduct['item']['price'] - (($hproduct['item']['price'] * $hproduct['item']['descount']) / 100));
                    }
                }
            } else {
                $totalPrice = 0;
                $hproducts = [];
            }

            return view('store.product-details', compact('product', 'youMayLike', 'qtd_stock', 'hproducts', 'totalPrice'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function cart()
    {
        try {
            if (!Session::has('cart')) {
                return redirect()->back();
            }
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $hproducts = $cart->items;
            $totalPrice = $cart->totalPrice;

            foreach ($hproducts as $hproduct) {
                if ($hproduct['item']['sale_id'] == 1 && $hproduct['item']['descount'] > 0) {
                    $totalPrice -= ($hproduct['item']['price'] - (($hproduct['item']['price'] * $hproduct['item']['descount']) / 100));
                }
            }

            return view('store.cart', compact('hproducts', 'totalPrice'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getRemoveItem($id)
    {
        try {
            $id = decrypt($id);
            $product = Product::find($id);

            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->removeItem($product->id);

            if (count($cart->items) > 0) {
                Session::put('cart', $cart);
            } else {
                Session::forget('cart');
            }

            session()->flash('warning', 'Produto removido do carrinho');

            if (session('warning')) {
                Alert::toast(session('warning'), 'warning');
            }

            return redirect()->back()->with('success', 'Dados removido com sucesso');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAddToCart(Request $request, $id)
    {
        try {
            $id = decrypt($id);

            $product = Product::find($id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($product, $product->id);
            $request->session()->put('cart', $cart);

            $request->session()->flash('success', 'Produto adicionado no carrinho');

            if (session('success')) {
                Alert::toast(session('success'), 'success');
            }

            return redirect()->route('store.products');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
