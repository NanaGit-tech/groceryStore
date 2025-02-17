

    <h2>Add New Product</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="price">Price:</label>
        <input type="text" name="price" required>

        <label for="description">Description:</label>
        <textarea name="description"></textarea>

        <label for="category">Category:</label>
        <input type="text" name="category" required>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" required>

        <label for="photo">Product Image:</label>
        <input type="file" name="photo">

        <button type="submit">Save Product</button>
    </form>
