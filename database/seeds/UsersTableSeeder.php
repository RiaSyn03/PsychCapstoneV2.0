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
        User::truncate();
        DB::table('role_user')->truncate();
        DB::table('timeslots')->truncate();

        $adminRole = Role::where('name', 'admin') -> first();
        $councilourRole = Role::where('name', 'councilour') -> first();
        $studentRole = Role::where('name', 'student') -> first();

        $admin = User::create([
            'idnum' => '11111111',
            'fname' => 'Admin',
            'mname' => 'Ad',
            'lname' => 'Admin',
            'year' => '5',
            'email' => 'admin@admin.com',
            'password' => bcrypt ('admin')
        ]);

        $councilour = User::create([
            'idnum' => '22222222',
            'fname' => 'Councilour',
            'mname' => 'Co',
            'lname' => 'Councilour',
            'year' => '5',
            'email' => 'councilour@councilour.com',
            'password' => bcrypt ('councilour')

        ]);
        $jenny = User::create([
            'idnum' => '12102212',
            'fname' => 'Generosa',
            'mname' => 'Misa',
            'lname' => 'Arches',
            'year' => '0',
            'email' => 'jenny@jenny.com',
            'password' => bcrypt ('generosa')

        ]);

        $student = User::create([
            'idnum' => '33333333',
            
            'fname' => 'Student',
            'mname' => 'St',
            'lname' => 'Student',
            'year' => '5',
            'email' => 'student@student.com',
            'password' => bcrypt ('student')
        ]);

        $kyle = User::create([
            'idnum' => '15105515',
         
            'fname' => 'Kyle Christian',
            'mname' => 'Misa',
            'lname' => 'Arches',
            'year' => '4',
            'email' => 'kurumitokisaki0324@gmail.com',
            'password' => bcrypt ('Kurumitokisaki')
        ]);

        $admin -> roles() -> attach($adminRole);
        $councilour->roles()->attach($councilourRole);
        $jenny->roles()->attach($councilourRole);
        $student->roles()->attach($studentRole);
        $kyle->roles()->attach($studentRole);

        // factory(App\User::class, 5)->create();
    }


}