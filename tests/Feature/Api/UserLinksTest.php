<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Link;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserLinksTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_user_links()
    {
        $user = User::factory()->create();
        $links = Link::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.links.index', $user));

        $response->assertOk()->assertSee($links[0]->link);
    }

    /**
     * @test
     */
    public function it_stores_the_user_links()
    {
        $user = User::factory()->create();
        $data = Link::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.links.store', $user),
            $data
        );

        unset($data['user_id']);

        $this->assertDatabaseHas('links', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $link = Link::latest('id')->first();

        $this->assertEquals($user->id, $link->user_id);
    }
}
