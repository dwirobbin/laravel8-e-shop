@extends('layouts.backend.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('categories.index') }}">Categories</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Category</li>
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
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Quick Example</h3>
                        </div>

                        <!-- form start -->
                        <form action="{{ route('categories.update', $category->slug) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Category Name</label>
                                    <input type="text" id="inputName" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter category name" value="{{ old('name', $category->name) }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="inputImage">Image File</label><br>
                                    @if ($category->image)
                                        <img src="{{ asset('storage/category-images/' . $category->image) }}"
                                            class="img-fluid img-preview mb-3" width="160px">
                                    @else
                                        <img src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg"
                                            class="img-fluid img-preview mb-3 col-sm-5 d-block p-0">
                                    @endif
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="inputImage" name="image"
                                                class="custom-file-input @error('image')
                                            is-invalid
                                        @enderror"
                                                onchange="previewImage()">
                                            <label class="custom-file-label" for="inputImage">Choose file</label>
                                        </div>
                                    </div>
                                    @error('image')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" id="seenInAllCategory" name="seenInAllCategory"
                                                    class="custom-control-input"
                                                    {{ $category->seen_in_all_category == 1 ? 'checked' : '' }}>
                                                <label for="seenInAllCategory" class="custom-control-label">
                                                    Seen in all category
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" id="seenInPopularCategories"
                                                    name="seenInPopularCategories" class="custom-control-input"
                                                    {{ $category->seen_in_popular_categories == 1 ? 'checked' : '' }}>
                                                <label for="seenInPopularCategories" class="custom-control-label">
                                                    Seen in popular categories
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Save Changes
                                        </button>
                                    </div>
                                    <div>
                                        <a href="{{ route('categories.index') }}" class="btn btn-warning">
                                            <i class="fas fa-arrow-left"></i> Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
