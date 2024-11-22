<?php

namespace AngusDV\ParsNews\Test\Feature;

use AngusDV\ParsNews\Database\Factories\ApiUserFactory;
use AngusDV\ParsNews\Database\Factories\ArticleFactory;
use AngusDV\ParsNews\Database\Factories\CommentFactory;
use AngusDV\ParsNews\Entity\ApiUser;
use AngusDV\ParsNews\Entity\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AuthLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_login_with_valid_credentials()
    {
        // Create a user with known credentials
        $user = ApiUserFactory::new()->create([
            'email' => 'superadmin@test.com',
            'password' => bcrypt('123'), // Ensure the password is hashed
            'type' => 'api',
        ]);

        // Prepare the login data
        $loginData = [
            'email' => 'superadmin@test.com',
            'password' => '123',
        ];

        // Submit the login request
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->postJson('/api/v1/login', $loginData);

        // Assert that the response is successful
        $response->assertStatus(200) // Adjust based on your API's expected status code for successful login
        ->assertJson([
            'isSuccess' => true,
            'code' => 200, // Adjust if your API returns a different code
            'message' => '', // Adjust based on your actual response
            'result' => [
                'accessToken' => true, // Check if access token is returned
                // Optionally, you can check for other user details if needed
            ],
        ]);

        // Optionally, you can also assert the presence of the access token
        $this->assertNotEmpty($response->json('result.accessToken'));
    }
}

