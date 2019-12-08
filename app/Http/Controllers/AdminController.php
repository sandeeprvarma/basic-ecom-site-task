<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Products;
use App\Orders;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function admin()
    {
        $orders = Products::orders()->toArray();;
        return view('admin.home')->with('orders',$orders);
    }

    public function category()
    {
        $category = Category::all();
        return view('admin.category')->with('categories',$category);
    }

    public function products()
    {
        $category = Category::all();
        $products = Products::all();
        return view('admin.products')->with('data',array('category'=>$category,'products'=>$products));
    }

    public function addCategory(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]+$/u|max:255|unique:category',
        ]);
        Category::create([            
            'name' => ucwords($data['name'])
        ]);
        return redirect('admin/category')->with('message','Category added successfully');
    }

    public function addProducts(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'category' => 'required|max:255',
            'description' => 'required|max:255',
            'filename' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
            'price' => 'required|regex:/[^a-zA-Z]/',
        ]);
        if($request->hasFile('filename')) {
            $fileName = time().'.'.$request->file('filename')->extension();  
            $request->file('filename')->move(public_path('uploads'), $fileName);
        }
        Products::create([            
            'category_id' => $data['category'],
            'title' => $data['name'],
            'description' => $data['description'],
            'image' => $fileName,
            'price' => $data['price'],
        ]);
        return redirect('admin/products')->with('message','Product added successfully');
    }
}
