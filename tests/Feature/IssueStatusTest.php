<?php

namespace Tests\Feature;

use App\Models\TaskManager\Issue;
use App\Models\TaskManager\IssueStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class IssueStatusTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateStatus()
    {
        $this->post(route('issue-statuses.store'), [
            'name' => 'first status'
        ]);

        $this->assertDatabaseHas('issue_statuses', ['name' => 'first status']);
    }

    public function testValidateStatusName()
    {
        $this->post(route('issue-statuses.store'), [
            'name' => ''
        ]);

        $this->assertDatabaseMissing('issue_statuses', ['id' => 1]);
    }

    public function testRelationsIssues()
    {
        $status = $this->getDataStatus();
        $status->issues()->createMany(
            factory(Issue::class, 3)->make()->toArray()
        );

        $this->assertEquals(3, $status->issues()->count());
    }

    public function testUpdateStatus()
    {
        $status = $this->getDataStatus();
        $this->patch(route('issue-statuses.update', ['issue_status' => $status->id]), [
            'name' => 'first status!'
        ]);

        $this->assertDatabaseHas('issue_statuses', ['name' => 'first status!']);
    }

    public function testDestroyStatus()
    {
        $status = $this->getDataStatus();
        $this->delete(route('issue-statuses.destroy', ['issue_status' => $status->id]));

        $this->assertDatabaseMissing('issue_statuses', ['id' => $status->id]);
    }

    public function getDataStatus()
    {
        return factory(IssueStatus::class)->create();
    }
}
