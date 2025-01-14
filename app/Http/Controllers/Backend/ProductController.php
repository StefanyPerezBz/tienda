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
use Illuminate\Support\Facades\Storage;
use Exception;


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
        // Obtener todas las categorías sin filtro de estado
        $categories = Category::with(['subcategories' => function ($query) {
            $query->where('status', 'active');
        }, 'subcategories.childCategories' => function ($query) {
            $query->where('status', 'active');
        }])->get();

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
            'short_description' => 'required|max:600',
            'long_description' => 'required',
            'video_link' => 'nullable|url|regex:/^https?:\/\/[^\s]+$/',
            'sku' => 'nullable',
            'price' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'offer_price' => 'nullable|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'offer_start_date' => 'nullable|date|before:offer_end_date',
            'offer_end_date' => 'nullable|date|after:offer_start_date',
            'product_type' => 'nullable|in:nueva_llegada,destacado,producto_top,mejor_producto',
            'is_top' => 'required|in:Si,No',
            'is_best' => 'required|in:Si,No',
            'is_featured' => 'required|in:Si,No',
            'status' => 'required|in:active,inactive',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
        ]);

        $product = new Product();

        // Manejo de la imagen
        if ($request->hasFile('thumb_image')) {
            $path = $request->file('thumb_image')->store('product');
            $product_image = str_replace('product/', '', $path);
            $product->thumb_image = $product_image;
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
        $product->is_approved = 'active';
        $product->seo_description = $request->seo_description;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Producto creado exitosamente.');
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
        $product = Product::where('slug', $slug)->firstOrFail();

        $subcategories = SubCategory::where('status', 'active')->get();
        $childcategories = ChildCategory::where('status', 'active')->get();
        $categories = Category::with(['subcategories' => function ($query) {
            $query->where('status', 'active');
        }, 'subcategories.childCategories' => function ($query) {
            $query->where('status', 'active');
        }])->get();

        $brands = Brand::all();
        
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'subcategories', 'childcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => 'required|max:200|regex:/^[\p{L}\s]+$/u|unique:products,name,' . $product->id,
            'thumb_image' => 'required|image|mimes:jpeg,png,jpg|max:3000',
            'category' => 'required|exists:categories,id',
            'sub_category' => 'required|exists:sub_categories,id',
            'child_category' => 'required|exists:child_categories,id',
            'brand' => 'required|exists:brands,id',
            'qty' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'short_description' => 'required|max:600',
            'long_description' => 'required',
            'video_link' => 'nullable|url|regex:/^https?:\/\/[^\s]+$/',
            'sku' => 'nullable',
            'price' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'offer_price' => 'nullable|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'offer_start_date' => 'nullable|date|before:offer_end_date',
            'offer_end_date' => 'nullable|date|after:offer_start_date',
            'product_type' => 'required|in:nueva_llegada,destacado,producto_top,mejor_producto',
            'status' => 'required|in:active,inactive',
            'is_top' => 'required|in:Si,No',
            'is_best' => 'required|in:Si,No',
            'is_featured' => 'required|in:Si,No',
            'status' => 'required|in:active,inactive',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
        ]);

        // Manejo de la imagen
        if ($request->hasFile('thumb_image')) {
            // Eliminar la imagen anterior si existe
            if ($product->thumb_image && Storage::exists('product/' . $product->thumb_image)) {
                Storage::delete('product/' . $product->thumb_image);
            }

            // Almacenar la nueva imagen
            $path = $request->file('thumb_image')->store('product');
            $product_image = str_replace('product/', '', $path);
            $product->thumb_image = $product_image;
        } else {
            // Mantener la imagen actual si no se envió una nueva
            $product_image = $product->thumb_image;
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
        $product->seo_description = $request->seo_description;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $product = Product::findOrFail($id);

            if ($product->thumb_image && Storage::exists('product/' . $product->thumb_image)) {
                Storage::delete('product/' . $product->thumb_image);
            }

            $product->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Producto eliminado con éxito.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se pudo eliminar el producto. Inténtalo nuevamente.'
            ], 500);
        }
    }
}
