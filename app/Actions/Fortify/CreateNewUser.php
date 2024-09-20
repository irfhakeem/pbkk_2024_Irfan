<?php

namespace App\Actions\Fortify;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'nik' => ['required', 'string', 'digits:8'],
            'name' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'no_hp' => ['required', 'string', 'digits_between:1,12'],
            'Golongan_darah' => ['required', 'string', 'max:2'],
            'jenis_kelamin' => ['required', 'string', 'max:1'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        Patient::create([
            'nik' => $input['nik'],
            'name' => $input['name'],
            'email' => $input['email'],
            'tanggal_lahir' => $input['tanggal_lahir'],
            'no_hp' => $input['no_hp'],
            'Golongan_darah' => $input['Golongan_darah'],
            'jenis_kelamin' => $input['jenis_kelamin'],
        ]);

        $user->assignRole('patient');

        return $user;
    }
}
