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

class CommentApiTest extends TestCase
{
    use RefreshDatabase;

    // Use this if you need a fresh database for each test

    public function test_can_retrieve_comments_with_authenticated_user()
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

        // Create some comments associated with an article
        $article = ArticleFactory::new()->create([
            'title' => 'Test Article',
            'description' => 'This is a test article.',
            'user_id' => $user->id,
        ]);

        $comment1 = CommentFactory::new()->create([
            'article_id' => $article->id,
            'user_id' => $user->id,
            'comment' => 'First comment',
        ]);

        $comment2 = CommentFactory::new()->create([
            'article_id' => $article->id,
            'user_id' => $user->id,
            'comment' => 'Second comment',
        ]);

        // Retrieve comments using the Bearer token
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' =>  $token,
        ])->get('/api/v1/comment', [
            'search' => '',
            'article_id' => '',
        ]);

        // Assert that the response is successful
        $response->assertStatus(200) // Adjust based on your API's expected status code for retrieval
        ->assertJson([
            'isSuccess' => true,
            'code' => 200, // Adjust if your API returns a different code
            'result' => [
                [
                    'id' => $comment1->id,
                    'comment' => 'First comment',
                    'article_id' => $article->id,
                ],
                [
                    'id' => $comment2->id,
                    'comment' => 'Second comment',
                    'article_id' => $article->id,
                ],
            ],
        ]);
    }


    public function test_can_create_comment_with_authenticated_user()
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

        // Create an article to associate the comment with
        $article = ArticleFactory::new()->create([
            'title' => 'Test Article',
            'description' => 'This is a test article.',
            'user_id' => $user->id,
        ]);

        // Prepare the comment data
        $commentData = [
            'article_id' => $article->id, // Use the created article's ID
            'user_id' => $user->id,       // Use the created user's ID
            'comment' => 'salam',
        ];

        // Submit the comment using the Bearer token
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => $token,
            'Content-Type' => 'application/json',
        ])->postJson('/api/v1/comment', $commentData);

        // Assert that the response is successful
        $response->assertStatus(200) // Adjust based on your API's expected status code for creation
        ->assertJson([
            'isSuccess' => true,
            'code' => 200, // Adjust if your API returns a different code
            'message' => '', // Adjust based on your actual response
            'result' => null,
        ]);

        // Optionally, verify the comment was added to the database
        $this->assertDatabaseHas('comments', [
            'article_id' => $article->id,
            'user_id' => $user->id,
            'comment' => 'salam',
        ]);
    }
    public function test_can_update_comment_with_authenticated_user()
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

        // Create an article to associate the comment with
        $article = ArticleFactory::new()->create([
            'title' => 'Test Article',
            'description' => 'This is a test article.',
            'user_id' => $user->id,
        ]);

        // Create a comment to update
        $comment = CommentFactory::new()->create([
            'article_id' => $article->id,
            'user_id' => $user->id,
            'comment' => 'Original comment',
        ]);

        // Submit the PATCH request to update the comment using the Bearer token
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' =>  $token
        ])->patch('/api/v1/comment/' . $comment->id . '?_method=patch', [
            'comment' => 'salam222',
        ]);

        // Assert that the response is successful
        $response->assertStatus(200) // Adjust based on your API's expected status code for updates
        ->assertJson([
            'isSuccess' => true,
            'code' => 200, // Adjust if your API returns a different code
            'message' => '', // Adjust based on your actual response
            'result' => null
        ]);

        // Verify that the comment was updated in the database
        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'comment' => 'salam222',
        ]);
    }
    public function test_can_delete_comment_with_authenticated_user()
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

        // Create an article to associate the comment with
        $article = ArticleFactory::new()->create([
            'title' => 'Test Article',
            'description' => 'This is a test article.',
            'user_id' => $user->id,
        ]);

        // Create a comment to delete
        $comment = CommentFactory::new()->create([
            'article_id' => $article->id,
            'user_id' => $user->id,
            'comment' => 'This comment will be deleted',
        ]);

        // Submit the DELETE request to remove the comment using the Bearer token
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete('/api/v1/comment/' . $comment->id);

        // Assert that the response is successful
        $response->assertStatus(200) // Adjust based on your API's expected status code for deletion
        ->assertJson([
            'isSuccess' => true,
            'code' => 200, // Adjust if your API returns a different code
            'message' => '', // Adjust based on your actual response
        ]);

        // Verify that the comment was deleted from the database
        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);
    }
    public function test_can_retrieve_comment_with_authenticated_user()
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

        // Create an article to associate the comment with
        $article = ArticleFactory::new()->create([
            'title' => 'Test Article',
            'description' => 'This is a test article.',
            'user_id' => $user->id,
        ]);

        // Create a comment to retrieve
        $comment = CommentFactory::new()->create([
            'article_id' => $article->id,
            'user_id' => $user->id,
            'comment' => 'This is a test comment.',
        ]);

        // Submit the GET request to retrieve the comment using the Bearer token
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/v1/comment/' . $comment->id);

        // Assert that the response is successful
        $response->assertStatus(200) // Adjust based on your API's expected status code for retrieval
        ->assertJson([
            'isSuccess' => true,
            'code' => 200, // Adjust if your API returns a different code
            'result' => [
                'id' => $comment->id,
                'article_id' => $article->id,
                'comment' => 'This is a test comment.',
            ],
        ]);
    }
    public function test_can_like_comment_with_authenticated_user()
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

        // Create an article to associate the comment with
        $article = ArticleFactory::new()->create([
            'title' => 'Test Article',
            'description' => 'This is a test article.',
            'user_id' => $user->id,
        ]);

        // Create a comment to like
        $comment = CommentFactory::new()->create([
            'article_id' => $article->id,
            'user_id' => $user->id,
            'comment' => 'This is a test comment.',
        ]);

        // Prepare the data to like the comment
        $likeData = [
            'type' => 'like',
        ];

        // Submit the POST request to like the comment using the Bearer token
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->postJson('/api/v1/comment/' . $comment->id . '/like/or/dislike', $likeData);

        // Assert that the response is successful
        $response->assertStatus(200) // Adjust based on your API's expected status code for liking a comment
        ->assertJson([
            'isSuccess' => true,
            'code' => 200, // Adjust if your API returns a different code
            'message' => '', // Adjust based on your actual response
            'result' => [
                'totalLikes' => 1, // Adjust based on what your API returns
            ],
        ]);

        // Optionally, verify that the like was recorded in the database
        $this->assertDatabaseHas('comment_likes', [
            'comment_id' => $comment->id,
            'user_id' => $user->id,
        ]);
    }
}

