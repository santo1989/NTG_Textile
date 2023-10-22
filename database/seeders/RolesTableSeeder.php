<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin'
        ]);

        Role::create([
            'name' => 'General'
        ]);

        Role::create([
            'name' => 'Creator_cpbs'
        ]);

        Role::create([
            'name' => 'Editor'
        ]);

        Role::create([
            'name' => 'Creator_qcs'
        ]);
        //til
        Role::create([
            'name' => 'Creator_yarn'
        ]);
        Role::create([
            'name' => 'Creator_grey'
        ]);
        Role::create([
            'name' => 'Editor_fabrics'
        ]);
        Role::create([
            'name' => 'Creator_fabrics'
        ]);
        Role::create([
            'name' => 'Creator_trim'
        ]);
        Role::create([
            'name' => 'Editor_garments'
        ]);
        
    }
}
