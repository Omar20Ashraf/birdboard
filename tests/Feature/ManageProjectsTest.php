<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase
{
    use WithFaker,RefreshDatabase;

    /** @test  */
    public function guest_cannot_control_project()
    {
        $project = Project::factory()->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }

    /** @test  */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());

        $this->get('/projects/create')->assertStatus(200);

        $user = User::first();

        $data = Project::factory()->raw(['owner_id' => $user->id]);

        $this->post('/projects', $data)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $data);
    }

    /** @test  */
    public function a_user_can_view_their_project()
    {
        $this->withoutExceptionHandling();

        $this->be(User::factory()->create());

        $project = Project::factory()->create(['owner_id' => auth()->user()->id]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test  */
    public function an_authenticated_user_cannot_view_projects_of_others()
    {
        $this->be(User::factory()->create());

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
    }

    /** @test  */
    public function a_title_is_required()
    {

        $this->actingAs(User::factory()->create());

        $data = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $data)->assertSessionHasErrors('title');
    }

    /** @test  */
    public function a_description_is_required()
    {
        $this->actingAs(User::factory()->create());
        $data = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $data)->assertSessionHasErrors('description');
    }
}
