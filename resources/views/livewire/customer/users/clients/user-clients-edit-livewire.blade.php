
<div class="lk-page__content">
    <div class="lk-page__head">
        <div class="lk-page__back"><a class="button-back" href="{{route('customer.users.index')}}">Повернутись<i class="ico_angle-left"></i></a></div>
        <h1 class="lk-page__title">Картка користувача</h1>
        <div class="lk-page__empty"></div>
    </div>
    <div class="lk-page__user-box user-box">
        <form class="user-box__inner" action="#!">
            <div class="user-box__left">
                @include('livewire.customer.users.clients.includes.add-edit-single')
            </div>
            <div class="user-box__right">
            <div>
              <div class="form-group">
                <label class="check">
                    <input class="check__input" type="checkbox" @if($this->data_collect->blocked_ip_id == 1) checked="checked" onclick="@this.unblockUser({{$data_collect['id']}})" @else onclick="@this.blockUser({{$data_collect['id']}})"  @endif />
                    <span class="check__box"></span><span class="check__txt">Заблокован</span></label></div>
              <div class="form-group">
                <label class="check">
                    <input class="check__input" type="checkbox" @if($data_collect->deleted_at) checked="checked"  @endif  onclick="@this.removeUser({{ $data_collect->id }})" />
                    <span class="check__box"></span><span class="check__txt">Видален</span></label></div>
              <div class="form-group">
                <label class="check">
                    <input class="check__input" type="checkbox" /><span class="check__box"></span>
                    <span class="check__txt">@lang('custom::admin.Subscribed to newsletter')</span></label>
              </div>
              <div class="form-group">
                <label class="check">
                    <input class="check__input" type="checkbox" @if(isset($data['is_admin']) AND $data['is_admin']==1) checked @endif onclick="@this.changeDataItem('is_admin','{{(isset($data['is_admin']) AND $data['is_admin']==1) ? 0 : 1}}')" />
                    <span class="check__box"></span>
                    <span class="check__txt">@lang('custom::admin.Admin group')</span></label></div>

               @if($data_collect)
                    @livewire('customer.users.clients.user-clients-blocked-livewire',['data_collect'=>$data_collect,'phone'=>isset($phone) ? $phone : null],
                    key(time().'user-clients-blocked-livewire'))
                @endif

                <div class="form-group user-box__btn">
                    <button class="button-accent" type="button" onclick="@this.saveData();">Зберегти</button>
                </div>
            </div>
            <div>
                <div class="form-group"><button class="button-accent" type="button" data-bs-target="#modal-counterparty-create" data-bs-toggle="modal">Додати контрагента</button></div>
                </div>
            </div>
        </form>
    </div>
    <script>
        function changeItemDataSelect(id,html) {
            html = html.replace(/ +/g, ' ').trim();
            $('#'+id).val(html);
            $('#'+id).text(html);
        }
    </script>
</div>
@push('show-data')

    <x-modal-form id="modal-counterparty-create">
        {{-- Форма создания контрагента --}}
        <livewire:forms.counterparty-create-livewire/>
    </x-modal-form>


@endpush
