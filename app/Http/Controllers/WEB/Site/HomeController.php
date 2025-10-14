<?php

namespace App\Http\Controllers\WEB\Site;

use App;
use App\Models\Cart;
use App\Models\Category;
use App\Models\LandingPage;
use App\Models\Review;
use App\Models\Setting;
use App\Models\Language;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Page;
use App\Models\ScreensSlider;
use App\Models\ProductVitamin;
use App\Models\Banner;
use App\Models\Favorite;
use App\Models\SubscribeEmail;
use App\Models\Venders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\RequestException;

class HomeController extends Controller
{
 public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        view()->share([
            'locales' => $this->locales,
            'settings' => $this->settings,

        ]);
        $category_view_list = Category::query();

    }




    public function home()
    {
      $categories=Category::where('status','active')->get();
      $venders = Venders::where('status','active')->get();
      $products=Product::where('status','active')->orderBy('id','desc')->take(6)->get();

        if (auth()->check()) {
            $carts = Cart::where('user_id', Auth::user()->id)
                ->orWhere('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        } else {
            $carts = Cart::where('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        }

//
        $currentLocale = App::getLocale();

        $banners = Banner::where('status', 'active')
            ->join('banner_translations', function($join) use ($currentLocale) {
                $join->on('banners.id', '=', 'banner_translations.banner_id')
                    ->where('banner_translations.locale', '=', $currentLocale);
            })
            ->orderBy('banner_translations.locale', 'asc') // or 'desc'
            ->select('banners.*') // important to avoid overwriting columns
            ->get();

        return view('website.home',[
            'categories'=> $categories,
            'products'=> $products,
            'venders'=>$venders,
            'banners'=> $banners,
            'carts'=>$carts,
            ]);


    }


    public function prouctDetails (Request $request,$id,$slug)
    {



        $product=Product::where('status','active')->with('variants','variants.variantType','category','images','vitamin')->findOrFail($id);

        if (auth()->check()) {
            $carts = Cart::where('user_id', Auth::user()->id)
                ->orWhere('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        } else {
            $carts = Cart::where('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        }
//
        $cart=$carts->where('product_id',$id)->first();


        $groupedVariants = $product->variants
            ->filter(fn($v) => $v->variantType) // Avoid nulls
            ->groupBy(fn($variant) =>app()->getLocale()=='en'?  $variant->variantType->name_en:$variant->variantType->name_ar);

//        dd(app()->getLocale());
        if ($product->vender_id> 0) {
            $visitor = Venders::where('id',$product->vender_id)->first();
            if(!empty($visitor)){
                $newVisitorCount=$visitor->visitor + 1;
                Venders::where('id',$product->vender_id)->update(['visitor' => $newVisitorCount]);

            }
        }

       $products=Product::where('status','active')
                ->where('category_id',$product->category_id)
                ->where('vender_id',$product->vender_id)
                ->orderBy('id','desc')->take(8)->get();

        $product_image = $product->images;
        $products_vitamin = DB::table('vitamin_product')
                            ->leftJoin('product_vitamin', 'vitamin_product.vitamin_id', '=', 'product_vitamin.id')
                            ->where('vitamin_product.product_id', $id)
                            ->select('vitamin_product.*', 'product_vitamin.*')
                            ->get();


        return view('website.prouctDetails ',[
            'product'           => $product,
            'cart'=>$cart,
            'products'          => $products,
            'product_image'     => $product_image,
            'products_vitamin'  => $products_vitamin,
            'groupedVariants'=>$groupedVariants
        ]);
    }


    public function storeReview(Request $request) {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        Review::create([
            'product_id' => $validated['product_id'],
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'review' => $validated['review']
        ]);

        // Recalculate average rating
        $averageRating = Review::where('product_id', $validated['product_id'])->average('rating');
        Product::where('id', $validated['product_id'])->update(['average_rating' => $averageRating]);

        return redirect()->back()->with('success', __('website.review_submitted'));
    }
    public function productByCategory(Request $request,$id,$slug)
    {
      $category=Category::where('status','active')->findOrFail($id);
      if($request->sort =='min'){
        $products=Product::where('category_id',$id)->where('status','active')->orderBy('price','asc')->paginate(12);
      }elseif($request->sort =='max'){
        $products=Product::where('category_id',$id)->where('status','active')->orderBy('price','desc')->paginate(12);
      }else{
        $products=Product::where('category_id',$id)->where('status','active')->orderBy('id','desc')->paginate(12);
      }

        if (auth()->check()) {
            $carts = Cart::where('user_id', Auth::user()->id)
                ->orWhere('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        } else {
            $carts = Cart::where('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        }

      if ($request->ajax()) {
            $is_more='yes';
            if($products->count() < 12){$is_more='no';}
            $view = view('website.more_blad.product_items')->with(['products'=>$products,'carts'=>$carts])->render();
            return response()->json(['html' => $view,'is_more'=>$is_more]);
        }

        return view('website.profucts_by_categories',[
            'category'=> $category,
            'products'=> $products,
            'carts'=>$carts,
            ]);
    }

    public function offers(Request $request)
    {

        if($request->sort =='min'){
            $products=Product::where('status','active')->where('discount_price','>',0)->where('offer_end_date' ,'>=', now()->toDateString())->orderBy('discount_price','asc')->paginate(12);
        }else{
            $products=Product::where('status','active')->where('discount_price','>',0)->where('offer_end_date' ,'>=', now()->toDateString())->orderBy('discount_price','desc')->paginate(12);
        }

        if (auth()->check()) {
            $carts = Cart::where('user_id', Auth::user()->id)
                ->orWhere('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        } else {
            $carts = Cart::where('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        }
        if ($request->ajax()) {
            $is_more='yes';
            if($products->count() < 12){$is_more='no';}
            $view = view('website.more_blad.product_items')->with(['products'=>$products,'carts'=>$carts])->render();
            return response()->json(['html' => $view,'is_more'=>$is_more]);
        }

        return view('website.offers',[
            'products'=> $products,
            'carts'=>$carts,
            ]);
    }


    public function newArrival(Request $request) {
        if($request->sort =='min'){
            $products=Product::where('status','active')->orderBy('price','asc')->orderBy('id','desc')->paginate(12);
        }elseif($request->sort =='max'){
            $products=Product::where('status','active')->orderBy('price','desc')->orderBy('id','desc')->paginate(12);
        }
        else{
            $products=Product::where('status','active')->orderBy('id','desc')->paginate(12);
        }
        if (auth()->check()) {
            $carts = Cart::where('user_id', Auth::user()->id)
                ->orWhere('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        } else {
            $carts = Cart::where('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        }


        if ($request->ajax()) {
            $is_more='yes';
            if($products->count() < 12){$is_more='no';}
            $view = view('website.more_blad.product_items')->with(['products'=>$products,'carts'=>$carts])->render();
            return response()->json(['html' => $view,'is_more'=>$is_more]);
        }

        return view('website.newArrival',[
            'products'=> $products,
            'carts'=>$carts,
            ]);
    }

    public function searchProducts (Request $request) {
        $search=$request->get('search');
        if($request->sort =='min'){
            $products=Product::where('status','active')->whereTranslationLike('name', '%'. $search.'%')->orderBy('price','asc')->orderBy('id','desc')->paginate(12);
        }elseif($request->sort =='max'){
            $products=Product::where('status','active')->whereTranslationLike('name', '%'. $search.'%')->orderBy('price','desc')->orderBy('id','desc')->paginate(12);
        }
        else{
            $products=Product::where('status','active')->whereTranslationLike('name', '%'. $search.'%')->orderBy('id','desc')->paginate(12);
        }

        if (auth()->check()) {
            $carts = Cart::where('user_id', Auth::user()->id)
                ->orWhere('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        } else {
            $carts = Cart::where('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        }

        if ($request->ajax()) {
            $is_more='yes';
            if($products->count() < 12){$is_more='no';}
            $view = view('website.more_blad.product_items')->with(['products'=>$products,'carts'=>$carts])->render();
            return response()->json(['html' => $view,'is_more'=>$is_more]);
        }

        return view('website.searchProducts',[
            'products'=> $products,
            'search'=> $search,
            'carts'=>$carts,
            ]);
    }



    public function addFavorite(Request $request , $id){

        if(Favorite::where('user_id',auth()->id())->where('product_id',$id)->exists())
        {
            $message = __('api.alreadyFound');
             return response()->json(['status' => true, 'code' => 200, 'message' =>  $message]);

        }else{
            $fevorite= new Favorite();
            $fevorite->user_id=auth()->id();
            $fevorite->product_id=$id;
            $fevorite->save();
          }

           if ($fevorite) {
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);

           } else {
             $message = __('api.not_found');
             return response()->json(['status' => true, 'code' => 200, 'message' => $message]);

          }
    }

    public function deleteFromFavorit(Request $request , $id)
    {
        $item = Favorite::where('user_id',auth()->id())->where('product_id',$id)->first();
        if ($item) {
               $item->delete();

            $message = __('api.ok');

            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        }
        $massege =__('api.whoops');
        return response()->json(['status' => false, 'code' => 200, 'message' => $massege ]);
    }


    public function myFavorites(Request $request)
    {
        $items = Favorite::where('user_id',auth()->id())->with('product')->paginate(12);
        if (auth()->check()) {
            $carts = Cart::where('user_id', Auth::user()->id)
                ->orWhere('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        } else {
            $carts = Cart::where('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        }

        if ($request->ajax()) {
            $is_more='yes';
            if($items->count() < 12){$is_more='no';}
            $view = view('website.more_blad.moreFavorites')->with(['items'=>$items,'carts'=>$carts])->render();
            return response()->json(['html' => $view,'is_more'=>$is_more]);
        }

         return view('website.myFavorites',[
            'items'=> $items,
             'carts'=>$carts,
            ]);

    }

    public function pages($slug)
    {
      $page = Page::whereTranslation('slug', $slug)->first();
      if (empty($page)) {
        return view('website.404');
      }
        return view('website.pages',['page'=>$page]);
    }


    public function contact(Request $request)
    {
        return view('website.contact');
    }

    public function contactUs(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'validator' =>implode("\n",$validator-> messages()-> all()) ]);
        }

        $review= new Contact();
         $review->name=$request->name;
        $review->email=$request->email;
        $review->message=$request->message;
        $review->mobile=$request->mobile;
        $review->read=0;

        $review->save();

        if($review){

            $message = __('api.ok');
             return response()->json(['status' => true, 'code' => 300, 'message' => $message,  ]);
        }
            $message = __('api.whoops');
            return response()->json(['status' => false, 'code' => 500, 'message' => $message,  ]);
    }

       public function subscribeNow(Request $request)   {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'validator' =>implode("\n",$validator-> messages()-> all()) ]);
        }

        $review= new SubscribeEmail();
        $review->email=$request->email;
        // $review->type=$request->type;

        $review->save();

        if($review){

            $message = __('api.ok');
             return response()->json(['status' => true, 'code' => 300, 'message' => $message,  ]);
        }
            $message = __('api.whoops');
            return response()->json(['status' => false, 'code' => 500, 'message' => $message,  ]);



    }

    public function productByVender(Request $request,$id)
    {
        $category=Venders::where('status','active')->findOrFail($id);
        $categories=Category::where('status','active')->get();

        if($request->sort =='min') {
            $products = Product::where('vender_id',$id)->where('status','active')->orderBy('price','asc')->paginate(12);
        } elseif($request->sort =='min') {
            $products=Product::where('vender_id',$id)->where('status','active')->orderBy('price','desc')->paginate(12);
        } else {
            $products=Product::where('vender_id',$id)->where('status','active')->orderBy('id','desc')->paginate(12);
        }
        if (auth()->check()) {
            $carts = Cart::where('user_id', Auth::user()->id)
                ->orWhere('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        } else {
            $carts = Cart::where('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        }

        if ($request->ajax()) {
            $is_more='yes';
            if($products->count() < 12){$is_more='no';}
            $view = view('website.more_blad.product_items')->with(['products'=>$products,'carts'=>$carts])->render();
            return response()->json(['html' => $view,'is_more'=>$is_more]);
        }

        $category=Venders::where('verified','1')->findOrFail($id);

        return view('website.profucts_by_venders',[
            'category'=> $category,
            'products'=> $products,
            'categories'=> $categories,
            'carts'=>$carts,
            'V_id'=>$id

        ]);

    }

    public function productByvenderCategory(Request $request,$V_id,$id,$slug)
    {
        $visitor = Venders::where('id',$V_id)->first();
        $new_quantity=$visitor->visitor + 1;
        Venders::where('id',$V_id)->update(['visitor' => $new_quantity]);


      $categories=Category::where('status','active')->get();
      $category=Category::where('status','active')->findOrFail($id);
      if($request->sort =='min') {

        $products=Product::where('category_id',$id)
                         ->where('vender_id',$V_id)
                         ->where('status','active')
                         ->orderBy('price','asc')->paginate(12);

      } elseif($request->sort =='min') {

        $products = Product::where('category_id',$id)
                    ->where('status','active')
                    ->where('vender_id',$V_id)
                    ->orderBy('price','desc')->paginate(12);

      } else {

        $products = Product::where('category_id',$id)
                    ->where('status','active')
                    ->where('vender_id',$V_id)
                    ->orderBy('id','desc')->paginate(12);
        }
        if (auth()->check()) {
            $carts = Cart::where('user_id', Auth::user()->id)
                ->orWhere('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        } else {
            $carts = Cart::where('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        }

        if ($request->ajax()) {
            $is_more='yes';
            if($products->count() < 12){$is_more='no';}
            $view = view('website.more_blad.product_items')->with(['products'=>$products,'carts'=>$carts])->render();
            return response()->json(['html' => $view,'is_more'=>$is_more]);
        }

        return view('website.profucts_by_venders',[
            'category'=> $category,
            'products'=> $products,
            'categories'=> $categories,
            'carts'=>$carts,
            'V_id'=>$V_id

        ]);

    }



}

