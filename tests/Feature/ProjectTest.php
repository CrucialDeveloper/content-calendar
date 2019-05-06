<?php

namespace Tests\Feature;

use App\Project;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_project_has_attributes()
    {
        $this->withoutExceptionHandling();

        $project = Project::create([
            'owner' => 'John Lowery',
            'title' => 'New Title',
            'type' => 'Work',
            'business_unit' => 'Spectrum Enterprise',
            'publish_date' => Carbon::tomorrow(),
        ]);

        $this->assertDatabaseHas('projects', $project->toArray());
    }

    /**
     * @test
     */
    public function a_project_can_be_created_from_post_request()
    {
        $this->withoutExceptionHandling();

        $project = $this->raw(Project::class);

        $this->post('/projects', $project);

        $this->assertDatabaseHas('projects', $project);

    }

    /**
     * @test
     */
    public function a_project_can_be_updated_from_a_patch_request()
    {
        $this->withoutExceptionHandling();

        $project = $this->create(Project::class);

        $response = $this->patch("/projects/$project->id", [
            'title' => 'Updated Title',
            'type' => "Other",
            "business_unit" => 'Finance',
        ]);

        $this->assertDatabaseHas('projects', [
            'title' => 'Updated Title',
            'type' => "Other",
            "business_unit" => 'Finance',
        ]);

    }

    /**
     * @test
     */
    public function a_project_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $project = $this->create(Project::class);

        $this->assertCount(1, Project::all());

        $this->delete("/projects/$project->id");

        $this->assertCount(0, Project::all());

    }

}
