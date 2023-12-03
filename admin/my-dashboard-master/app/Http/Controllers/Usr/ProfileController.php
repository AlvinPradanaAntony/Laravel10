<?php

namespace App\Http\Controllers\Usr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function setImage(Request $request)
    {
        $user = auth()->user();

        if($request->hasFile('image') && $request->image->isValid())
        {
            if(Storage::exists($user->image_path))
                Storage::delete($user->image_path);

            $path = $request->image->store("profiles/users/{$user->uuid}");
        }

        $result = $user->setImage($path, false);

        if($result < 1)
            return redirect()->back()->with('failed', 'falha ao atualizar imagem!');

        return redirect()->route('profile')->with('success', 'Imagem atualizado com sucesso!');
    }
}
