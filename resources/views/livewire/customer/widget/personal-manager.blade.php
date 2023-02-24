<div class="col-xl-6" data-aos="fade-up" data-aos-delay="400" data-aos-duration="500">
  <div class="lk-widjet --manager-info">
    <div class="lk-widjet__head">
      <h3 class="lk-widjet__title">{!! __('custom::site.personal_manager_widget_title') !!}</h3>
    </div>
    <div class="lk-widjet__body">
      <ul class="widjet-user-info">
        <li class="widjet-user-info__item">
          <div class="widjet-user-info__label">@lang('custom::site.fio')</div>
          <div class="widjet-user-info__value">{{$user_name}}</div>
        </li>
        <li class="widjet-user-info__item">
          <div class="widjet-user-info__label">@lang('custom::site.phone')</div>
          <div class="widjet-user-info__value">{{$user_phone}}</div>
        </li>
        <li class="widjet-user-info__item">
          <div class="widjet-user-info__label">@lang('custom::site.Email')</div>
          <div class="widjet-user-info__value">{{$user_email}}</div>
        </li>
      </ul><a href="#m-new-message" data-bs-toggle="modal">Написати менеджеру</a>
    </div>
  </div>

<div class="modal fade" id="m-callback">
  <div class="modal-dialog modal-dialog-centered">
      @include('livewire.customer.widget.write-manager')
  </div>
</div>

</div>


