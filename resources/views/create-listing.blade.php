@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <form action="{{ route('store.listing') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                </div>
                <div class="col-md-6">
                    <label for="construction_type" class="form-label">Construction Type</label>
                    <input type="text" class="form-control" id="construction_type" name="construction_type" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="year_built" class="form-label">Year Built</label>
                    <input type="number" class="form-control" id="year_built" name="year_built" required>
                </div>
                <div class="col-md-6">
                    <label for="units_in_building" class="form-label">Units in Building</label>
                    <input type="number" class="form-control" id="units_in_building" name="units_in_building" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="bathrooms" class="form-label">Bathrooms</label>
                    <input type="number" class="form-control" id="bathrooms" name="bathrooms" required>
                </div>
                <div class="col-md-6">
                    <label for="bedrooms" class="form-label">Bedrooms</label>
                    <input type="number" class="form-control" id="bedrooms" name="bedrooms" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="flooring" class="form-label">Flooring</label>
                    <input type="text" class="form-control" id="flooring" name="flooring" required>
                </div>
                <div class="col-md-6">
                    <label for="amenities" class="form-label">Amenities</label>
                    <input type="text" class="form-control" id="amenities" name="amenities" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="col-md-6">
                    <label for="cooling" class="form-label">Cooling</label>
                    <input type="text" class="form-control" id="cooling" name="cooling" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="other_features" class="form-label">Other Features</label>
                    <input type="text" class="form-control" id="other_features" name="other_features" required>
                </div>
                <div class="col-md-6">
                    <label for="rent_price" class="form-label">Rent Price</label>
                    <input type="number" class="form-control" id="rent_price" name="rent_price" step="0.01" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="pictures" class="form-label">Pictures</label>
                <textarea class="form-control" id="pictures" name="pictures" rows="3"></textarea>
                <small class="form-text text-muted">Enter picture URLs in JSON format (e.g., ["https://example.com/picture1.jpg","https://example.com/picture2.jpg",...])</small>
            </div>
            <input type="hidden" value="2" name="categories_id">
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Create Building</button>
            </div>
        </form>
    </div>
@endsection
