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
                'contact' => '03014377011',
                'cnic' => '35202-4381672-9',
                'address' => '105 Hadyatullah Block, Mustafa Town Wahdat Road Lahore',
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
            $user->contact = $admin['contact'];
            $user->CNIC = $admin['cnic'];
            $user->address = $admin['address'];
            $user->verified = $admin['verified'];
            $user->type = $admin['type'];
            $user->verification_token = $admin['verification_token'];

            $user->save();
        }
    }
}
