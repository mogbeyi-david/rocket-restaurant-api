<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\User;


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
    public function should_fail_to_register_a_user_for_bad_request()
    {
        DB::table('roles')->insert([
            'role' => 'CUSTOMER',
            'id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([
            'firstname' => 'testFirstname',
            'lastname' => 'testLastname',
            'email' => 'test@email.com',
            'phone_number' => "2349087767454",
            'password' => 'shodak_234'
        ]);

        $response = $this->postJson('/api/register', [
            'firstname' => 'testFirstname',
            'lastname' => 'testLastname',
            'email' => 'test@email.com',
            'phoneNumber' => '2349087767454',
            'password' => 'Kernel_23'
        ]);

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function should_fail_to_register_a_user_if_role_does_not_exist()
    {

        $response = $this->postJson('/api/register', [
            'firstname' => 'testFirstname',
            'lastname' => 'testLastname',
            'email' => 'mogbeyidavid@gmail.com',
            'phoneNumber' => '2349088765234',
            'password' => 'Kernel_23'
        ]);

        $response->assertStatus(500);
    }


    /**
     * @test
     */
    public function should_successfully_register_a_new_user()
    {
        DB::table('roles')->insert([
            'role' => 'CUSTOMER',
            'id' => 1,
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

//        var_dump($response->content());

        $response->assertStatus(201)->assertJson([
            "success" => true,
            "data" => [
                "firstname" => "testFirstname",
                "lastname" => "testLastname"
            ]
        ]);
    }
}
