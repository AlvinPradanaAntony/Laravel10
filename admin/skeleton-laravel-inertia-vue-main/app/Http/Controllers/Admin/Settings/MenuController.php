<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MenuController extends Controller
{
    function __construct()
    {
        //  $this->middleware('can:menu list', ['only' => ['index','show']]);
        //  $this->middleware('can:menu create', ['only' => ['create','store']]);
        //  $this->middleware('can:menu edit', ['only' => ['edit','update']]);
        //  $this->middleware('can:menu delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Setting/Menu/list', [
            'list'  => Menu::all(),
            'can'   => [
                'create'    => Auth::user()->can('menu create'),
                'edit'      => Auth::user()->can('menu edit'),
                'delete'    => Auth::user()->can('menu delete'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(menu $menu)
    {
        //
    }
}
