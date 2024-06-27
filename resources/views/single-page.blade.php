@extends('layouts.app')

@section('content')
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

    <section class="property-single-pg">
        <div class="container">
            <div class="property-hd-sec">
                <div class="card">
                    <div class="card-body">
                        <a href="#">
                            <h3>{{ $response->category->name ?? 'Regular Building' }}</h3>
                            <p><i class="la la-map-marker"></i>{{ $response->address }}</p>
                        </a>
                        <ul>
                            @if ($response->categories_id == 2)
                                <li>{{ $response->details['Bathrooms'] }} Bathrooms</li>
                                <li>{{ $response->details['Bedrooms'] }} Beds</li>
                                <li>Area {{ $response->details['Flooring'] }}</li>
                            @elseif($response->categories_id == 1)
                                <li>Event Day: {{ $response->details['event_time_d'] }}</li>
                                <li>Event Time: {{ $response->details['event_time_h'] }}</li>
                                <li>Contact Person: {{ $response->details['contact_person']['name'] }}</li>
                                <li>Contact Email: {{ $response->details['contact_person']['email'] }}</li>
                                <li>Contact Number: {{ $response->details['contact_person']['number'] }}</li>
                            @endif
                        </ul>
                    </div><!--card-body end-->
                    <div class="rate-info">
                        <h5>${{ number_format($response->rent_price, 2) }}</h5>
                        <span>For Rent</span>
                    </div><!--rate-info end-->
                </div><!--card end-->
            </div><!---property-hd-sec end-->
            <div class="property-single-page-content">
                <div class="row">
                    <div class="col-lg-8 pl-0 pr-0">
                        <div class="property-pg-left">
                            <div class="property-imgs">
                                <div class="property-main-img">
                                    @foreach ($response->pictures as $picture)
                                        <div class="property-img">
                                            <img src="{{ $picture }}" alt="">
                                        </div><!--property-img end-->
                                    @endforeach
                                </div><!--property-main-img end-->
                                <div class="property-thumb-imgs">
                                    <div class="row thumb-carous">
                                        @foreach ($response->pictures as $picture)
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                <div class="property-img">
                                                    <img src="{{ $picture }}" alt="">
                                                </div><!--property-img end-->
                                            </div>
                                        @endforeach
                                    </div>
                                </div><!--property-thumb-imgs end-->
                            </div><!--property-imgs end-->
                            <div class="descp-text">
                                <h3>Description</h3>
                                <p>{{ $response->description }}</p>
                            </div><!--descp-text end-->
                            <div class="details-info">
                                <h3>Detail</h3>
                                <ul>
                                    {{-- {{ dd($response->details) }} --}}
                                    @foreach ($response->details as $key => $value)
                                        @if ($key == 'contact_person')
                                            <li>
                                                <span>{{ $value['name'] }} {{ $value['number'] }}</span>
                                            </li>
                                        @else
                                            <li>
                                                <h4>{{ $key }}:</h4>
                                                <span>{{ $value }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div><!--details-info end-->
                            <!-- ... existing sections ... -->
                        </div><!--property-pg-left end-->
                    </div>
                    <div class="col-lg-4 pl-0">
                        <div class="sidebar layout2">
                            <div class="widget widget-form">
                                <h3 class="widget-title">Like This? Rent It!</h3>
                                <div class="contct-info">
                                    <img src="https://via.placeholder.com/81x74" alt="">
                                    <div class="contct-nf">
                                        <h3>{{ $response->owner->name }}</h3>
                                        <h4>{{ $response->owner->address }}</h4>
                                        <span><i class="la la-phone"></i>{{ $response->owner->phone }}</span>
                                    </div>
                                </div><!--contct-info end-->
                                <div class="post-comment-sec">
                                    <form action="{{ route('building.rent') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="building_id" value="{{ $response->id }}">
                                        <div class="form-field">
                                            <label for="start_date">Choose the Start Date</label>
                                            <input type="datetime-local" name="start_date" id="start_date"
                                                placeholder="Start Date" required>
                                        </div>
                                        <div class="form-field">
                                            <label for="end_date">Choose the End Date</label>
                                            <input type="datetime-local" name="end_date" id="end_date"
                                                placeholder="End Date" required>
                                        </div>
                                        <div class="form-field">
                                            <label for="total_amount">Total Price</label>
                                            <input type="number" name="total_amount" id="total_amount"
                                                placeholder="Total Amount" readonly required>
                                        </div>
                                        <button type="submit" class="btn2">Rent</button>
                                    </form>
                                </div>
                            </div><!--widget-form end-->
                            <!-- ... existing widgets ... -->
                        </div><!--sidebar end-->
                    </div>
                </div>
            </div><!--property-single-page-content end-->
        </div>
    </section><!--property-single-pg end-->

    <!-- ... existing sections ... -->

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
                        <p>Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor
                            eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const totalAmountInput = document.getElementById('total_amount');
            const buildingPrice =
                {{ $response['rent_price'] }}; // Assuming rent_price is available in the $response

            function calculateTotalAmount() {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);
                if (startDate && endDate && endDate > startDate) {
                    const timeDifference = endDate - startDate;
                    const daysDifference = Math.ceil(timeDifference / (1000 * 3600 * 24));
                    const totalAmount = buildingPrice * daysDifference;
                    totalAmountInput.value = totalAmount.toFixed(2);
                } else {
                    totalAmountInput.value = '';
                }
            }

            startDateInput.addEventListener('change', calculateTotalAmount);
            endDateInput.addEventListener('change', calculateTotalAmount);
        });
    </script>
@endsection
