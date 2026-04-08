<h1>Daftar Produk</h1>

@foreach($product as $product)
    <div style="border:1px solid #ccc; margin:10px; padding:10px;">
        <h3>{{ $product->productName }}</h3>
        <p>Harga: Rp {{ $product->productPrice }}</p>

        @if($product->productImage1)
            <img src="{{ asset('storage/'.$product->productImage1) }}" width="150">
        @endif
    </div>
@endforeach
