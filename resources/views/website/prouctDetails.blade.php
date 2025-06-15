@extends('website.layout')
@section('title', $product->name)
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>

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
        /*width: 100px;*/

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

    /* Override for LTR languages */


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

    /* General Styling */
    /*.product-detail-container { padding: 40px 0; }*/

    /* Breadcrumbs */

    .breadcrumb-container { background: #f9f9f9; padding: 10px 15px; margin-bottom: 25px; border-radius: 5px; }
    .breadcrumb-item a { color: var(--text-color) }
    .breadcrumb-item a:hover { text-decoration: underline; color: var(--main-color); }
    .breadcrumb-item.active { color:   var(--text-color); font-weight: bold; }

    /* Product Gallery */
    .product-gallery { display: flex; flex-direction: column; gap: 10px; }
    .product-main-image { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .product-main-image img { width: 100%; height: auto; object-fit: contain; }
    .product-thumbnails { display: flex; gap: 10px; }
    .product-thumbnail { width: 70px; height: 70px; border: 2px solid transparent; border-radius: 5px; cursor: pointer; overflow: hidden; transition: border-color 0.3s; }
    .product-thumbnail:hover, .product-thumbnail.active { border-color: var(--main-color); }
    .product-thumbnail img { width: 100%; height: 100%; object-fit: contain; }

    /* Product Info */
    /*.product-info { padding-left: 30px; }*/
    .product-title { font-size: 28px; font-weight: 600; margin-bottom: 15px;    white-space: normal;
        word-wrap: break-word;
        overflow: visible; }
    .product-price { font-size: 24px; font-weight: 700; color: var(--main-color); margin-bottom: 15px; }
    .regular-price del { color: #999; }
    .product-rating { margin-bottom: 15px; }
    .product-rating .stars i { color: #ffd700; margin-right: 5px; }
    .btn-rate { background: none; color: var(--main-color); font-size: 14px; border: none; cursor: pointer; }

    /* Add to Cart / Favorite Buttons */
    .product-actions { display: flex; gap: 15px; margin-bottom: 25px; }
    .addToCart,.removeFromCart, .addToFavorite,.removeFromFavorite { padding: 10px 20px; border-radius: 5px; font-size: 16px; color: white; cursor: pointer; }
    .addToCart,.removeFromCart,.removeFromFavorite { background: #ff6b81; border: none; }
    .addToCart,.removeFromCart,.removeFromFavorite:hover { background: var(--main-color); }
    .addToFavorite,.removeFromFavorite { background: #6c757d; }
    .addToFavorite,.removeFromFavorite:hover { background: #5a6268; }
    .addToFavorite.active { background: #ff6b81; }
    .removeFromFavorite.active { background: #ff6b81; }

    /* Product Description */
    .product-description { margin-top: 25px; padding: 20px; background: #f9f9f9; border-radius: 10px; }
    .product-description h5 { font-size: 20px; font-weight: 600; color: var(--text-color); margin-bottom: 15px; }

    /* Reviews */
    .product-reviews { margin: 25px; }
    /*.review-form { margin-bottom: 20px; }*/
    /*.review-item { padding: 15px; border: 1px solid #eee; border-radius: 5px; margin-bottom: 15px; }*/


</style>
@endsection

@section('socialMeta')
    <meta property="og:url"                content="{{Request::fullUrl()}}" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{$product->name}}" />
    <meta property="og:description"        content="{{str_limit(strip_tags($product->description) ,  200)}}" />
    <meta property="og:image"              content="{{url($product->image)}}" />
    <meta property="fb:app_id" 			   content="17734562" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@ASAL" />
    <meta name="twitter:creator" content="@ASAL" />
    <meta name="twitter:title" content="{{$product->name}}" />
    <meta name="twitter:description" content="{{str_limit(strip_tags($product->description) ,  200)}}" />
    <meta name="twitter:image" content="{{url($product->image)}}" />
@endsection

@section('content')
<div class="container product-detail-container ">
    <!-- Breadcrumbs -->
    <div class="breadcrumb-container">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category', [$product->category->id, Str::slug($product->category->name)]) }}">{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <!-- Product Gallery -->
        <div class="col-md-6">
            <div class="product-gallery">
                <div class="product-main-image">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" id="mainImage">
                </div>
                <div class="product-thumbnails">
                    @foreach ($product->images as $image)
                        <div class="product-thumbnail">
                            <img src="{{ $image }}" alt="Thumbnail">
                        </div>
                    @endforeach
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
                {{--                <!-- Product Variants -->--}}
{{--                @if ($product->variants->count())--}}
{{--                    <div class="product-variants">--}}
{{--                        <label for="variant">Choose a variant:</label>--}}
{{--                        <select id="variantSelect" class="form-control">--}}
{{--                            @foreach ($product->variants as $index => $variant)--}}
{{--                                <option value="{{ $variant->id }}" data-price="{{ $variant->price }}" data-discount-price="{{ $variant->discount_price }}" {{ $index === 0 ? 'selected' : '' }}>--}}
{{--                                    {{ $variant->name }}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <!-- Ratings -->--}}
                <div class="product-rating">
                    <span class="stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa {{ $i <= $product->average_rating ? 'fa-star' : 'fa-star-o' }}"></i>
                        @endfor
                    </span>
{{--                    <button class="btn-rate" data-toggle="modal" data-target="#rateProductModal">(Add Rating)</button>--}}
                </div>

                <!-- Actions -->
                <div class="product-actions">
{{--                    @if( $product->is_cart)--}}
{{--                        <div class="quantity-item">--}}
{{--                            @if($cart->product->quantity > 0)--}}
{{--                                <div class="quantity">--}}
{{--                                    <div class="btn button-count dec jsQuantityDecrease" data-id="{{@$cart->product->id}}" minimum="1">--}}
{{--                                        <i class="fa fa-minus" aria-hidden="true"></i>--}}
{{--                                    </div>--}}
{{--                                    <input type="text" name="count-quat1" class="count-quat" value="{{$cart->quantity}}" min="1" max="{{$cart->product->quantity}}">--}}
{{--                                    <div class="btn button-count inc jsQuantityIncrease" max="{{$cart->product->quantity}}" data-id="{{@$cart->product->id}}">--}}
{{--                                        <i class="fa fa-plus" aria-hidden="true"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @else--}}
                                <div class="soldOut" style="display: none" id="soldOutId">
                                    <h1>@lang('website.Sold Out')</h1>
                                </div>
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <button class="removeFromCart" data-id="{{$product->id}}"> Remove from Cart </button>--}}

{{--                    @else--}}
                        <button class="addToCart" data-id="{{ $product->id }}" data-variant-id="{{ $product->variants->first()->id??0 }}" id="addToCartButton">
                            {{__('website.addToCart')}}
                        </button>

{{--                    @endif--}}

                    @if($product->is_favorite)
                            <button class="removeFromFavorite {{ $product->is_favorite ? 'active' : '' }}" data-id="{{$product->id}}">@lang('cp.RemovefromFavorites')</button>
                        @else
                            <button class="addToFavorite  " data-id="{{$product->id}}">{{__('cp.AddtoFavorites')}}</button>


                        @endif

{{--                    <button class="addToCart" data-id="{{$product->id}}">{{ $product->is_cart ? 'Remove from Cart' : 'Add to Cart' }}</button>--}}
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

                <div >
                    <label style="font-weight: bold; display: block; margin-bottom: 8px;">Rating:</label>

                    <div class="star-rating ">
                        <input type="radio" id="star5" name="rating" value="5" required /><label for="star5"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1"><i class="fas fa-star"></i></label>
                    </div>
                </div>

                <div>
                    <label for="review">Review:</label>
                    <textarea name="review" id="review" rows="4" class="form-control " required></textarea>
                </div>

                <button type="submit" class="btn-site ">Submit Review</button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const variantSelect = document.getElementById('variantSelect');
            const regularPrice = document.getElementById('regularPrice');
            const finalPrice = document.getElementById('finalPrice');
            const addToCartBtn = document.getElementById('addToCartButton');

            // if (variantSelect) {
            //     variantSelect.addEventListener('change', function () {
            //         const selectedOption = variantSelect.options[variantSelect.selectedIndex];
            //         const price = selectedOption.getAttribute('data-price');
            //         const discountPrice = selectedOption.getAttribute('data-discount-price');
            //         const variantId = selectedOption.value;
            //
            //         // Update price display
            //         if (discountPrice && discountPrice !== 'null') {
            //             regularPrice.innerHTML = `<del>${price} KWD</del>`;
            //             finalPrice.innerHTML = `${discountPrice} KWD`;
            //         } else {
            //             regularPrice.innerHTML = '';
            //             finalPrice.innerHTML = `${price} KWD`;
            //         }
            //
            //         // Update Add to Cart button's data-variant-id
            //         if (addToCartBtn) {
            //             addToCartBtn.setAttribute('data-variant-id', variantId);
            //         }
            //     });
            // }
        });
        function selectVariant(element) {
            // 1. First deselect ALL variant boxes in the entire document
            document.querySelectorAll('.variant-box.selected').forEach(selectedBox => {
                selectedBox.classList.remove('selected', 'bg-primary', 'text-white');
            });

            // 2. Now select the clicked variant
            element.classList.add('selected', 'bg-primary', 'text-white');

            // 3. Get price data from the selected variant
            const price = parseFloat(element.dataset.price) || 0;
            const discountPrice = parseFloat(element.dataset.discountPrice) || 0;
            const Quantity = parseFloat(element.dataset.quantity) || 0;
            console.log(Quantity);

            const hasDiscount = discountPrice > 0 && discountPrice < price;

            // 4. Update price display
            const regularPriceEl = document.getElementById('regularPrice');
            const finalPriceEl = document.getElementById('finalPrice');

            if (hasDiscount) {
                regularPriceEl.innerHTML = `<del>${price.toFixed(3)} KWD</del>`;
                finalPriceEl.textContent = `${discountPrice.toFixed(3)} KWD`;
            } else {
                regularPriceEl.innerHTML = '';
                finalPriceEl.textContent = `${price.toFixed(3)} KWD`;
            }



            // 5. Update Add to Cart button
            const addToCartBtn = document.getElementById('addToCartButton');
            const soldOutBtn = document.getElementById('soldOutId');
            if(Quantity==0){
                addToCartBtn.style.display = 'none';
                soldOutBtn.style.display = 'block';



                return;
            }else {
                addToCartBtn.style.display = 'block';
                soldOutBtn.style.display = 'none';


            }
            if (addToCartBtn) {
                addToCartBtn.dataset.variantId = element.dataset.variantId;
                addToCartBtn.disabled = false;
            }

            // Debug logs (can be removed in production)
            console.log('Selected variant:', {
                id: element.dataset.variantId,
                name: element.textContent.trim(),
                price: price,
                discountPrice: discountPrice
            });
        }
        // Automatically select the first variant on page load
        window.addEventListener('DOMContentLoaded', () => {
            const firstVariant = document.querySelector('.variant-box');
            if (firstVariant) {
                selectVariant(firstVariant);
            }
        });


    </script>


    <script>
        tinymce.init({
            selector: 'textarea[id^="description_"]',
            plugins: 'lists link image table code',
            toolbar: 'undo redo | formatselect | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | code',
            height: 300,
            menubar: false,
        });
    </script>

@endsection
