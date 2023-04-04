<div >
    {{-- orders livewire -- Бренди управління admin.orders.create--}}

   <div id="footable-content"
             class="footable-content @if($this->isNeedRevalidateFootable()) footable-revalidate @endif"
             style="display: none">
            @include('livewire.admin.settings.includes.address-shop-index-footable-render')
        </div>
        <div class="table-before-btn --small"><button class="button button-accent button-small button-icon ico_plus" type="button" data-bs-target="#m-add-address-branch" data-bs-toggle="modal"></button></div>
<table wire:ignore id="footable-holder" class="users-table table-td-small"
               data-empty="@lang('custom::site.data_is_absent')"
               data-show-toggle="true" data-toggle-column="last">
        </table>

    <div class="modal fade" id="m-add-address-branch" tabindex="-1" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ __('custom::admin.Select filial') }}</h5><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="#!">
                @if(count($data)>=3)
                <center style="color:red">
                {{ __('custom::admin.Max 3 address') }}
                </center>
                @else
              <div class="form-group">
                @include('livewire.admin.includes.select-data-arrow',[
                    'select_data_input'=>(isset($select_data['shop_id']) ? $select_data['shop_id']: null),
                    'select_data_array'=>(isset($select_array['shop_id']) ? $select_array['shop_id']: null),
                    'placeholder'=>__('custom::admin.Select filial'),
                    'index'=>'shop_id',
                    'show_title'=>true,
                    //'drop_list'=>'drop-list',
                    //'showKey' => true
                    ])

              </div>
              <div class="mt-4">
                @if(isset($this->select_data['shop_id']))
                <button class="button w-100" wire:click="addShopData" type="button" data-bs-dismiss="modal">Сохранить</button>
                @endif
            </div>
                @endif

            </form>
          </div>
        </div>
      </div>
    </div>
    <script>
        function chaneOrderAddress(key,order) {
            if(order>3)
            {
                order=3;
            }

            @this.changeOrderAddress(key,order);
        }
    </script>
</div>
