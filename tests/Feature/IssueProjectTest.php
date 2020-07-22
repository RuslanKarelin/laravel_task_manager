<?php

namespace Tests\Feature;

use App\Models\TaskManager\Project;
use App\Models\TaskManager\Source;
use App\Models\TaskManager\Issue;
use App\Models\TaskManager\IssueStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class IssueProjectTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateProject()
    {
        $this->post(route('projects.store'), [
            'name' => 'first Project'
        ]);

        $this->assertDatabaseHas('projects', ['name' => 'first Project']);
    }

    public function testValidateProjectName()
    {
        $this->post(route('projects.store'), [
            'description' => 'test'
        ]);

        $this->assertDatabaseMissing('projects', ['description' => 'test']);
    }

    public function testGetDataProject()
    {
        $project = $this->getDataProject();
        $response = $this->get(route('projects.show', ['project' => $project->id]));

        $response->assertStatus(200);
    }

    public function testGetDataProjectNotFound()
    {
        $response = $this->get(route('projects.show', ['project' => 1]));

        $response->assertStatus(404);
    }

    public function testRelationsIssues()
    {
        $project = $this->getDataProject();
        $project->issues()->createMany(
            factory(Issue::class, 3)->make([
                'status_id' => factory(IssueStatus::class)->create()->id,
            ])->toArray()
        );

        $this->assertEquals(3, $project->issues()->count());
    }

    public function testUpdateProject()
    {
        $project = $this->getDataProject();
        $this->patch(route('projects.update', ['project' => $project->id]), [
            'name' => 'first Project!'
        ]);

        $this->assertDatabaseHas('projects', ['name' => 'first Project!']);
    }

    public function testDestroyProject()
    {
        $project = $this->getDataProject();
        $this->delete(route('projects.destroy', ['project' => $project->id]));

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function getDataProject()
    {
        return factory(Project::class)->create([
            'source_id' =>  factory(Source::class)->create()
        ]);
    }
}
