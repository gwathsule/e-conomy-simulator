<?php

use Illuminate\Database\Seeder;
use App\Domains\User\User;
use App\Domains\User\UserRepository;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $repository = new UserRepository();

        //create normal user
        $user = new User();
        $user->name = 'User';
        $user->email = 'user@mail.com';
        $user->password = bcrypt('123');
        $repository->save($user);

        //create admin user
        $admin = new User();
        $admin->is_admin = true;
        $admin->name = 'Admin';
        $admin->email = 'admin@mail.com';
        $admin->password = bcrypt('admin');
        $repository->save($admin);
    }
}
