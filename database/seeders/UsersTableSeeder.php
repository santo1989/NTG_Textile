<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UsersTableSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'role_id' => 1,
            'name' => 'Admin',
            'emp_id' => '0001',
            'email' => 'admin@ntg.com.bd',
            'email_verified_at' => now(),
            'picture' => 'avatar.png',
            'dob' => '1989-02-03',
            'joining_date' => '2019-02-03',
            'division_id' => '1',
            'company_id' => '1',
            'department_id' => '9',
            'designation_id' => '1',
            'password' => bcrypt('admin456'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'role_id' => 3,
            'name' => 'creator cpbs',
            'emp_id' => '002',
            'email' => 'cpbs@ntg.com.bd',
            'picture' => 'avatar.png',
            'dob' => '1989-02-03',
            'joining_date' => '2019-02-03',
            'division_id' => '1',
            'company_id' => '1',
            'department_id' => '9',
            'designation_id' => '8',
            'email_verified_at' => now(),
            'password' => bcrypt('cpbs123'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 5,
            'name' => 'creator qcs',
            'emp_id' => '003',
            'picture' => 'avatar.png',
            'dob' => '1989-02-03',
            'joining_date' => '2019-02-03',
            'division_id' => '1',
            'company_id' => '1',
            'department_id' => '9',
            'designation_id' => '6',
            'email' => 'qcs@ntg.com.bd',
            'email_verified_at' => now(),
            'password' => bcrypt('qcs456'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 4,
            'name' => 'Editor',
            'emp_id' => '004',
            'email' => 'editor@ntg.com.bd',
            'email_verified_at' => now(),
            'picture' => 'avatar.png',
            'dob' => '1984-02-03',
            'joining_date' => '2019-02-03',
            'division_id' => '1',
            'company_id' => '1',
            'department_id' => '15',
            'designation_id' => '6',
            'password' => bcrypt('987654321'),
            'remember_token' => Str::random(10),
        ]);

        //til fabrics 
        User::create([
            'role_id' => 6,
            'name' => 'Yarn Data Entry',
            'emp_id' => '006',
            'email' => 'yarn.til@ntg.com.bd',
            'picture' => 'avatar.png',
            'dob' => '1989-02-03',
            'joining_date' => '2019-02-03',
            'division_id' => '1',
            'company_id' => '1',
            'department_id' => '9',
            'designation_id' => '8',
            'email_verified_at' => now(),
            'password' => bcrypt('yarn123'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 7,
            'name' => 'Grey Data Entry',
            'emp_id' => '007',
            'picture' => 'avatar.png',
            'dob' => '1989-02-03',
            'joining_date' => '2019-02-03',
            'division_id' => '1',
            'company_id' => '1',
            'department_id' => '9',
            'designation_id' => '6',
            'email' => 'grey.til@ntg.com.bd',
            'email_verified_at' => now(),
            'password' => bcrypt('grey123'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 8,
            'name' => 'Editor Fabrics',
            'emp_id' => '008',
            'email' => 'fabrics_til@ntg.com.bd',
            'email_verified_at' => now(),
            'picture' => 'avatar.png',
            'dob' => '1984-02-03',
            'joining_date' => '2019-02-03',
            'division_id' => '1',
            'company_id' => '1',
            'department_id' => '15',
            'designation_id' => '6',
            'password' => bcrypt('fabrics123'),
            'remember_token' => Str::random(10),
        ]);

        //til garments 
        User::create([
            'role_id' => 9,
            'name' => 'fabrics Data Entry',
            'emp_id' => '009',
            'email' => 'fabrics.til@ntg.com.bd',
            'picture' => 'avatar.png',
            'dob' => '1989-02-03',
            'joining_date' => '2019-02-03',
            'division_id' => '1',
            'company_id' => '1',
            'department_id' => '9',
            'designation_id' => '8',
            'email_verified_at' => now(),
            'password' => bcrypt('fabrics123'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 10,
            'name' => 'Trims Data Entry',
            'emp_id' => '0010',
            'picture' => 'avatar.png',
            'dob' => '1989-02-03',
            'joining_date' => '2019-02-03',
            'division_id' => '1',
            'company_id' => '1',
            'department_id' => '9',
            'designation_id' => '6',
            'email' => 'trims.til@ntg.com.bd',
            'email_verified_at' => now(),
            'password' => bcrypt('trims123'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 11,
            'name' => 'Editor Garments',
            'emp_id' => '0011',
            'email' => 'garments.til@ntg.com.bd',
            'email_verified_at' => now(),
            'picture' => 'avatar.png',
            'dob' => '1984-02-03',
            'joining_date' => '2019-02-03',
            'division_id' => '1',
            'company_id' => '1',
            'department_id' => '15',
            'designation_id' => '6',
            'password' => bcrypt('garments123'),
            'remember_token' => Str::random(10),
        ]);





    }
}
