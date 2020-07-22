<?php

namespace App\Http\Controllers\TaskManager;

use App\Http\Requests\SourceRequest;
use App\Interfaces\Repositories\ISourceRepository;
use App\Interfaces\Factories\ISourceFactory;

class SourcesController extends BaseController
{

    protected $sourceRepository;
    protected $sourceFactory;

    /**
     * SourcesController constructor.
     * @param ISourceRepository $sourceRepository
     * @param ISourceFactory $sourceFactory
     */
    public function __construct(ISourceRepository $sourceRepository, ISourceFactory $sourceFactory)
    {
        $this->sourceRepository = $sourceRepository;
        $this->sourceFactory = $sourceFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        parent::index();
        $sources = $this->sourceRepository->getAllWithPaginate(env('PAGINATE_LIMIT'));
        return view('taskmanager.source.sources', compact('sources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('taskmanager.source.create_source');
    }

    /**
     * @param SourceRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SourceRequest $request)
    {
        $source = $this->sourceFactory->create($request);
        return redirect(route('sources.index'))->with('status', 'source created, id=' . $source->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return view('taskmanager.source.show_source', ['source' => $this->sourceRepository->getById($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return view('taskmanager.source.edit_source', ['source' => $this->sourceRepository->getById($id)]);
    }

    /**
     * @param SourceRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(SourceRequest $request, int $id)
    {
        $this->sourceFactory->update($request, $id);
        return redirect(route('sources.edit', $id))->with('status', 'source updated, id=' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->sourceFactory->destroy($id);
        return redirect(route('sources.index'))->with('status', 'source deleted, id=' . $id);
    }
}
