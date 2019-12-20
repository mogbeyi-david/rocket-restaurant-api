<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;


class AuthControllerTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function can_successfully_register_a_new_user()
    {
        DB::table('roles')->insert([
            'role' => 'CUSTOMER',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $response = $this->postJson('/api/register', [
            'firstname' => 'testFirstname',
            'lastname' => 'testLastname',
            'email' => 'mogbeyidavid@gmail.com',
            'phoneNumber' => '2349088765234',
            'password' => 'Kernel_23'
        ]);

        $response->assertStatus(201)->assertJson([
            "success" => true,
            "data" => [
                "firstname" => "testFirstname",
                "lastname" => "testLastname"
            ]
        ]);
    }
}
