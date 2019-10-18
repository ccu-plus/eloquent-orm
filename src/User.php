<?php

namespace CCUPLUS\EloquentORM;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

/**
 * @property integer $id
 * @property string $username
 * @property string $nickname
 * @property string|null $email
 * @property string $token
 * @property string $api_token
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

    /**
     * Get api token attribute.
     *
     * @return string
     */
    public function getApiTokenAttribute(): string
    {
        $hmac = hash_hmac('md5', $this->token, env('APP_KEY'), true);

        return sprintf('%s.%s', $this->token, base64_encode($hmac));
    }
}
