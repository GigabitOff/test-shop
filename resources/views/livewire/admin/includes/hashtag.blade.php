    @php
        if(!isset($key_tag))
        $key_tag = 'keywords';
    @endphp
    @if(isset($data[session('lang')][$key_tag]) AND is_array($data[session('lang')][$key_tag]))
    <div class="tagger">
        <input class="form-control" type="hidden" placeholder="Додати хештег" value="sdfsdf,dfsdfsdf" hidden="hidden">
        <ul>
            @foreach ($data[session('lang')][$key_tag] as $item_k)
            <li>
            <a href="javascript: void(0);" class="--yellow">
                <span class="label">{{$item_k}}</span>
                <span href="#" class="close" onclick="@this.unSetDataTags('{{$key_tag}}','{{$item_k}}')">×</span>
            </a>
            </li>
            @endforeach

            <li class="tagger-new">
                <input class="js-tags-next" onkeypress="return addNewsTags(event)" placeholder="@lang('custom::admin.Add hash tags')" >
                <div class="tagger-completion"></div>
            </li>
        </ul>
    </div>
    @else
    <input class="js-tags form-control" onprogress="" type="text" placeholder="@lang('custom::admin.Add hash tags')" value = "">
    @endif

  {{-- on_main <div class="form-group mt-4"><button class="button" type="button">Добавить</button></div>--}}

<script>
    /* ---------------------------- Tags в поле input --------------------------- */

    document.addEventListener('DOMContentLoaded', function () {

        $('.js-tags').on('keypress',function(e) {
            if(e.which == 13) {

                @this.setDataTags('{{$key_tag}}',"'"+$('.js-tags').val()+"'")
            }
        });
   });

   function addNewsTags(e) {
     if(e.which == 13) {

        @this.setDataTags('{{$key_tag}}',"'"+$('.js-tags-next').val()+"'")
        $('.js-tags-next').val('');
    }
   }


  </script>
