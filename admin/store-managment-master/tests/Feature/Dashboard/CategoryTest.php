<?php

namespace Tests\Feature\Dashboard;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
    * @test
    */
    public function can_get_category_list()
    {
        $this->login();

        $this->get('/dashboard/categories')
            ->assertHasProp('categories');
    }

    /**
     * @test
     */
    public function can_create_new_category()
    {

        $this->login();

        $this->post('/dashboard/categories', [
            'name' => 'name',
            'admin_commission' => 1 ,
            'marketer_commission' => 2,
            'package_price' => 3,
            'weight_avaliable' => true,
            'gram_price' => 2,
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'name',
            'admin_commission' => 1 ,
            'marketer_commission' => 2,
            'package_price' => 3,
            'weight_avaliable' => true,
            'gram_price' => 2,
        ]);
    }

    /**
     * @test
     */
    public function can_update_category()
    {
        $category = factory(Category::class)->create([
            'name' => 'Update',
        ]);


        $this->login();

        $this->put("/dashboard/categories/$category->id", [
            'name' => 'name',
            'admin_commission' => 1 ,
            'marketer_commission' => 2,
            'package_price' => 3,
            'weight_avaliable' => true,
            'gram_price' => 2,
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'name',
            'admin_commission' => 1 ,
            'marketer_commission' => 2,
            'package_price' => 3,
            'weight_avaliable' => true,
            'gram_price' => 2,
        ]);
    }

    /**
     * @test
     */
    public function can_delete_category()
    {
        $category = factory(Category::class)->create([
            'name' => 'Jone Doe',
        ]);


        $this->login();

        $this->delete("/dashboard/categories/$category->id");

        $this->assertDatabaseMissing('categories', ['name' => $category->name]);
    }
}
