<div>

    <div class="container">
        @include('livewire.admin.includes.head_button',['route'=>route('admin.product.create',['category_id'=>$category->id]),'lang'=>'admin.Add Product'])
    </div>
    <div class="container">
        @include('livewire.admin.includes.search')
    </div>
    <div class="container">
        <div class="row">
            <div class="text-align-right">
                {{ $data_paginate->links()}}
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" width="30">#</th>
                        <th scope="col">@lang('custom::admin.Name')</th>
                        <th scope="col" data-breakpoints="xs sm md" width="200">@lang('custom::admin.Slug')</th>
                        <th scope="col" data-breakpoints="xs sm md" width="200">@lang('custom::admin.Image')</th>

                        <th scope="col" data-breakpoints="xs sm md" width="20%">@lang('custom::admin.Take action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_paginate as $key=>$item)
                    <tr @if($key==0) data-expanded="true" @endif>
                        <th scope="row">{{ $item->id }}</th>

                        <td>
                            @if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->title)){{$item->translate(session('lang'))->title}}@else{{config('app.fallback_locale') }}@endif
                        </td>

                        <td>
                            {{ isset($item->slug) ? $item->slug: '' }}
                        </td>
                        <td>
                            @if(isset($item->image) AND
                            \Storage::disk('public')->exists($item->image))
                            <img src="{{ \Storage::disk('public')->url($item->image) }}" width="80" alt="">
                            @endif
                        </td>


                        <td>
                            <a href="{{ route('admin.product.edit', [$item->id, 'category_id'=>$category->id] ) }}"
                                class="btn btn-sm btn-outline-dark mr-2">@lang('custom::admin.Edit')</a>

                            <button class="btn btn-sm btn-danger"
                                data-toggle="modal" data-target="#dellMode{{$item->id}}"">@lang('custom::admin.Del')</button>
                                @include('livewire.admin.includes.scripts_data',['wire_click'=>'destroyData('.$item->id.')','key'=>$item->id, 'title'=>'Видалити продукт: '.$item->title])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
