<ul class="add-social">
    @php($ifSocialData='')

    @php(isset($data['social']['facebook']) AND $ifSocialData = $data['social']['facebook'])
    <li class="add-social__item @if(isset($ifSocialData) AND $ifSocialData != '') is-active @endif" data-social="facebook">
            <span class="add-social__btn" @if(isset($ifSocialData) AND $ifSocialData != '')  onclick="@this.clearSocialParams('facebook')" @endif></span>
        <a class="add-social__link"  href="#m-add-social" data-bs-toggle="modal" onclick="@this.setSocialParams('facebook','Facebook')">
            <span class="add-social__icon ico_facebook"></span>
            <span class="add-social__text">@if(isset($ifSocialData) AND $ifSocialData != ''){{$ifSocialData}}@endif</span>
        </a>
    </li>
    @php($ifSocialData='')
    @php(isset($data['social']['instagram']) AND $ifSocialData = $data['social']['instagram'])
    <li class="add-social__item  @if(isset($ifSocialData) AND $ifSocialData != '') is-active @endif" data-social="instagram">
            <span class="add-social__btn" @if(isset($ifSocialData) AND $ifSocialData != '') onclick="@this.clearSocialParams('instagram')" @endif></span>
        <a class="add-social__link" href="#m-add-social" data-bs-toggle="modal" onclick="@this.setSocialParams('instagram','Instagram')" >
            <span class="add-social__icon ico_instagram"></span>
            <span class="add-social__text" >@if(isset($ifSocialData) AND $ifSocialData != ''){{$ifSocialData}}@endif</span>
        </a>
    </li>
    @php($ifSocialData='')
    @php(isset($data['social']['twitter']) AND $ifSocialData = $data['social']['twitter'])
    <li class="add-social__item  @if(isset($ifSocialData) AND $ifSocialData != '') is-active @endif" data-social="twitter">
            <span class="add-social__btn"@if(isset($ifSocialData) AND $ifSocialData != '')  onclick="@this.clearSocialParams('twitter')" @endif></span>
        <a class="add-social__link" href="#m-add-social" data-bs-toggle="modal" onclick="@this.setSocialParams('twitter','Twitter')" >
            <span class="add-social__icon ico_twitter"></span>
            <span class="add-social__text">@if(isset($ifSocialData) AND $ifSocialData != ''){{$ifSocialData}}@endif</span>
        </a>
    </li>
    @php($ifSocialData='')
    @php(isset($data['social']['linkedin']) AND $ifSocialData = $data['social']['linkedin'])
    <li class="add-social__item  @if(isset($ifSocialData) AND $ifSocialData != '') is-active @endif" data-social="linkedin">
            <span class="add-social__btn" @if(isset($ifSocialData) AND $ifSocialData != '') onclick="@this.clearSocialParams('linkedin')"  @endif></span>
        <a class="add-social__link" href="#m-add-social" data-bs-toggle="modal" onclick="@this.setSocialParams('linkedin','Linkedin')">
            <span class="add-social__icon ico_linkedin"></span><span class="add-social__text" wire:click="clearSocialParams('linkedin')">@if(isset($ifSocialData) AND $ifSocialData != ''){{$ifSocialData}}@endif</span>
        </a>
    </li>

    @php($ifSocialData='')
    @php(isset($data['social']['telegram']) AND $ifSocialData = $data['social']['telegram'])
    <li class="add-social__item  @if(isset($ifSocialData) AND $ifSocialData != '') is-active @endif" data-social="telegram">
            <span class="add-social__btn" @if(isset($ifSocialData) AND $ifSocialData != '') onclick="@this.clearSocialParams('telegram')"  @endif></span>
        <a class="add-social__link" href="#m-add-social" data-bs-toggle="modal" onclick="@this.setSocialParams('telegram','Telegram')">
            <span class="add-social__icon ico_telegram"></span><span class="add-social__text" wire:click="clearSocialParams('telegram')">@if(isset($ifSocialData) AND $ifSocialData != ''){{$ifSocialData}}@endif</span>
        </a>
    </li>

    @php($ifSocialData='')
    @php(isset($data['social']['viber']) AND $ifSocialData = $data['social']['viber'])
    <li class="add-social__item  @if(isset($ifSocialData) AND $ifSocialData != '') is-active @endif" data-social="linkedin">
            <span class="add-social__btn" @if(isset($ifSocialData) AND $ifSocialData != '') onclick="@this.clearSocialParams('viber')"  @endif></span>
        <a class="add-social__link" href="#m-add-social" data-bs-toggle="modal" onclick="@this.setSocialParams('viber','Viber')">
            <span class="add-social__icon ico_viber"></span><span class="add-social__text" wire:click="clearSocialParams('viber')">@if(isset($ifSocialData) AND $ifSocialData != ''){{$ifSocialData}}@endif</span>
        </a>
    </li>

    @php($ifSocialData='')
    @php(isset($data['social']['youtube']) AND $ifSocialData = $data['social']['youtube'])
    <li class="add-social__item  @if(isset($ifSocialData) AND $ifSocialData != '') is-active @endif" data-social="youtube">
            <span class="add-social__btn" @if(isset($ifSocialData) AND $ifSocialData != '') onclick="@this.clearSocialParams('youtube')"  @endif></span>
        <a class="add-social__link" href="#m-add-social" data-bs-toggle="modal" onclick="@this.setSocialParams('youtube','YouTube')" >
            <span class="add-social__icon ico_youtube"></span>
            <span class="add-social__text" wire:click="clearSocialParams('youtube')">@if(isset($ifSocialData) AND $ifSocialData != ''){{$ifSocialData}}@endif</span>
        </a>
    </li>
    @php($ifSocialData='')
    @php(isset($data['social']['tiktok']) AND $ifSocialData = $data['social']['tiktok'])
    <li class="add-social__item  @if(isset($ifSocialData) AND $ifSocialData != '') is-active @endif" data-social="tiktok">
            <span class="add-social__btn" @if(isset($ifSocialData) AND $ifSocialData != '') onclick="@this.clearSocialParams('tiktok')"  @endif></span>
        <a class="add-social__link" href="#m-add-social" data-bs-toggle="modal" onclick="@this.setSocialParams('tiktok','Tiktok')">
            <span class="add-social__icon ico_tiktok"></span><span class="add-social__text" wire:click="clearSocialParams('tiktok')">@if(isset($ifSocialData) AND $ifSocialData != ''){{$ifSocialData}}@endif</span>
        </a>
    </li>
</ul>

<div class="modal fade" id="m-add-social" tabindex="-1" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          @if($social_name !== 'none')

          <div class="modal-header">
            <h5 class="modal-title">@lang('custom::admin.Add') <span>{{$social_name}}</span></h5><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" onclick="@this.resetSocial()"></button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <input class="form-control" type="text" placeholder="@lang('custom::admin.Link to go')" value="{{isset($data['social'][$social_key]) ? $data['social'][$social_key] : ''}}" onchange = "@this.set('data_tmp.social.{{$social_key}}',this.value)">
                </div>
              <div class="mt-4">

                  <button class="button w-100" onclick="@this.AddSocialData()" type="button" data-bs-dismiss="modal" aria-label="Close">@lang('custom::admin.Save')</button>
                </div>
          </div>
        @endif

        </div>
      </div>
    </div>
