<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\{Str, Facades\DB, Facades\File};
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(3);
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:categories,name|max:255',
            'image' => 'required|mimes:jpg, jpeg, bmp, png, giv, svg|max:10240'
        ];

        $messages = [
            'name.required' => 'Field name cannot be empty',
            'name.unique' => 'Field name already used',
            'name.max' => 'Name must be a maximum of 255 characters',
            'image.required' => 'Field image cannot be empty',
            'image.mimes' => 'image must be in .jpg, .jpeg, .png, .bmp, .giv, .svg formats',
            'image.max' => 'image must be a maximum size of 10 MB ',
        ];

        $this->validate($request, $rules, $messages);

        $imageName = null;

        if ($request->file('image')) {
            $imageNameBody = uniqid();
            $imageName = substr(md5($imageNameBody), 6, 6) . '_' . time() . '.' . $request->image->extension();
        }

        DB::beginTransaction();
        try {
            $createCategory = Category::create([
                'name' => Str::title($request->name),
                'slug' => Str::slug($request->name),
                'seen_in_all_category' => $request->seenInAllCategory == true ? 1 : 0,
                'seen_in_popular_categories' => $request->seenInPopularCategories == true ? 1 : 0,
                'image' => $imageName
            ]);

            if ($createCategory) {
                $rules['image'] = $request->file('image')
                    ->storeAs('category-images', $imageName);
            }

            return redirect()
                ->route('categories.index')
                ->with('success', 'New category has been added');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->route('categories.index')
                ->with('failed', 'Failed to add new product');
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'image' => 'mimes:jpg, jpeg, bmp, png, giv, svg|max:10240'
        ];

        if ($request->name != $category->name) {
            $rules['name'] = 'required|max:255|unique:categories,name';
        }

        $messages = [
            'name.required' => 'Field category name cannot be empty',
            'name.unique' => 'Field name already used',
            'name.max' => 'Name must be a maximum of 255 characters',
            'image.mimes' => 'image must be in .jpg, .jpeg, .png, .bmp, .giv, .svg formats',
            'image.max' => 'image must be a maximum size of 10 MB ',
        ];

        $this->validate($request, $rules, $messages);

        $imageName = $category->image;

        if ($request->file('image')) {
            $imageNameBody = uniqid();
            $imageName = substr(md5($imageNameBody), 6, 6) . '_' . time() . '.' . $request->image->extension();
        }

        DB::beginTransaction();
        try {
            $changeCategory = Category::where('id', $category->id)->update([
                'name' => Str::title($request->name),
                'slug' => Str::slug($request->name),
                'seen_in_all_category' => $request->seenInAllCategory == true ? 1 : 0,
                'seen_in_popular_categories' => $request->seenInPopularCategories == true ? 1 : 0,
                'image' => $imageName
            ]);

            if ($changeCategory && $request->file('image')) {
                if (File::exists('storage/category-images/' . $category->image)) {
                    File::delete('storage/category-images/' . $category->image);
                }

                $rules['image'] = $request->file('image')
                    ->storeAs('category-images', $imageName);
            }

            return redirect()
                ->route('categories.index')
                ->with('success', 'Category has been updated');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->route('categories.index')
                ->with('failed', 'Failed to change category.');
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $infoCategory = Category::findOrFail($category->id);

        DB::beginTransaction();
        try {
            if ($infoCategory) {
                if (File::exists('storage/category-images/' . $category->image)) {
                    File::delete('storage/category-images/' . $category->image);
                }

                $infoCategory->delete();

                return redirect()
                    ->route('categories.index')
                    ->with('success', 'Category has been deleted');
            }
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->route('categories.index')
                ->with('failed', 'Failed to delete category');
        } finally {
            DB::commit();
        }
    }
}
