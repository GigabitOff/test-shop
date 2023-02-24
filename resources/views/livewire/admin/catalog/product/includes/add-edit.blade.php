@foreach($languages as $key=>$lang)
<div class="card card-primary tab-pane fade @if($key==$show_lang) show active @endif" id="nav-{{$key}}" role="tabpanel"
    aria-labelledby="nav-{{$key}}-tab">
    <!-- /.card-header -->
    <div class="card-body">
        <div class="form-group">
            <label for="pageTitle{{$key}}">
                @lang('custom::admin.Title')
            </label>
            <input type="text" class="form-control @error('data.{{$key}}.title') is-invalid @enderror"
                 placeholder="@lang('custom::admin.Title')" wire:model="data.{{$key}}.title">
            @error('data.{{$key}}.title')
            <span  class="error invalid-feedback">{{ @$message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="pageH1{{$key}}">
                @lang('custom::admin.H1')
            </label>
            <input type="text" class="form-control" id="pageH1{{$key}}" placeholder="@lang('custom::admin.H1')"
                wire:model="data.{{$key}}.h1">
        </div>

        <div class="form-group">
            <label>@lang('custom::admin.Description')</label>
            <textarea class="form-control" rows="3" placeholder="@lang('custom::admin.Description')"
                wire:model.lazy="data.{{$key}}.description">
                                @if(isset($data[$key]['description']))
                                {{ $data[$key]['description'] }}
                                @endif
                                </textarea>
        </div>
        <div class="form-group" wire:ignore>
            <label>@lang('custom::admin.Body')</label>
            <textarea class="form-control" rows="3" cols="30" data-description="@this" placeholder="@lang('custom::admin.Body')"
                wire:model="data.{{$key}}.body" id="pageBody{{$key}}">
                                    @if(isset($data[$key]['body']))
                                    {{ $data[$key]['body'] }}

                                    @endif
                                </textarea>
            @include('livewire.admin.includes.ckeditor-form', ['formId'=>'pageBody', 'nameForm'=>'body'])
        </div>

        <h5>SEO</h5>
        <div class="form-group">
            <label for="pageMetaTitle{{$key}}">@lang('custom::admin.Meta title')</label>
            <input type="text" class="form-control" id="pageMetaTitle{{$key}}" placeholder="@lang('custom::admin.Meta title')"
                wire:model="data.{{$key}}.meta_title">
        </div>
        <div class="form-group">
            <label>@lang('custom::admin.Meta keywords')</label>
            <textarea class="form-control" rows="3" placeholder="@lang('custom::admin.Meta keywords')"
                wire:model="data.{{$key}}.meta_keywords"></textarea>
        </div>
        <div class="form-group">
            <label>@lang('custom::admin.Meta description')</label>
            <textarea class="form-control" rows="3" placeholder="@lang('custom::admin.Meta description')"
                wire:model="data.{{$key}}.meta_description"></textarea>
        </div>
    </div>

    <!-- /.card-body -->


</div>
<!-- /.card -->
@endforeach
