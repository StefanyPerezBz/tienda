<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('ensureCategoryAndSubCategoryExists')->except('index');
    }
    
    public function index(ChildCategoryDataTable $dataTable)
    {
        $hasActiveCategory = Category::where('status', 'active')->exists();
        $hasActiveSubCategory = SubCategory::where('status', 'active')->exists();
        return $dataTable->render('admin.childcategory.index', compact('hasActiveCategory', 'hasActiveSubCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        return view('admin.childcategory.create', compact('categories'));
    }

    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->where('status', 'active')->get();
        return $subCategories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|exists:categories,id',
            'subcategory' => 'required|exists:sub_categories,id',
            'status' => 'required|in:active,inactive',
            'name' => 'required|max:200|unique:child_categories,name',
        ], [
            'name.unique' => 'El nombre ya está en uso. Por favor, elige otro.',
        ]);

        $childCategory = new ChildCategory();

        $childCategory->category_id = $request->category;
        $childCategory->sub_category_id = $request->subcategory;
        $childCategory->name = $request->name;
        $childCategory->slug = Str::slug($request->name);
        $childCategory->status = $request->status;
        $childCategory->save();

        return redirect()->route('admin.childcategory.index')->with('success', 'Sub Subcategoría creada exitosamente.');

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
        $childcategory = ChildCategory::where('slug', $slug)->firstOrFail();
        $subcategories = SubCategory::where('category_id', $childcategory->category_id)
        ->where('status', 'active')
        ->get();
    
        return view('admin.childcategory.edit', compact('categories', 'childcategory', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $childCategory = ChildCategory::where('slug', $slug)->firstOrFail();

        $request->validate([
            'category' => 'required|exists:categories,id',
            'subcategory' => 'required|exists:sub_categories,id',
            'name' => 'required|max:200|unique:child_categories,name,' . $childCategory->id,
            'status' => 'required|in:active,inactive'
        ]);

        $childCategory->category_id = $request->category;
        $childCategory->sub_category_id = $request->subcategory;
        $childCategory->name = $request->name;
        $childCategory->slug = Str::slug($request->name);
        $childCategory->status = $request->status;
        $childCategory->save();

        return redirect()->route('admin.childcategory.index')->with('success', 'Sub Subcategoría creada exitosamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(string $slug)
     {
         $childCategory = ChildCategory::where('slug', $slug)->firstOrFail();
         
    //     if(Product::where('child_category_id', $childCategory->id)->count() > 0){
    //         return response(['status' => 'error', 'message' => 'This item contain relation can\'t delete it.']);
    //     }

    //     $homeSettings = HomePageSetting::all();

    //     foreach($homeSettings as $item){
    //         $array = json_decode($item->value, true);
    //         $collection = collect($array);
    //         if($collection->contains('child_category', $childCategory->id)){
    //             return response(['status' => 'error', 'message' => 'This item contain relation can\'t delete it.']);
    //         }
    //     }

         $childCategory->delete();

         return response(['status' => 'success', 'message' => '¡Sub SubCategoría eliminada!']);
     }
}
