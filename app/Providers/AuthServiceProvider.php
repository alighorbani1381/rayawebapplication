<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
 
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

  
    public function boot()
    {
        $this->registerPolicies();
        $this->generateDynamicGates();       
    }

    # Configuration ACL (Access Control List) & Create Gates
    private function generateDynamicGates()
    {
         if (Schema::hasTable('permissions')) {
            $permissions = $this->getPermissions();
            foreach ($permissions as $permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $user->hasRole($permission->roles);
                });
            }
        }
    }

    # Get All Permission has Roles
    private function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
