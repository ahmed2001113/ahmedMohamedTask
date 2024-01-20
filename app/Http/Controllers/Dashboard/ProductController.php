<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $Products = Product::all();
        return view('Dashboard.product',compact('Products'));
    }
    public function store(Request $request)
    {
        $rules=[
            'name_en'=>['required' , 'string'],
            'name'=>['required' , 'string'],
            'price'=>['required','numeric'],
        ];
        $request->validate($rules);
      try{  
       $products = new Product();
       $products->product_name = $request->name;
       $products->product_name_en = $request->name_en;
       $products->price = $request->price;
       $products->save();
      return redirect()->back()->with('add','Product Added Successfully');
     } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}
public function update(Request $request)
{
    $rules=[
        'name_en'=>['required' , 'string'],
        'name'=>['required' , 'string'],
        'price'=>['required','numeric'],
    ];
    $request->validate($rules);
try{
    $products = Product::findOrFail($request->id);
    $products->update([
        'product_name' => $request->name,
        'product_name_en' => $request->name_en,
        'price' => $request->price,
    ]);

    return redirect()->back()->with('edit','Product Has been Modified');
}  
catch (\Exception $e) {
    DB::rollback();
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}

}

public function destroy(Request $request)
{
try{
    $products = Product::findOrFail($request->id);
    Product::destroy($request->id);
    return redirect()->back()->with('delete','Product Has been Deleted');

}catch (\Exception $e) {
    DB::rollback();
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}
  }

}
