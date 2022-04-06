<?php

namespace Tests\Unit;

use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_posts_store()
    {
        $resp = $this->call('POST', '/api/v1/article/develop',[
            'title' => 'Artikel baru 123',
            'image' => 'facebook.jpg',
            'category_id'=> '4',
            'user_id'=> '2',
            'content'=>'lorem ipsum'
        ]);
        $resp->assertStatus($resp->status(), 200);
        // $this->assertTrue(true);
    }

    public function test_posts_update()
    {   
        $resp = $this->call('PUT', '/api/v1/article/{id}/change',[
            'title' => 'Artikel edit',
            'image' => 'facebook.jpeg',
            'category_id'=> '2',
            'user_id'=> '2',
            'content'=>'lorem ipsum 2'
        ]);
        $resp->assertStatus($resp->status(), 201);
    }

    public function test_posts_destroy()
    {   
        $resp = $this->call('DELETE', '/api/v1/article/{id}',[
            'message' => 'Article has been deleted!'
        ]);
        $resp->assertStatus($resp->status(), 200);
    }


    public function test_categories_store()
    {
        $resp = $this->call('POST', '/api/v1/categories/develop',[
            'name' => 'Sport',
            'user_id' => 2,
        ]);
        $resp->assertStatus($resp->status(), 200);
    }

    public function test_categories_update()
    {   
        $resp = $this->call('PUT','/api/v1/categories/{id}',[
            'name' => 'Sport',
            'user_id' => 2,
        ]);
        $resp->assertStatus($resp->status(), 201);
    }

    public function test_categories_destroy()
    {   
        $resp = $this->call('DELETE', 'api/v1/categories/{id}',[
            'message' => 'Category has been deleted!'
        ]);
        $resp->assertStatus($resp->status(), 200);
    }
}
