<?php

namespace App\Http\Controllers\Api\v1\Devs;

use App\Http\Controllers\Controller;
use App\Http\Resources\DevsResource;
use App\Models\DevsPost;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class DevsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = DevsPost::where('is_active', 1)->orderBy('updated_at', 'desc')->paginate(5);

        return new DevsResource(true, 'List data devs post', $post);
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
        // Make validation
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'content'       => 'required',
        ]);
        
        // Check validation
        if ( $validator->fails() ) {
            return response()->json($validator->errors(), 442);
        }
        
        $slug = str_replace(' ', '-', strtolower($request->title));
        // return response(Auth::user()->id);
        $post = DevsPost::create([
            'title'         => $request->title,
            'content'       => $request->content,
            'slug'          => $slug,
            'is_active'     => 1,
            'category_id'   => $request->category_id ?? 1,
            'user_id'       => 1,
            // 'user_id'       => Auth::user()->id,
        ]);

        return new DevsResource(true, 'Data post berhasil ditambahkan!', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(DevsPost $devspost)
    {
        return new DevsResource(true, 'Data post ditemukan!', $devspost);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    // public function update(Request $request, Devspost $devspost)
    {
        // Make validation
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'content'       => 'required',
        ]);
        
        // Check validation
        if ( $validator->fails() ) {
            return response()->json($validator->errors(), 442);
        }

        $devspost = DevsPost::find($id);
        if (isEmpty($devspost)) {
            return response()->json('Post data not found or incorrect', 404);
        }

        $slug = str_replace(' ', '-', strtolower($request->title));
        
        $devspost->update([
            'title'         => $request->title,
            'content'       => $request->content,
            'slug'          => $slug,
            'is_active'     => 1,
            // 'category_id'   => $request->category_id,
            // 'user_id'       => Auth::user()->id,
        ]);
        
        return new DevsResource(true, 'Data Post berhasil diubah!', $devspost);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $devspost = DevsPost::findOrFail($id);
        $devspost = DevsPost::find($id);
        if (isEmpty($devspost)) {
            return response()->json('Post data not found or incorrect', 404);
        }

        $devspost->delete();

        return new DevsResource(true, 'Data post berhasil dihapus', null);
    }
}
