<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Role getIdCustomerRole()
 */
class Role extends Model
{
    use HasFactory;

    public const ROLE_ADMIN_ALIAS = 'admin';

    public const ROLE_CUSTOMER_ALIAS = 'customer';

    public const ALL_ROLES = [
        self::ROLE_ADMIN_ALIAS => 'Admin',
        self::ROLE_CUSTOMER_ALIAS => 'Customer',
    ];

    protected $fillable = [
        'name'
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeGetCustomerRole($query): mixed
    {
        return $query->where('alias', self::ROLE_CUSTOMER_ALIAS)->first();
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeGetAdminRole($query): mixed
    {
        return $query->where('alias', self::ROLE_ADMIN_ALIAS)->first();
    }
}
