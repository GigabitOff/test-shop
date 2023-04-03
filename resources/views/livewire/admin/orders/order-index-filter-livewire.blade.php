<ul class="nav nav-tabs" role="tablist" wire:ignore>
            <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-selected="true"  onclick="@this.setFilter(0)">@lang('custom::admin.All') <span class="nav-item__counter">{{$count}}</span></button></li>
        @foreach($statuses as $statusItem)
        @if($statusItem->ordersCount != 0)
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#new" type="button" role="tab" aria-selected="false" tabindex="-1" onclick="@this.setFilter({{$statusItem->id}})">{{$statusItem->name}} <span class="nav-item__counter">{{$statusItem->ordersCount}}</span></button>
            </li>
        @endif
        @endforeach
          </ul>
