<ul class="social-list">
    @if(isset($data->facebook))<li><a href="{!! $data->facebook !!}" target="_blank"><span class="ico_facebook"></span></a>
    </li>@endif
    @if(isset($data->instagram))<li><a href="{!! $data->instagram !!}" target="_blank"><span class="ico_instagram"></span></a></li>@endif
    @if(isset($data->youtube))<li><a href="{!! $data->youtube !!}" target="_blank"><span class="ico_youtube"></span></a></li>@endif
</ul>
