@extends('layouts.backend.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('products.index') }}">Products</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('products.update', $product->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Product : {{ $product->name }}</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select name="category"
                                                class="form-control @error('category') is-invalid @enderror">
                                                <option value="">Choose Category</option>
                                                @foreach ($categories as $category)
                                                    @if (old('category', $product->category_id) == $category->id)
                                                        <option value="{{ $category->id }}" selected>
                                                            {{ $category->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputName">Product Name</label>
                                            <input type="text" id="inputName" name="name"
                                                class="form-control @error('name')
                                            is-invalid
                                        @enderror"
                                                value="{{ old('name', $product->name) }}">
                                            @error('name')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="client">Original Price</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="number" name="originalPrice"
                                                    class="form-control @error('originalPrice') is-invalid @enderror"
                                                    value="{{ old('originalPrice', $product->original_price) }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            @error('originalPrice')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="client">Selling Price</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Rp.
                                                    </span>
                                                </div>
                                                <input type="number" name="sellingPrice"
                                                    class="form-control @error('sellingPrice') is-invalid @enderror"
                                                    value="{{ old('sellingPrice', $product->selling_price) }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            @error('sellingPrice')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <div class="input-group">
                                                <input type="number" id="quantity" name="quantity"
                                                    class="form-control @error('quantity') is-invalid @enderror"
                                                    value="{{ old('quantity', $product->quantity) }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        item
                                                    </span>
                                                </div>
                                            </div>
                                            @error('quantity')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tax">Tax</label>
                                            <div class="input-group">
                                                <input type="number" id="tax" name="tax"
                                                    class="form-control @error('tax') is-invalid @enderror"
                                                    value="{{ old('tax', $product->tax) }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            @error('tax')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputImage">Image File</label><br>
                                            @if ($product->image)
                                                <img src="{{ asset('storage/product-images/' . $product->image) }}"
                                                    class="img-fluid img-preview mb-3" width="160px">
                                            @else
                                                <img src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg"
                                                    class="img-fluid img-preview mb-3 col-sm-5 d-block p-0">
                                            @endif
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" id="inputImage" name="image"
                                                        class="custom-file-input @error('image') is-invalid @enderror"
                                                        onchange="previewImage()">
                                                    <label class="custom-file-label" for="inputImage">
                                                        Choose image file
                                                    </label>
                                                </div>
                                            </div>
                                            @error('image')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea id="description" name="description"
                                                class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                                            @error('description')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" id="seenInAllProduct" name="seenInAllProduct"
                                                    class="custom-control-input"
                                                    {{ $product->seen_in_all_product == 1 ? 'checked' : '' }}>
                                                <label for="seenInAllProduct" class="custom-control-label">
                                                    Seen in all product
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" id="seenInTrendingProducts"
                                                    name="seenInTrendingProducts" class="custom-control-input"
                                                    {{ $product->seen_in_trending_products == 1 ? 'checked' : '' }}>
                                                <label for="seenInTrendingProducts" class="custom-control-label">
                                                    Seen in trending products
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-save mr-1"></i> Save Changes
                                        </button>
                                    </div>
                                    <div>
                                        <a href="{{ route('products.index') }}" class="btn btn-danger btn-sm">
                                            <i class="fa fa-times mr-1"></i> Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{-- Custom file input --}}
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>

    {{-- Preview Image --}}
    <script>
        function previewImage() {
            const image = document.querySelector('#inputImage');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush
