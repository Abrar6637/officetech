@extends('frontend.layout.main')
@section('title', '404')
@section('main.container')

<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs__inner">
            <a href="/" data-translate="home">
                Home
            </a>
            <div class="el">
                /
            </div>
            <span>
                404
            </span>
        </div>
    </div>
</div>

<main>
    <section class="notPage">
        <div class="container">
            <div class="notPage__inner">
                <h1 class="notPage__title titleSection" data-translate="404_page_not_found">
                    404, Page not founds
                </h1>
                <div class="notPage__dscr">
                    <p data-translate="something_went_wrong_it_looks_that_your_requested_colud_not_be_found_it_looks_like_the_link_is_broken_or_the_page_is_removed">
                        Something went wrong. It’s look that your requested could not be found. It’s look like the link is broken or the page is
                        removed.
                    </p>
                </div>
                <a href="/" class="notPage__btn btnHover" data-translate="go_to_home">
                    Go to home
                </a>
            </div>
        </div>
    </section>
</main>

@endsection