<?php

namespace App\Http\Controllers\TaskManager;

use App\Http\Requests\ProjectRequest;
use App\Interfaces\Repositories\ISourceRepository;
use App\Interfaces\Repositories\IProjectRepository;
use App\Interfaces\Factories\IProjectFactory;

class ProjectsController extends BaseController
{

    protected $projectRepository;
    protected $projectFactory;
    protected $sourceRepository;

    /**
     * ProjectsController constructor.
     * @param IProjectRepository $projectRepository
     * @param IProjectFactory $projectFactory
     * @param ISourceRepository $sourceRepository
     */
    public function __construct(
        IProjectRepository $projectRepository,
        IProjectFactory $projectFactory,
        ISourceRepository $sourceRepository
    )
    {
        $this->projectRepository = $projectRepository;
        $this->projectFactory = $projectFactory;
        $this->sourceRepository = $sourceRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function index()
    {
        parent::index();
        $projects = $this->projectRepository->getAllWithPaginate(env('PAGINATE_LIMIT'));
        return view('taskmanager.project.projects', compact('projects'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('taskmanager.project.create_project', ['sources' => $this->sourceRepository->getAll()]);
    }

    /**
     * @param ProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ProjectRequest $request)
    {
        $project = $this->projectFactory->create($request);
        return redirect(route('projects.index'))->with('status', 'project created, id=' . $project->id);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        return view('taskmanager.project.show_project', ['project' => $this->projectRepository->getById($id)]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        return view('taskmanager.project.edit_project', [
            'project' => $this->projectRepository->getById($id),
            'sources' => $this->sourceRepository->getAll()
        ]);
    }

    /**
     * @param ProjectRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ProjectRequest $request, int $id)
    {
        $this->projectFactory->update($request, $id);
        return redirect(route('projects.edit', $id))->with('status', 'project updated, id=' . $id);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(int $id)
    {
        $this->projectFactory->destroy($id);
        return redirect(route('projects.index'))->with('status', 'project deleted, id=' . $id);
    }
}
