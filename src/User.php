<?php

namespace CCUPLUS\EloquentORM;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

/**
 * @property integer $id
 * @property string $username
 * @property string $nickname
 * @property string $email
 * @property string $token
 * @property Carbon|null $verified_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['verified_at'];
}
