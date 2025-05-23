@extends('layout.adminLayout')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Review</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" class="card p-4 shadow-sm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Rating</label>
                <div class="star-rating">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating', $review->rating) == $i ? 'checked' : '' }}/>
                        <label for="star{{ $i }}" title="{{ $i }} stars">&#9733;</label>
                    @endfor
                </div>
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea name="review" id="comment" class="form-control" rows="4" required>{{ old('review', $review->review) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Review</button>
            <a href="{{ route('admin.products.edit', $review->product_id) }}" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>

    <style>
        .star-rating {
            direction: rtl;
            display: flex;
            gap: 5px;
            font-size: 1.5rem;
        }
        .star-rating input[type="radio"] {
            display: none;
        }
        .star-rating label {
            color: #ccc;
            cursor: pointer;
        }
        .star-rating input[type="radio"]:checked ~ label {
            color: #ffc107;
        }
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #ffc107;
        }
    </style>
@endsection
