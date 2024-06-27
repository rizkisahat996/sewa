@extends('layouts.app')

@section('content')

    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-content">
                        <h1>Discover best properties in one place</h1>
                    </div>
                    <form action="{{ route('items.filter') }}" method="GET" class="row banner-search">
                        <div class="form_field addres">
                            <input type="text" name="address" class="form-control" placeholder="Enter Address, City or State">
                        </div>
                        <div class="form_field tpmax">
                            <div class="form-group">
                                <select name="type" class="form-control">
                                    <option value="">Any type</option>
                                    <option value="2">For Building</option>
                                    <option value="1">For Event</option>
                                </select>
                            </div>
                        </div>
                        <div class="form_field tpmax">
                            <div class="form-group">
                                <select name="max_price" class="form-control">
                                    <option value="">Max Price</option>
                                    <option value="2000">2000</option>
                                    <option value="3000">3000</option>
                                    <option value="4000">4000</option>
                                    <option value="5000">5000</option>
                                    <option value="6000">6000</option>
                                </select>
                            </div>
                        </div>
                        <div class="form_field tpmax">
                            <div class="form-group">
                                <select name="min_price" class="form-control">
                                    <option value="">Min Price</option>
                                    <option value="200">200$</option>
                                    <option value="300">300$</option>
                                    <option value="400">400$</option>
                                    <option value="500">500$</option>
                                    <option value="600">600$</option>
                                </select>
                            </div>
                        </div>
                        <div class="form_field srch-btn">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="la la-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="intro section-padding">
        @php
            // dd($building);
            $first = $building['0'];
            $imageFirst = $first['pictures'];
            // dd($imageFirst['0']);
            usort($building, function ($a, $b) {
                return $b['view_count'] - $a['view_count'];
            });
        @endphp
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 pl-0">
                    <div class="intro-content">
                        <h3>Homes around the world</h3>
                        <p>{{ $first['description'] }}
                        </p>
                        <a href="#" class="btn btn-outline-primary view-btn">
                            <i class="icon-arrow-right-circle"></i>View for rent</a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 pr-0">
                    <div class="intro-img">
                        <img src="{{ $imageFirst['0'] }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="intro-thumb-row">
                @foreach ($imageFirst as $item)
                    <a href="#" class="intro-thumb">
                        <img src="{{ $item }}" alt="">
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="popular-listing section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="section-heading">
                        <span>Discover</span>
                        <h3>Popular Listing</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach (array_slice($building, 0, 3) as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <a href="{{ route('building.show', ['id' => $item['id']]) }}">
                                <div class="img-block">
                                    <div class="overlay"></div>
                                    <img src="{{ $item['pictures']['0'] }}" alt="" class="img-fluid">
                                    <div class="rate-info">
                                        <h5>$ {{ $item['rent_price'] }}</h5>
                                        <span>For Rent</span>
                                    </div>
                                </div>
                            </a>
                            <div class="card-body">
                                <a href="{{ route('building.show', ['id' => $item['id']]) }}">
                                    <h3>{{ $item['name'] }}</h3>
                                    <p> <i class="la la-map-marker"></i>{{ $item['address'] }}</p>
                                </a>
                                <ul>
                                    @foreach (array_slice($item['details'], 0, 3) as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="pull-left">
                                    <i class="la la-heart-o"></i>
                                </a>
                                <a href="#" class="pull-right">
                                    <i class="la la-calendar-check-o"></i> 25 Days Ago</a>
                            </div>
                            <a href="#" title=""
                                class="ext-link"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="alert alert-success" role="alert">
        <strong>Added to Favourites</strong> You can check your favourite items here <a href="#"
            class="alert-link">Favourite Items</a>.
        <a href="#" title="" class="close-alert"><i class="la la-close"></i></a>
    </div>

    {{-- <section class="explore-feature section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="section-heading">
                        <span>Explore Features</span>
                        <h3>Service You Need</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-sm-6 col-md-6 col-lg-4">
                    <a href="#" title="">
                        <div class="card">
                            <div class="card-body">
                                <i class="icon-home"></i>
                                <h3>Perfect Tools</h3>
                                <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit conseat ipsum, nec
                                    sagittis sem nibh.</p>
                            </div>
                        </div><!--card end-->
                    </a>
                </div>
                <div class="col-xl-4 col-sm-6 col-md-6 col-lg-4">
                    <a href="#" title="">
                        <div class="card">
                            <div class="card-body">
                                <i class="icon-cursor"></i>
                                <h3>Search in Click</h3>
                                <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit conseat ipsum, nec
                                    sagittis sem nibh.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-sm-6 col-md-6 col-lg-4">
                    <a href="#" title="">
                        <div class="card">
                            <div class="card-body">
                                <i class="icon-lock"></i>
                                <h3>User Control</h3>
                                <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit conseat ipsum, nec
                                    sagittis sem nibh.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="popular-cities section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="section-heading">
                        <span>Popular Event Place</span>
                        <h3>Find Perfect Place</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                    $popular_event = array_slice($event, 0, 3);
                    // dd($event);
                @endphp
                @foreach ($popular_event as $item)
                    <div class="col-xl-4 col-md-6">
                        <a href="{{ route('building.show', ['id' => $item['id']]) }}">
                            <div class="card">
                                <div class="overlay"></div>
                                <img src="{{ $item['pictures']['0'] }}" alt="" class="img-fluid">
                                <div class="card-body">
                                    <h4>{{ $item['details']['event_name'] }}</h4>
                                    <p>{{ $item['view_count'] }}</p>
                                    <i class="fa fa-angle-right"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="map-container" class="fullwidth-home-map">
        <h3 class="vis-hid">Visible Heading</h3>
        <div id="map" data-map-zoom="9"></div>
    </section>

    <a href="#" title="">
        <section class="cta section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="cta-text">
                            <h2>Discover a home you'll love to stay</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </a>

    <section class="bottom section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-sm-6 col-md-4">
                    <div class="bottom-logo">
                        <img src="assets/images/logo.png" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-md-3">
                    <div class="bottom-list">
                        <h3>Helpful Links</h3>
                        <ul>
                            <li>
                                <a href="18_Half_Map.html" title="">Half Map</a>
                            </li>
                            <li>
                                <a href="#" title="">Register</a>
                            </li>
                            <li>
                                <a href="#" title="">Pricing</a>
                            </li>
                            <li>
                                <a href="#" title="">Add Listing</a>
                            </li>
                        </ul>
                    </div><!--bottom-list end-->
                </div>
                <div class="col-xl-5 col-sm-12 col-md-5 pl-0">
                    <div class="bottom-desc">
                        <h3>Aditional Information</h3>
                        <p>Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat
                            auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
