<?php

namespace App\Http\Livewire\Widgets\Cabinet;

use App\Models\Chat;
use App\Models\Order;
use App\Models\OrderStatusType;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Component;

class MenuWidget extends Component
{
    public string $page_title = '';
    public string $user_name = '';
    public array $data = [];

    protected ?User $user;
    protected array $replacementNames = [
        'chats' => 'write_message',
        'debts' => 'receivables',
        'logout' => 'to_logout',
    ];

    protected $listeners = [
        'eventMessagesViewedStatusChanged',
    ];

    public function boot()
    {
        $this->user = auth()->user();
    }

    public function mount()
    {
        $this->user_name = $this->user->name;

        $user = $this->user;

        if ($user->isHeadManager) {
            $this->data = $this->initHeadManager();
        } elseif ($user->isManager) {
            $this->data = $this->initManager();
        } elseif ($user->isDirector) {
            $this->data = $this->initDirector();
        } elseif ($user->isCustomerLegalAdmin) {
            // Юр.лицо Главный Админ
            $this->data = $this->initCustomerOkpo();
        } elseif ($user->isCustomerLegalUser) {
            // Юр.лицо пользователь
            $this->data = $this->initCustomerOkpoUser();
        } elseif ($user->isCustomerSimple) {
            // Обычный пользователь
            $this->data = $this->initCustomer();
        }

        $this->initNames();
        $this->setActiveRoute();
        $this->setActiveTitle();
    }

    public function render()
    {
        $this->evaluateCounters();

        return view('livewire.widgets.cabinet.menu-widget');
    }

    // Физ.лицо
    protected function initCustomer(): array
    {
        $this->replacementNames['orders'] = 'my_orders';

        return [
            'main' => ['route' => 'customer.dashboard'],
            'cart' => ['route' => 'customer.cart'],
            'orders' => ['route' => 'customer.orders.index'],
            'documents' => ['route' => 'customer.documents.index'],
            'comparisons' => ['route' => 'customer.comparisons'],
            'waiting' => ['route' => 'customer.waiting'],
            'chats' => ['route' => 'customer.chats.index'],
            'discounts' => ['route' => 'customer.discounts'],
            'logout' => ['route' => 'logout'],
        ];
    }

    // Юр.лицо
    protected function initCustomerOkpo(): array
    {
        $this->replacementNames['orders'] = 'my_orders';

        return [
            'main' => ['route' => 'customer.dashboard'],
            'cart' => ['route' => 'customer.cart'],
            'orders' => ['route' => 'customer.orders.index'],
            'users' => ['route' => 'customer.users.index'],
            'documents' => ['route' => 'customer.documents.index'],
            'comparisons' => ['route' => 'customer.comparisons'],
            'waiting' => ['route' => 'customer.waiting'],
            'chats' => ['route' => 'customer.chats.index'],
            'debts' => ['route' => 'customer.debts'],
            'discounts' => ['route' => 'customer.discounts'],
            'logout' => ['route' => 'logout'],
        ];
    }

    // Юр.лицо пользователь
    protected function initCustomerOkpoUser(): array
    {
        $this->replacementNames['orders'] = 'my_orders';

        return [
            'main' => ['route' => 'customer.dashboard'],
            'cart' => ['route' => 'customer.cart'],
            'orders' => ['route' => 'customer.orders.index'],
            'documents' => ['route' => 'customer.documents.index'],
            'comparisons' => ['route' => 'customer.comparisons'],
            'waiting' => ['route' => 'customer.waiting'],
            'chats' => ['route' => 'customer.chats.index'],
            'debts' => ['route' => 'customer.debts'],
            'logout' => ['route' => 'logout'],
        ];
    }

    // Менеджер
    protected function initManager(): array
    {
        return [
            'main' => ['route' => 'manager.dashboard'],
            'cart' => ['route' => 'manager.cart'],
            'orders' => ['route' => 'manager.orders.index'],
            'users' => ['route' => 'manager.users.index'],
            'documents' => ['route' => 'manager.documents.index'],
            'chats' => ['route' => 'manager.chats.index'],
            'debts' => ['route' => 'manager.debts'],
            'logout' => ['route' => 'logout'],
        ];
    }

