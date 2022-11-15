@extends('layouts.dashboard')

@section('title') Product Detail - Store @endsection
@section('content')
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Shirup Marzan</h2>
        <p class="dashboard-subtitle">Product Details</p>
    </div>
    <div class="dashboard-content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <form action="{{ route('dashboard.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Product Name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="name"
                                            aria-describedby="name"
                                            name="name"
                                            value="{{ $product->name }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="price"
                                            aria-describedby="price"
                                            name="price"
                                            value="{{ $product->price }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select name="category_id" id="category" class="form-control">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $product->category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea
                                            name="description"
                                            id="description"
                                            class="form-control"
                                        >{{ $product->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button
                                        type="submit"
                                        class="btn btn-success btn-block px-5"
                                    >
                                        Update Product
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach($product->gallery as $gallery)
                                <div class="col-md-4">
                                    <div class="gallery-container">
                                        <img
                                            src="{{ Storage::url($gallery->photo) }}"
                                            alt=""
                                            class="w-100"
                                        />
                                        <a class="delete-gallery" href="{{ route('dashboard.product.gallery.delete', $gallery->id) }}">
                                            <img src="{{ url('/images/icon-delete.svg') }}" alt="" />
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-md-12 mt-3">
                                <form action="{{ route('dashboard.product.gallery.upload') }}" method="post" enctype="multipart/form-data" id="galleryForm">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input
                                        type="file"
                                        id="file"
                                        style="display: none"
                                        name="photo"
                                        onchange="form.submit()"
                                    />
                                    <button
                                        type="button"
                                        class="btn btn-secondary btn-block"
                                        onclick="thisFileUpload();"
                                    >
                                        Add Photo
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

        function thisFileUpload() {
            document.getElementById("file").click();
        }
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector("#description"))
            .then((editor) => {
                console.log(editor);
            })
            .catch((error) => {
                console.error(error);
            });
    </script>
@endpush
