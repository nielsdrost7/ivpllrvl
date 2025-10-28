<?php

declare(strict_types=1);

namespace Modules\Modules\MyModules\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Modules\MyModules\Repositories\MyModuleRepository;

class MyModulesController extends Controller
{
    /**
     * @var MyModuleRepository
     */
    private $myModuleRepository;

    /**
     * MyModulesController constructor.
     */
    public function __construct(MyModuleRepository $myModuleRepository)
    {
        $this->myModuleRepository = $myModuleRepository;
    }

    /**
     * GET /my-modules.
     */
    public function index(): void
    {
        // TODO: Implement
    }

    /**
     * GET /my-modules/create.
     */
    public function create(): void
    {
        // TODO: Implement
    }

    /**
     * POST /my-modules.
     */
    public function store(Request $request): void
    {
        // TODO: Implement
    }

    /**
     * GET /my-modules/{id}.
     */
    public function show($id): void
    {
        // TODO: Implement
    }

    /**
     * GET /my-modules/{id}/edit.
     */
    public function edit($id): void
    {
        // TODO: Implement
    }

    /**
     * PUT/PATCH /my-modules/{id}.
     */
    public function update($id, Request $request): void
    {
        // TODO: Implement
    }

    /**
     * DELETE /my-modules/{id}.
     */
    public function destroy($id): void
    {
        // TODO: Implement
    }
}
