<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('ensureCategoryExists')->except('index');
    }
    
    public function index(SubCategoryDataTable $dataTable)
    {
        $hasActiveCategory = Category::where('status', 'active')->exists();
        return $dataTable->render('admin.subcategory.index', compact('hasActiveCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        return view('admin.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|exists:categories,id',
            'name' => 'required|max:200|unique:sub_categories,name',
            'status' => 'required|in:active,inactive'
        ]);

        $subCategory = new SubCategory();

        $subCategory->category_id = $request->category;
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->status = $request->status;
        $subCategory->save();

        return redirect()->route('admin.subcategory.index')->with('success', 'Subcategoría creada exitosamente.');
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
        $categories = Category::where('status', 'active')->get();

        $subcategory = SubCategory::where('slug', $slug)->firstOrFail();
        
        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $subCategory = SubCategory::where('slug', $slug)->firstOrFail();

        $request->validate([
            'category' => 'required|exists:categories,id',
            'name' => 'required|max:200|unique:sub_categories,name,' . $subCategory->id,
            'status' => 'required|in:active,inactive'
        ]);

        $subCategory->category_id = $request->category;
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->status = $request->status;
        $subCategory->save();

        return redirect()->route('admin.subcategory.index')->with('success', 'Subcategoría actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $subcategory = SubCategory::where('slug', $slug)->firstOrFail();

        $childCategory = ChildCategory::where('sub_category_id', $subcategory->id)->count();

        if ($childCategory > 0) {
            return response(['status' => 'error', 'message' => 'Estos elementos contienen subelementos para eliminarlos. ¡Primero debe eliminar los subelementos!']);
        }
        
        $subcategory->delete();

        return response(['status' => 'success', 'message' => '¡Subcategoría eliminada!']);
    }
}
