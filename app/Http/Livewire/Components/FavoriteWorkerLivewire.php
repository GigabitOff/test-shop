<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Str;
use Livewire\Component;

/**
 * Класс обработчик действий над списком favorites
 *
 * Управление осуществляется посредством livewire сообщений
 * Каждое сообщение может/должно содержать данные $payload
 * $payload = [
 *      'product_id' => int, // идентификатор товара
 *      'show_notification' => bool, // флаг запуска окна с сообщением о выполнении
 * ]
 */
class FavoriteWorkerLivewire extends Component
{
    const ACTION_ADD = 'add';
    const ACTION_REMOVE = 'remove';
    const ACTION_TOGGLE = 'toggle';
    const ACTION_CLEAR = 'clear';

    protected string $action = self::ACTION_CLEAR;

    protected array $payload = [];

    protected $listeners = [
        'eventToggleFavourite',
        'eventRemoveFavouriteItem',
        'eventAddFavouriteItem',
        'eventClearFavourites',
    ];

    public function render()
    {
        return <<<'blade'
            <div></div>
        blade;
    }

    public function eventToggleFavourite($payload)
    {
        $this->runWithAction(self::ACTION_TOGGLE, (array)$payload);
    }

    public function eventRemoveFavouriteItem($payload)
    {
        $this->runWithAction(self::ACTION_REMOVE, (array)$payload);
    }

    public function eventAddFavouriteItem($payload)
    {
        $this->runWithAction(self::ACTION_ADD, (array)$payload);
    }

    public function eventClearFavourites($payload)
    {
        $this->runWithAction(self::ACTION_CLEAR, (array)$payload);
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
        $this->{'do' . Str::studly($this->action) . 'Action'}();
    }

    protected function doAddAction()
    {
        $product_id = $this->tryGetProductId();
        favourites()->addProduct($product_id);
    }

    protected function doRemoveAction()
    {
        $product_id = $this->tryGetProductId();
        favourites()->removeProduct($product_id);
    }

    protected function doToggleAction()
    {
        $product_id = $this->tryGetProductId();
        favourites()->toggleProduct($product_id);
    }

    protected function doClearAction()
    {
        favourites()->clear();
    }

    protected function doActionEmit()
    {
        $this->emit('eventFavouritesChanged');
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
        $this->dispatchBrowserEvent('favoriteUpdated', [
            'product' => $product_id,
            'exist' => favourites()->isExistProduct($product_id),
        ]);
    }

    protected function showNotificationPopup()
    {
        if ($this->action === self::ACTION_TOGGLE) {
            $product_id = $this->tryGetProductId();
            $type = favourites()->isExistProduct($product_id)
                ? self::ACTION_ADD
                : self::ACTION_REMOVE;
        } else {
            $type = $this->action;
        }

        $messages = [
            'add' => __('custom::site.favorite_actions.add'),
            'remove' => __('custom::site.favorite_actions.remove'),
            'clear' => __('custom::site.favorite_actions.clear'),
        ];

        if ($message = data_get($messages, $type)) {
            $this->emit('eventShowDialogMessage', [
                'title' => __('custom::site.favorites'),
                'message' => $message,
            ]);
        }
    }

    protected function tryGetProductId(): int
    {
        $productId = (int) data_get($this->payload, 'product_id', 0);
        throw_unless($productId, new \Exception('FavoriteWorker: wrong product_id param'));

        return $productId;
    }

    protected function tryGetShowNotification(): bool
    {
        return (bool) data_get($this->payload, 'show_notification', false);
    }

}
