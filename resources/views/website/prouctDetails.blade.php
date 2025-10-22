@extends('website.layout')
@section('title', $product->name)
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <style>
        /* ===================================
           PRODUCT IMAGE CAROUSEL WITH DOTS
           =================================== */

        .product-gallery {
            width: 100%;
            position: relative;
        }

        /* Main Image Carousel */
        .main-image-swiper {
            width: 100%;
            height: 500px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .main-image-swiper .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f8f8;
        }

        .main-image-swiper .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Thumbnail Carousel */
        .thumbnail-swiper {
            width: 100%;
            height: 100px;
            margin-top: 10px;
        }

        .thumbnail-swiper .swiper-slide {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s ease;
            opacity: 0.6;
        }

        .thumbnail-swiper .swiper-slide:hover {
            opacity: 1;
            transform: scale(1.05);
        }

        .thumbnail-swiper .swiper-slide-thumb-active {
            border-color: var(--main-color, #007bff);
            opacity: 1;
        }

        .thumbnail-swiper .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Navigation Arrows */
        .swiper-button-next,
        .swiper-button-prev {
            color: var(--main-color, #007bff);
            background: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 18px;
            font-weight: bold;
        }

        /* Pagination Dots */
        .swiper-pagination {
            position: absolute;
            bottom: 15px !important;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 10;
        }

        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: rgba(255,255,255,0.5);
            opacity: 1;
            margin: 0 6px !important;
            border: 2px solid white;
            transition: all 0.3s ease;
        }

        .swiper-pagination-bullet-active {
            background: var(--main-color, #007bff);
            width: 30px;
            border-radius: 6px;
        }

        /* Zoom on hover effect */
        .main-image-swiper .swiper-slide img {
            transition: transform 0.3s ease;
        }

        .main-image-swiper .swiper-slide:hover img {
            transform: scale(1.05);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .main-image-swiper {
                height: 350px;
            }

            .thumbnail-swiper {
                height: 80px;
            }

            .thumbnail-swiper .swiper-slide {
                width: 80px;
                height: 80px;
            }

            .swiper-button-next,
            .swiper-button-prev {
                width: 35px;
                height: 35px;
            }
        }

        @media (max-width: 480px) {
            .main-image-swiper {
                height: 300px;
            }

            .thumbnail-swiper {
                height: 60px;
            }

            .thumbnail-swiper .swiper-slide {
                width: 60px;
                height: 60px;
            }
        }

        /* ===================================
           EXISTING STYLES (Keep your styles)
           =================================== */

        .variant-box {
            cursor: pointer;
            width: fit-content;
            transition: all 0.2s ease;
            background-color:white;
        }

        .variant-box.selected {
            border-color: var(--main-color);
            background-color:var(--main-color);
            font-weight: bold;
        }

        .review-form {
            margin-top: 20px;
        }

        .review-form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: start;
            gap: 8px;
            font-size: 1.5rem;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            font-size: 1.5em;
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s ease-in-out;
        }

        .star-rating input[type="radio"]:checked ~ label i,
        .star-rating label:hover i,
        .star-rating label:hover ~ label i {
            color: gold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .btn {
            padding: 10px 20px;
            font-weight: bold;
        }

        /* Breadcrumbs */
        .breadcrumb-container {
            background: #f9f9f9;
            padding: 10px 15px;
            margin-bottom: 25px;
            border-radius: 5px;
        }

        .breadcrumb-item a {
            color: var(--text-color)
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
            color: var(--main-color);
        }

        .breadcrumb-item.active {
            color: var(--text-color);
            font-weight: bold;
        }

        /* Product Info */
        .product-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 15px;
            white-space: normal;
            word-wrap: break-word;
            overflow: visible;
        }

        .product-price {
            font-size: 24px;
            font-weight: 700;
            color: var(--main-color);
            margin-bottom: 15px;
        }

        .regular-price del {
            color: #999;
        }

        .product-rating {
            margin-bottom: 15px;
        }

        .product-rating .stars i {
            color: #ffd700;
            margin-right: 5px;
        }

        .btn-rate {
            background: none;
            color: var(--main-color);
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        /* Add to Cart / Favorite Buttons */
        .product-actions {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .addToCart,.removeFromCart, .addToFavorite,.removeFromFavorite {
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            color: white;
            cursor: pointer;
        }

        .addToCart,.removeFromCart,.removeFromFavorite {
            background: #ff6b81;
            border: none;
        }

        .addToCart,.removeFromCart,.removeFromFavorite:hover {
            background: var(--main-color);
        }

        .addToFavorite,.removeFromFavorite {
            background: #6c757d;
        }

        .addToFavorite,.removeFromFavorite:hover {
            background: #5a6268;
        }

        .addToFavorite.active {
            background: #ff6b81;
        }

        .removeFromFavorite.active {
            background: #ff6b81;
        }

        /* Product Description */
        .product-description {
            margin-top: 25px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
        }

        .product-description h5 {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 15px;
        }

        /* Reviews */
        .product-reviews {
            margin: 25px;
        }
    </style>
@endsection

@section('socialMeta')
    <meta property="og:url" content="{{Request::fullUrl()}}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{$product->name}}" />
    <meta property="og:description" content="{{str_limit(strip_tags($product->description), 200)}}" />
    <meta property="og:image" content="{{url($product->image)}}" />
    <meta property="fb:app_id" content="17734562" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@ASAL" />
    <meta name="twitter:creator" content="@ASAL" />
    <meta name="twitter:title" content="{{$product->name}}" />
    <meta name="twitter:description" content="{{str_limit(strip_tags($product->description), 200)}}" />
    <meta name="twitter:image" content="{{url($product->image)}}" />
@endsection

@section('content')
    <div class="container product-detail-container">
        <!-- Breadcrumbs -->
        <div class="breadcrumb-container">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('cp.home')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category', [$product->category->id, Str::slug($product->category->name)]) }}">{{ $product->category->name }}</a></li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <!-- Product Gallery with Swiper Carousel -->
            <div class="col-md-6">
                <div class="product-gallery">
                    <!-- Main Image Carousel -->
                    <div class="swiper main-image-swiper">
                        <div class="swiper-wrapper">
                            <!-- Main product image -->
                            <div class="swiper-slide">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}">
                            </div>

                            <!-- Additional images -->
                            @foreach ($product->images as $index => $image)
                                <div class="swiper-slide">
                                    <img src="{{ $image->image }}" alt="Product Image {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation Arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>

                        <!-- Pagination Dots -->
                        <div class="swiper-pagination"></div>
                    </div>

                    <!-- Thumbnail Carousel -->
                    <div class="swiper thumbnail-swiper">
                        <div class="swiper-wrapper">
                            <!-- Main product thumbnail -->
                            <div class="swiper-slide">
                                <img src="{{ $product->image }}" alt="Thumbnail">
                            </div>

                            <!-- Additional thumbnails -->
                            @foreach ($product->images as $index => $image)
                                <div class="swiper-slide">
                                    <img src="{{ $image->image }}" alt="Thumbnail {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Information -->
            <div class="col-md-6">
                <div class="product-info">
                    <h1 class="product-title">{{ $product->name }}</h1>

                    <!-- Pricing -->
                    <div class="product-price">
                    <span class="regular-price" id="regularPrice">
                        @if ($product->variants->first()->discount_price!=null &&$product->variants->first()->discount_price>0&&$product->variants->first()->discount_price<$product->variants->first()->price)
                            <del>{{ $product->variants->first()->price??0 }} KWD</del>
                        @endif
                    </span>
                        <span id="finalPrice">
                        {{ $product->variants->first()->discount_price ?? $product->variants->first()->price??0 }} KWD
                    </span>
                    </div>

                    @if ($groupedVariants->count())
                        @foreach ($groupedVariants as $variantTypeName => $variants)
                            <div class="variant-type mb-4">
                                <h5>{{ $variantTypeName }}</h5>
                                <div class="variant-scroll-container d-flex overflow-auto gap-2">
                                    @foreach ($variants as $variant)
                                        <div
                                            class="variant-box border rounded p-2"
                                            data-variant-id="{{ $variant->id }}"
                                            data-price="{{ $variant->price }}"
                                            data-quantity="{{ $variant->quantity }}"
                                            data-discount-price="{{ $variant->discount_price }}"
                                            onclick="selectVariant(this)"
                                        >
                                            {{ $variant->name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <!-- Ratings -->
                    <div class="product-rating">
                    <span class="stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa {{ $i <= $product->average_rating ? 'fa-star' : 'fa-star-o' }}"></i>
                        @endfor
                    </span>
                    </div>

                    <!-- Actions -->
                    <div class="product-actions">
                        <button class="soldOut" id="soldOutId" style="display: none;">@lang('website.Sold Out')</button>
                        <button class="addToCart" data-id="{{ $product->id }}" data-variant-id="{{ $product->variants->first()->id??0 }}" id="addToCartButton">
                            {{__('website.addToCart')}}
                        </button>

                        @if($product->is_favorite)
                            <button class="removeFromFavorite {{ $product->is_favorite ? 'active' : '' }}" data-id="{{$product->id}}">@lang('cp.RemovefromFavorites')</button>
                        @else
                            <button class="addToFavorite" data-id="{{$product->id}}">{{__('cp.AddtoFavorites')}}</button>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="product-description">
                        <h5>{{__('cp.ProductDescription')}}</h5>
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews -->
        <div class="product-reviews row">
            <h1>{{__('cp.CustomerReviews')}}</h1>

            <!-- Review Form (if user is logged in) -->
            @auth
                <form action="{{ route('reviews.store') }}" method="POST" class="review-form col-md-6">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div>
                        <label style="font-weight: bold; display: block; margin-bottom: 8px;">Rating:</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" required /><label for="star5"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1"><i class="fas fa-star"></i></label>
                        </div>
                    </div>

                    <div>
                        <label for="review">Review:</label>
                        <textarea name="review" id="review" rows="4" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn-site">Submit Review</button>
                </form>
            @endauth

            <!-- Display Reviews -->
            @foreach ($product->reviews as $review)
                <div class="review-item">
                    <div class="reviewer-name">{{ $review->user->name }}</div>
                    <div class="review-stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa {{ $i <= $review->rating ? 'fa-star' : 'fa-star-o' }}"></i>
                        @endfor
                    </div>
                    <p>{{ $review->review }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        // Initialize Swiper Carousel
        document.addEventListener('DOMContentLoaded', function() {
            // Thumbnail Swiper
            const thumbnailSwiper = new Swiper('.thumbnail-swiper', {
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesProgress: true,
                breakpoints: {
                    320: {
                        slidesPerView: 3,
                        spaceBetween: 8
                    },
                    480: {
                        slidesPerView: 4,
                        spaceBetween: 8
                    },
                    768: {
                        slidesPerView: 5,
                        spaceBetween: 10
                    },
                    1024: {
                        slidesPerView: 6,
                        spaceBetween: 10
                    }
                }
            });

            // Main Image Swiper
            const mainSwiper = new Swiper('.main-image-swiper', {
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                thumbs: {
                    swiper: thumbnailSwiper,
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                loop: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                }
            });

            // Pause autoplay on hover
            const gallery = document.querySelector('.product-gallery');
            gallery.addEventListener('mouseenter', function() {
                mainSwiper.autoplay.stop();
            });

            gallery.addEventListener('mouseleave', function() {
                mainSwiper.autoplay.start();
            });
        });

        // Variant Selection Function
        function selectVariant(element) {
            // Deselect all variants
            document.querySelectorAll('.variant-box.selected').forEach(selectedBox => {
                selectedBox.classList.remove('selected', 'bg-primary', 'text-white');
            });

            // Select clicked variant
            element.classList.add('selected', 'bg-primary', 'text-white');

            // Get price data
            const price = parseFloat(element.dataset.price) || 0;
            const discountPrice = parseFloat(element.dataset.discountPrice) || 0;
            const Quantity = parseFloat(element.dataset.quantity) || 0;

            const hasDiscount = discountPrice > 0 && discountPrice < price;

            // Update price display
            const regularPriceEl = document.getElementById('regularPrice');
            const finalPriceEl = document.getElementById('finalPrice');

            if (hasDiscount) {
                regularPriceEl.innerHTML = `<del>${price.toFixed(3)} KWD</del>`;
                finalPriceEl.textContent = `${discountPrice.toFixed(3)} KWD`;
            } else {
                regularPriceEl.innerHTML = '';
                finalPriceEl.textContent = `${price.toFixed(3)} KWD`;
            }

            // Update Add to Cart button
            const addToCartBtn = document.getElementById('addToCartButton');
            const soldOutBtn = document.getElementById('soldOutId');

            if(Quantity == 0) {
                addToCartBtn.style.display = 'none';
                soldOutBtn.style.display = 'block';
            } else {
                addToCartBtn.style.display = 'block';
                soldOutBtn.style.display = 'none';
            }

            if (addToCartBtn) {
                addToCartBtn.dataset.variantId = element.dataset.variantId;
                addToCartBtn.disabled = false;
            }
        }

        // Automatically select the first variant on page load
        window.addEventListener('DOMContentLoaded', () => {
            const firstVariant = document.querySelector('.variant-box');
            if (firstVariant) {
                selectVariant(firstVariant);
            }
        });
    </script>
@endsection
