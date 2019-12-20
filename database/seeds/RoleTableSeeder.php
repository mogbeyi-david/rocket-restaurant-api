<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Insert all the possible roles for users in the database
     *
     * @return void
     */
    public function run()
    {
        // Specify all the possible roles for users here
        $roles = ['CUSTOMER', 'DELIVERY DRIVER', 'ADMIN'];

        // Loop through the roles array and insert the new role into the role table
        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'role' => $role,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

    }
}
