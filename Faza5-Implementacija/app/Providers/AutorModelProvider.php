<?php


namespace App\Providers;

use App\Models\KorisnikModel;
use Illuminate\Contracts\Auth\UserProvider;
use \Illuminate\Contracts\Auth\Authenticatable;

class AutorModelProvider implements UserProvider
{

    public function retrieveById($identifier)
    {
        return KorisnikModel::where('KorisnickoIme', $identifier)->first();
    }

    public function retrieveByToken($identifier, $token)
    {
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
    }

    public function retrieveByCredentials(array $credentials)
    {
        return KorisnikModel::where('KorisnickoIme', $credentials['korime'])->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return $user->getAuthPassword() == $credentials['lozinka'];
    }
}
