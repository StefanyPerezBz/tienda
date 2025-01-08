<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVendorProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Vendor::where('user_id', Auth::user()->id)->first();
        return view('admin.vendor-profile.index', compact('profile'));
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
        $request->validate([
            'banner' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
            'shop_name' => 'required|regex:/^[\p{L}\s]+$/u|string|max:200|unique:vendors,shop_name',
            'phone' => 'required|numeric|regex:/^\+?[1-9]\d{1,14}$/|unique:vendors,phone',
            'email' => 'required|email|max:200',
            'address' => 'required|regex:/^[\p{L}\d\s.#áéíóúÁÉÍÓÚñÑ]+$/u|string|max:255',
            'fb_link' => 'nullable|url|regex:/^https?:\/\/[^\s]+$/',
            'tw_link' => 'nullable|url|regex:/^https?:\/\/[^\s]+$/',
            'insta_link' => 'nullable|url|regex:/^https?:\/\/[^\s]+$/',
        ]);

        $vendor = new Vendor();

        $vendor = Vendor::where('user_id', Auth::user()->id)->first();

        // Manejo de la imagen
        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('bannerVendor');
            $banner_image = str_replace('bannerVendor/', '', $path);
            $vendor->banner = $banner_image;
        }

        $vendor->phone = $request->phone;
        $vendor->shop_name = $request->shop_name;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->description = $request->description;
        $vendor->fb_link = $request->fb_link;
        $vendor->tw_link = $request->tw_link;
        $vendor->insta_link = $request->insta_link;
        $vendor->save();

        toastr('¡Vendedor actualizado correctamente!', 'success');

        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
