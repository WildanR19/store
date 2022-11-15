@extends('layouts.dashboard')

@section('title') Transaction Details - Store @endsection
@section('content')
    <div class="dashboard-heading">
        <h2 class="dashboard-title">{{ $transaction->code }}</h2>
        <p class="dashboard-subtitle">Transaction Details</p>
    </div>
    <div class="dashboard-content" id="transactionDetails">
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
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <img
                                    src="{{ Storage::url($transaction->product->gallery->first()->photo) }}"
                                    alt=""
                                    class="w-100 mb-3"
                                />
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">Customer Name</div>
                                        <div class="product-subtitle">{{ $transaction->transaction->user->name }}</div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">Product Name</div>
                                        <div class="product-subtitle">
                                            {{ $transaction->product->name }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">
                                            Date of Transaction
                                        </div>
                                        <div class="product-subtitle">
                                            @php
                                                $date = date_create($transaction->created_at);
                                            @endphp
                                            {{ date_format($date,"d F, Y H:i") }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">Payment Status</div>
                                        <div class="product-subtitle text-danger">
                                            {{ $transaction->transaction->transaction_status }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">Total Amount</div>
                                        <div class="product-subtitle">${{ number_format($transaction->transaction->total_price) }}</div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">Mobile</div>
                                        <div class="product-subtitle">
                                            {{ $transaction->transaction->user->phone_number }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-4">
                                <h5>Shipping Informations</h5>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">Address 1</div>
                                        <div class="product-subtitle">
                                            {{ $transaction->transaction->user->address_one }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">Address 2</div>
                                        <div class="product-subtitle">
                                            {{ $transaction->transaction->user->address_two }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">Province</div>
                                        <div class="product-subtitle">{{ $transaction->transaction->user->province->name }}</div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">City</div>
                                        <div class="product-subtitle">{{ $transaction->transaction->user->regency->name }}</div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">Postal Code</div>
                                        <div class="product-subtitle">{{ $transaction->transaction->user->zip_code }}</div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="product-title">Country</div>
                                        <div class="product-subtitle">{{ $transaction->transaction->user->country }}</div>
                                    </div>
                                    <div class="col-12">
                                        <form action="{{ route('dashboard.transaction.update', $transaction->id) }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="product-title">Shipping Status</div>
                                                    <select
                                                        name="shipping_status"
                                                        id="status"
                                                        class="form-control"
                                                        v-model="status"
                                                    >
                                                        <option value="PENDING">PENDING</option>
                                                        <option value="SHIPPING">SHIPPING</option>
                                                        <option value="SUCCESS">SUCCESS</option>
                                                    </select>
                                                </div>
                                                <template v-if="status === 'SHIPPING'">
                                                    <div class="col-md-3">
                                                        <div class="product-title">
                                                            Input Resi
                                                        </div>
                                                        <input
                                                            class="form-control"
                                                            type="text"
                                                            name="resi"
                                                            id="resi"
                                                            v-model="resi"
                                                        />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button
                                                            type="submit"
                                                            class="btn btn-success btn-block mt-4"
                                                        >
                                                            Update Resi
                                                        </button>
                                                    </div>
                                                </template>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        const transactionDetails = new Vue({
            el: "#transactionDetails",
            data: {
                status: "{{ $transaction->shipping_status }}",
                resi: "{{ $transaction->resi }}",
            },
        });
    </script>
@endpush
