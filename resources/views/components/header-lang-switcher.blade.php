<div class="{{$classes}}">
  <div class="lang-box dropdown js-dropdown" style="display: {{count($locales)<=1?"none":""}}">
    <div class="lang-box__current dropdown-toggle" data-bs-toggle="dropdown">{{$current}}</div>
    <div class="lang-box__dropdown dropdown-menu">
    @foreach($locales as $locale)
      <a href="{{$locale['href']}}" class="dropdown-item {{$locale['class']}}"> {{$locale['name']}}</a>
    @endforeach
    </div>
  </div>
</div>
