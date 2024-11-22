<?php

namespace AngusDV\ParsNews\Test\Feature;

use AngusDV\ParsNews\Database\Factories\ApiUserFactory;
use AngusDV\ParsNews\Database\Factories\ArticleFactory;
use AngusDV\ParsNews\Entity\ApiUser;
use AngusDV\ParsNews\Entity\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleApiTest extends TestCase
{
    use RefreshDatabase;

    // Use this if you need a fresh database for each test

    public function test_can_get_articles_with_authenticated_user()
    {
        // Create a user
        $user = ApiUserFactory::new()->create([
            'password' => bcrypt($password = 'password'),
            'type' => 'api',
        ]);

        // Login to get the Bearer token
        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        // Check if the login was successful and get the Bearer token
        $response->assertStatus(200);
        $token = $response->json('result.accessToken');

        // Now use the Bearer token to access the articles API
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => $token,
            'Content-Type' => 'application/json',
        ])->json('GET', '/api/v1/article?page=1', [
            'search' => ''
        ]);

        // Assert that the response is successful
        $response->assertStatus(200)
            ->assertJson([
                'isSuccess' => true,
                'code' => 200,
                'currentPage' => 1,
                'totalPage' => 0,
                'perPage' => 10,
                'message' => '',
            ])
            ->assertJsonStructure([
                'result' => [
                    '*' => [ // Assuming 'result' is an array of articles
                        'id',
                        'title',
                        'description',
                        'primaryImage',
                    ],
                ],
            ]);
    }
    public function test_can_delete_article_with_authenticated_user()
    {
        // Create a user
        $user = ApiUserFactory::new()->create([
            'password' => bcrypt($password = 'password'),
            'type' => 'api',
        ]);

        // Login to get the Bearer token
        $loginResponse = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        // Check if the login was successful and get the Bearer token
        $loginResponse->assertStatus(200);
        $token = $loginResponse->json('result.accessToken');

        // Create an article to delete (make sure to adjust based on your model and factory)
        $article = ArticleFactory::new()->create(); // Assuming you have an Article factory

        // Now use the Bearer token to attempt to delete the article
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => $token,
            'Content-Type' => 'application/json',
        ])->json('DELETE', "/api/v1/article/{$article->id}");

        // Assert that the response is successful
        $response->assertStatus(200)
            ->assertJson([
                'isSuccess' => true,
                'code' => 200,
                'message' => '', // Adjust message based on your API response
            ]);

        // Check that the article exists but is soft deleted
        $this->assertNotNull(Article::onlyTrashed()->find($article->id)->deleted_at);
    }

    public function test_can_create_article_with_authenticated_user()
    {
        // Create a user
        $user = ApiUserFactory::new()->create([
            'password' => bcrypt($password = 'password'),
            'type' => 'api',
        ]);

        // Login to get the Bearer token
        $loginResponse = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        // Check if the login was successful and get the Bearer token
        $loginResponse->assertStatus(200);
        $token = $loginResponse->json('result.accessToken');

        // Prepare the file paths for the images
        $primaryImagePath = '/home/hsm/.cache/.fr-CKPaQZ/3000_images/combined_9.jpg';
        $attachmentPaths = [
            '/home/hsm/.cache/.fr-wPj6zv/3000_images/combined_6.jpg',
            '/home/hsm/.cache/.fr-iO3D2W/3000_images/combined_1.jpg',
            '/home/hsm/Desktop/qrcode/background.jpg',
        ];

        // Convert the attachment paths to UploadedFile instances
        $attachments = [];
        foreach ($attachmentPaths as $attachmentPath) {
            $attachments[] = new \Illuminate\Http\UploadedFile($attachmentPath, basename($attachmentPath));
        }

        // Create the article using the Bearer token
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/v1/article', [
            'title' => 'test',
            'description' => 'ddddd',
            'primary_image' => new \Illuminate\Http\UploadedFile($primaryImagePath, basename($primaryImagePath)),
            'attachments' => $attachments,
        ]);

        // Assert that the response is successful
        $response->assertStatus(201) // Adjust based on your API's expected status code for creation
        ->assertJson([
            'isSuccess' => true,
            'code' => 201, // Adjust if your API returns a different code
            'message' => 'Article created successfully.', // Adjust based on your actual response
        ])
            ->assertJsonStructure([
                'result' => [
                    'id',
                    'title',
                    'description',
                    'primaryImage',
                    'attachments' => [
                        '*' => [ // Assuming each attachment has an expected structure
                            'id',
                            'url',
                        ],
                    ],
                ],
            ]);
    }


}

