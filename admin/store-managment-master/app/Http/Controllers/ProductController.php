<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category', 'subcategory'])->paginate(100);

        return inertia()->render('Dashboard/products/index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return inertia()->render('Dashboard/products/create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {

        $request->validated();
        $product = new Product();

        $product->name = $request->name;
        $product->weight = $request->weight;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->added_value = $request->added_value;
        $product->deducted_value = $request->deducted_value;
        $product->price = $request->price;
        $product->total_price = $product->setTotalPrice($request->weight, $request->added_value, $request->deducted_value, $request->price);
        $product->code = $request->code;
        $product->stock = $request->stock;

        if ($request->has('image')) {

            $product->addMedia($request->image)->preservingOriginal()->toMediaCollection('products');
        }

        $product->save();

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'تم أضافة المنتج'
        ]);

        return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();

        return inertia()->render('Dashboard/products/edit', [
            'product' => $product,
            'categories' => $categories,
            '_subcategories' => $subcategories,
            'image' => $product->image
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {

        $request->validated();

        $product->update([
            'name' => $request->name,
            'weight' => $request->weight,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'added_value' => $request->added_value,
            'deducted_value' => $request->deducted_value,
            'price' => $request->price,
            'total_price' => $product->setTotalPrice($request->weight, $request->added_value, $request->deducted_value, $request->price),
            'code' => $request->code,
            'stock' => $request->stock,
        ]);

        if ($request->has('image') && $request->image != 'undefined' ) {

            $mediaItems = $product->getFirstMedia('products');
            (!empty($mediaItems)) ? $mediaItems->delete() : $product->addMedia($request->image)->preservingOriginal()->toMediaCollection('products') ;

        }

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'تم تعديل المنتج'
        ]);

        return redirect()->route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'تم حذف المنتج'
        ]);

        return redirect()->route('categories.index');
    }
}
