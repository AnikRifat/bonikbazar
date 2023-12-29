<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //check module permission (if action value set (Ex.is_view) than check specific permission otherwise return full permission)
    public function checkPermission(string $module_slug, string $action=null){
        $role_id = Auth::guard('admin')->user()->role_id;
        if($role_id == SUPER_ADMIN){
            return ["is_view" => 1,"is_add" => 1,"is_edit" => 1, "is_delete" =>1];
        }
        $permission = RolePermission::join('modules', 'role_permissions.module_id', 'modules.id')->where('slug', $module_slug)->where('role_id', $role_id);
            if($action){
                $permission->where($action, 1);
            }
        $permission = $permission->where('status', 1)->selectRaw('role_permissions.*')->first();

        //if action not exist return full permission
        if(!$action){ return $permission; }
        if($permission){
            return true;
        }else{
            return false;
        }  
    }
}
