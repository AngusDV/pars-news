<?php

namespace AngusDV\ParsNews\Test\Feature;

use AngusDV\ParsNews\Database\Factories\ApiUserFactory;
use AngusDV\ParsNews\Database\Factories\ArticleFactory;
use AngusDV\ParsNews\Entity\ApiUser;
use AngusDV\ParsNews\Entity\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
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


        // Create the article using the Bearer token
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/v1/article', [
            'title' => 'test',
            'description' => 'ddddd',
            'primary_image' =>UploadedFile::fake()->create('test3.png', 50)
        ]);

        // Assert that the response is successful
        $response->assertStatus(200) // Adjust based on your API's expected status code for creation
        ->assertJson([
            'isSuccess' => true,
            'code' => 200, // Adjust if your API returns a different code
            'message' => '', // Adjust based on your actual response
        ]);
    }


    public function test_can_update_article_with_authenticated_user()
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

        // Create an article that we will update
        $article = ArticleFactory::new()->create([
            'title' => 'Original Title',
            'description' => 'Original Description',
            'user_id' => $user->id, // Assuming articles are linked to users
        ]);

        // Update the article using the Bearer token
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' =>  $token,
        ])->patch('/api/v1/article/' . $article->id . '?_method=patch', [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
        ]);

        // Assert that the response is successful
        $response->assertStatus(200) // Adjust based on your API's expected status code for updates
        ->assertJson([
            'isSuccess' => true,
            'code' => 200, // Adjust if your API returns a different code
            'message' => '', // Adjust based on your actual response
        ]);

        // Verify that the article was updated in the database
        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => 'Updated Title',
            'description' => 'Updated Description',
        ]);
    }
    public function test_can_retrieve_article_with_authenticated_user()
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

        // Create an article to retrieve
        $article = ArticleFactory::new()->create([
            'title' => 'Test Article',
            'description' => 'This is a test article.',
            'user_id' => $user->id, // Assuming articles are linked to users
        ]);

        // Retrieve the article using the Bearer token
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/v1/article/' . $article->id);

        // Assert that the response is successful
        $response->assertStatus(200) // Adjust based on your API's expected status code for retrieval
        ->assertJson([
            'isSuccess' => true,
            'code' => 200, // Adjust if your API returns a different code
            'result' => [
                'id' => $article->id,
                'title' => 'Test Article',
                'description' => 'This is a test article.',
            ],
        ]);
    }

}

