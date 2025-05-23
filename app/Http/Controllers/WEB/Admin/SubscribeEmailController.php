<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\SubscribeEmail;
use App\Models\Careers;
use App\Models\Language;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use DataTables;
class SubscribeEmailController extends Controller
{
    public function __construct()
    {
        $this->settings = Setting::query()->first();
        view()->share([
            'settings' => $this->settings,
        ]);
        
              $this->middleware(function ($request, $next) {
         if(!can('subscribes')){
            return abort(403);
        }
        return $next($request);
        });
    }
    public function index(Request $request)
    {
        $items = SubscribeEmail::query();
        if ($request->has('email')) {
            if ($request->get('email') != null)
                $items->where('email', 'like', '%' . $request->get('email') . '%');
        }

 
        if ($request->get('from_date') && $request->get('to_date')) {
            $items->whereDate('updated_at', '>=', Carbon::parse($request->get('from_date')));
            $items->whereDate('updated_at', '<=', Carbon::parse($request->get('to_date')));
        }
        $items = $items;

        if ($request->ajax()) {
            // Order::select('*');
            return Datatables::of($items->select('*'))->setRowId(function ($row) {
                return 'tr-'.$row->id;
            })->editColumn('created_at', function($data){
                  $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                   return $formatedDate; })->escapeColumns([])
                ->addColumn('action', function($row){
                           $btn =view('admin.subscribes.btns')->with(['row'=>$row])->render();
                            return $btn;
                    })->rawColumns(['action'])->make(true);
        }

        return view('admin.subscribes.home', [
            // 'items' => $items,
        ]);

    }
 

 


    public function destroy($id)
    {
        $item = SubscribeEmail::query()->findOrFail($id);
        if ($item) {
            SubscribeEmail::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }


}
