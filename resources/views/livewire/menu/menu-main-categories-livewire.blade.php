@foreach ($menuCategories as $menuCategory)
    @if($category = $menuCategory->category)
        <div class="hero-menu__submenu">
            <div class="hero-menu__submenu-grid">
                <ul>
                    @foreach ($category->children as $child)
                        <li>
                            <a href="{{ route('catalog.show',$child->slug)}}">
                                @if($child->image)
                                    <img src="{{\Storage::disk('public')->url($child->image)}}"
                                         alt="img-submenu">
                                @endif
                                <h5>{{ $child->name }}</h5>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="hero-menu__submenu-brands">
                <ul>
                    @foreach($category->brands as $brand)
                        @if($brand->imageSrc)
                            <li>
                                <a href="{{route('catalog.show', $category->slug)}}?filters[brand_id][{{$brand->id}}]={{$brand->id}}">
                                    <img src="{{$brand->imageSrc}}"
                                         alt="brand {{$brand->name}}">
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

        </div>
    @endif
@endforeach
