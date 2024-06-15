<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run(): void
    {
        // Default credentials
        $users =  [
               [ 'name' => 'Left4code',
                'email' => 'midone@left4code.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'gender' => 'male',
                'type' => '1',
                'active' => 1,
                'remember_token' => Str::random(10)]
        ];
       
        foreach ($users as $user) { 
            $userAdd = User::where('email',$user['email'])->first(); 
            
            if(!$userAdd){
                $userAdd = new User();
            }
            $userAdd->name = $user['name'];
            $userAdd->email = $user['email'];
            $userAdd->email_verified_at = $user['email_verified_at'];
            $userAdd->password = $user['password'];
            $userAdd->gender = $user['gender'];
            $userAdd->type = $user['type'];
            $userAdd->active = $user['active']; 
            $userAdd->remember_token = $user['remember_token']; 
            $userAdd->save();
        } ;

        // Fake users
        // User::factory()->times(9)->create();
    }
}
