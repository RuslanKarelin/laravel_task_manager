<?php

namespace Tests\Feature;

use App\Models\TaskManager\EventIssue;
use App\Models\TaskManager\IssueStatus;
use App\Models\TaskManager\IssueTime;
use App\Models\TaskManager\Source;
use App\Models\TaskManager\Project;
use App\Models\TaskManager\Issue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class IssueTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateIssue()
    {
        $this->post(route('issues.store'), [
            'name' => 'first issue',
            'status_id' => factory(IssueStatus::class)->create()->id,
            'project_id' => factory(Project::class)->create()->id,
        ]);

        $this->assertDatabaseHas('issues', ['name' => 'first issue']);
    }

    public function testValidateIssueStatus()
    {
        $project = factory(Project::class)->create();
        $this->post(route('issues.store'), [
            'name' => 'first issue',
            'project_id' => $project->id,
        ]);

        $this->assertDatabaseMissing('issues', ['name' => 'first issue']);
    }

    public function testValidateIssueEstimateNumeric()
    {
        $project = factory(Project::class)->create();
        $this->post(route('issues.store'), [
            'name' => 'first issue',
            'estimate' => 'numeric',
            'status_id' => factory(IssueStatus::class)->create()->id,
            'project_id' => $project->id,
        ]);

        $this->assertDatabaseMissing('issues', ['name' => 'first issue']);
    }

    public function testValidateIssueProject()
    {
        $status = factory(IssueStatus::class)->create();
        $this->post(route('issues.store'), [
            'name' => 'first issue',
            'estimate' => 18.0,
            'status_id' => $status->id
        ]);

        $this->assertDatabaseMissing('issues', ['name' => 'first issue']);
    }

    public function testValidateIssueCompletionMustBeTimestampFormat()
    {
        $project = factory(Project::class)->create();
        $status = factory(IssueStatus::class)->create();
        $this->post(route('issues.store'), [
            'name' => 'first issue',
            'completion' => '2020.10.05',
            'project_id' => $project->id,
            'status_id' => $status->id
        ]);

        $this->assertDatabaseMissing('issues', ['completion' => '2020.10.05']);
    }

    public function testgetDataIssue()
    {
        $issue = $this->getDataIssue();
        $response = $this->get(route('issues.show', ['issue' => $issue['issue']->id]));

        $response->assertStatus(200);
    }

    public function testgetDataIssueNotFound()
    {
        $response = $this->get(route('issues.show', ['issue' => 1]));

        $response->assertStatus(404);
    }

    public function testUpdateIssueWithQueryParams()
    {
        $issue = $this->getDataIssue();
        $status = factory(IssueStatus::class)->create(['name' => 'В работе']);
        $this->patch(route('issues.update',
            [
                'issue' => $issue['issue']->id,
                'time' => 33.5,
                'comment' => 'body comment'
            ]), [
            'name' => 'first issue!',
            'estimate' => 18.0,
            'status_id' => $status->id,
            'project_id' => $issue['project']->id,
        ]);

        $this->assertDatabaseHas('issue_times', ['time' => 33.5]);
        $this->assertDatabaseHas('event_issues', ['body' => 'Статус изменен на В работе. Оценка задачи 18 ч.. Списано время 33 ч. 30 м..']);
        $this->assertDatabaseHas('comments', ['body' => 'body comment']);
        $this->assertDatabaseMissing('issues', ['beginning' => null]);
    }

    public function testUpdateIssue()
    {
        $issue = $this->getDataIssue();
        $this->patch(route('issues.update', ['issue' => $issue['issue']->id]), [
            'name' => 'first issue!',
            'status_id' => $issue['status']->id,
            'project_id' => $issue['project']->id,
        ]);

        $this->assertDatabaseHas('issues', ['name' => 'first issue!']);
    }

    public function testDestroyIssue()
    {
        $issue = $this->getDataIssue();
        $this->delete(route('issues.destroy', ['issue' => $issue['issue']->id]));

        $this->assertDatabaseMissing('issues', ['name' => 'first issue']);
    }

    public function testRelationsIssueTime()
    {
        $issue = $this->getDataIssue();
        $issue['issue']->times()->createMany(
            factory(IssueTime::class, 3)->make([
                'event_id' => factory(EventIssue::class)->create(['issue_id' => $issue['issue']->id])->id
            ])->toArray()
        );

        $this->assertEquals(3, $issue['issue']->times()->count());
    }

    public function testRelationsEventIssue()
    {
        $issue = $this->getDataIssue();
        $issue['issue']->events()->createMany(
            factory(EventIssue::class, 3)->make()->toArray()
        );

        $this->assertEquals(4, $issue['issue']->events()->count());
    }

    public function testHasStatus()
    {
        $issue = $this->getDataIssue();
        $this->assertEquals(1, $issue['issue']->status()->count());
    }

    public function testHasProject()
    {
        $issue = $this->getDataIssue();
        $this->assertEquals(1, $issue['issue']->project()->count());
    }

    public function getDataIssue()
    {
        $source = factory(Source::class)->create();
        $status = factory(IssueStatus::class)->create();
        $project = factory(Project::class)->create(['source_id' => $source->id]);
        $issue = factory(Issue::class)->create([
            'name' => 'first issue1',
            'status_id' => $status->id,
            'project_id' => $project->id,
            'estimate' => 18.12,
        ]);

        return [
            'status' => $status,
            'project' => $project,
            'issue' => $issue
        ];
    }
}
