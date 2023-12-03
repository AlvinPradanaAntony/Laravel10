<?php

namespace Tests\Feature\Dashboard;

use App\Category;
use App\Subcategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubcategoryTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_create_sub_category()
    {
        // $this->withExceptionHandling();
        $this->login();

        $category = factory(Category::class)->create();

        $this->post('/dashboard/subcategories', [
            'name' => 'name',
            'category_id' => $category->id,
        ]);

        $this->assertDatabaseHas('subcategories', [
            'name' => 'name',
            'category_id' => $category->id,
        ]);

    }

    /** @test */
    public function can_edit_sub_category(){

        // $this->withExceptionHandling();
        $this->login();

        $subcategory = factory(Subcategory::class)->create();

        $this->put('/dashboard/subcategories/'. $subcategory->id, [
            'name' => 'update',
            'category_id' => $subcategory->category->id,
        ]);

        $this->assertDatabaseHas('subcategories', [
            'name' => 'update',
            'category_id' => $subcategory->category->id,
        ]);

    }

    /** @test */
    public function can_delete_sub_category(){

        // $this->withExceptionHandling();
        $this->login();

        $subcategory = factory(Subcategory::class)->create();

        $this->delete('/dashboard/subcategories/'. $subcategory->id);

        $this->assertDatabaseMissing('subcategories', [
            'id' => $subcategory->id,
        ]);

    }

}



