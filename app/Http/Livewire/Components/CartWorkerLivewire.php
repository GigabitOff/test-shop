<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Str;
use Livewire\Component;

/**
 * Класс обработчик действий над корзиной
 *
 * Управление осуществляется посредством livewire сообщений
 * Каждое сообщение может/должно содержать данные $payload
 * $payload = [
 *      'product_id' => int, // идентификатор товара
 *      'show_notification' => bool, // флаг запуска окна с сообщением о выполнении
 * ]
 */
class CartWorkerLivewire extends Component
{
    const ACTION_ADD = 'add';
    const ACTION_REMOVE = 'remove';
    const ACTION_CLEAR = 'clear';

    protected string $action = self::ACTION_CLEAR;

    protected array $payload = [];

    protected $listeners = [
        'eventCartRemoveProduct',
        'eventCartAddProduct',
        'eventCartClear',
    ];

    public function render()
    {
        return <<<'blade'
            <div></div>
        blade;
    }

    public function eventCartRemoveProduct($payload)
    {
        $this->runWithAction(self::ACTION_REMOVE, (array) $payload);
    }

    public function eventCartAddProduct($payload)
    {
        $this->runWithAction(self::ACTION_ADD, (array) $payload);
    }

    public function eventCartClear($payload)
    {
        $this->runWithAction(self::ACTION_CLEAR, (array) $payload);
    }

    protected function runWithAction(string $action, array $payload)
    {
        $this->payload = $payload;
        $this->action = $action;

        $this->doAction();
        $this->doActionEmit();
        $this->doBrowserEvent();
        $this->doInfoMessage();
    }

    protected function doAction()
    {
        $this->{'do'.Str::studly($this->action).'Action'}();
    }

    protected function doAddAction()
    {
        $product_id = $this->tryGetProductId();
        $quantity = $this->tryGetQuantity();
        $priceAdded = $this->tryGetPrice();
        cart()->addProduct($product_id, $quantity ?: 1, null, $priceAdded);
    }

    protected function doRemoveAction()
    {
        $product_id = $this->tryGetProductId();
        cart()->removeProduct($product_id);
    }

    protected function doClearAction()
    {
        cart()->clear();
    }

    protected function doActionEmit()
    {
        $this->emit('eventCartChanged');
    }

    protected function doBrowserEvent()
    {
        $product_id = $this->tryGetProductId();
        $this->dispatchBrowserUpdatedEvent($product_id);
    }

    protected function doInfoMessage()
    {
        if ($this->tryGetShowNotification()) {
            $this->showNotificationPopup();
        }
    }

    private function dispatchBrowserUpdatedEvent($product_id)
    {
        $this->dispatchBrowserEvent('cartUpdated', [
            'product' => $product_id,
            'quantity' => cart()->getQuantity($product_id),
        ]);
    }

    protected function showNotificationPopup()
    {
        $type = $this->action;

        $messages = [
            'add' => __('custom::site.cart_actions.add'),
            'remove' => __('custom::site.cart_actions.remove'),
            'clear' => __('custom::site.cart_actions.clear'),
        ];

        if ($message = data_get($messages, $type)) {
            $this->emit('eventShowDialogMessage', [
                'title' => __('custom::site.cart'),
                'message' => $message,
            ]);
        }
    }

    protected function tryGetProductId(): int
    {
        $productId = (int) data_get($this->payload, 'product_id', 0);
        throw_unless($productId, new \Exception('CartWorker: wrong product_id param'));

        return $productId;
    }

    protected function tryGetQuantity(): int
    {
        return (int) data_get($this->payload, 'quantity', 1);
    }

    protected function tryGetPrice(): int
    {
        return (int) data_get($this->payload, 'price_added', null);
    }

    protected function tryGetShowNotification(): bool
    {
        return (bool) data_get($this->payload, 'show_notification', false);
    }

}
