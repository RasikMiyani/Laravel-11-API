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
              <div class="card-header">
                <h4>Create Product
                  <a href="{{ route('products.index') }}" class="btn btn-primary float-end">Back</a>
                </h4>
              </div>
              <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter product name">
                    @error('name')
                      <div class="invalid-feedback mt-1">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="sku" class="form-label">SKU</label>
                    <input type="text" value="{{ old('sku') }}" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" placeholder="Enter product SKU">
                    @error('sku')
                      <div class="invalid-feedback mt-1">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Enter product price">
                    @error('price')
                      <div class="invalid-feedback mt-1">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                      <div class="invalid-feedback mt-1">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label class="form-label d-block mb-2">Status</label>
                    <div class="form-check form-check-inline">
                      <input type="radio" class="form-check-input" id="status_active" name="status" value="active" checked>
                      <label class="form-check-label" for="status_active">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="radio" class="form-check-input" id="status_inactive" name="status" value="inactive">
                      <label class="form-check-label" for="status_inactive">Inactive</label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Create Product</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>