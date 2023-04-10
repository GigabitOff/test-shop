<?php

namespace App\Http\Controllers\Api\Mobile\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\V1\RegisterRequest;
use App\Http\Resources\Api\Mobile\V1\CityResource;
use App\Models\City;
use App\Models\Language;
use App\Models\User;
use App\Services\UsersService;
use App\Traits\JsonResponseFormat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UnauthorizedController extends Controller
{
    use JsonResponseFormat;

    protected string $token_name = 'api-mobile-auth';
    protected int $per_page;

    public function __construct()
    {
        $this->per_page = config('app.api.export.per_page', 100);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'phone' => 'required|exists:users,phone',
            'password' => 'required'
        ]);

        if (!Auth::attempt($validated)) {
            return $this->error('Forbidden', 403);
        }

        $user = auth()->user();
        $user->tokens()->where('name', $this->token_name)->delete();
        $tokenResult = $user->createToken($this->token_name)->plainTextToken;

        return $this->success([
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
        ], 'New token created.');
    }

    /**
     * Отправка кода восстановления пароля
     * @return JsonResponse
     */
    public function getLocales(): JsonResponse
    {
        return $this->success(
            Language::query()
                ->where('status', true)
                ->select('lang', 'name', 'default')
                ->get()
                ->toArray()
        );
    }

    public function setPasswordRecoverySendCode(Request $request, UsersService $service): JsonResponse
    {
        $phone = $request->validate(['phone' => 'required|exists:users,phone']);

        /** @var User $user */
        $user = User::query()->where('phone', $phone)->first();

        if (false !== $service->sendRecoveryCode($user)) {
            return $this->success([], __('custom::site.send_recovery_code_sms'));
        }

        return $this->error(__('custom::site.send_message_error'));
    }

    public function setPasswordRecoveryConfirmCode(Request $request, UsersService $service): JsonResponse
    {
        $request->validate([
            'phone' => 'required|exists:users,phone',
            'code' => [
                'required',
                Rule::exists('users', 'recovery_code')->where('phone', $request->phone)
            ]
        ]);

        /** @var User $user */
        $user = User::query()->where('phone', $request->phone)->first();

        if ($service->setPasswordFromRecoveryCode($user)) {
            return $this->success([], __('custom::site.password_recovery_success'));
        }

        return $this->error(__('custom::site.password_recovery_error'));
    }

    /**
     * Поиск по населенным пунктам
     * @param Request $request
     * @return JsonResponse
     */
    public function searchCities(Request $request): JsonResponse
    {
        $search = trim($request->query('search'));
        $limit = $request->query('limit') ?? $this->per_page;

        $query = City::query()->limit($limit);

        if ($search){
            $query->searchByName($search);
        } else {
            //Было  $query->;
           $query->searchByName($search); // Сделал.
        }

        return $this->success(CityResource::collection($query->get()));
    }

    /**
     * Register new Customer
     * @param RegisterRequest $request
     * @param UsersService $service
     * @return JsonResponse
     */
    public function register(RegisterRequest $request, UsersService $service): JsonResponse
    {
        try {
            $service->registerNewCustomer($request->validated());
            return $this->success([], 'success');
        } catch (\Exception $e){
            return $this->error($e->getMessage());
        }
    }
}
