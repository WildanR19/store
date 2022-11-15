@extends('layouts.dashboard')

@section('title') Create Product - Store @endsection
@section('content')
<div class="dashboard-heading">
    <h2 class="dashboard-title">Add New Product</h2>
    <p class="dashboard-subtitle">Create your own product</p>
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
            <form action="{{ route('dashboard.product.store') }}" method="post" enctype="multipart/form-data">
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
                                    />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category_id" id="category" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        cols="30"
                                        rows="5"
                                        class="form-control"
                                    ></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="thumbnails">Thumbnails</label>
                                    <input
                                        type="file"
                                        multiple
                                        class="form-control pt-1"
                                        id="thumbnails"
                                        aria-describedby="thumbnails"
                                        name="thumbnails"
                                        required
                                    />
                                    <small class="text-muted">
                                        Kamu dapat memilih lebih dari satu file
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <button
                            type="submit"
                            class="btn btn-success btn-block px-5"
                        >
                            Save Now
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
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
