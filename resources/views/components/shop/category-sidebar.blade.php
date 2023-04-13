@props(['categories', 'subcategories'])
<div class="col-lg-2 dropend-categories">
    <ul class="nav flex-column">
        @foreach($categories as $category_)
            @if(!$category_->isEmpty())
            <li class="nav-item {{ $category_->subcategories->count() > 0 ? 'dropend dropend-hover' : ''}} category-link">
                <a class="nav-link {{ $category_->subcategories->count() > 0 ? 'has-navi' : ''}}" href="{{route('shop.category.show', ['category' => $category_->id])}}" id="category{{$category_->id}}" role="button" aria-expanded="false">
                    <i class="bi bi-balloon-heart"></i>
                    <span class="d-block">{{$category_->name}}</span>
                </a>
                @if($category_->subcategories->count() > 0)
                <ul class="dropdown-menu category-dropdown p-0" aria-labelledby="category{{$category_->id}}">
                    @foreach($category_->subcategories as $subcategory)
                        @if(!$subcategory->isEmpty())
                            <li class="dropdown-item
                            @if(!$loop->last)
                            {{'li-border-bottom'}}
                         @endif
                         "><a href="{{route('shop.subcategory.show', ['subcategory' => $subcategory->id])}}">{{$subcategory->name}}</a></li>
                        @endif
                    @endforeach
                </ul>
                @endif
            </li>
            @endif
        @endforeach
    </ul>
</div>
<div class="col-lg-2 dropdown-categories">
    <ul class="nav flex-column">
        @foreach($categories as $category_)
            <li class="nav-item {{ $category_->subcategories->count() > 0 ? 'dropdown' : ''}} category-link">
                <a class="nav-link {{ $category_->subcategories->count() > 0 ? 'has-navi' : ''}}" href="{{route('shop.category.show', ['category' => $category_->id])}}" id="category{{$category_->id}}" role="button" {{ $category_->subcategories->count() > 0 ? 'data-bs-toggle=dropdown' : ''}}  aria-expanded="false">
                    <i class="bi bi-balloon-heart"></i>
                    <span class="d-block">{{$category_->name}}</span>
                </a>
                @if($category_->subcategories->count() > 0)
                    <ul class="dropdown-menu category-dropdown" aria-labelledby="category{{$category_->id}}">
                        @foreach($category_->subcategories as $subcategory)
                            <li><a class="dropdown-item" href="{{route('shop.subcategory.show', ['subcategory' => $subcategory->id])}}">{{$subcategory->name}}</a></li>
                            @if(!$loop->last)
                                <li><hr class="dropdown-divider"></li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </li>

        @endforeach
    </ul>
</div>
