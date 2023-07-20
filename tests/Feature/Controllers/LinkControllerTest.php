<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Link;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LinkControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_links()
    {
        $links = Link::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('links.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.links.index')
            ->assertViewHas('links');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_link()
    {
        $response = $this->get(route('links.create'));

        $response->assertOk()->assertViewIs('app.links.create');
    }

    /**
     * @test
     */
    public function it_stores_the_link()
    {
        $data = Link::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('links.store'), $data);

        unset($data['user_id']);

        $this->assertDatabaseHas('links', $data);

        $link = Link::latest('id')->first();

        $response->assertRedirect(route('links.edit', $link));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_link()
    {
        $link = Link::factory()->create();

        $response = $this->get(route('links.show', $link));

        $response
            ->assertOk()
            ->assertViewIs('app.links.show')
            ->assertViewHas('link');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_link()
    {
        $link = Link::factory()->create();

        $response = $this->get(route('links.edit', $link));

        $response
            ->assertOk()
            ->assertViewIs('app.links.edit')
            ->assertViewHas('link');
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

        $response = $this->put(route('links.update', $link), $data);

        unset($data['user_id']);

        $data['id'] = $link->id;

        $this->assertDatabaseHas('links', $data);

        $response->assertRedirect(route('links.edit', $link));
    }

    /**
     * @test
     */
    public function it_deletes_the_link()
    {
        $link = Link::factory()->create();

        $response = $this->delete(route('links.destroy', $link));

        $response->assertRedirect(route('links.index'));

        $this->assertModelMissing($link);
    }
}
