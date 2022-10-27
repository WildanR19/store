@extends('layouts.admin')

@section('title') Product Gallery - Store @endsection
@section('content')
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Product Gallery</h2>
        <p class="dashboard-subtitle">Create New Gallery</p>
    </div>
    <div class="dashboard-content">
        <div class="row">
            <div class="col-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('product-gallery.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="product_id">Product</label>
                                        <select name="product_id" id="product_id" class="form-control">
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input id="photo" type="file" class="form-control" name="photo" placeholder="Photo" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <button
                                        type="submit"
                                        class="btn btn-success px-5"
                                    >
                                        Save Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
