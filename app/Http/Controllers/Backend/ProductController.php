<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::with('subcategories.childCategories')
        ->where('status', 'active')
        ->get();
        $brands = Brand::all();

        return view('admin.products.create', compact('categories', 'brands'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200|regex:/^[\p{L}\s]+$/u|unique:products,name',
            'thumb_image' => 'required|image|mimes:jpeg,png,jpg|max:3000',
            'category' => 'required|exists:categories,id',
            'sub_category' => 'required|exists:sub_categories,id',
            'child_category' => 'required|exists:child_categories,id',
            'brand' => 'required|exists:brands,id',
            'qty' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'short_description' => 'required',
            'long_description' => 'required',
            'video_link' => 'nullable|url|regex:/^https?:\/\/[^\s]+$/',
            'sku' => 'nullable',
            'price' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'offer_price' => 'nullable|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'offer_start_date' => 'nullable|date|before:offer_end_date',
            'offer_end_date' => 'nullable|date|after:offer_start_date',
            'product_type' => 'nullable',
            'is_top' => 'required|in:Si,No',
            'is_best' => 'required|in:Si,No',
            'is_featured' => 'required|in:Si,No',
            'status' => 'required|in:active,inactive',
            'is_approved' => 'required|in:active,inactive',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
        ]);

        $product = new Product();

        // Manejo de la imagen
        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('banner');
            $product_image = str_replace('banner/', '', $path);
            $product->banner = $product_image;
        }


        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_top = $request->is_top;
        $product->is_best = $request->is_best;
        $product->is_featured = $request->is_featured;
        $product->status = $request->status;
        $product->seo_title = $request->seo_title;
        $product->is_approved = $request->is_approved;
        $product->seo_description = $request->seo_description;
        $product->save();
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
        $product = Product::findOrFail($id);
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'subCategories', 'childCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|max:200|regex:/^[\p{L}\s]+$/u|unique:products,name,' . $product->id,
            'thumb_image' => 'required|image|mimes:jpeg,png,jpg|max:3000',
            'category' => 'required|exists:categories,id',
            'sub_category' => 'required|exists:sub_categories,id',
            'child_category' => 'required|exists:child_categories,id',
            'brand' => 'required|exists:brands,id',
            'qty' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'short_description' => 'required',
            'long_description' => 'required',
            'video_link' => 'nullable|url|regex:/^https?:\/\/[^\s]+$/',
            'sku' => 'nullable',
            'price' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'offer_price' => 'nullable|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'offer_start_date' => 'nullable|date|before:offer_end_date',
            'offer_end_date' => 'nullable|date|after:offer_start_date',
            'product_type' => 'nullable',
            'status' => 'required|in:active,inactive',
            'is_top' => 'required|in:Si,No',
            'is_best' => 'required|in:Si,No',
            'is_featured' => 'required|in:Si,No',
            'status' => 'required|in:active,inactive',
            'is_approved' => 'required|in:active,inactive',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
        ]);

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_top = $request->is_top;
        $product->is_best = $request->is_best;
        $product->is_featured = $request->is_featured;
        $product->status = $request->status;
        $product->seo_title = $request->seo_title;
        $product->is_approved = $request->is_approved;
        $product->seo_description = $request->seo_description;
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
