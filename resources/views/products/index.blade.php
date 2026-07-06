<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark text-white p-5">
      <h1>Welcome to Laravel 11 CRUD</h1>
    </div>
    <div>
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div>
                    @if (Session::has('error'))
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
              <div class="card-header">
                <h4>Products
                  <a href="{{ route('products.create') }}" class="btn btn-primary float-end">Add Product</a>
                </h4>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>SKU</th>
                      <th>Price</th>
                      <th width="100" class="text-center">Status</th>
                      <th width="150" class="text-center">Action</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($products->isNotEmpty())
                        @foreach($products as $product)
                            <tr>
                            <td>{{ $product->id }}</td>
                            <td>@if(empty($product->image))
                                <img class="rounded" src="{{ asset('https://placehold.co/600x400') }}" alt="Default Image" class="img-fluid" width="50">
                                @else
                                <img class="rounded" src="{{ asset('storage/uploads/products/' . $product->image) }}" alt="Product Image" class="img-fluid" width="50">
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>${{ $product->price }}</td>
                            <td class="text-center">
                                @if($product->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                                </form>
                            </td>
                            <td>{{ $product->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $product->updated_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center">No Products Available</td>
                        </tr>
                    @endif
                  </tbody>
              </div>
            </div>
          </div>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>