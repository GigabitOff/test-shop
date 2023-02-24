<div class="lk-menu">
    <button class="lk-menu__btn">
        <span>{{$page_title}}</span>
        <span class="ico_arrow"></span>
    </button>
    <div class="lk-menu__box">
        <ul class="lk-menu__list">
            @foreach($data as $item)
                <li @if($item['active']) class="is-active" @endif >
                    <a href="{{$item['href']}}">
                        <span>{{$item['label']}}</span>
                        <i class="ico_menu-arrow"></i>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
