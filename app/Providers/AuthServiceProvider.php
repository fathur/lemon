<?php

namespace App\Providers;

use App\Role;
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

        $this->defineGates();
    }

    /**
     * @param $access
     *
     * @author Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    private function defineGate($access)
    {
        \Gate::define($access, function ($user) use ($access) {


            $userRole = Role::find($user->role_id);
            $permission = $userRole->permissions()->whereSlug($access)->first();

            if (!is_null($permission)) {
                return true;
            }

            return false;
        });
    }

    /**
     *
     * @author Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    private function defineGates()
    {
        foreach (\Config::get('auth.permissions') as $slug => $name) {
            $this->defineGate($slug);
        }
    }
}
