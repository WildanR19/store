@extends('layouts.dashboard')

@section('title') Create Product - Store @endsection
@section('content')
    <div class="dashboard-heading">
        <h2 class="dashboard-title">My Account</h2>
        <p class="dashboard-subtitle">Update your current profile</p>
    </div>
    <div class="dashboard-content">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('dashboard.setting.update') }}" method="post" id="accountForm">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Your Name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="name"
                                            aria-describedby="emailHelp"
                                            name="name"
                                            value="{{ $user->name }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Your Email</label>
                                        <input
                                            type="email"
                                            class="form-control"
                                            id="email"
                                            aria-describedby="emailHelp"
                                            name="email"
                                            value="{{ $user->email }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="addressOne">Address 1</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="addressOne"
                                            aria-describedby="emailHelp"
                                            name="address_one"
                                            value="{{ $user->address_one }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="addressTwo">Address 2</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="addressTwo"
                                            aria-describedby="emailHelp"
                                            name="address_two"
                                            value="{{ $user->address_two }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="province">Province</label>
                                        <select name="province_id" id="province" class="form-control" v-if="provinces" v-model="province_id">
                                            <option v-for="province in provinces" :value="province.id" :selected="province.id === province_id">@{{ province.name }}</option>
                                        </select>
                                        <select v-else class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <select name="regencies_id" id="city" class="form-control" v-if="regencies" v-model="regency_id">
                                            <option v-for="regency in regencies" :value="regency.id" :selected="regency.id === regency_id">@{{ regency.name }}</option>
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
                                            value="{{ $user->zip_code }}"
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
                                            value="{{ $user->country }}"
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
                                            value="{{ $user->phone_number }}"
                                        />
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
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        const locations = new Vue({
            el: "#accountForm",
            mounted() {
                this.getProvincesData()
                this.getRegenciesData()
            },
            data: {
                provinces: null,
                regencies: null,
                province_id: {{ $user->province_id }},
                regency_id: {{ $user->regencies_id }},
                selected_province: {{ $user->province_id }},
                selected_regency: {{ $user->regencies_id }},
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
