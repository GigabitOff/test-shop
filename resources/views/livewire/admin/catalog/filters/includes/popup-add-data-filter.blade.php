<div class="modal fade" id="m-add-data-filter" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">@lang('custom::admin.Filters create')</h5><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @if(!isset($item_id))
              <div id="message_banner" style="display: none; font-size: 18pt; color: red">
                @lang('custom::admin.Data download in progress')
              </div>
              @endif
              @if(session('success_add_data'))
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-lable="close">
                        <span aria-hidden="true">x</span>
                        </button>
                            {{ session()->get('success_add_data') }}
                        </div>
                    </div>
                </div>
            @endif
            <form action="#!">
                <h4>@lang('custom::admin.Select attribute')</h4>
                <div class="form-group">
                    {{--<div class="input-group" wire:ignore>
                        @include('livewire.admin.includes.select-data-arrow',['select_data_input'=>(isset($select_data['product_column']) ? $select_data['product_column']: null),'select_data_array'=>$product_column, 'placeholder'=>__('custom::admin.product_column'),'index'=>'product_column','show_name'=>true])

                    </div>--}}
                    @if(!isset($select_data['product_column']))
                    <div class="input-group" wire:ignore>
                        @include('livewire.admin.includes.select-data-dropdown',['select_data_input'=>(isset($select_data['attribute']) ? $select_data['attribute']['id']: null),'select_data_array'=>$atributes, 'placeholder'=>__('custom::admin.Attribute'),'index'=>'attribute', 'title_select'=>__('custom::admin.Attribute'),'data_type'=>'single'])

                    </div>
                    @endif
                </div>
                @if(isset($data['attribute_id']) OR isset($data['column_product']))
                <ul class="list-clear my-4">
                    <li>
                        <label class="check --radio" onclick="@this.changeDataItem('basic','{{isset($data['basic']) AND $data['basic']==1 ? 0 : 1}}')">
                            <input class="check__input" type="checkbox" @if(isset($data['basic']) AND $data['basic']==1) checked @endif/>
                            <span class="check__box">@lang('custom::admin.Basic attribute')</span>
                        </label>
                    </li>
                </ul>
                <div><button class="button" type="button" onclick="@this.saveData()" data-bs-dismiss="modal" aria-label="Close">{{__('custom::admin.Add')}}</button></div>
                @endif
            </form>
          </div>
        </div>
    </div>
</div>
