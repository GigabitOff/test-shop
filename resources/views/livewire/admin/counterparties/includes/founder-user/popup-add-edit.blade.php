 <div class="modal fade" id="m-add-edit-founder-user" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('custom::admin.'.$indexFounder)</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @if(isset($keyFounder[$indexFounder]))
<form action="#!">
    <div class="form-group">
        <div class="mt-4">
            <div class="person-box__body is-active " style="display: block;" >
                        <div class="row g-3">
                          <div class="col-12">
                            <input class="form-control @error('data.'.$indexFounder.'.'.$keyFounder[$indexFounder].'.name') is-invalid @enderror"  type="text" wire:model.lazy="data.{{ $indexFounder }}.{{ $keyFounder[$indexFounder] }}.name" placeholder="@lang('custom::admin.FIO')">
                            @error('data.'.$indexFounder.'.'.$keyFounder[$indexFounder].'.name')
                            <div class="is-invalid ">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                          <div class="col-12">
                            <input class="js-phone form-control @error('data.'.$indexFounder.'.'.$keyFounder[$indexFounder].'.phone') is-invalid @enderror" onchange="@this.set('data.{{ $indexFounder }}.{{ $keyFounder[$indexFounder] }}.phone',this.value); "  wire:model.lazy="data.{{ $indexFounder }}.{{ $keyFounder[$indexFounder] }}.phone" type="text" placeholder="@lang('custom::admin.Phone')" inputmode="text">
                            @error('data.'.$indexFounder.'.'.$keyFounder[$indexFounder].'.phone')
                            <div class="is-invalid ">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                          <div class="col-12">
                            <input class="form-control @error('data.'.$indexFounder.'.'.$keyFounder[$indexFounder].'.email') is-invalid @enderror"  type="text" wire:model.lazy="data.{{ $indexFounder }}.{{ $keyFounder[$indexFounder] }}.email" placeholder="E-mail">
                            @error('data.'.$indexFounder.'.'.$keyFounder[$indexFounder].'.name')
                            <div class="is-invalid ">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                          <div class="col-12">
                            <input class="form-control @error('data.'.$indexFounder.'.'.$keyFounder[$indexFounder].'.job') is-invalid @enderror"  type="text" wire:model.lazy="data.{{ $indexFounder }}.{{ $keyFounder[$indexFounder] }}.job" placeholder="@lang('custom::admin.founderJobs')">
                            @error('data.'.$indexFounder.'.'.$keyFounder[$indexFounder].'.job')
                            <div class="is-invalid ">
                                {{ $message }}
                            </div>
                            @enderror
                </div>
                @if(!isset($error_data_title))
                          <div class="col-12">

                <button class="button w-100" type="button" @if($item_id) data-bs-dismiss="modal" aria-label="Close" @else onclick="@this.addRemoveFounderUser()"  @endif >@lang('custom::admin.Save')</button>
                        </div>
            @endif
                        </div>

                    </div>

            </div>
        </div>
    </form>


<script>
    jQuery(document).ready(function ($) {
            $('.js-phone').inputmask({"mask": "+38(999) 999-99-99"});

    })
        function showMasc(item) {
            $(item).inputmask({"mask": "+38(999) 999-99-99"});
        }
</script>
@endif
</div>
        </div>
    </div>
</div>
