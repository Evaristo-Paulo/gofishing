<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function people()
    {
        return $this->belongsTo(People::class);
    }

    public function isClient (){
        $function = new User();
        $user = $function->user(Auth::user()->email);

        return ($user[0]->role == 'client') ? true : false;
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    protected $fillable = [
        'email', 'password', 'people_id', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_users', 'user_id', 'role_id');
    }

    public function hasAnyRoles($roles)
    {
        if ($this->roles()->whereIn('type', $roles)->first()) {
            return true;
        }

        return false;
    }


    public function hasRole($role)
    {
        if ($this->roles()->where('type', $role)->first()) {
            return true;
        }

        return false;
    }

    public function array_first_occurence(array $arr)
    {
        foreach ($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }

    public function user($email){
        return \DB::select('select u.id, p.name, u.email, g.type as gender, r.type as role from people p, users u, role_users rs, roles r, genders g where u.id = rs.user_id and p.id = u.people_id and p.active = 1 and u.active = 1 and u.email = ? and rs.role_id = r.id and p.gender_id = g.id', [$email]);
    }

}
