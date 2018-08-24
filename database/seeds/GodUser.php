<?php

use Illuminate\Database\Seeder;
use App\Notifications\GodUserCreation;
use Illuminate\Support\Facades\DB;

class GodUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = \App\User::firstOrNew([
            'email' => 'god@gmail.com',
        ]);

        $psw = str_random(6);

        $user->name     = 'God';
        $user->last     = 'User';
        $user->full     = 'God User';
        $user->picture  = 'https://api.adorable.io/avatars/240/god@gmail.com.png';
        $user->role     = 'admin';
        $user->password = bcrypt($psw);

        $user->save();

        $user->notify(new GodUserCreation(['user' => $user, 'psw' => $psw]));

    }
}
