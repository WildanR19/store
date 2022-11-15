@extends('layouts.admin')

@section('title') transaction - Store @endsection
@push('addon-style')
    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }
        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
@endpush
@section('content')
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Transaction</h2>
        <p class="dashboard-subtitle">Create New Transaction</p>
    </div>
    <div class="dashboard-content">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('transaction.update', $transaction->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="transaction_status">Transaction Status</label>
                                        <select name="transaction_status" id="transaction_status" class="form-control">
                                            <option value="PENDING" {{ $transaction->transaction_status == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                            <option value="SHIPPING" {{ $transaction->transaction_status == 'SHIPPING' ? 'selected' : '' }}>SHIPPING</option>
                                            <option value="SUCCESS" {{ $transaction->transaction_status == 'SUCCESS' ? 'selected' : '' }}>SUCCESS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="total_price">Total Price</label>
                                        <input id="total_price" type="number" class="form-control" name="total_price" required value="{{ $transaction->total_price }}" />
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

@push('addon-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector("#description"))
            .catch((error) => {
                console.error(error);
            });
    </script>
@endpush
