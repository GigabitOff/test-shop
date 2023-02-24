<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.feedback')<small>@lang('custom::site.on_project_domain')</small></h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <form wire:submit.prevent="submit">
            @if(session()->has('chat_message_fail'))
                <div class="alert alert-danger" role="alert">
                    {{ session('chat_message_fail') }}
                </div>
            @endif

            @if(session()->has('chat_message_success'))
                <div class="alert alert-success" role="alert">
                    {{ session('chat_message_success') }}
                </div>
            @endif

            <div class="form-group">
                <input class="form-control" type="text" name="fio"
                       wire:model.lazy="fio"
                       placeholder="@lang('custom::site.s_fio')" required><span></span>

                @error('fio')
                <div class="invalid-feedback" style="display:block;"> {{$message}} </div>
                @enderror
            </div>

            <div class="form-group">
                <input class="form-control" type="email" name="email"
                       wire:model.lazy="email"
                       placeholder="@lang('custom::site.Email')" required><span></span>

                @error('email')
                <div class="invalid-feedback" style="display:block;"> {{$message}} </div>
                @enderror
            </div>

            <div class="form-group">
                <input class="js-phone form-control" type="text"
                       onchange="@this.set('phoneRaw', this.value)"
                       wire:model.defer="phoneRaw"
                       value="{{$phoneRaw}}"
                       autocomplete="off"
                       name="phone" placeholder="@lang('custom::site.phone')"
                       required><span></span>
                @error('phone')
                <div class="invalid-feedback" style="display:block;"> {{$message}} </div>
                @enderror
            </div>
            <div class="form-group">
                <x-livewire.nice-select
                    name="department"
                    model="departmentId"
                    :list="$departmentList"
                    :placeholder="__('custom::site.select_department')">
                </x-livewire.nice-select>
                @error('department')
                <div class="invalid-feedback" style="display:block;"> {{$message}} </div>
                @enderror

            </div>
            <div class="form-group">
                <textarea class="form-control" type="text"
                          wire:model.lazy="message"
                          placeholder="@lang('custom::site.accompanying_text')" name="message"
                          required>
                </textarea><span></span>
                @error('message')
                <div class="invalid-feedback" style="display:block;"> {{$message}} </div>
                @enderror
            </div>
            <div class="form-group">
                <button class="button-accent button-accent w-100" type="submit">
                        @lang('custom::site.Send')</button>
            </div>
        </form>
    </div>
</div>
