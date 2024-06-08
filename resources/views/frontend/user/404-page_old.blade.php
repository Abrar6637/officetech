@extends('frontend.layout.main')
@section('title', '404')
@section('main.container')
<main class="main margin" >
    <div class="container text-center mt-4 section-top">
        <div class="div">
            <div class="d-flex flex-column w-100   mx-auto px-5 gap-3 py-5  custom-content">
                <h3 style="font-size:35px; font-weight:900">404, Page not found</h3>
                <p>Something went wrong. It’s look that your requested could not be found. It’s look like the link is
                    broken or the page is removed..</p>
                <div class="d-flex justify-content-center">
                    <button class="arrow-white btn-bg-color text-white w-50 "
                        style="height: 37px; border-radius: 20px; border: none; margin-top: 10px">Go Back</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
</main>
@endsection