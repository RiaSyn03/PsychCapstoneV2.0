<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $adminRole = Role::where('role_name', 'admin') -> first();
        // $counselorRole = Role::where('role_name', 'counselor') -> first();
        // $studentRole = Role::where('role_name', 'student') -> first();

        $admin = User::create([
            'role_id'=>'1',
            'course_id'=>'6',
            'idnum' => '15100278',
            'fname' => 'John Gio',
            'mname' => 'Gayo',
            'lname' => 'Alfanta',
            'year' => 'Non-Student',
            'email' => 'johnalfanta20@gmail.com',
            'password' => bcrypt ('admin')
        ]);

        $counselor = User::create([
            'role_id'=>'2',
            'course_id'=>'6',
            'idnum' => '15102502',
            'fname' => 'Katherine Mitz',
            'mname' => 'Cueva',
            'lname' => 'Lebrias',
            'year' => 'Non-Student',
            'email' => 'staceyjung69@gmail.com',
            'password' => bcrypt ('counselor')

        ]);

        $student = User::create([
            'role_id'=>'3',
            'course_id'=>'1',
            'idnum' => '15105515',
            'fname' => 'Kyle Christian',
            'mname' => 'Misa',
            'lname' => 'Arches',
            'year' => '4th Year',
            'email' => 'kurumitokisaki0324@gmail.com',
            'password' => bcrypt ('student')
        ]);

        // $admin->role()->attach($adminRole);
        // $counselor->role()->attach($counselorRole);
        // $student->role()->attach($studentRole);
    }
}
