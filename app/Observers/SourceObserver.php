<?php

namespace App\Observers;

use App\Models\TaskManager\Source;
use Illuminate\Support\Facades\Storage;

class SourceObserver
{
    /**
     * @param Source $source
     */
    public function deleting(Source $source)
    {
        $source->projects->each(function ($project) {
            $project->issues->each(function ($issue) {
                $issue->files->each(function ($file) {
                    Storage::deleteDirectory(env('FILES_PATH') . $file->filename);
                });
            });
        });
    }
}
