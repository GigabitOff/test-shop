<div class="hero-menu__submenu-columns">
    <ul>
        @foreach ($menuCategories as $menuCategory)
            @php($category = $menuCategory->category)

            <li>
                @if($category->image)
                    <img src="{{\Storage::disk('public')->url($category->image)}}" alt="img-submenu">
                @endif
                <h5>
                    <a href="{{ route('catalog.show',$category->slug)}}">{{ $category->name }}</a>
                </h5>
                <ul>
                    @foreach ($category->children as $subcategory)
                        <li><a href="{{ route('catalog.show',$subcategory->slug)}}">{{ $subcategory->name }}</a></li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
