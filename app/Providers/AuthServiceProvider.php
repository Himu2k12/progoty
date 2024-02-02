<?php

namespace App\Providers;

use App\StaffInfo;
use App\StaffInformation;
use Illuminate\Support\Facades\Auth;
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

        if (Auth::check()) {
            //$view->with('currentUser', Auth::user());
            $uid= Auth::user();
            $ProfilePhotos = StaffInfo::where('user_id',$uid->id)->first();
            if (!$ProfilePhotos==null){
                $sp = $ProfilePhotos->staff_photo;
                View::Share('dp',$sp);
            }else{
                View::Share('dp',null);
            }
        }

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
        Gate::define('isCashier',function ($user){
            if($user->role==4 && $user->access==1){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('isIT',function ($user){
            if($user->role==5 && $user->access==1){
                return true;
            }else{
                return false;
            }
        });
    }
}
