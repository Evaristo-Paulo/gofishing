<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Role;
use App\Models\Sold;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Client;
use App\Models\People;
use App\Models\Product;
use App\Models\Category;
use App\Models\RoleUser;
use App\Models\Ocupation;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
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

    
    public function contactUs(Request $request)
    {
        try{
            session()->flash('success', 'Mensagem enviada com sucesso');
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

    public function newsLetter(Request $request)
    {
        try{
            session()->flash('success', 'Subscrição realizada com sucesso');
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
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
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
            ->join('stocks', function ($join) {
                $join->on('products.id', '=', 'stocks.product_id')
                    ->where([['products.active', '=', 1]]);
            })
            ->select('products.*', 'stocks.qty as stock')
            ->paginate(9);

        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $hproducts = $cart->items;
            $totalPrice = $cart->totalPrice;
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
        $filterBrand = 'todas';

        $products = \DB::table('products')
            ->join('categories', function ($join) use ($slug) {
                $join->on('categories.id', '=', 'products.category_id')
                    ->where([['categories.active', '=', 1], ['categories.slug', '=', $slug], ['products.active', '=', 1], ['products.condition_id', '=', 1]]);
            })
            ->join('stocks', function ($join) {
                $join->on('products.id', '=', 'stocks.product_id')
                    ->where([['products.active', '=', 1]]);
            })
            ->select('products.*', 'stocks.qty as stock')
            ->paginate(9);

        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $hproducts = $cart->items;
            $totalPrice = $cart->totalPrice;
        } else {
            $totalPrice = 0;
            $hproducts = [];
        }

        session()->flash('success', 'Filtro aplicado com sucesso');
        if (session('success')) {
            Alert::toast(session('success'), 'success');
        }
        return view('store.products', compact('products', 'hproducts', 'totalPrice', 'filterCategory', 'filterBrand'));
    }

    public function productFilterByName(Request $request)
    {
        $filterCategory = 'todas';
        $filterBrand = 'todas';
        $slug = Str::slug($request->input('name'));

        $products = \DB::table('products')
            ->join('categories', function ($join) use ($slug) {
                $join->on('categories.id', '=', 'products.category_id')
                    ->where([['products.slug', 'like', '%' . $slug . '%']]);
            })
            ->join('stocks', function ($join) {
                $join->on('products.id', '=', 'stocks.product_id')
                    ->where([['products.active', '=', 1]]);
            })
            ->select('products.*', 'stocks.qty as stock')
            ->paginate(9);

        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $hproducts = $cart->items;
            $totalPrice = $cart->totalPrice;
             
        } else {
            $totalPrice = 0;
            $hproducts = [];
        }
        $search = true;

        session()->flash('success', 'Pesquisa efectuada com sucesso');
        if (session('success')) {
            Alert::toast(session('success'), 'success');
        }
        return view('store.products', compact('products', 'search', 'hproducts', 'totalPrice', 'filterCategory', 'filterBrand'));
    }


    public function productFilterByBrand($slug)
    {
        $filterBrand = $slug;
        $filterCategory = 'todas';

        $products = \DB::table('products')
            ->join('categories', function ($join) {
                $join->on('categories.id', '=', 'products.category_id')
                    ->where([['categories.active', '=', 1], ['products.active', '=', 1], ['products.condition_id', '=', 1]]);
            })
            ->join('brades', function ($join) use ($slug) {
                $join->on('brades.id', '=', 'products.brade_id')
                    ->where([['brades.slug', '=', $slug]]);
            })
            ->join('stocks', function ($join) {
                $join->on('products.id', '=', 'stocks.product_id')
                    ->where([['products.active', '=', 1]]);
            })
            ->select('products.*', 'stocks.qty as stock')
            ->paginate(9);

        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $hproducts = $cart->items;
            $totalPrice = $cart->totalPrice;

             
        } else {
            $totalPrice = 0;
            $hproducts = [];
        }

        session()->flash('success', 'Filtro aplicado com sucesso');
        if (session('success')) {
            Alert::toast(session('success'), 'success');
        }
        return view('store.products', compact('products', 'hproducts', 'totalPrice', 'filterCategory', 'filterBrand'));
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
                ->join('stocks', function ($join) {
                    $join->on('products.id', '=', 'stocks.product_id')
                        ->where([['products.active', '=', 1]]);
                })
                ->select('products.*', 'photos.photo', 'stocks.qty as stock')
                ->limit(4)
                ->get();

            $function = new Product();
            $youMayLike = $function->productsGroupByID($youMayLike);

            if (Session::has('cart')) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $hproducts = $cart->items;
                $totalPrice = $cart->totalPrice;
            } else {
                $totalPrice = 0;
                $hproducts = [];
            }

            return view('store.product-details', compact('product', 'youMayLike', 'qtd_stock', 'hproducts', 'totalPrice'));
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
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

            //dd():
            $stocks = Stock::all();

            return view('store.cart', compact('hproducts', 'totalPrice', 'stocks'));
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
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

                session()->flash('warning', 'Produto removido do carrinho');
                if (session('warning')) {
                    Alert::toast(session('warning'), 'warning');
                }
                return redirect()->route('store.products');
            }

            session()->flash('warning', 'Produto removido do carrinho');

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

    public function cartUpdatePrice(Request $request)
    {
        try {
            $product_array = $request->input('products');
            $qty_array = $request->input('qtys');

            Session::forget('cart');

            foreach ($product_array as $key => $id) {
                $qty = 0;
                do {
                    $product = Product::find($id);
                    $oldCart = Session::has('cart') ? Session::get('cart') : null;
                    $cart = new Cart($oldCart);
                    $cart->add($product, $product->id);
                    $request->session()->put('cart', $cart);
                    $qty++;
                } while ($qty < $qty_array[$key]);
            }


            $request->session()->flash('success', 'Carrinho actualizado com sucesso');

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

    public function cartUpdate(Request $request)
    {
        try {
            $product_array = $request->input('products');
            $qty_array = $request->input('qtys');

            Session::forget('cart');

            foreach ($product_array as $key => $id) {
                $qty = 0;
                do {
                    $product = Product::find($id);
                    $oldCart = Session::has('cart') ? Session::get('cart') : null;
                    $cart = new Cart($oldCart);
                    $cart->add($product, $product->id);
                    $request->session()->put('cart', $cart);
                    $qty++;
                } while ($qty < $qty_array[$key]);
            }


            $request->session()->flash('success', 'Carrinho actualizado com sucesso');

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

    public function getAddToCart(Request $request, $id)
    {
        try {
            $id = decrypt($id);

            $product = Product::find($id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);

            //dd( $product );
            $cart->add($product, $product->id);
            $request->session()->put('cart', $cart);

            $request->session()->flash('success', 'Produto adicionado no carrinho');

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

    public function checkout()
    {
        try {
            if (!Auth::check()) {
                session()->flash('error', 'Faça o login');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            $function = new User();
            if (!$function->isClient()) {
                session()->flash('error', 'Regista-se como cliente');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            if (!Session::has('cart')) {
                return redirect()->back();
            }
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $hproducts = $cart->items;
            $totalPrice = $cart->totalPrice;

             

            $kwanzaToDollar = (round((($totalPrice) / 644.5), 0));

            Stripe::setApiKey('sk_test_51J9qa8KrBI5BIIZaYGFkUd3PvsKcBlmcSOpI0HOz3YjJDFuyR13MGw1PGkvR4Cgtg8c43OELZ7bG7nvY9njOkseR00uWVvHqVK');
            $payment_intent = \Stripe\PaymentIntent::create([
                'amount' => $kwanzaToDollar * 100,
                'currency' => 'usd',
                'payment_method_types' => ['card'],
                'description' => 'Pagamento efectuado com cartão',
                'receipt_email' => Auth::user()->email,
            ]);

            $intent = $payment_intent->client_secret;

            return view('store.checkout', compact('hproducts', 'totalPrice', 'intent'));
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique sua internet e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }

    public function confirmPayment()
    {
        try {
            if (!Auth::check()) {
                session()->flash('error', 'Faça o login');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            $function = new User();
            if (!$function->isClient()) {
                session()->flash('error', 'Regista-se como cliente');

                if (session('error')) {
                    Alert::toast(session('error'), 'error');
                }
                return redirect()->back();
            }

            if (!Session::has('cart')) {
                return redirect()->back();
            }

            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $products = $cart->items;
            $totalPrice = $cart->totalPrice;


            $client = Client::where('user_id', Auth::user()->id)->first();

            $order = [
                'client_id' => $client->id,
                'state' => 'WA',
                'payment' => $totalPrice,
            ];

            $order = Order::create($order);

            //Save sales and order_ product
            foreach ($products as $product) {
                $sold = new Sold();
                $sold->product_id = $product['item']['id'];
                $sold->qty = $product['qty'];
                $sold->save();

                $stock = Stock::where('product_id', $product['item']['id'])->first();
                $stock->qty -= $product['qty'];
                $stock->save();

                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $product['item']['id'];
                $orderProduct->state = 'WA';
                $orderProduct->qty =  $product['qty'];
                $orderProduct->payment = ($product['item']['sale_id'] == 1 && $product['item']['descount'] > 0) ? ($product['item']['price'] - (($product['item']['price'] * $product['item']['descount']) / 100)) * $product['qty'] : $product['item']['price'] * $product['qty'];
                $orderProduct->save();
            }

            Session::forget('cart');

            session()->flash('success', 'Pagamento efectuado com sucesso');
            if (session('success')) {
                Alert::toast(session('success'), 'success');
            }
            return redirect()->route('store.products');
        } catch (\Exception $e) {
            session()->flash('error', 'Ops! Verifique os dados e tenta novamente');
            if (session('error')) {
                Alert::toast(session('error'), 'error');
            }
            return redirect()->back();
        }
    }
}
