<?php

namespace App\Http\Controllers;

use App\Models\{Product, Category};
use Illuminate\Support\{Str, Facades\DB, Facades\File};
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(3);
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.products.create', compact('categories'));
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
            'category' => 'required',
            'name' => 'required|unique:products,name|max:255',
            'originalPrice' => 'required',
            'sellingPrice' => 'required',
            'quantity' => 'required',
            'tax' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,bmp,png,giv,svg|max:10240'
        ];

        $messages = [
            'category.required' => "Field category can't be empty",
            'name.required' => "Field name can't be empty",
            'name.unique' => 'Field name already used',
            'name.max' => 'Name must be a maximum of 255 characters',
            'originalPrice.required' => "Field original price can't be empty",
            'sellingPrice.required' => "Field selling price can't be empty",
            'quantity.required' => "Field quantity can't be empty",
            'tax.required' => "Field tax can't be empty",
            'description.required' => "Field description can't be empty",
            'image.required' => "Field image can't be empty",
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
            $createProduct = Product::create([
                'name' => Str::title($request->name),
                'slug' => Str::slug($request->name),
                'original_price' => $request->originalPrice,
                'selling_price' => $request->sellingPrice,
                'quantity' => $request->quantity,
                'tax' => $request->tax,
                'image' => $imageName,
                'description' => $request->description,
                'seen_in_all_product' => $request->seenInAllProduct == true ? 1 : 0,
                'seen_in_trending_products' => $request->seenInTrendingProducts == true ? 1 : 0,
                'category_id' => $request->category
            ]);

            if ($createProduct) {
                $rules['image'] = $request->file('image')
                    ->storeAs('product-images', $imageName);
            }

            return redirect()
                ->route('products.index')
                ->with('success', 'Product has been added');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('products.index')
                ->with('failed', 'Failed to add new product');
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('backend.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'category' => 'required',
            'originalPrice' => 'required',
            'sellingPrice' => 'required',
            'quantity' => 'required',
            'tax' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpg, jpeg, bmp, png, giv, svg|max:10240'
        ];

        if ($request->name != $product->name) {
            $rules['name'] = 'required|unique:products,name|max:255';
        }

        $messages = [
            'category.required' => "Field category can't be empty",
            'name.required' => "Field name can't be empty",
            'name.unique' => 'Field name already used',
            'name.max' => 'Name must be a maximum of 255 characters',
            'originalPrice.required' => "Field original price can't be empty",
            'sellingPrice.required' => "Field selling price can't be empty",
            'quantity.required' => "Field quantity can't be empty",
            'tax.required' => "Field tax can't be empty",
            'description.required' => "Field description can't be empty",
            'image.mimes' => 'image must be in .jpg, .jpeg, .png, .bmp, .giv, .svg formats',
            'image.max' => 'image must be a maximum size of 10 MB ',
        ];

        $this->validate($request, $rules, $messages);

        $imageName = $product->image;

        if ($request->file('image')) {
            $imageNameBody = uniqid();
            $imageName = substr(md5($imageNameBody), 6, 6) . '_' . time() . '.' . $request->image->extension();
        }

        DB::beginTransaction();
        try {
            $changeProduct = Product::where('id', $product->id)->update([
                'name' => Str::title($request->name),
                'slug' => Str::slug($request->name),
                'original_price' => $request->originalPrice,
                'selling_price' => $request->sellingPrice,
                'quantity' => $request->quantity,
                'tax' => $request->tax,
                'image' => $imageName,
                'description' => $request->description,
                'seen_in_all_product' => $request->seenInAllProduct == true ? 1 : 0,
                'seen_in_trending_products' => $request->seenInTrendingProducts == true ? 1 : 0,
                'category_id' => $request->category
            ]);

            if ($changeProduct && $request->file('image')) {
                if (File::exists('storage/product-images/' . $product->image)) {
                    File::delete('storage/product-images/' . $product->image);
                }

                $rules['image'] = $request->file('image')
                    ->storeAs('product-images', $imageName);
            }

            return redirect()
                ->route('products.index')
                ->with('success', 'Product has been updated');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('products.index')
                ->with('failed', 'Failed to change product');
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $infoProduct = Product::findOrFail($product->id);

        DB::beginTransaction();
        try {
            if ($infoProduct) {
                if (File::exists('storage/product-images/' . $product->image)) {
                    File::delete('storage/product-images/' . $product->image);
                }

                $infoProduct->delete();

                return redirect()
                    ->route('products.index')
                    ->with('success', 'Product has been deleted');
            }
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->route('products.index')
                ->with('failed', 'Failed to delete product');
        } finally {
            DB::commit();
        }
    }
}
