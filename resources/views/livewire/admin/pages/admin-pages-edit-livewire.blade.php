<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link @if(-1==$show_lang) active @endif" id="nav-main-tab" data-toggle="tab"
                        href="#nav-0" wire:click="changeLangTab(-1)" role="tab" aria-controls="nav-0"
                        aria-selected="false" style="color: black;">
                        <span class="nav-item-text">{{config('app.locales')[$lang]}} Загальні дані</span>
                    </a>
                    @if($allLang)
                    @foreach($languages as $key=>$lang)

                    <a class="nav-item nav-link @if($key==$show_lang) active @endif" id="nav-{{$key}}-tab"
                        data-toggle="tab" href="#nav-{{$key}}" wire:click="changeLangTab('{{$key}}')" role="tab"
                        aria-controls="nav-{{$key}}" aria-selected="false" style="color: black;">
                        <span class="nav-item-text"> {{ $lang }}</span>
                    </a>
                    @endforeach
                    @endif
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="card card-primary tab-pane fade @if(-1==$show_lang) show active @endif" id="nav-0"
                        role="tabpanel" aria-labelledby="nav-0-tab">
                        <div class="card-body col-12">
                            <div class="form-group">
                                <label for="pageTitle{{$lang}}">
                                    @lang('custom::admin.Title')
                                </label>
                                <input type="text"
                                    class="form-control @error('data.{{$lang}}.title') is-invalid @enderror"
                                    id="pageTitle{{$lang}}" placeholder="@lang('custom::admin.Title')"
                                    wire:model="data.{{$lang}}.title">
                            </div>
                            <div class="form-group">
                                <label for="pageSlug">Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                    id="pageSlug" placeholder="Slug" wire:model="slug">
                            </div>

                            <div class="form-group" wire:ignore>
                                <label>Верхнє меню</label>
                                <span onclick="@this.changeStatusAll('top_menu');">
                                    <input type="checkbox" wire:model="data.top_menu" data-toggle="toggle" data-on="Так"
                                        @if(isset($data['top_menu'])) checked @endif data-off="Ні" data-size="sm">
                                </span>
                            </div>
                            <div class="form-group" wire:ignore>
                                <label>Нижнє меню</label>
                                <span onclick="@this.changeStatusAll('footer_menu');">
                                    <input type="checkbox" wire:model="data.footer_menu" data-toggle="toggle"
                                        data-on="Так" @if(isset($data['footer_menu'])) checked @endif data-off="Ні"
                                        data-size="sm">
                                </span></div>
                            <div class="form-group">
                                <label for="pageH1{{$lang}}">
                                    @lang('custom::admin.H1')
                                </label>
                                <input type="text" class="form-control" id="pageH1{{$lang}}"
                                    placeholder="@lang('custom::admin.H1')" wire:model="data.{{$lang}}.h1">
                            </div>
                            @if($select_pages)
                            <div class="form-group row">
                                <label for="forParentPage" class="col-sm-3 col-form-label">Включено в </label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="forParentPage" wire:model="data.parent_id">
                                        <option value="0">обрати сторінку</option>
                                        @foreach ($select_pages as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            @if($data['parent_id'] == 17)
                            <div class="form-group">
                                @include('livewire.admin.includes.add-document',
                                ['itleImage'=>"Документ локально."])
                            </div>
                            @else
                            <div class="form-group">
                                @include('livewire.admin.includes.add-img-locale')

                            </div>
                            @endif
                            <div class="form-group">
                                <label>@lang('custom::admin.Description')</label>
                                <textarea class="form-control" rows="3" placeholder="@lang('custom::admin.Description')"
                                    wire:model.lazy="data.{{$lang}}.description">
                                    @if(isset($data[$lang]['description']))
                                    {{ $data[$lang]['description'] }}
                                    @endif
                                </textarea>
                            </div>
                            @if($data['parent_id'] != 17)
                            <div class="form-group" wire:ignore>
                                <label>@lang('custom::admin.Body')</label>
                                <textarea class="form-control" rows="3" cols="30" data-description="@this"
                                    placeholder="@lang('custom::admin.Body')" wire:model="data.{{$lang}}.body"
                                    id="pageBody{{$lang}}">
                                        @if(isset($data[$lang]['body']))
                                        {{ $data[$lang]['body'] }}

                                        @endif
                                </textarea>
                               @include('livewire.admin.includes.ckeditor-form', ['formId'=>'pageBody', 'nameForm'=>'body'])
                            </div>
                            @endif
                            <h5>SEO</h5>
                            <div class="form-group">
                                <label for="pageMetaTitle{{$lang}}">@lang('custom::admin.Meta title')</label>
                                <input type="text" class="form-control" id="pageMetaTitle{{$lang}}"
                                    placeholder="@lang('custom::admin.Meta title')" wire:model="data.{{$lang}}.meta_title">
                            </div>
                            <div class="form-group">
                                <label>@lang('custom::admin.Meta keywords')</label>
                                <textarea class="form-control" rows="3" placeholder="@lang('custom::admin.Meta keywords')"
                                    wire:model="data.{{$lang}}.meta_keywords"></textarea>
                            </div>
                            <div class="form-group">
                                <label>@lang('custom::admin.Meta description')</label>
                                <textarea class="form-control" rows="3" placeholder="@lang('custom::admin.Meta description')"
                                    wire:model="data.{{$lang}}.meta_description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pagelink{{$lang}}">
                                    @lang('custom::admin.Link')
                                </label>
                                <input type="text"
                                    class="form-control @error('data.{{$lang}}.link') is-invalid @enderror"
                                    id="pagelink{{$lang}}" placeholder="@lang('custom::admin.Link')"
                                    wire:model="data.{{$lang}}.link">
                            </div>
                            <div class="form-group" wire:ignore>
                                <label>Статус</label>
                                <span onclick="@this.changeStatusAll('status');">
                                    <input type="checkbox" wire:model="data.status" checked data-toggle="toggle"
                                        data-on="Активно" data-off="Не активно" data-size="sm">
                                </span>
                            </div>
                        </div>
                    </div>
                    @include('livewire.admin.pages.includes.add-edit')
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" wire:click="saveData">@lang('custom::admin.Save')</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
