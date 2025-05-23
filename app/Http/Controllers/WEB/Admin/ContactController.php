<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Contact;
use App\Models\Careers;
use App\Models\Language;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use DataTables;
class ContactController extends Controller
{
    public function __construct()
    {
        $this->settings = Setting::query()->first();
        view()->share([
            'settings' => $this->settings,
        ]);
        
              $this->middleware(function ($request, $next) {
         if(!can('contact-us')){
            return abort(403);
        }
        return $next($request);
        });
    }
    public function index(Request $request)
    {
        $items = Contact::query();
        if ($request->has('email')) {
            if ($request->get('email') != null)
                $items->where('email', 'like', '%' . $request->get('email') . '%');
        }

        if ($request->has('mobile')) {
            if ($request->get('mobile') != null)
                $items->where('mobile', 'like', '%' . $request->get('mobile') . '%');
        }
        if ($request->get('from_date') && $request->get('to_date')) {
            $items->whereDate('updated_at', '>=', Carbon::parse($request->get('from_date')));
            $items->whereDate('updated_at', '<=', Carbon::parse($request->get('to_date')));
        }
        $items = $items;

        if ($request->ajax()) {
            // Order::select('*');
            return Datatables::of($items->select('*'))->editColumn('read',function($row){
                $btn =view('admin.contacts.status_lable')->with(['row'=>$row])->render();
                return $btn;
             })/*->editColumn('type',function($row){
                $btn =view('admin.contacts.type_lable')->with(['row'=>$row])->render();
                return $btn;
             })*/->setRowId(function ($row) {
                return 'tr-'.$row->id;
            })->editColumn('created_at', function($data){
                  $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                   return $formatedDate; })->escapeColumns([])
                ->addColumn('action', function($row){
                           $btn =view('admin.contacts.btns')->with(['row'=>$row])->render();
                            return $btn;
                    })->rawColumns(['action'])->make(true);
        }

        return view('admin.contacts.home', [
            // 'items' => $items,
        ]);

    }
    public function viewMessage($id)
    {
        Contact::query()->where('id', $id)->update(['read' => 1]);
        $item = Contact::query()->findOrFail($id);
        return view('admin.contacts.message', [
            'item' => $item,
        ]);
    }


    public function store(Request $request)
    {
        
        $roles = [
            
             'name' => 'required',
             'mobile' => 'required',
             'email' => 'required',
             'message' => 'required',
        
         ];
         $this->validate($request, $roles);
         
         $contact = new Contact();
        
 
         $contact->name = $request->name;
         $contact->email = $request->email;
         $contact->mobile = $request->mobile;
         $contact->message = $request->message;
         $contact->type = 1;
         $contact->save();
         return redirect()->back()->with('status', __('cp.sended'));
    }


    public function destroy($id)
    {
        $item = Contact::query()->findOrFail($id);
        if ($item) {
            Contact::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }


}
