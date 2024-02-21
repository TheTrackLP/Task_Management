<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function getPermissionGroups(){
        $permi_groups = DB::table('permissions')
        ->select('group_name')
        ->groupBy('group_name')
        ->get();
        return $permi_groups;
    }

    public static function getpermissionByGroupName($group_name){
        $permissions = DB::table('permissions')
                            ->select('id', 'name')
                            ->where('group_name', $group_name)
                            ->get();
        return $permissions;
    }

    public static function roleHasPermissions($role, $permissions){
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if(!$role->HasPermissionTo($permission->name)){
                $hasPermission = false;
            }
        }
        return $hasPermission;
    }
}