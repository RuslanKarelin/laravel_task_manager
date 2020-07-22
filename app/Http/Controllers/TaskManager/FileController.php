<?php

namespace App\Http\Controllers\TaskManager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\Repositories\IFileRepository;
use App\Interfaces\Factories\IFileFactory;

class FileController extends BaseController
{
    protected $fileRepository;
    protected $fileFactory;

    /**
     * FileController constructor.
     * @param IFileRepository $fileRepository
     */
    public function __construct(IFileRepository $fileRepository, IFileFactory $fileFactory)
    {
        $this->fileRepository = $fileRepository;
        $this->fileFactory = $fileFactory;
    }

    /**
     * @param Request $request
     */
    public function upload(Request $request)
    {
        $uploadedFile = $request->file('file');
        $filename = time() . $uploadedFile->getClientOriginalName();
        $issue_id = $request->input('issue_id');

        $path = Storage::disk('local')->putFileAs(
            env('FILES_PATH') . $filename,
            $uploadedFile,
            $filename
        );

        if (!empty($path)) {
            $this->fileFactory->create(compact(['filename', 'issue_id', 'path']));
        }
    }

    /**
     * @param $filename
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download(string $filename): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        return Storage::download($this->fileRepository->getByName($filename)->path);
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request)
    {
        $this->fileFactory->destroy($request->input('id'));
        Storage::deleteDirectory(env('FILES_PATH') . $request->input('filename'));
    }
}