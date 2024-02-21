<ul>
    @foreach ($categories as $category)
        <li class="sub-category">
            <div class="category">
                <span class="categoy-title">
                    {{ $category->name }}
                </span>
                <span class="categoy-action">
                    <a href="{{ route('category.edit',$category->id) }}" class="btn btn-primary btn-sm me-2">Edit</a>
                    <a href="{{ route('category.destroy',$category->id) }}" class="btn btn-danger btn-sm me-2">Delete</a>
                </span>
            </div>
            @if ($category->children->count() > 0)
                @include('admin/pages/category/subcategories', ['categories' => $category->children])
            @endif
        </li>
    @endforeach
</ul>
