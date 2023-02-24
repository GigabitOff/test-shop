<?php

namespace App\Http\Controllers\Api\Mobile\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Mobile\V1\PaymentTypeResource;
use App\Http\Resources\Api\Mobile\V1\UserResource;
use App\Http\Resources\Api\V1\CounterpartyResource;
use App\Http\Resources\Api\V1\CustomerResource;
use App\Http\Resources\Api\V1\DeliveryAddressResource;
use App\Http\Resources\Api\V1\DocumentResource;
use App\Http\Resources\Api\V1\OrderResource;
use App\Http\Resources\Api\V1\YourTechniqueResource;
use App\Models\Counterparty;
use App\Models\DeliveryAddress;
use App\Models\Document;
use App\Models\Order;
use App\Models\OrderStatusType;
use App\Models\User;
use App\Models\YourTechnique;
use App\Traits\ApiPaginateFormat;
use App\Traits\JsonResponseFormat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserExportController extends Controller
{
    use JsonResponseFormat;
    use ApiPaginateFormat;

    protected $perPage;

    public function __construct()
    {
        $this->perPage = config('app.api.export.per_page', 100);
    }

    public function getUserData(Request $request): JsonResponse
    {
        // Разрешаем просматривать только разрешенных пользователей
        $sub = auth()->user()->customers()->select('id')->toRawSql();
        $phone = $request->validate([
            'phone' => [
                'required',
                Rule::exists('users','phone')
                    ->where(fn($q) => $q->whereInRaw('id', $sub))
            ],
        ]);

        $user = User::query()
            ->where('phone', $phone)
            ->with(['translations'])
            ->first();

       return $this->success(new UserResource($user));
    }

    public function getUserPaymentTypesAvailable(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $types = $user->availablePaymentTypes()
            ->withTranslation()
            ->get();

        return $this->success(PaymentTypeResource::collection($types));
    }
}
