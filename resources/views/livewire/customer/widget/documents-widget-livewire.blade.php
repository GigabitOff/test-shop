<div class="lk-widjet lk-widjet-document">
    <div class="lk-widjet__title">
        <span>@lang('custom::site.not_signed_they')</span>
        <span class="text-lowercase" style="color: inherit">@lang('custom::site.documents')</span>
        @php($totalCount = $total ? "+$total" : '')
        <span>{{$totalCount}}</span>
    </div>
    <div class="lk-widjet__body">
        <ul class="widjet-document-list">
            @foreach($records as $document)
                <li>
                    <div>
                        <a href="{{$document->fileUrl}}" target="_blank">№ {{$document->registry_no}}</a>
                        <span class="text-lowercase">@lang('custom::site.from') {{formatDate($document->date_at)}}</span>
                    </div>
                    <div>
                        <span>@lang('custom::site.not_signed_it')</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
