<?php

namespace App\Http\Controllers\Api\Mobile\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\V1\SetUserDataRequest;
use App\Models\User;
use App\Services\ImportService;
use App\Services\UsersService;
use App\Traits\JsonResponseFormat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserImportController extends Controller
{
    use JsonResponseFormat;

    protected UsersService $service;

    public function __construct(UsersService $service)
    {
        $this->service = $service;
    }

    public function setUserPassword(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'password' => 'required|min:6',
        ]);

        if ($this->service->setPassword($this->getUser(), $validated['password'])) {
            return $this->success([], __('custom::site.password_change_success'));
        }

        return $this->error(__('custom::site.password_change_error'));
    }

    public function setUserData(SetUserDataRequest $request): JsonResponse
    {
        if ($this->service->updateUserData($this->getUser(), $request->validated())) {
            return $this->success('');
        }

        return $this->error('Import error');
    }


    protected function getUser(): ?User
    {
        return auth()->user();
    }
}
