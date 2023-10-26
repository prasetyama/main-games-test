<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){

        $search = $request->search;
        $sort = $request->sort;

        $menu = new Menu();

        if($search){
            $menu = $menu->where('name','like',"%".$search."%");
        }

        if ($sort){
            if ($sort == "n-asc"){
                $menu = $menu->orderBy('name', 'asc');
            } else if ($sort == "n-desc"){
                $menu = $menu->orderBy('name', 'desc');
            } 
        }

        $menu = $menu->get();

        return view('menu.index', compact('menu'));
    }

    public function create(){
        return view('menu.add');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required',
			'price' => 'required',
            'stock' => 'required',
            'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
		]);

        $file = $request->file('file');

        $file_name = time()."_".$file->getClientOriginalName();

        $file_dir = 'uploads/images';

        Menu::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $file_name
        ]);

        $file->move($file_dir,$file_name);

        return redirect()->route('menu.index')
            ->withSuccess(__('Menu created successfully.'));
    }

    public function delete(Request $request, $id){
        $menu = Menu::Where('id', '=', $id)->first();

        $menu->delete();

        return redirect()->route('menu.index')
            ->withSuccess(__('Delete successfull.'));
    }

    public function edit(Menu $menu)
    {
        return view('menu.edit', [
            'menu' => $menu
        ]);
    }
    public function update(Request $request, Menu $menu)
    {
        $this->validate($request, [
            'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
		]);

        $file = $request->file('file');

        $file_name = time()."_".$file->getClientOriginalName();

        $file_dir = 'uploads/images';

        $update = Menu::where('id', $menu->id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $file_name
        ]);
        
        $file->move($file_dir,$file_name);

        return redirect()->route('menu.index')
            ->withSuccess(__('Menu updated successfully.'));
    }
}
