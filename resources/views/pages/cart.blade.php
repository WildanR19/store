@extends('layouts.app')

@section('title') Cart - Store @endsection
@section('content')
    <div class="page-details page-content">
        <section
            class="store-breadcrumbs"
            data-aos="fade-down"
            data-aos-delay="100"
        >
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name & Seller</th>
                                <th>Price</th>
                                <th>Menu</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $total_price = 0; @endphp
                            @foreach($carts as $cart)
                                <tr>
                                    <td>
                                        @if(count($cart->product->gallery))
                                            <img
                                                src="{{ Storage::url($cart->product->gallery->first()->photo) }}"
                                                alt="{{ $cart->product->name }}"
                                                class="cart-image"
                                            />
                                        @else
                                            <img
                                                src="{{ url('/images/empty.jpg') }}"
                                                alt="{{ $cart->product->name }}"
                                                class="cart-image"
                                            />
                                        @endif
                                    </td>
                                    <td>
                                        <div class="product-title">{{ $cart->product->name }}</div>
                                        <div class="product-subtitle">by {{ $cart->product->user->store_name }}</div>
                                    </td>
                                    <td>
                                        <div class="product-title">${{ $cart->product->price }}</div>
                                        <div class="product-subtitle">USD</div>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.delete', $cart->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-remove-cart">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                                @php $total_price += $cart->product->price; @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                </div>

                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-12">
                        <h2 class="mb-4">Shipping Details</h2>
                    </div>
                </div>

                <form action="{{ route('checkout') }}" method="POST" id="locations">
                    @csrf
                    <input type="hidden" name="total_price" value="{{ $total_price }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_one">Address 1</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="address_one"
                                    name="address_one"
                                    value="{{ Auth::user()->address_one }}"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_two">Address 2</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="address_two"
                                    name="address_two"
                                    value="{{ Auth::user()->address_two }}"
                                />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="province">Province</label>
                                <select name="province_id" id="province" class="form-control" v-if="provinces" v-model="province_id">
                                    <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City</label>
                                <select name="regencies_id" id="city" class="form-control" v-if="regencies" v-model="regency_id">
                                    <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="postalCode">Postal Code</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="postalCode"
                                    name="zip_code"
                                    value="{{ Auth::user()->zip_code }}"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="country"
                                    name="country"
                                    value="{{ Auth::user()->country }}"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="mobile"
                                    name="phone_number"
                                    value="{{ Auth::user()->phone_number }}"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-12 mb-2">
                        <h2>Payment Informations</h2>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="product-title">$0</div>
                        <div class="product-subtitle">Country Tax</div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="product-title">$0</div>
                        <div class="product-subtitle">Product Insurance</div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="product-title">$0</div>
                        <div class="product-subtitle">Ship to Bandung</div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="product-title text-success">${{ $total_price }}</div>
                        <div class="product-subtitle">Total</div>
                    </div>
                    <div class="col-8 col-md-3">
                        <button type="submit" class="btn btn-success btn-block mt-4 px-4"
                        >Checkout Now</button
                        >
                    </div>
                </div>
                </form>
            </div>
        </section>
    </div>
@endsection


@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        const locations = new Vue({
            el: "#locations",
            mounted() {
                AOS.init();
                this.getProvincesData()
                this.getRegenciesData()
            },
            data: {
                provinces: null,
                regencies: null,
                province_id: {{ $user->province_id ?: 'null' }},
                regency_id: {{ $user->regencies_id ?: 'null' }},
            },
            methods: {
                getProvincesData() {
                    const self = this;
                    axios.get("{{ route('api.location.province') }}")
                        .then(function (response) {
                            self.provinces = response.data
                        });
                },
                getRegenciesData() {
                    const self = this;
                    axios.get("{{ url('api/location/regency') }}/" + self.province_id)
                        .then(function (response) {
                            self.regencies = response.data
                        });
                }
            },
            watch: {
                province_id: function (val, oldVal) {
                    this.getRegenciesData()
                    this.regency_id = null
                }
            }
        });
    </script>
@endpush
