<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use WithFaker,RefreshDatabase;

    /** @test  */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $data = Project::factory()->raw();

        $this->post('/projects',$data)
            ->assertRedirect('/projects');

        $this->assertDatabaseHas('projects',$data);

    }

    /** @test  */
    public function a_title_is_required()
    {
        $data = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $data)
            ->assertSessionHasErrors('title');
    }

    /** @test  */
    public function a_description_is_required()
    {
        $data = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $data)
            ->assertSessionHasErrors('description');
    }
}
