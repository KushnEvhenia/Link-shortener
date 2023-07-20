<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Link;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LinkTest extends TestCase
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
    public function it_gets_links_list()
    {
        $links = Link::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.links.index'));

        $response->assertOk()->assertSee($links[0]->link);
    }

    /**
     * @test
     */
    public function it_stores_the_link()
    {
        $data = Link::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.links.store'), $data);

        unset($data['user_id']);

        $this->assertDatabaseHas('links', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_link()
    {
        $link = Link::factory()->create();

        $user = User::factory()->create();

        $data = [
            'link' => $this->faker->text(255),
            'link_id' => $this->faker->text(255),
            'user_id' => $this->faker->text(255),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(route('api.links.update', $link), $data);

        unset($data['user_id']);

        $data['id'] = $link->id;

        $this->assertDatabaseHas('links', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_link()
    {
        $link = Link::factory()->create();

        $response = $this->deleteJson(route('api.links.destroy', $link));

        $this->assertModelMissing($link);

        $response->assertNoContent();
    }
}
