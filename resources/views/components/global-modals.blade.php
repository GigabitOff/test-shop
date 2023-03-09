<div class="modals">
{{--   // Глобальные Модальные окна видны на всех страницах приложения  --}}


    @guest
{{--   // Модальные окна для гостей  --}}
        <x-modal-form id="m-login"><livewire:forms.auth.login-livewire/></x-modal-form>
        <x-modal-form id="m-registration"><livewire:forms.auth.registration-livewire/></x-modal-form>
        <x-modal-form id="m-password-recovery"><livewire:forms.auth.password-recovery-livewire/></x-modal-form>

    @endguest

    @auth
{{--    // Модальные окна для зарегистрированных пользователей  --}}

    @endauth

{{--    // Модальные окна для всез пользователей  --}}


{{--    // Вариант flash popup без использования Livewire --}}
    <x-modal-form id="m-flash-info">@include('components.flash-info')</x-modal-form>
{{--    // Вариант Dialog popup основанный на Livewire, более настраиваемый  --}}
    <x-modal-form id="m-dialog-message"><livewire:forms.dialog-message-livewire/></x-modal-form>


    <x-modal-form id="m-callback">
        <livewire:forms.feedback-test-livewire/>
    </x-modal-form>
</div>
