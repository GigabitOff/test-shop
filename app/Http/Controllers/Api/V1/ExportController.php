<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Mobile\V1\ChatResource;
use App\Http\Resources\Api\V1\CounterpartyResource;
use App\Http\Resources\Api\V1\CustomerResource;
use App\Http\Resources\Api\V1\DeliveryAddressResource;
use App\Http\Resources\Api\V1\DocumentResource;
use App\Http\Resources\Api\V1\OrderResource;
use App\Http\Resources\Api\V1\ProductReserveResource;
use App\Http\Resources\Api\V1\YourTechniqueResource;

use App\Models\ChatMessage;
use App\Models\Counterparty;
use App\Models\DeliveryAddress;
use App\Models\Document;
use App\Models\Order;
use App\Models\OrderStatusType;
use App\Models\Product;
use App\Models\User;
use App\Models\YourTechnique;
use App\Traits\ApiPaginateFormat;
use App\Traits\JsonResponseFormat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    use JsonResponseFormat;
    use ApiPaginateFormat;

    protected $perPage;

    public function __construct()
    {
        $this->perPage = config('app.api.export.per_page', 100);
    }

    public function getCustomers(Request $request): JsonResponse
    {
        $query = User::query()
            ->role(['simple', 'legal'])
            ->OnlyNotTransferred()
            ->with(['translations', 'counterparties', 'deliveryAddresses']);

       return $this->success(
            $this->summary(
                $query->paginate($this->perPage),
                CustomerResource::class
            )
        );
    }

    public function getCounterparties(Request $request): JsonResponse
    {
        $query = Counterparty::query()
            ->OnlyNotTransferred()
            ->with(['city', 'users', 'deliveryAddresses', 'siblings', 'manager', 'regionManager']);

        return $this->success(
            $this->summary(
                $query->paginate($this->perPage),
                CounterpartyResource::class
            )
        );
    }

    public function getOrdersRegistered(Request $request)
    {
        $this->validate($request, ['status_id_1c' => 'sometimes|required|exists:order_status_types,id_1c']);

        $query = Order::query()
            ->where('fast_order', false)
            ->OnlyNotTransferred()
            ->with(['customer', 'manager', 'status', 'deliveryAddress', 'driver', 'products', 'counterparty']);

        if (!empty($request->status_id_1c)){
            $id =  OrderStatusType::where('id_1c', $request->status_id_1c)->first()->id;
            $query->where('status_id', $id);
        }

        return $this->success(
            $this->summary(
                $query->paginate($this->perPage),
                OrderResource::class
            )
        );
    }

    public function getFastOrders(Request $request)
    {
        $this->validate($request, ['status_id_1c' => 'sometimes|required|exists:order_status_types,id_1c']);

        $query = Order::query()
            ->where('fast_order', true)
            ->OnlyNotTransferred()
            ->with(['customer', 'manager', 'status', 'deliveryAddress', 'driver', 'products', 'counterparty']);

        if (!empty($request->status_id_1c)){
            $id =  OrderStatusType::where('id_1c', $request->status_id_1c)->first()->id;
            $query->where('status_id', $id);
        }

        return $this->success(
            $this->summary(
                $query->paginate($this->perPage),
                OrderResource::class
            )
        );
    }

    public function getYourTechnique(Request $request)
    {
        $query = YourTechnique::query()
            ->OnlyNotTransferred()
            ->with(['customer', 'product']);

        return $this->success(
            $this->summary(
                $query->paginate($this->perPage),
                YourTechniqueResource::class
            )
        );
    }

    public function getDocs(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|in:1,2,3',
            'status_id' => 'sometimes|required|exists:order_status_types,id'
        ]);

        $query = Document::query()
            ->where('type', $request->type)
            ->OnlyNotTransferred()
            ->with(['products'])
            ->with('order', fn($q) => $q->select(['id', 'id_1c']));

        if (!empty($request->status_id_1c)){
            $query->where('status_id', $request->status_id_1c);
        }

        return $this->success(
            $this->summary(
                $query->paginate($this->perPage),
                DocumentResource::class
            )
        );
    }

    public function getDeliveryAddresses(Request $request)
    {
        $query = DeliveryAddress::query()
            ->OnlyNotTransferred()
            ->with(['deliveryType', 'owner', 'city']);

        return $this->success(
            $this->summary(
                $query->paginate($this->perPage),
                DeliveryAddressResource::class
            )
        );
    }

    public function getProductsReserve(Request $request)
    {
        $this->validate($request, ['filter' => 'nullable|in:all,positive']);
        $filter = $request->get('filter', 'positive');

        $query = Product::query()
            ->when('positive' === $filter, function($q){
                $q->where('reserve', '>', 0);
            })
            ->select('id', 'id_1c', 'reserve', 'reserve_minutes');

        return $this->success(
            $this->summary(
                $query->paginate($this->perPage),
                ProductReserveResource::class
            )
        );
    }

    public function getChatMessage(Request $request)
    {
        $chat_id = $request->get('chat_id');

        $query = ChatMessage::where('chat_id',$chat_id)->get();

        return $this->success(
                $query,
                ChatResource::class
            );
        //dd($request);


        //return $this->success([], 'Import success');
    }
}
