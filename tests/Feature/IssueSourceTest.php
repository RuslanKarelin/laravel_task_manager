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

class IssueSourceTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateSource()
    {
        $this->post(route('sources.store'), [
            'first_name' => 'first source',
            'price' => 800.00,
        ]);

        $this->assertDatabaseHas('sources', ['first_name' => 'first source']);
    }

    public function testValidateSourcePrice()
    {
        $this->post(route('sources.store'), [
            'first_name' => 'first source',
            'price' => '',
        ]);

        $this->post(route('sources.store'), [
            'first_name' => 'first source',
            'price' => 'price',
        ]);

        $this->assertDatabaseMissing('sources', ['first_name' => 'first source']);
    }

    public function testValidateSourceFirstName()
    {
        $this->post(route('sources.store'), [
            'price' => 800.00,
        ]);

        $this->assertDatabaseMissing('sources', ['price' => 800.00]);
    }

    public function testGetDataSource()
    {
        $source = $this->getDataSource();
        $response = $this->get(route('sources.show', ['source' => $source->id]));

        $response->assertStatus(200);
    }

    public function testGetDataSourceNotFound()
    {
        $response = $this->get(route('sources.show', ['source' => 1]));

        $response->assertStatus(404);
    }

    public function testRelationsProjects()
    {
        $source = $this->getDataSource();
        $source->projects()->createMany(
            factory(Project::class, 3)->create()->toArray()
        );

        $this->assertEquals(3, $source->projects()->count());
    }

    public function testUpdateSource()
    {
        $source = $this->getDataSource();
        $this->patch(route('sources.update', ['source' => $source->id]), [
            'first_name' => 'first source!',
            'price' => 800.00
        ]);

        $this->assertDatabaseHas('sources', ['first_name' => 'first source!']);
    }

    public function testDestroySource()
    {
        $source = $this->getDataSource();
        $this->delete(route('sources.destroy', ['source' => $source->id]));

        $this->assertDatabaseMissing('sources', ['id' => $source->id]);
    }

    public function getDataSource()
    {
        return factory(Source::class)->create();
    }
}
