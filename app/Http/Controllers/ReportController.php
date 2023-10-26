<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use App\Models\Receipt;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){

        $search = $request->search;
        $from = $request->from;
        $to = $request->to;

        $data = New Receipt;

        if($search){
            $data = $data->with(['orders' => function ($query) use ($search) {
                $query->join('menu', 'menu.id', '=', 'orders.menu_id')->where('menu.name', 'like', "%".$search."%");
            }]);
        }

        if ($from || $to){
            $data = $data->whereBetween('created_at', [$from, $to]);
        }

        $data = $data->paginate(10);

        return view('report.index', compact('data'));

    }
}
