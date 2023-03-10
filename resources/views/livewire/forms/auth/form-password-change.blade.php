<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">{{__('custom::site.password_change')}}
            <small>{{__('custom::site.on_project_domain')}}</small></h5>
        <button class="btn-close" type="button"
                data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <form wire:submit.prevent="submit" class="_pass-form">
            <div class="form-group">
                <p>@lang('custom::site.changing_password_convenient')</p>
            </div>
            <div class="form-group">
                <input class="_pass _pass-1 form-control @error('password') is-invalid @enderror"
                       wire:model.defer="password"
                       type="password" placeholder="{{__('custom::site.password')}}"
                       required>
                <div class="show-password"></div>
                @error('password')
                <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <input class="_pass-2 form-control" type="password"
                       wire:model.defer="password_confirmation"
                       placeholder="{{__('custom::site.password_confirm')}}"
                       required>
                <div class="show-password"></div>
                <div class="invalid-feedback">{{__('custom::site.password_equal_fail')}}</div>
            </div>
            <div class="password-quality">
                <div
                    class="_password-quality-title password-quality__title">{{__('custom::site.password_quality')}}</div>
                <ul class="_password-quality password-quality__list">
                    <li class="one"></li>
                    <li class="two"></li>
                    <li class="three"></li>
                    <li class="four"></li>
                    <li class="five"></li>
                </ul>
            </div>
            <div class="form-group">
                <button class="button-accent w-100" type="submit" data-bs-dismiss="modal">
                    {{__('custom::site.do_confirm')}}</button>
            </div>
        </form>
    </div>
</div>

@push('custom-scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if($autoShow)
            setTimeout(function () {
                $('.modal').modal('hide');
                $('#m-change-password').modal('show');
            }, 2000);
            @endif
        });

        //# sourceURL=modal-password-change.js
    </script>
@endpush
