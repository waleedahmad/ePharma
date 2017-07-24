<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'Waleed Ahmad',
                'email' => 'waleedgplus@gmail.com',
                'password' => Hash::make('binarystar'),
                'verified' => true,
                'type' => 'su',
                'verification_token'    =>  ''
            ]
        ];
        foreach($admins as $admin){
            $user = new \App\User();
            $user->name = $admin['name'];
            $user->email = $admin['email'];
            $user->password = $admin['password'];
            $user->verified = $admin['verified'];
            $user->type = $admin['type'];
            $user->verification_token = $admin['verification_token'];

            $user->save();
        }
    }
}
