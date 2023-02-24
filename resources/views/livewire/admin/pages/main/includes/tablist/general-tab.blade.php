{{-- Категорії меню --}}
@if($dataPage)
<div >
@include('livewire.admin.includes.page-data', ['lang'=>session('lang')])
</div>
    <div wire:ignore>
    <h6>@lang('custom::admin.Category list')</h6>
        @livewire('admin.menu.menu-category.menu-category-item-livewire', ['dataPage' => $dataPage,'page_id'=>$dataPage->id, 'type'=>'main'], key(time().'-page-category-item'))
    </div>
        @endif
    <h6>@lang('custom::admin.Banners list')</h6>
    <div wire:ignore>
    @livewire('admin.banners.banners-item-livewire', ['page_id' => $data['id'], 'type'=>'main'], key(time().$data['id']))
    </div>

    {{--<h6>@lang('custom::admin.Complete Solutions')</h6>
    <div class="row g-4 mb-4" wire:ignore>
        <div class="col-md-6">
            @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Solution').' #1',
                    'type' => 'text',
                    'key'=>'main_solution_1'
                    ], key(time().'-setting-main_solution_1'))
        </div>
        <div class="col-md-6">
            @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => 'URL №1',
                    'type' => 'text',
                    'key'=>'main_solution_url_1'
                    ], key(time().'-setting-main_solution_url_1'))
        </div>
        <div class="col-md-6">
            @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Solution').' #2',
                    'type' => 'text',
                    'key'=>'main_solution_2'
                    ], key(time().'-setting-main_solution_2'))
        </div>
        <div class="col-md-6">
            @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => 'URL №2',
                    'type' => 'text',
                    'key'=>'main_solution_url_2'
                    ], key(time().'-setting-main_solution_url_2'))
        </div>
        <div class="col-md-6">
            @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Solution').' #3',
                    'type' => 'text',
                    'key'=>'main_solution_3'
                    ], key(time().'-setting-main_solution_3'))
        </div>
        <div class="col-md-6">
            @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => 'URL №3',
                    'type' => 'text',
                    'key'=>'main_solution_url_3'
                    ], key(time().'-setting-main_solution_url_3'))
        </div>
        <div class="col-md-6">
            @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Solution').' #4',
                    'type' => 'text',
                    'key'=>'main_solution_4'
                    ], key(time().'-setting-main_solution_4'))
        </div>
        <div class="col-md-6">
            @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => 'URL №4',
                    'type' => 'text',
                    'redirect' => 'admin.pages.index',
                    'key'=>'main_solution_url_4'
                    ], key(time().'-setting-main_solution_url_4'))

        </div>
    </div>
--}}

