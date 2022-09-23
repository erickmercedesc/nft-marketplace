<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Hashids\Hashids;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'balance'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'permissions' => 'array',
        'is_admin' => 'boolean'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */

    public function Deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function Tokens()
    {
        return $this->belongsToMany(Token::class)->withPivot('price');
    }

    public function fixBalance()
    {
        $deposit_amount = $this->Deposits()->sum('amount');
        $token_purchased = $this->Tokens()->sum('token_user.price');

        $this->update([
            'balance' => $deposit_amount - $token_purchased
        ]);
    }
    
    public function MakeDeposit($depositData)
    {
        $newDeposit = $this->Deposits()->create($depositData);
        $this->fixBalance();
        return $newDeposit;
    }

    public function ScopeName($query, $name)
    {
        return $query->where('name', 'LIKE', "%$name%");
    }
}
