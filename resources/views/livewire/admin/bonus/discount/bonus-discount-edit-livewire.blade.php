<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.'.$nameLive.'.index'])
    <h4 class="text-center text-lg-start">
        {{ isset($data[session('lang')]['title']) ? $data[session('lang')]['title'] : '' }}
    </h4>
   @include('livewire.admin.bonus.discount.includes.add-edit-single',['hide_seo'=>true])

</div>
