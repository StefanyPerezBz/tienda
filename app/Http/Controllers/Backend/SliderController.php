<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ImageUploadTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => 'required|image|max:2048|mimes:jpg,jpeg,png',
            'type' => 'string|max:200|regex:/^[\p{L}\s]+$/u',
            'title' => 'required|max:200|regex:/^[\p{L}\s]+$/u|unique:sliders,title',
            'starting_price' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'btn_url' => 'url|regex:/^https?:\/\/[^\s]+$/',
            'serial' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive'
        ]);

        $slider = new Slider();

        // Manejo de la imagen
        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('banner');
            $banner_image = str_replace('banner/', '', $path);
            $slider->banner = $banner_image;
        }

        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->starting_price = $request->starting_price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();

        Cache::forget('sliders');

        return redirect()->route('admin.slider.index')->with('success', 'Banner creado exitosamente.');
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
    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'banner' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
            'type' => 'string|max:200|regex:/^[\p{L}\s]+$/u',
            'title' => 'required|max:200|regex:/^[\p{L}\s]+$/u|unique:sliders,title,' . $slider->id, 
            'starting_price' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'btn_url' => 'url|regex:/^https?:\/\/[^\s]+$/',
            'serial' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive'
        ]);

        // Manejo de la imagen
        if ($request->hasFile('banner')) {
            // Eliminar la imagen anterior si existe
            if ($slider->banner && Storage::exists('banner/' . $slider->banner)) {
                Storage::delete('banner/' . $slider->banner);
            }

            // Almacenar la nueva imagen
            $path = $request->file('banner')->store('banner');
            $banner_image = str_replace('banner/', '', $path);
            $slider->banner = $banner_image;
        } else {
            // Mantener la imagen actual si no se envió una nueva
            $banner_image = $slider->banner;
        }

        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->starting_price = $request->starting_price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();

        Cache::forget('sliders');

        return redirect()->route('admin.slider.index')->with('success', 'Banner actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $slider = Slider::findOrFail($id);
    
            if (File::exists(public_path($slider->banner))) {
                File::delete(public_path($slider->banner));
            }
    
            $slider->delete();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Slider eliminado con éxito.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se pudo eliminar el slider. Inténtalo nuevamente.'
            ], 500);
        }
    }
    
}
