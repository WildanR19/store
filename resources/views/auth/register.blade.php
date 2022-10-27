@extends('layouts.auth')

@section('content')
<div class="page-content page-auth" id="register">
    <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center justify-content-center row-login">
                <div class="col-lg-4">
                    <h2>Memulai untuk jual beli dengan cara terbaru</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input id="name"
                                   type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required
                                   autocomplete="name"
                                   autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input id="email"
                                   type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="email"
                                   v-model="email"
                                   @change="emailCheck()"
                                   :class="{ 'is-invalid' : this.email_unavailable }">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password"
                                   type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   required
                                   autocomplete="new-password"
                                   v-model="password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Password Confirmation</label>
                            <input id="password-confirm"
                                   type="password"
                                   class="form-control"
                                   name="password_confirmation"
                                   required
                                   autocomplete="new-password"
                                   v-model="password_confirmation"
                                   @change="passwordCheck()"
                                   :class="{ 'is-invalid' : this.password_not_match }">
                        </div>
                        <div class="form-group">
                            <label for="store">Store</label>
                            <p class="text-muted">Apakah anda juga ingin membuka toko?</p>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input
                                    type="radio"
                                    class="custom-control-input"
                                    name="is_store_open"
                                    id="openStoreTrue"
                                    v-model="is_store_open"
                                    :value="true">
                                <label for="openStoreTrue" class="custom-control-label">Iya, boleh</label>
                            </div>
                            <div
                                class="custom-control custom-radio custom-control-inline"
                            >
                                <input
                                    type="radio"
                                    class="custom-control-input"
                                    name="is_store_open"
                                    id="openStoreFalse"
                                    v-model="is_store_open"
                                    :value="false"
                                />
                                <label for="openStoreFalse" class="custom-control-label">Enggak, makasih</label>
                            </div>
                        </div>
                        <div class="form-group" v-if="is_store_open">
                            <label for="storeName">Store Name</label>
                            <input id="storeName"
                                   type="text"
                                   class="form-control @error('store_name') is-invalid @enderror"
                                   name="store_name"
                                   value="{{ old('store_name') }}"
                                   required
                                   autocomplete="store_name"
                                   autofocus>

                            @error('store_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" v-if="is_store_open">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="" disabled selected>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-block mt-4" :disabled="this.email_unavailable">
                            Sign Up Now
                        </button>
                        <a href="{{ url('login') }}" class="btn btn-signup btn-block mt-2">
                            Back to Sign In
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="{{ url('/vendor/vue/vue.js') }}"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script>
        Vue.use(Toasted);
        const register = new Vue({
            el: "#register",
            mounted() {
                AOS.init();
            },
            methods: {
                emailCheck: function() {
                    const self = this;
                    axios.get('{{ route('api-register-check') }}', {
                      params: {
                          email: self.email
                      }
                    })
                      .then(function (response) {
                          if (response.data === 'Available') {
                              self.$toasted.show(
                                  "Email Available",
                                  {
                                      position: "top-center",
                                      className: "rounded",
                                      duration: 2000,
                                  }
                              );
                              self.email_unavailable = false;
                          } else {
                              self.$toasted.error(
                                  "Maaf, tampaknya email sudah terdaftar pada sistem kami.",
                                  {
                                      position: "top-center",
                                      className: "rounded",
                                      duration: 2000,
                                  }
                              );
                              self.email_unavailable = true;
                          }
                      });
                },
                passwordCheck: function () {
                    const self = this;
                    if (self.password !== self.password_confirmation) {
                        self.$toasted.error(
                            "Password does not match.",
                            {
                                position: "top-center",
                                className: "rounded",
                                duration: 2000,
                            }
                        );
                        self.password_not_match = true;
                    }
                }
            },
            data() {
                return {
                    is_store_open: true,
                    email: '',
                    email_unavailable: false,
                    password: '',
                    password_confirmation: '',
                    password_not_match: false,
                }
            },
        });
    </script>
    <script src="{{ url('script/navbar-scroll.js') }}"></script>
@endpush
