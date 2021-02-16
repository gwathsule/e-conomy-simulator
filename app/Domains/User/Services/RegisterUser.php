<?php

namespace App\Domains\User\Services;

use App\Domains\User\User;
use App\Domains\User\UserRepository;
use App\Domains\User\Validators\RegisterUserValidator;
use App\Support\Service;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterUser extends Service
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function validate(array $data)
    {
        return (new RegisterUserValidator())->validate($data);
    }

    protected function perform(array $data, array $columns = ['*'], array $relations = [])
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->api_token = Str::random(80);
        $this->userRepository->save($user);
        return $user;
    }
}
