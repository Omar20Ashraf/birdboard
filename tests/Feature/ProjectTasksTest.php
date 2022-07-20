<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test  */
    public function a_project_can_have_tasks()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $project = auth()->user()->projects()->create(Project::factory()->raw());

        $data = ['body' => 'test task'];

        $this->post($project->path().'/tasks',$data)->assertRedirect($project->path());

        $this->assertDatabaseHas('tasks', $data);
    }

    /** @test  */
    public function a_body_is_required()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(Project::factory()->raw());

        $data = Task::factory()->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $data)->assertSessionHasErrors('body');
    }
}
