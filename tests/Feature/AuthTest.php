<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public $email;
    public $password;

    public function __construct()
    {
        parent::__construct();
        $this->email = 'test@aa.aa';
        $this->password = 'test1234';
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_redirects_successfull()
    {
        $user = $this->createAUser();
        $response = $this->post('/login',['email' => $this->email, 'password' => bcrypt($this->password)]);

        $response->assertStatus(302);
        $response->assertRedirect('/');

    }

    public function test_unauthorized_redirect()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
        $response->assertRedirect('/login');

    }


    public function createAUser()
    {
        return User::create([
            'name' => 'Test User',
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);
    }



}
