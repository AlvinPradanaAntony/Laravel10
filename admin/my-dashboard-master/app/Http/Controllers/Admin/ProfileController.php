<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function setImage(Request $request)
    {
        $admin = auth('admin')->user();

        if($request->hasFile('image') && $request->image->isValid())
        {
            if(Storage::exists($admin->image_path))
                Storage::delete($admin->image_path);

            $path = $request->image->store("profiles/admins/{$admin->uuid}");
        }

        $result = $admin->setImage($path, false);

        if($result < 1)
            return redirect()->back()->with('failed', 'falha ao atualizar imagem!');

        return redirect()->route('admin.profile')->with('success', 'Imagem atualizado com sucesso!');
    }
}
