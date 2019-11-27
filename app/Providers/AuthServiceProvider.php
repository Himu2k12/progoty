<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isSuper',function ($user){
           if($user->role==1 && $user->access==1){
               return true;
           }else{
               return false;
           }
        });
        Gate::define('isFieldMan',function ($user){
            if($user->role==3 && $user->access==1){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('isSupervisor',function ($user){
            if($user->role==2 && $user->access==1){
                return true;
            }else{
                return false;
            }
        });
    }
}
