<div>
<table class="footable footable-1" style="width: 500px">
    <tbody>
@if(isset($category_related) AND count($category_related)>0)
        @foreach ($category_related as $item)
        <tr>
            <td style="display: table-cell; width: 80%"><span>{{ $item['name'] }}</span></td>
            <td style="display: table-cell;"><button class="button button-icon ico_trash" wire:click="removeRelatedData({{ $item['id'] }})"></button></td>
        </tr>
        @endforeach
@endif
        @if(isset($addData) AND count($addData)>0)
        @foreach ($addData as $key_tmp=>$item_tmp_data)

        <tr>
            <td style="display: table-cell; width: 80%"><span>{{ $item_tmp_data['show'] ?? $item_tmp_data['show']}}</span></td>
            <td style="display: table-cell;"><button class="button button-icon ico_trash" wire:click="removeRelatedData('{{ $key_tmp }}')"></button></td>
        </tr>
        @endforeach
        @endif

    </tbody>
</table>
{{--
<script>

    document.addEventListener("DOMContentLoaded", function(event) {
        $('.form-control').on('input',function() {
            setTimeout(() => {
                    changeTableFoot();

            }, 1200);
         });
    });
</script>--}}

        <div class="form-group"  wire:ignore.self>
            <div class="input-group"><span class="input-group-text">@lang('custom::admin.Category')</span>
                @include('livewire.admin.includes.select-data-search-category',[
                    'select_data_input'=>(isset($select_data['category_0']['input']) ? $select_data['category_0']: null),
                    'select_data_array'=>isset($this->select_array['category_0'])? $this->select_array['category_0'] : [],
                    'placeholder'=>__('custom::admin.Subcategory'),
                    'index'=>'category_0',
                    'show_name'=>true
                    ])
            </div>
        </div>
        @if(isset($this->select_data['category_0']['id']) AND isset($this->select_array[$this->select_data['category_0']['id']]))
        <div class="form-group"  wire:ignore.self>
            <div class="input-group" wire:ignore><span class="input-group-text">@lang('custom::admin.Subcategory')</span>
                @include('livewire.admin.includes.select-data-search-category',[
                    'select_data_input'=>(isset($select_data['category_1']) ? $select_data['category_1']: null),
                    'select_data_array'=>$select_array[$this->select_data['category_0']['id']],
                    'placeholder'=>__('custom::admin.Subcategory'),
                    'index'=>'category_1','show_name'=>true])
            </div>
        </div>
        @endif
        @if(isset($this->select_data['category_1']['id']) AND isset($this->select_array[$this->select_data['category_1']['id']]))
        @if(isset($this->select_data['category_1']['id']) AND isset($this->select_array[$this->select_data['category_1']['id']]))
        <div class="form-group"  wire:ignore.self>
            <div class="input-group input-group--4" >
                <span class="input-group-text">@lang('custom::admin.Tovar category')</span>
        @include('livewire.admin.includes.select-data-search-category',[
                    'select_data_input'=>(isset($select_data['category_2']) ? $select_data['category_2']: null),
                    'select_data_array'=>$select_array[$this->select_data['category_1']['id']],
                    'placeholder'=>__('custom::admin.Subcategory'),
                    'index'=>'category_2','show_name'=>true])


            @for ($i = 3; $i < 10; $i++)
                @if(isset($this->select_data['category_'.($i-1)]['id']) AND isset($this->select_array[$this->select_data['category_'.($i-1)]['id']]))
                @include('livewire.admin.includes.select-data-search-category',[
                    'select_data_input'=>(isset($select_data['category_'.$i]) ? $select_data['category_'.$i]: null),
                    'select_data_array'=>$select_array[$this->select_data['category_'.($i-1)]['id']],
                    'placeholder'=>__('custom::admin.Subcategory'),
                    'index'=>'category_'.$i,'show_name'=>true])
                @endif
            @endfor
            </div>
        </div>
        @endif
        @endif
        <div class="page-save d-flex flex-column flex-sm-row justify-content-between mt-4">
        @if(!isset($from_category))
         <button class="button mb-2" type="button" onclick="@this.emit('getCategoryAttributes')">@lang('custom::admin.Update Category Attributes')</button>
        @endif
         @if(isset($data['category_id']))
        <button class="button  mb-2" type="button" wire:click="addCategoryToTable">@lang('custom::admin.Connect Category')</button>
        @endif
        </div>
    </div>


