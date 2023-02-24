<?php

namespace App\Http\Livewire\Forms;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component;

/**
 * Класс отображения модального окна сообщения с возможностью реакции на событие
 *
 * Запуск окна происходит по событию 'eventShowDialogMessage'
 * Возможно добавить неограниченрое колличество кнопок, а также повесить неограниченное
 * колличество реакций(action) на каждую кнопку. Также можно повесить неограниченное
 * колличества реакций на кнопку закрытия окна.
 *
 * Пример:
 * Livewire.emit('eventShowDialogMessage', {
 *      'title': '',      // Заголовок окна (default - сообщение)
 *      'message': '',    // обязательный Отображаемое сообщение
 *      'closeButton': {    // Настройки для кнопки закрыть
 *          actions: []     // Действия такие же как и для кнопок
 *      }
 *      'buttons': [        // Кнопки и их настройки
 *          {
 *              type: 'primary', // Один из вариантов ['primary', 'secondary'], default=primary
 *              text: 'text',    // Напись на кнопке, обязательное
 *              width: 'full',   // Ширина из вариантов ['full', 'half', 'third'], default=full
 *              actions: [
 *                  {
 *                      'type': 'showModal',  // Тип, один из вариантов  ['showModal', 'sendEvent']
 *                      'target': 'm-login',    // Целевой объект, обязателен при наличии 'action'
 *                      'payload': {},          // Нагрузка передаваемая действию, если возможно.
 *                  }, {...}
 *              ]
 *          }
 *      ]
 * })
 */
class DialogMessageLivewire extends Component
{

    const BUTTON_TYPES = ['primary', 'secondary'];
    const BUTTON_WIDTH = ['full', 'half', 'third'];
    const ACTION_TYPES = ['showModal', 'sendEvent'];

    const BUTTON_TYPE_DEFAULT = 'primary';
    const BUTTON_WIDTH_DEFAULT = 'full';

    public string $title = '';
    public string $message = '';
    public array $closeButton = [];
    public array $buttons = [];

    public bool $startShow = false;

    protected $listeners = [
        'eventShowDialogMessage'
    ];

    public function mount()
    {
        if (session('session_message')) {
            try {
                $payload = json_decode(base64_decode(session('session_message')), true);
                $this->parsePayload($payload);
                $this->startShow = true;
            } catch (\Exception $e){}
        }
    }

    public function render()
    {
        return view('livewire.forms.dialog-message-livewire');
    }

    public function eventShowDialogMessage(array $payload)
    {
        $this->parsePayload($payload);

        $this->dispatchBrowserEvent('showModal', [
            'modalId' => 'm-dialog-message',
        ]);
    }

    protected function parsePayload(array $payload)
    {
        $this->reset('title', 'message', 'closeButton', 'buttons');

        $this->title = $payload['title'] ?? __('custom::site.message');

        $this->parseMessage($payload);
        $this->parseCloseButton($payload);
        $this->parseButtons($payload);
    }

    protected function parseMessage(array $payload)
    {
        throw_if(empty($payload['message']), new \Exception('Message is empty.'));
        $this->message = $payload['message'];
    }

    protected function parseCloseButton(array $payload)
    {
        if (!empty($payload['closeButton'])) {
            $this->closeButton['actions'] =
                collect(Arr::get($payload, 'closeButton.action', []))
                    ->map(fn($a) => $this->applyValidActionStructure((array)$a))
                    ->toArray();
        }
    }

    protected function parseButtons(array $payload)
    {
        if (empty($payload['buttons'])) {
            return;
        }

        throw_unless(is_array($payload['buttons']), new \Exception('Buttons collection is wrong.'));

        foreach ($payload['buttons'] as $button) {

            $key = (string)Str::orderedUuid();
            $this->buttons[$key] = [
                'key' => $key,
                'text' => $button['text'] ?? __('custom::site.agree'),
                'type' => $this->parseButtonType($button['type'] ?? 'primary'),
                'width' => $this->parseButtonWidth($button['width'] ?? 'full'),
                'actions' =>
                    collect($button['actions'] ?? [])
                        ->map(fn($a) => $this->applyValidActionStructure((array)$a))
                        ->toArray(),
            ];
        }
    }

    protected function parseButtonType(string $needle): string
    {
        return in_array($needle, self::BUTTON_TYPES)
            ? $needle
            : self::BUTTON_TYPE_DEFAULT;
    }

    protected function parseButtonWidth(string $needle): string
    {
        return in_array($needle, self::BUTTON_WIDTH)
            ? $needle
            : self::BUTTON_WIDTH_DEFAULT;
    }

    public function closeButtonHandler()
    {
        $this->doActions($this->closeButton['actions'] ?? []);
    }

    public function buttonHandler(string $key)
    {
        $button = $this->buttons[$key] ?? null;

        throw_unless($button, new \Exception('Wrong button key.'));

        $this->doActions($button['actions'] ?? []);
    }

    public function doActions(array $actions)
    {
        foreach ($actions as $action) {

            switch ($action['type']) {
                case 'showModal':
                    $this->tryShowModalAction($action);
                    break;
                case 'sendEvent':
                    $this->trySendEventAction($action);
                    break;
            }
        }
    }

    protected function tryShowModalAction(array $action)
    {
        $this->validateActionTarget($action['target']);

        $this->dispatchBrowserEvent('showModal', [
            'modalId' => $action['target'],
        ]);
    }

    protected function trySendEventAction(array $action)
    {
        $this->validateActionTarget($action['target']);

        $this->emit(
            $action['target'],
            $action['payload'] ?: null
        );
    }

    protected function validateActionTarget(string $target)
    {
        throw_unless($target, new \Exception('Target is empty.'));
    }

    protected function applyValidActionStructure(array $data): array
    {
        return array_merge([
            'type' => '',
            'target' => '',
            'payload' => [],
        ], $data);
    }

    public function resolveColCssClass(string $width): string
    {
        switch ($width) {
            case 'third':
                return 'col-md-4';
            case 'half':
                return 'col-md-6';
            default:
                return 'col-md-12';
        }
    }

    public function resolveTypeCssClass(string $type): string
    {
        switch ($type) {
            case 'primary':
                return 'button-accent';
            default:
                return 'button-outline';
        }
    }
}
