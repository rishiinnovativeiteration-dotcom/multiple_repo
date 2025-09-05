<!DOCTYPE html>

<head>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {               /* //RED GREEN BLUE */
            background-color: rgba(105, 90, 90, 0.32);
        }

        a {
            font-size: 30px;
            text-decoration: none;
        }
    </style>
</head>

<body>
        <h3>hello123</h3>
        <h4>hello456789</h4>
    <h1 class="text-center mt-2 ">Product List</h1>
    <a href="{{ route('products.create') }}">Add New Product</a>

    <table class="table table-hover text-center table-striped border-primary table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Images</th>
            <th>Actions</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    @if($product->image)
                    <img src="{{ asset('uploads/'.$product->image) }}" width="80px" alt="Product Image">
                    @else
                        NO Image
                    @endif
                </td>
                <td>
                    <a class="btn btn-secondary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>