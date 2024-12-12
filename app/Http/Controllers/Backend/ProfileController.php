<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use DragonCode\Support\Filesystem\File as FilesystemFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
            'image' => ['image', 'max:2048']
        ]);


        $user = Auth::user();

        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }
        
            // Almacenar la nueva imagen en la carpeta 'profile'
            $image = $request->file('image');
            $path = $image->store('profile'); // Guarda en storage/app/profile
        
            $user->image = $path; // Guarda la ruta en la base de datos
        }        

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr()->success('¡Perfil actualizado exitosamente!');
        return redirect()->back();
    }

    /** Update Password */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr()->success('¡Contraseña del perfil actualizada correctamente!');
        return redirect()->back();
    }
}
