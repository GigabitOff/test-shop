
<div class="modal-header">
    <h5 class="modal-title">@lang('custom::admin.Review Moderation')</h5><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    @if(isset($success))
    <p><i class="ico_{{$type}}"></i><span>{{$success}}</span></p>
    {{--<div style="text-align: center;"><i class="ico_success"></i><span>{{ $success }}</span></div>--}}
    @else
    @if(isset($item_id))
            <ul class="list-info">
              <li><span>@lang('custom::admin.By whom')</span><strong>
                  <a class="nowrap" href="{{ route('admin.users.edit', [$data_show->user_id]) }}" target="_blank"> {{ isset($data_show->name) ? $data_show->name: '' }}</a></strong></li>
                @if(isset($data_show->getProduct->articul))
              <li><span>@lang('custom::admin.products.Articul')</span><strong>№ {{ $data_show->getProduct->articul }}</strong></li>
              <li><span>@lang('custom::admin.Product')</span><a target="_blank" href="{{ route('products.show',$data_show->getProduct->id)}}">{{ route('products.show',$data_show->getProduct->id)}}</a></li>
              @endif
              <li><span>@lang('custom::admin.Rating')</span>
                <fieldset class="rating">
                  <div class="rating__group">
                      @for ($i = 1; $i <= 5; $i++)
                        <input class="rating__input" id="-{{$i}}" type="radio" name="" value="{{$i}}" onclick="@this.setRating({{$i}});" @if(isset($data['rating']) AND $data['rating'] == $i) checked @endif /><label class="rating__star" onclick="@this.setRating({{$i}});" for="-{{$i.'-'.$data_show->id}}" aria-label="@lang('custom::admin.rating.'.$i)"></label>
                        @endfor
                  </div>
                </fieldset>
              </li>
            </ul>
              <div class="form-group">
                  <textarea class="form-control" placeholder="@lang('custom::admin.Text review')" wire:model="data.text">{{ $data_show->text }}</textarea></div>
              <div class="row mt-4">
                <div class="col-6">
                    <button class="button w-100" type="button"
                            onclick="@this.changeStatusReview('{{ $data_show->id }}'); {{--changeTableFoot();--}}">
                        @lang('custom::admin.Confirm')</button>
                </div>
                <div class="col-6"><button class="button button-secondary w-100" type="button" onclick="@this.destroyData('{{ $data_show->id }}')">@lang('custom::admin.Delete')</button></div>
              </div>
@else

@lang('custom::admin.Loading')
@endif
@endif
</div>
