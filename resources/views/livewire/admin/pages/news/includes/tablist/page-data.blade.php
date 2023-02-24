<div >
@include('livewire.admin.includes.page-data', ['lang'=>session('lang')])
</div>
<div class="page-save text-end text-xl-start">
        @include('livewire.admin.includes.save-data-include',['wire_click'=>'saveData','title_button'=>__('custom::admin.Save')])
</div>
