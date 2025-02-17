
<div class="container">
    <h2>Edit Product</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
    </div>

    <div class="form-group">
        <label>Price:</label>
        <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
    </div>

    <div class="form-group">
        <label>Description:</label>
        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
    </div>

    <div class="form-group">
        <label>Category:</label>
        <input type="text" name="category" class="form-control" value="{{ $product->category }}" required>
    </div>

    <div class="form-group">
        <label>Stock:</label>
        <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
    </div>

    <!-- Image Upload Field -->
    <div class="form-group">
        <label>Product Image:</label>
        <input type="file" name="photo" class="form-control">
        
        @if($product->photo)
            <img src="{{ asset('storage/' . $product->photo) }}" width="100" class="mt-2">
        @endif
    </div>

    <button type="submit" class="btn btn-success">Update Product</button>
</form>
</div>
