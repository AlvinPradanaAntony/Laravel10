<?php

namespace Tests\Feature\Dashboard;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;
use function MongoDB\BSON\toJSON;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
    * @test
    */
    public function can_get_users_list()
    {
        $this->login();

        $this->get('/dashboard/users')
            ->assertHasProp('users');
    }

    /**
     * @test
     */
    public function can_create_new_user()
    {

        $permission = factory(Permission::class)->create();

        $this->login();

        $this->post('/dashboard/users', [
            'name' => 'Jone Doe',
            'username' => 'test',
            'phone' => '0123456789',
            'alt_phone' => '9876543210',
            'address' => 'Arkawet',
            'balance' => 50,
            'password' => 'password',
            'password_confirmation' => 'password',
            'permission' => $permission->id,
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Jone Doe',
            'username' => 'test',
            'phone' => '0123456789',
            'alt_phone' => '9876543210',
            'address' => 'Arkawet',
            'balance' => 50,
        ]);
    }

    /**
     * @test
     */
    public function can_update_user()
    {
        $user = factory(User::class)->create([
            'name' => 'Update',
        ]);

        $permission = factory(Permission::class)->create();

        $this->login();

        $this->put("/dashboard/users/$user->id", [
            'name' => 'Jone Doe',
            'username' => 'test',
            'phone' => '0123456789',
            'alt_phone' => '9876543210',
            'address' => 'Arkawet',
            'balance' => 50,
            'password' => 'password',
            'password_confirmation' => 'password',
            'permission' => $permission->id,
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Jone Doe',
            'username' => 'test',
            'phone' => '0123456789',
            'alt_phone' => '9876543210',
            'address' => 'Arkawet',
            'balance' => 50,
        ]);
    }

    /**
     * @test
     */
    public function can_delete_user()
    {
        $user = factory(User::class)->create([
            'name' => 'Jone Doe',
        ]);


        $this->login();

        $this->delete("/dashboard/users/$user->id");

        $this->assertDatabaseMissing('users', ['name' => $user->name]);
    }

}
