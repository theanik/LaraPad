<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Articale;
use App\Category;
use Tests\TestCase;

class ArticaleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_articalpage_contains_empty_articals_table()
    {
        $response = $this->get('/articale');

         $response->assertStatus(200);

        $response->assertSee("No artical here");

       
    }


    public function test_articalpage_contains_not_empty_articals_table()
    {

        $cat = Category::create([
            'name' => 'cat2',
            'slug' => 'cat2'
        ]);

        $articale = Articale::create([
            'title' => 'Hello',
            'body' => 'This is body',
            'category_id' => $cat->id,
            'created_by' => 1
        ]);

        $response = $this->get('/articale');

        $response->assertDontSeeText("No artical here");

        $response->assertSee($articale->title);
        $response->assertSee($cat->name);


        $articale_view = $response->viewData('articales');

        // dd($articale_view);
        $this->assertEquals($articale->title, $articale_view->first()->title);
        $response->assertStatus(200);
        

       
    }
}
