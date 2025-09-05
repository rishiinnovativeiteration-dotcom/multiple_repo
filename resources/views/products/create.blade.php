<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 30px;
            height: 350px;
            width: 350px;
            background-color: beige;
            display: flex;
            align-items: center;
            /* align-items: center;*/
            border-radius: 9px;
        }
        input{
            width: 100%;
            margin-top: 9px;
        }
        
    </style>
</head>

<body>
    <h1 class="text-center mt-2">Add Product</h1>
    <div class="container">
        <form enctype="multipart/form-data" class="form-control-lg" action="{{ route('products.store') }}" method="post">
            @csrf
            Name:<input type="text" name="name"><br>
            Price:<input type="text" name="price"><br>
            Discription:<textarea name="description"></textarea><br>
            Image: <input type="file" name="image">
            <button class="btn btn-danger" type="submit">Save</button>
        </form>
    </div>
</body>
</html>