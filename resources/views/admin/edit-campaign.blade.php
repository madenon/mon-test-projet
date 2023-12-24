@extends('admin.index')

@section('admin-content')
<div class="container">
    <h1>Edit Campaign</h1>
    <form action="{{ route('admin.edit-campaign', ['id' => $campaign->id]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Campaign Name</label>
            <input type="text" name="name" class="form-control" value="{{ $campaign->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required>{{ $campaign->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ $campaign->start_date }}" required>
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ $campaign->end_date }}" required>
        </div>

        <div class="form-group">
            <label for="discount_percentage">Discount Percentage</label>
            <input type="number" name="discount_percentage" class="form-control" value="{{ $campaign->discount_percentage }}" min="0" max="100">
        </div>

        <div class="form-group">
            <label for="products_included">Products Included</label>
            <input type="text" name="products_included" class="form-control" value="{{ $campaign->products_included }}">
        </div>

        <div class="form-group">
            <label for="sponsor_id">Sponsor</label>
            <select name="sponsor_id" class="form-control">
                @foreach ($sponsors as $sponsor)
                    <option value="{{ $sponsor->id }}" {{ $campaign->sponsor_id == $sponsor->id ? 'selected' : '' }}>{{ $sponsor->name }}</option>
                @endforeach
            </select>
        </div>
<div class="flex justify-end mt-2">
        <button type="submit" class="btn text-white " style="background:var(--primary-color);">Update Campaign</button></div>
    </form>
</div>
@endsection