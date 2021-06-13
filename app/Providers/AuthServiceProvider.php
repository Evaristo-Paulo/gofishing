<?php

namespace App\Providers;

use App\User;
use App\Models\Role;
use App\Models\Sale;
use App\Models\Brade;
use App\Models\Photo;
use App\Models\Stock;
use App\Models\Style;
use App\Models\Gender;
use App\Models\People;
use App\Models\Product;
use App\Models\Category;
use App\Models\RoleUser;
use App\Models\Condition;
use App\Models\Ocupation;
use App\Models\Collaborator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (!app()->runningInConsole() || app()->runningUnitTests()) {
            Gate::define('just-admin-and-manager', function ($user) {
                return $user->hasAnyRoles(['admin', 'manager']);
            });

            Gate::define('only-admin', function ($user) {
                return $user->hasRole('admin');
            });

            Gate::define('is-Client', function ($user) {
                return $user->hasRole('client');
            });


            $genders = Gender::all();
            $roles = Role::all();
            $people = People::all();
            $users = User::all();
            $categories = Category::where('active', 1)->get();
            $brades = Brade::all();
            $collaborators = Collaborator::where('active', 1)->get();
            $ocupations = Ocupation::all();
            $conditions = Condition::all();
            $sales = Sale::all();
            $stockq = \DB::table('stocks')
                ->join('products', function ($join) {
                    $join->on('products.id', '=', 'stocks.product_id')
                        ->where([['products.active', '=', 1]]);
                })
                ->join('collaborators', function ($join) {
                    $join->on('collaborators.id', '=', 'stocks.collaborator_id')
                        ->where([['collaborators.active', '=', 1]]);
                })
                ->select('stocks.*', 'products.name as product', 'products.id as product_id', 'collaborators.name as collaborator')
                ->get();
            $styles = Style::all();
            $roles_users = RoleUser::all();
            $photos = Photo::all();
            View::share(compact('genders','photos', 'stockq', 'sales', 'conditions', 'styles', 'brades', 'collaborators', 'categories', 'ocupations', 'roles', 'people', 'roles_users', 'users'));
        }
    }
}
