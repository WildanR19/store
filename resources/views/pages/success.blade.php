@extends('layouts.success')

@section('title') Success - Store @endsection
@section('content')
    <div class="page-success">
        <div class="section-success" data-aos="zoom-in">
            <div class="container">
                <div class="row align-items-center row-login justify-content-center">
                    <div class="col-lg-6 text-center">
                        <img src="/images/success.svg" alt="" class="mb-4" />
                        <h2>Transaction Processed!</h2>
                        <p>
                            Silahkan tunggu konfirmasi email dari kami dan kami akan
                            menginformasikan resi secept mungkin!
                        </p>
                        <div class="mt-4">
                            <a href="/dashboard.html" class="btn btn-success w-50"
                            >My Dashboard</a
                            >
                            <a href="/dashboard.html" class="btn btn-signup w-50 mt-2"
                            >Go to Shopping</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
