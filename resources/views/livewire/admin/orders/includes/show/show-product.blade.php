<h4 class="order-table-title">Список товаров</h4>
          <table class="js-table_new table-td-small table-order" wire:ignore data-sorting="true">
            <thead>
              <tr>
                <th data-sortable="false">Id<br> @lang('custom::admin.products.Product artikul')</th>
                <th data-breakpoints="x-small small" data-sortable="false">@lang('custom::admin.products.Product name')</th>
                <th data-sortable="false">@lang('custom::admin.products.seller')</th>
                <th data-breakpoints="x-small small" data-sortable="false">@lang('custom::admin.products.Availability')</th>
                <th data-breakpoints="x-small small" data-sortable="false">@lang('custom::admin.products.Price')</th>
                <th data-breakpoints="x-small" data-sortable="true">@lang('custom::admin.products.Count')</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($this->dataPage->products as $item)
                <tr>
                <td>{{ $item->id }}<span class="order-name">{{ $item->articul }}</span></td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->seller}}</td>
                <td>{{ $item->availability }}</td>
                <td>{{ $item->price_init }}</td>
                <td>{{ $item->stock }}</td>
              </tr>
                @endforeach
            </tbody>
          </table>