    // Главный менеджер
    protected function initHeadManager(): array
    {
        return [
            'main' => ['route' => 'manager.dashboard'],
            'cart' => ['route' => 'manager.cart'],
            'orders' => ['route' => 'manager.orders.index'],
            'users' => ['route' => 'manager.users.index'],
            'documents' => ['route' => 'manager.documents.index'],
            'debts' => ['route' => 'manager.debts'],
            'logout' => ['route' => 'logout'],
        ];
    }

    // Директор
    protected function initDirector(): array
    {
        return [
            'main' => ['route' => 'manager.dashboard'],
            'orders' => ['route' => 'manager.orders.index'],
            'debts' => ['route' => 'manager.debts'],
            'logout' => ['route' => 'logout'],
        ];
    }

    protected function initNames()
    {
        foreach ($this->data as $key => &$arr) {
            if (!isset($arr['label'])) {
                $key = $this->replacementNames[$key] ?? $key;
                $arr['label'] = __("custom::site.$key");
            }
        }
    }

    protected function setActiveRoute()
    {
        foreach ($this->data as $key => &$arr) {
            if ($arr['route']) {
                $arr['href'] = route($arr['route']);
                $arr['active'] = $this->isEqualRoutes(Route::currentRouteName(), $arr['route']);
            }
        }
    }

    protected function setActiveTitle()
    {
        if ($this->page_title) {
            return;
        }

        foreach ($this->data as $arr) {
            if ($arr['active']) {
                $this->page_title = $arr['label'];
                break;
            }
        }
    }

    protected function evaluateCounters()
    {
        foreach ($this->data as $key => &$arr) {
            $method = Str::camel("evaluate_{$key}_counter");
            $arr['count'] = method_exists($this, $method)
                ? $this->{$method}()
                : 0;
        }
    }

    /**
     * Сравниваем имена роутов на идентичность.
     * Используем только два первых сегмента т.е. очищаем роуты от конечных точек.
     *
     * @param string $first
     * @param string $second
     * @return bool
     */
    protected function isEqualRoutes(string $first, string $second): bool
    {
        $pattern = "/^([\w]+)\.([\w]+).*$/";

        $first = preg_replace($pattern, '$1.$2', $first);
        $second = preg_replace($pattern, '$1.$2', $second);

        return $first === $second;
    }

    public function eventMessagesViewedStatusChanged()
    {
        // Just revalidate counters
    }

    /**
     * Calculate chats with unViewed messages.
     *
     * @return int
     */
    public function evaluateChatsCounter(): int
    {
        /** @var User */
        $user = auth()->user();

        if ($user->isCustomer) {
            return $user->chats()
                ->whereHas('messages', function ($q) use ($user) {
                    $q->where('owner_id', '!=', $user->id)
                        ->where('viewed', false);
                })
                ->count();
        } else {
            $sub = $user->departments()->select('id')->toRawSql();
            return Chat::query()
                ->where(function ($q) use ($user, $sub) {
                    $q->where('manager_id', $user->id);
                    $q->orWhere(function ($q) use ($sub) {
                        $q->whereNull('manager_id');
                        $q->whereInRaw('department_id', $sub);
                    });
                })
                ->whereHas('messages', function ($q) use ($user) {
                    $q->where('owner_id', '!=', $user->id)
                        ->where('viewed', false);
                })
                ->count();
        }
    }

    /**
     * Calculate orders with status 'new'.
     *
     * @return int
     */
    public function evaluateOrdersCounter(): int
    {
        /** @var User */
        $user = auth()->user();

        if ($user->isCustomer) {
            return 0;
        } else {
            $sub = $user->customers()->select('id')->toRawSql();
            return Order::query()
                ->whereRelation('status', 'id', '=', OrderStatusType::STATUS_NEW)
                ->whereInRaw('customer_id', $sub)
                ->count();
        }
    }
}
