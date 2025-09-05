<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\DsCaster;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view("products.index", compact("products"));
    }

    public function create()
    {
        return view("products.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'price'=> 'required|numeric',
            'description'=> 'nullable',
            'image'=> 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);
        
        $data=request()->all();
        if($request->hasFile(   'image'))
        {
            $fileName=time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $fileName);
            $data['image']= $fileName;
        }
        Product::create( $data);

        return redirect()->route('products.index')
                         ->with('success','Product created successfully');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // public function update(Request $request, Product $id)
    // {
    //     $request->validate([
    //         'name'=> 'required',
    //         'price'=> 'required|numeric',
    //         'description'=>['nullable'],
    //         'image'=> 'nullable|image|mimes:jpg,jped,png,gif|max:2048'
    //     ]);

    //     $data=request()->all();
    //     if($request->hasFile('image')){
    //         $imageName=time().'.'.$request->image->extension();
    //         $request->image->move(public_path('uploads'), $imageName);
    //         $product->image=$imageName;

    //     }
    //     $product->Save();

    //     return redirect()->route('products.index')
    //                      ->with('success','Product updated successfully');
    // }

    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;

    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);
        $product->image = $imageName;
    }

    $product->save();

    // Redirect to product list page with success message
    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
}


    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success','Product deleted successfully');
    }
}

