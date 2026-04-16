
<h1>Daftar Kategori</h1>

@foreach($categories as $category)
    <div>
        <h3>{{ $category->categoryName }}</h3>
        <p>{{ $category->categoryDescription }}</p>
    </div>
@endforeach

