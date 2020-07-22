<?php

namespace App\Http\Controllers\TaskManager;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function index()
    {
        if (request()->has('factory')) {
            $this->destroyEntities();
        }
    }

    protected function destroyEntities()
    {
        $repository = app(request()->input('factory'));
        if (request()->has('items')) {
            $repository->destroyAll(array_keys(request()->input('items')));
            header('Location: ' . request()->getPathInfo());
            exit;
        }
    }
}