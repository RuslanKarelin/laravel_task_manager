<?php

namespace App\Factories;

use \App\Interfaces\Factories\ISourceFactory;
use App\Models\TaskManager\Source;
use Illuminate\Http\Request;

class SourceFactory implements ISourceFactory
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        return Source::create($request->all());
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed|void
     */
    public function update(Request $request, int $id)
    {
        $source = Source::findOrFail($id);
        $source->update($request->all());
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function destroy(int $id)
    {
        Source::destroy($id);
    }

    /**
     * @param array $ids
     * @return mixed|void
     */
    public function destroyAll(array $ids)
    {
        Source::destroy($ids);
    }
}