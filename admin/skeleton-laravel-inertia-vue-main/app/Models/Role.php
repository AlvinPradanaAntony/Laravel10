<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'guard_name',
    ];

    /**
     * The permissions that belong to the role.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions');
    }

    public function hasPermission($role_id)
    {
        $roleHas = DB::table('Roles', 'r')
                        ->select('r.name', 'rhp.*')
                        ->leftJoin('role_has_permissions as rhp', 'r.id', '=', 'rhp.role_id')
                        ->where('rhp.role_id', '=', $role_id);

        $permissions = DB::table('permissions', 'p')
                        ->joinSub($roleHas, 'rh', function (JoinClause $join) {
                            $join->on('rh.permission_id', '=', 'p.id');
                        })->get();

        return $permissions;
    }
}
