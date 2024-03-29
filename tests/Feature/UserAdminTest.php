<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_a_user()
    {
        $response = $this->post(route('admin.users.store'), [
            'name'                  => 'Same Name',
            'email'                 => 'someemail@exemplo.com',
            'password'              => '12345678',
            'password_confirmation' => '12345678',
        ]);
        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    public function test_delete_a_user()
    {
        $user = User::factory()->create();
        $this->assertDatabaseCount(User::class, 1);
        $response = $this->delete(route('admin.users.destroy', $user->id));
        $response->assertSessionHas('success');
        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseCount(User::class, 0);
    }

    public function test_delete_a_unexists_user()
    {
        $response = $this->delete(route('admin.users.destroy', rand(9999, 9999999)));
        $response->assertSessionHas('error');
    }

    public function test_update_a_user()
    {
        $name = 'New Name';
        $user = User::factory()->create();
        $response = $this->put(route( 'admin.users.update', $user->id), compact('name'));
        $response->assertSessionHas('success');
        $userUpdated = User::find($user->id);
        $this->assertEquals($name, $userUpdated->name);
        $response->assertSessionHas('success');
    }

    public function test_update_a_unexist_user()
    {
        $response = $this->put(route( 'admin.users.update', PHP_INT_MAX), ['name' =>'name']);
        $response->assertSessionHas('error');
    }
}
