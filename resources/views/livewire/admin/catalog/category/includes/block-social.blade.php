<ul class="add-social">

    @php($ifSocialData='')

    @php(isset($data['facebook']) AND $ifSocialData = $data['facebook'])
    <li class="add-social__item @if(isset($ifSocialData) AND $ifSocialData != '') is-active @endif" data-social="facebook">
            <span class="add-social__btn" @if(isset($ifSocialData) AND $ifSocialData != '')  onclick="@this.clearSocialParams('facebook')" @endif></span>
        <a class="add-social__link"  href="#m-add-social" data-bs-toggle="modal" onclick="@this.setSocialParams('facebook','Facebook')">
            <span class="add-social__icon ico_facebook"></span>
            <span class="add-social__text">@if(isset($ifSocialData) AND $ifSocialData != ''){{$ifSocialData}}@endif</span>
        </a>
    </li>
    @php($ifSocialData='')
    @php(isset($data['instagram']) AND $ifSocialData = $data['instagram'])
    <li class="add-social__item  @if(isset($ifSocialData) AND $ifSocialData != '') is-active @endif" data-social="instagram">
            <span class="add-social__btn" @if(isset($ifSocialData) AND $ifSocialData != '') onclick="@this.clearSocialParams('instagram')" @endif></span>
        <a class="add-social__link" href="#m-add-social" data-bs-toggle="modal" onclick="@this.setSocialParams('instagram','Instagram')" >
            <span class="add-social__icon ico_instagram"></span>
            <span class="add-social__text" >@if(isset($ifSocialData) AND $ifSocialData != ''){{$ifSocialData}}@endif</span>
        </a>
    </li>
    @php($ifSocialData='')
    @php(isset($data['twitter']) AND $ifSocialData = $data['twitter'])
    <li class="add-social__item  @if(isset($ifSocialData) AND $ifSocialData != '') is-active @endif" data-social="twitter">
            <span class="add-social__btn"@if(isset($ifSocialData) AND $ifSocialData != '')  onclick="@this.clearSocialParams('twitter')" @endif></span>
        <a class="add-social__link" href="#m-add-social" data-bs-toggle="modal" onclick="@this.setSocialParams('twitter','Twitter')" >
            <span class="add-social__icon ico_twitter"></span>
            <span class="add-social__text">@if(isset($ifSocialData) AND $ifSocialData != ''){{$ifSocialData}}@endif</span>
        </a>
    </li>
    @php($ifSocialData='')
    @php(isset($data['linkedin']) AND $ifSocialData = $data['linkedin'])
    <li class="add-social__item  @if(isset($ifSocialData) AND $ifSocialData != '') is-active @endif" data-social="linkedin">
            <span class="add-social__btn" @if(isset($ifSocialData) AND $ifSocialData != '') onclick="@this.clearSocialParams('linkedin')"  @endif></span>
        <a class="add-social__link" href="#m-add-social" data-bs-toggle="modal" onclick="@this.setSocialParams('linkedin','Linkedin')">
            <span class="add-social__icon ico_linkedin"></span><span class="add-social__text" wire:click="clearSocialParams('linkedin')">@if(isset($ifSocialData) AND $ifSocialData != ''){{$ifSocialData}}@endif</span>
        </a>
    </li>
    @php($ifSocialData='')
    @php(isset($data['youtube']) AND $ifSocialData = $data['youtube'])
    <li class="add-social__item  @if(isset($ifSocialData) AND $ifSocialData != '') is-active @endif" data-social="youtube">
            <span class="add-social__btn" @if(isset($ifSocialData) AND $ifSocialData != '') onclick="@this.clearSocialParams('youtube')"  @endif></span>
        <a class="add-social__link" href="#m-add-social" data-bs-toggle="modal" onclick="@this.setSocialParams('youtube','YouTube')" >
            <span class="add-social__icon ico_youtube"></span>
            <span class="add-social__text" wire:click="clearSocialParams('youtube')">@if(isset($ifSocialData) AND $ifSocialData != ''){{$ifSocialData}}@endif</span>
        </a>
    </li>
</ul>

<div class="modal fade" id="m-add-social" tabindex="-1" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          @if(isset($social_name) AND $social_name !== 'none')

          <div class="modal-header">
            <h5 class="modal-title">@lang('custom::admin.Add') <span>{{$social_name}}</span></h5><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" onclick="@this.resetSocial()"></button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <input class="form-control" type="text" placeholder="@lang('custom::admin.Link to go')" wire:model.lazy = 'data.{{$social_key}}'>
                </div>
              <div class="mt-4">
                  <button class="button w-100"  type="button" data-bs-dismiss="modal" aria-label="Close" onclick="@this.resetSocial()">@lang('custom::admin.Save')</button>
                </div>
          </div>
        @endif

        </div>
      </div>
    </div>
