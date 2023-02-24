<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.Add review on site')
            <small>@lang('custom::site.on_project_domain')</small>
        </h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        @if($success)
            <h3>@lang('custom::site.Your feedback has been sent.')</h3>
            <div class="form-group mt-2">
                <button class="button button-secondary button-block button-lg" type="button"
                        data-dismiss="modal">@lang('custom::site.Close')
                </button>
            </div>
        @endif
        <form wire:submit.prevent="sendData" id="review-form" autocomplete="off">
            <div class="form-group">
                <fieldset class="rating">
                    <div class="rating__group">
                        <input wire:model="data.rating" class="rating__input"
                               id="rating-1" type="radio" name="rating"
                               value="1" checked=""/>
                        <label class="rating__star" for="rating-1"
                               aria-label="Ужасно"></label>
                        <input wire:model="data.rating" class="rating__input"
                               id="rating-2" type="radio" name="rating"
                               value="2"/>
                        <label class="rating__star" for="rating-2" aria-label="Сносно"></label>
                        <input wire:model="data.rating" class="rating__input"
                               id="rating-3" type="radio" name="rating"
                               value="3"/>
                        <label class="rating__star" for="rating-3" aria-label="Нормально"></label>
                        <input wire:model="data.rating" class="rating__input"
                               id="rating-4" type="radio" name="rating"
                               value="4"/>
                        <label class="rating__star" for="rating-4" aria-label="Хорошо"></label>
                        <input wire:model="data.rating" class="rating__input"
                               id="rating-5" type="radio" name="rating"
                               value="5"/>
                        <label class="rating__star" for="rating-5" aria-label="Отлично"></label>
                    </div>
                </fieldset>
                @error('data.rating')
                <div class="invalid-feedback"
                     style="display:block;">@lang('custom::site.select_count_stars')</div>
                @enderror
            </div>

            <div class="form-group">
                <input class="form-control @error('data.name') is-invalid @enderror"
                       wire:model.defer="data.name"
                       type="text" placeholder="@lang('custom::site.Fio')" name="name">

                <div class="invalid-feedback">@error('data.name'){{$message}}@enderror</div>

            </div>
            <div class="form-group">
                <input class="js-phone form-control @error('data.phone') is-invalid @enderror" type="text"
                       onchange="@this.set('phoneRaw', this.value)"
                       name="phone" placeholder="Номер телефону">

                <div class="invalid-feedback">@error('data.phone'){{$message}}@enderror</div>
            </div>
            <div class="form-group">
                <textarea class="form-control @error('data.text') is-invalid @enderror"
                          wire:model.defer="data.text" class="form-control" type="text"
                          placeholder="@lang('custom::site.Response')" name="message">
                </textarea>

                <div class="invalid-feedback">@error('data.text'){{$message}}@enderror</div>
            </div>
            <div class="form-group">
                <button class="button-accent w-100" type="submit"
                        onclick="@this.set('phoneRaw', $('#review-form').find('input[name=phone]').val());">
                    @lang('custom::site.Add')
                </button>
            </div>
        </form>
    </div>
</div>