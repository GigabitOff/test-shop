@extends('layouts.admin')
@php
$title=__('custom::admin.Bonus');
@endphp
@section('class_body'){{'class="cashback"'}}@endsection
@section('content')
    @livewire('admin.bonus.bonus.bonus-bonus-edit-livewire', ['item_id'=>$id], key(time().'bonus-edit'))
{{-- тимчасовий код --}}
    <script>
    $(document).on('input', '.search__controls > input, .tagger-new > input', function () {
    let textLenght = $(this).val().length;

    if (textLenght >= 1) {
      $(this).closest('.search').addClass('is-active');
      $(this).closest('.search').find('.search__drop').addClass('is-show');
      $('.search__overlay').addClass('is-show');
      $('body').addClass('no-scroll');
    } else {
      $(this).closest('.search').find('.search__drop').removeClass('is-show');
      $('.search').removeClass('is-active');
      $('.search__overlay').removeClass('is-show');
      $('body').removeClass('no-scroll');
    }
  });
  $(document).on('click', '.search__close, .search__btn button', function () {
    $('.search__drop').addClass('is-show');
    $('.search__overlay').removeClass('is-show');
    $('.search').removeClass('is-active');
  });
  $(document).on('click', function (e) {
    if (!$(e.target).closest(".search").length) {
      $('.search__drop').addClass('is-show');
      $('.search__overlay').removeClass('is-show');
      $('.search').removeClass('is-active');
      $('body').removeClass('no-scroll');
    }

    e.stopPropagation();
  });
  $(document).on('input', '.sidebar-search input', function () {
    let textLenght = $(this).val().length;

    if (textLenght > 0) {
      $(this).closest('.sidebar-search').find('.form-control-clear').addClass('--active');
    } else {
      $(this).closest('.sidebar-search').find('.form-control-clear').removeClass('--active');
    }
  });
  $(document).on('click', '.form-control-clear', function () {
    $(this).closest('.sidebar-search').find('.form-control').val('');
    $(this).removeClass('--active');
  });
  $(document).on('click', '.js-change', function () {
    let numb = $(this).closest('tr').find('.js-art').text();
    let tags = `<li>
                  <a href="/tag/${numb}" target="_black">
                    <span class="label">${numb}</span>
                    <span class="close">Г—</span>
                  </a>
                </li>`;
    $(tags).prependTo('.search__result-box .tagger > ul');
    $('.search__result-box .tagger > input.js-tags').val(numb + ', ' + $('.search__result-box .tagger > input.js-tags').val());
  });
  $(document).on('keyup', '.js-password', function () {
    var reg = /[Р°-СЏРђ-РЇС‘РЃ]/g;

    if (this.value.search(reg) != -1) {
      $('.js-cirilick').addClass('is-show');
    } else {
      $('.js-cirilick').removeClass('is-show');
    }
  });
  $('.js-password').capsChecker({
    capson: function (e, isOn) {
      $('.js-capslock').addClass('is-show');
    },
    capsoff: function (e, isOn) {
      $('.js-capslock').removeClass('is-show');
    }
  });
  var langList = new Swiper(".js-lang-list", {
    slidesPerView: "4",
    scrollbar: {
      el: ".swiper-scrollbar",
      draggable: true
    },
    mousewheel: true
  });
  $(document).on('click', '.button-change', function () {
    $(this).toggleClass('is-change');
  });
  $(document).on('input', '.form-control-file__text > input', function () {
    let textLenght = $(this).val().length;
    let box = $(this).closest('.form-control-file');
    let boxUpload = box.find('.form-control-file__upload');

    if (textLenght >= 1) {
      boxUpload.addClass('is-not-active');
    } else {
      boxUpload.removeClass('is-not-active');
    }
  });
</script>
    @endsection
