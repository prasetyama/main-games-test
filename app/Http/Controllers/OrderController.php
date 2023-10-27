<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Orders;
use App\Models\Receipt;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){

        $search = $request->search;
        $menu = new Menu();

        if($search){
            $menu = $menu->where('name','like',"%".$search."%");
        }

        $menu = $menu->get();

        return view('order.index', compact('menu'));
    }

    public function cart(Request $request){

        $receipt = Receipt::create([
            'user_id' => auth()->id(),
        ]);

        $total_receipt = 0;

        foreach ($request->menu as $menu){

            if ($menu['quantity'] != 0){
                $item = Menu::Where('id', '=', $menu['id'])->first();
                $orders = Orders::create(array_merge([
                    'receipt_id' => $receipt->id,
                    'menu_id' => $menu['id'],
                    'quantity' => $menu['quantity'],
                    'price' => $item->price,
                    'total_price' => $item->price * $menu['quantity']
                ]));

                $total_receipt += $orders->total_price;
            }
        }

        return view('order.receipt', compact('receipt', 'total_receipt'));
    }

    public function checkStock ($id, $quantity){

        $menu = Menu::Where('id', '=', $id)->first();

        if ($menu['stock'] >= $quantity){
            $menu['available'] = true;
        } else {
            $menu['available'] = false;
        }

        return $menu;
    }
}
