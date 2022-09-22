<?php

namespace App\Actions\Fortify;

use App\Models\CoinRemitter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Hashids\Hashids;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'referer_id' => ['nullable', 'string'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $hashids = new Hashids();
        $depositAddress = 'test';

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'referer_id' => (isset($input['referer_id'])) ? $hashids->decode($input['referer_id'])[0] : null,
            'password' => Hash::make($input['password']),
            'deposit_address' => $depositAddress
        ]);
    }
}
