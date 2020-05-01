<?php

namespace App\Domains\User;

use App\Support\Repository;

class UserRepository extends Repository
{
    public function getModel(): string
    {
        return User::class;
    }
}
