<div class="lk-widjet lk-widjet-invoice">
    <div class="lk-widjet__header">
        @php $totalCount = $totalCount ? '+' . $totalCount : ''; @endphp
        <div class="lk-widjet__title">@lang('custom::site.new_complaints') <span>{{$totalCount}}</span></div>
        <a class="lk-widjet__more-btn" href="{{route('manager.documents.index', ['filter' => 1])}}"><span
                class="ico_angel-r"></span></a>
    </div>
    <div class="lk-widjet__body">
        <ul class="invoice-list">
            @foreach($documents as $document)
                @php
                    $customer = $document->order->customer;
                    $product = $document->products->first();
                    $productSKU = $product->artikul ?? '';
                    $productName = $product->name ?? '';
                    $reason = Str::limit($document->response, 25);
                @endphp
                <li class="invoice-list__item">
                    @if($document->path)
                        <a class="invoice-list__btn"
                           href="{{$document->fileUrl}}"><span
                                class="ico_downloads"></span></a>
                    @endif
                    <div class="invoice-list__desc"><span class="invoice-list__name">{{$customer->name}}</span><span
                            class="invoice-list__text">№ {{$productSKU}} {{$productName}}</span>
                    </div>
                    <div class="invoice-list__info"><span
                            class="invoice-list__date">@lang('custom::site.from') {{formatDate($document->date_at)}}</span><span
                            class="invoice-list__status">{{$reason}}</span></div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
