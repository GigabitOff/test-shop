<div class="hero-menu__submenu-brands">
    <ul>
        @foreach ($menuCategories as $menuCategory)
            @if($category = $menuCategory->category)
                @foreach ($category->brands as $brand)
                    @if($brand->imageSrc)
                        <li>
                            <a href="{{route('catalog.show', $category->slug)}}?filters[brand_id][{{$brand->id}}]={{$brand->id}}">
                                <img src="{{$brand->imageSrc}}" alt="brand {{$brand->title}}">
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>
</div>
