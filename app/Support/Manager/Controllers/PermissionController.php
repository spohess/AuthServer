<?php

declare(strict_types=1);

namespace App\Support\Manager\Controllers;

use App\Base\Abstracts\Controller;
use App\Support\Auth\Actions\Permission\PermissionCollectorAction;
use App\Support\Auth\Actions\Permission\PermissionCreatorAction;
use App\Support\Auth\Actions\Permission\PermissionDeleterAction;
use App\Support\Auth\Actions\Permission\PermissionUpdaterAction;
use App\Support\Manager\Requests\Permission\PermissionIndexRequest;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(
        private PermissionCollectorAction $collector,
        private PermissionCreatorAction $creator,
        private PermissionUpdaterAction $updater,
        private PermissionDeleterAction $deleter,
    ) {}

    public function index(PermissionIndexRequest $request) {}

    public function store(Request $request) {}

    public function show($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
