@extends('layouts.app')

@section('content')
    {{-- @php
        dd($items);
    @endphp --}}
    <section class="form_sec">
        <h3 class="vis-hid">Invisible</h3>
        <div class="container">
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
    </section><!--form_sec end-->
    <section class="blog-grid section-padding">
        <div class="container">
            <div class="blog-grid-posts">
                <div class="row">
                    @if (isset($event) || isset($building) || isset($filters))
                        @if (isset($event))
                            @foreach ($event as $item)
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="blog-single-post">
                                        <div class="blog-img">
                                            <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">
                                                <img src="{{ $item['pictures']['0'] }}" alt="">
                                            </a>
                                            <div class="view-post">
                                                <a href="{{ route('building.show', ['id' => $item['id']]) }}" title=""
                                                    class="view-posts">View Post</a>
                                            </div>
                                        </div><!--blog-img end-->
                                        <div class="post_info">
                                            <ul class="post-nfo">
                                                <li><i class="la la-calendar"></i>{{ $item['created_at'] }}</li>
                                            </ul>
                                            <h3><a href="{{ route('building.show', ['id' => $item['id']]) }}"
                                                    title="">Rent This Item</a></h3>
                                            <p>{{ $item['description'] }}</p>
                                            <a href="{{ route('building.show', ['id' => $item['id']]) }}"
                                                title="">Read More <i class="la la-long-arrow-right"></i></a>
                                        </div>
                                        <a href="{{ route('building.show', ['id' => $item['id']]) }}" title=""
                                            class="ext-link"></a>
                                    </div><!--blog-single-post end-->
                                </div>
                            @endforeach
                            {{ $event->links() }}
                        @endif

                        @if (isset($building))
                            @foreach ($building as $item)
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="blog-single-post">
                                        <div class="blog-img">
                                            <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">
                                                <img src="{{ $item['pictures']['0'] }}" alt="">
                                            </a>
                                            <div class="view-post">
                                                <a href="{{ route('building.show', ['id' => $item['id']]) }}"
                                                    title="" class="view-posts">View Post</a>
                                            </div>
                                        </div><!--blog-img end-->
                                        <div class="post_info">
                                            <ul class="post-nfo">
                                                <li><i class="la la-calendar"></i>{{ $item['created_at'] }}</li>
                                            </ul>
                                            <h3><a href="{{ route('building.show', ['id' => $item['id']]) }}"
                                                    title="">Rent This Item</a></h3>
                                            <p>{{ $item['description'] }}</p>
                                            <a href="{{ route('building.show', ['id' => $item['id']]) }}"
                                                title="">Read More <i class="la la-long-arrow-right"></i></a>
                                        </div>
                                        <a href="{{ route('building.show', ['id' => $item['id']]) }}" title=""
                                            class="ext-link"></a>
                                    </div><!--blog-single-post end-->
                                </div>
                            @endforeach
                            {{ $building->links() }}
                        @endif
                    @else
                        @foreach ($items as $item)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="blog-single-post">
                                    <div class="blog-img">
                                        <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">
                                            <img src="{{ $item['pictures']['0'] }}" alt="">
                                        </a>
                                        <div class="view-post">
                                            <a href="{{ route('building.show', ['id' => $item['id']]) }}" title=""
                                                class="view-posts">View Post</a>
                                        </div>
                                    </div><!--blog-img end-->
                                    <div class="post_info">
                                        <ul class="post-nfo">
                                            <li><i class="la la-calendar"></i>{{ $item['created_at'] }}</li>
                                        </ul>
                                        <h3><a href="{{ route('building.show', ['id' => $item['id']]) }}"
                                                title="">Rent This Item</a></h3>
                                        <p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi
                                            accumsan
                                            ipsum
                                            velit vamec.</p>
                                        <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">Read
                                            More <i class="la la-long-arrow-right"></i></a>
                                    </div>
                                    <a href="{{ route('building.show', ['id' => $item['id']]) }}" title=""
                                        class="ext-link"></a>
                                </div><!--blog-single-post end-->
                            </div>
                        @endforeach
                        {{ $items->links() }}
                    @endif
                    {{-- <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="blog-single-post">
                            <div class="blog-img">
                                <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">
                                    <img src="{{ $item['pictures']['0'] }}" alt="">
                                </a>
                                <div class="view-post">
                                    <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="" class="view-posts">View Post</a>
                                </div>
                            </div><!--blog-img end-->
                            <div class="post_info">
                                <ul class="post-nfo">
                                    <li><i class="la la-calendar"></i>{{ $item['created_at'] }}</li>
                                </ul>
                                <h3><a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">Rent This Item</a></h3>
                                <p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum
                                    velit vamec.</p>
                                <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">Read More <i
                                        class="la la-long-arrow-right"></i></a>
                            </div>
                            <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="" class="ext-link"></a>
                        </div><!--blog-single-post end-->
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="blog-single-post">
                            <div class="blog-img">
                                <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">
                                    <img src="{{ $item['pictures']['0'] }}" alt="">
                                </a>
                                <div class="view-post">
                                    <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="" class="view-posts">View Post</a>
                                </div>
                            </div><!--blog-img end-->
                            <div class="post_info">
                                <ul class="post-nfo">
                                    <li><i class="la la-calendar"></i>{{ $item['created_at'] }}</li>
                                </ul>
                                <h3><a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">Rent This Item</a></h3>
                                <p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum
                                    velit vamec.</p>
                                <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">Read More <i
                                        class="la la-long-arrow-right"></i></a>
                            </div>
                            <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="" class="ext-link"></a>
                        </div><!--blog-single-post end-->
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="blog-single-post">
                            <div class="blog-img">
                                <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">
                                    <img src="{{ $item['pictures']['0'] }}" alt="">
                                </a>
                                <div class="view-post">
                                    <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="" class="view-posts">View Post</a>
                                </div>
                            </div><!--blog-img end-->
                            <div class="post_info">
                                <ul class="post-nfo">
                                    <li><i class="la la-calendar"></i>{{ $item['created_at'] }}</li>
                                </ul>
                                <h3><a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">Rent This Item</a></h3>
                                <p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum
                                    velit vamec.</p>
                                <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">Read More <i
                                        class="la la-long-arrow-right"></i></a>
                            </div>
                            <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="" class="ext-link"></a>
                        </div><!--blog-single-post end-->
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="blog-single-post">
                            <div class="blog-img">
                                <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">
                                    <img src="{{ $item['pictures']['0'] }}" alt="">
                                </a>
                                <div class="view-post">
                                    <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="" class="view-posts">View Post</a>
                                </div>
                            </div><!--blog-img end-->
                            <div class="post_info">
                                <ul class="post-nfo">
                                    <li><i class="la la-calendar"></i>{{ $item['created_at'] }}</li>
                                </ul>
                                <h3><a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">Rent This Item</a></h3>
                                <p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum
                                    velit vamec.</p>
                                <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="">Read More <i
                                        class="la la-long-arrow-right"></i></a>
                            </div>
                            <a href="{{ route('building.show', ['id' => $item['id']]) }}" title="" class="ext-link"></a>
                        </div><!--blog-single-post end-->
                    </div> --}}
                </div>
            </div><!--blog-grid-posts end-->
        </div>
    </section><!--blog-single-sec end-->
@endsection
