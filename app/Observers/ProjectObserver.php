<?php

namespace App\Observers;

use App\Models\TaskManager\Project;
use Illuminate\Support\Facades\Storage;

class ProjectObserver
{
    /**
     * @param Project $project
     */
    public function deleting(Project $project)
    {
        $project->issues->each(function ($issue) {
            $issue->files->each(function ($file) {
                Storage::deleteDirectory(env('FILES_PATH') . $file->filename);
            });
        });
    }
}
