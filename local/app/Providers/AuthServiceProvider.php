<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Employee;

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
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        $gate->define('IsAdmin', function ($user) {
            return $user->ID_type_users == '1' || $user->ID_type_users == 9;
        });

        $gate->define('IsSale', function ($user) {
            return $user->ID_type_users == '2';
        });

        $gate->define('Chiefsales', function ($user) {
            return $user->ID_type_users == '2';
        });
        $gate->define('IsScrene', function ($user) {
            return $user->ID_type_users == '3';
        });

        $gate->define('IsTechnician', function ($user) {
            return $user->ID_type_users == '4';
        });

        $gate->define('IsQC', function ($user) {
            return $user->ID_type_users == '7';
        });

        $gate->define('IsFQC', function ($user) {
            return $user->ID_type_users == '5';
        });

        $gate->define('IsUser', function ($user) {
            return $user->ID_type_users == null;
        });

        $gate->define('IsService', function ($user) {
            return $user->ID_type_users == 6;
        });
        
        $gate->define('adminSale', function ($user) {
            return $user->ID_type_users == 8;
        });

        // $gate->define('supervisor', function ($user) {
        //     return $user->ID_type_users == 9;
        // });


        // $gate->define('IsSemener', function($user){
            // foreach ($employee_department as $data) {
            //     if ($user->id == $data->ID_user) {
            //         return $data->department =='8';
            //     }
            // }
            // foreach ($employee_user as $data) {
            //     if ($data->ID_user == 200) {
            //         return true;
            //     }
            // }
        //       return false;
        // });

        // $gate->define('IsSemener',function($user){
        //     $employee = Employee::select_employee();
        //     foreach ($employee as $data) {
        //         if ($user->ID_type_users == 2) {
        //             if($employee->id == 9){
        //                 return true;
        //             }
        //         }
        //     }
        //     return false;
        // });
    }
}
