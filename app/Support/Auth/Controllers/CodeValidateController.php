<?php

declare(strict_types=1);

namespace App\Support\Auth\Controllers;

use App\Base\Abstracts\Controller;
use App\Support\Auth\Requests\CodeValidateRequest;
use Illuminate\Http\JsonResponse;

class CodeValidateController extends Controller
{
    public function __invoke(CodeValidateRequest $request): JsonResponse {}
}
