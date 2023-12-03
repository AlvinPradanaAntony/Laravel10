<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\SubcategoryStoreRequest;
use App\Http\Requests\SubcategoryUpdateRequest;
use App\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::with('category')->paginate(100);

        return inertia()->render('Dashboard/subcategories/index',[
            'subcategories' => $subcategories,
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

        return inertia()->render('Dashboard/subcategories/create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoryStoreRequest $request)
    {
        $data = $request->all();

        Subcategory::create($data);

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'تم أضافة تصنيف فرعي'
        ]);

        return redirect()->route('subcategories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();

        return inertia()->render('Dashboard/subcategories/edit', [
            'categories' => $categories,
            'subcategory' => $subcategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(SubcategoryUpdateRequest $request, Subcategory $subcategory)
    {
        $data = $request->validated();

        $subcategory->update($data);

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'تم تعديل التصنيف الفرعي'
        ]);

        return redirect()->route('subcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $id = $subcategory->category_id;
        $subcategory->delete();

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'تم حذف التصنيف الفرعي'
        ]);

        return redirect()->route('subcategories.index', $id);
    }
}
