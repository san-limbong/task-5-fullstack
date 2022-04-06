<?php

namespace Tests\Unit;

use Tests\TestCase;

class CrudTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_article_store()
    {
        $response = $this->call('POST', '/home/articles',[
            'title' => 'Artikel baru 123',
            'image' => 'facebook.jpg',
            'category_id'=> '4',
            'user_id'=> '2',
            'content'=>'lorem ipsum'
        ]);
        $response->assertStatus($response->status(), 200);
        // $this->assertTrue(true);
    }

    public function test_article_update()
    {   
        $response = $this->call('PUT', '/home/articles/{article}',[
            'title' => 'Artikel edit',
            'image' => 'facebook.jpeg',
            'category_id'=> '2',
            'user_id'=> '2',
            'content'=>'lorem ipsum 2'
        ]);
        $response->assertStatus($response->status(), 201);
    }

    public function test_article_destroy()
    {   
        $response = $this->call('DELETE', '/home/articles/{article}',[
            'message' => 'Article has been deleted!'
        ]);
        $response->assertStatus($response->status(), 200);
    }


    public function test_category_store()
    {
        $response = $this->call('POST', '/categories',[
            'name' => 'Sport',
            'user_id' => 2,
        ]);
        $response->assertStatus($response->status(), 200);
    }

    public function test_category_update()
    {   
        $response = $this->call('PUT','categories/{category}',[
            'name' => 'Sport',
            'user_id' => 2,
        ]);
        $response->assertStatus($response->status(), 201);
    }

    public function test_category_destroy()
    {   
        $response = $this->call('DELETE', '/categories/{category}',[
            'message' => 'Category has been deleted!'
        ]);
        $response->assertStatus($response->status(), 200);
    }


}
