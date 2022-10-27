@extends('layouts.app')

@section('title') Homepage - Store @endsection
@section('content')
    <div class="page-home page-content">
        <!-- carousel -->
        <section class="store-carousel">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" data-aos="zoom-in">
                        <div
                            class="carousel slide"
                            id="storeCarousel"
                            data-ride="carousel"
                        >
                            <ol class="carousel-indicators">
                                <li
                                    class="active"
                                    data-target="#storeCarousel"
                                    data-slide-to="0"
                                ></li>
                                <li
                                    class="active"
                                    data-target="#storeCarousel"
                                    data-slide-to="1"
                                ></li>
                                <li
                                    class="active"
                                    data-target="#storeCarousel"
                                    data-slide-to="2"
                                ></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img
                                        src="{{ url('/images/banner.jpg') }}"
                                        alt="carousel image"
                                        class="w-100 d-block"
                                    />
                                </div>
                                <div class="carousel-item">
                                    <img
                                        src="{{ url('/images/banner.jpg') }}"
                                        alt="carousel image"
                                        class="w-100 d-block"
                                    />
                                </div>
                                <div class="carousel-item">
                                    <img
                                        src="{{ url('/images/banner.jpg') }}"
                                        alt="carousel image"
                                        class="w-100 d-block"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- categories -->
        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Trend Categories</h5>
                    </div>
                </div>
                <div class="row">
                    @php $delay_category = 0; @endphp
                    @forelse($categories as $category)
                        <div
                            class="col-6 col-md-3 col-lg-2"
                            data-aos="fade-up"
                            data-aos-delay="{{ $delay_category += 100 }}"
                        >
                            <a href="{{ route('categories.detail', $category->slug) }}" class="component-categories d-block">
                                <div class="categories-image">
                                    <img
                                        src="{{ Storage::url($category->photo) }}"
                                        alt="{{ $category->name }}"
                                        class="w-100"
                                    />
                                </div>
                                <p class="categories-text">{{ $category->name }}</p>
                            </a>
                        </div>
                    @empty
                        <div
                            class="col-12 text-center py-5"
                            data-aos="fade-up"
                            data-aos-delay="100"
                        > No Categories Found </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- products -->
        <section class="store-new-products">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>New Products</h5>
                    </div>
                </div>
                <div class="row">
                @php $delay_product = 0; @endphp
                @forelse($products as $product)
                    <div
                        class="col-6 col-md-4 col-lg-3"
                        data-aos="fade-up"
                        data-aos-delay="{{ $delay_product += 100 }}"
                    >
                        <a href="{{ route('details', $product->slug) }}" class="component-products d-block">
                            <div class="products-thumbnail">
                                <div
                                    class="products-image"
                                    style="
                                    @if (count($product->gallery))
                                        background-image: url({{ Storage::url($product->gallery()->first()->photo) }});
                                    @else
                                        background-color: #eee;
                                    @endif "
                                ></div>
                            </div>
                            <div class="products-text">{{ $product->name }}</div>
                            <div class="products-price">${{ $product->price }}</div>
                        </a>
                    </div>
                    @empty
                        <div
                            class="col-12 text-center py-5"
                            data-aos="fade-up"
                            data-aos-delay="100"
                        > No Products Found </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>

@endsection
