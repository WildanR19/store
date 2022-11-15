@extends('layouts.admin')

@section('title') Product - Store @endsection
@section('content')
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Transaction</h2>
        <p class="dashboard-subtitle">List of Transactions</p>
    </div>
    <div class="dashboard-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover scroll-horizontal-vertical w-100" id="productTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        const dataTable = $('#productTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}'
            },
            columns: [
                { data: 'id', name: 'id'},
                { data: 'user.name', name: 'user.name'},
                { data: 'total_price', name: 'total_price'},
                { data: 'transaction_status', name: 'transaction_status'},
                { data: 'created_at', name: 'created_at'},
                { data: 'action', name: 'action', orderable: false, searchable: false, width: '15%'},
            ]
        });
    </script>
@endpush
