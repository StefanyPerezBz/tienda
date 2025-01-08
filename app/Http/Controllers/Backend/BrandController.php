<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Exception;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
            'name' => 'required|max:200|regex:/^[\p{L}\s]+$/u|unique:brands,name',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'required|in:yes,no',
        ], [
            'name.unique' => 'El nombre ya está en uso. Por favor, elige otro.',
        ]);

        $brand = new Brand();

        // Manejo de la imagen
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logo');
            $brand_image = str_replace('logo/', '', $path);
            $brand->logo = $brand_image;
        }

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->status = $request->status;
        $brand->is_featured = $request->is_featured;
        $brand->save();

        return redirect()->route('admin.brand.index')->with('success', 'Marca creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        return view('admin.brand.edit', compact('brand'));
    }    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();

        $request->validate([
            'logo' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
            'name' => 'required|max:200|regex:/^[\p{L}\s]+$/u|unique:brands,name,' . $brand->id,
            'status' => 'required|in:active,inactive',
            'is_featured' => 'required|in:yes,no',
        ], [
            'name.unique' => 'El nombre ya está en uso. Por favor, elige otro.',
        ]);

        // Manejo de la imagen
        if ($request->hasFile('logo')) {
            // Eliminar la imagen anterior si existe
            if ($brand->logo && Storage::exists('logo/' . $brand->logo)) {
                Storage::delete('logo/' . $brand->logo);
            }

            // Almacenar la nueva imagen
            $path = $request->file('logo')->store('logo');
            $brand_image = str_replace('logo/', '', $path);
            $brand->logo = $brand_image;
        } else {
            // Mantener la imagen actual si no se envió una nueva
            $brand_image = $brand->logo;
        }

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->status = $request->status;
        $brand->is_featured = $request->is_featured;
        $brand->save();

        return redirect()->route('admin.brand.index')->with('success', 'Marca actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        try {
            $brand = Brand::where('slug', $slug)->firstOrFail();
            
            // Eliminar la imagen si existe
            if ($brand->logo && Storage::exists('logo/' . $brand->logo)) {
                Storage::delete('logo/' . $brand->logo);
            }

            $brand->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Marca eliminada con éxito.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se pudo eliminar la marca. Inténtalo nuevamente.',
            ], 500);
        }
    }
}
