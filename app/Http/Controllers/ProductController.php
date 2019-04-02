<?php

namespace App\Http\Controllers;

use DB;
use File;
use App\Color;
use App\Product;
use App\Category;
use App\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $data = Product::join('categories', 'products.categoryId', '=', 'categories.id')
            ->join('colors', 'products.colorId', '=', 'colors.id')
            ->select('products.*', 'categories.name as category', 'colors.colorName')
            ->get()->whereNotIn('status', ['T']);
        // dd($data);
        // $data = Product::all()->whereIn('status', ['Y', 'N']);
        return view('layouts.product.admin.index')->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $colors = Color::all()->where('status', 'Y');
        $categories = Category::all()->where('status', 'Y');
        // dd($categories);
        return view('layouts.product.admin.create', compact('colors', 'categories'));
    }

    protected function checkCategoryId($id)
    {
        $category = Category::find($id);
        if ($category->status == 'Y') {
            // dd($category->status);
            return true;
        } else {
            return false;
        }
    }

    public function changeStatus(Request $request)
    {
        // print_r($request->all());
        // die;
        $product = Product::find($request->id);
        if ($product->status == 'N') {
            $product->status = 'Y';
        } else {
            $product->status = 'N';
        }
        $product->save();
        return ['data' => true, 'message' => 'Product Status Changed Successfully'];
    }

    public static function getCategoryName($catid)
    {
        $category = Category::find($catid);
        return $category->name;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
        // dd($request->all());
        $request->validate([
            'thumbnail' => 'required|image',
            'name' => 'required|string',
            'ram' => 'required|string|alpha_dash',
            'colorId' => 'required',
            'battery' => 'required|string|alpha_dash',
            'processor' => 'required|string',
            'price' => 'required',
            'stock' => 'required|numeric',
            'upc' => 'required',
        ]);

        if ($this->checkCategoryId($request->categoryId) == false) {
            return redirect('/product/admin/create')->withInput()->withErrors(array('message' => 'Only Select the Category which is Active '));
        }

        if ($request->hasFile('thumbnail')) {

            $img = $request->thumbnail;
            $product = Product::create($request->all());
            $name = $product->upc . '_thumbnail.' . $img->getClientOriginalExtension();
            $product->thumbnail = $name;
            $product->save();
            $product_id = $product->id;
            if (!File::exists(base_path('resources\assets\images\products\\' . $product_id . '\\'))) {
                File::makeDirectory(base_path('resources\assets\images\products\\' . $product_id . '\\'), 0775, true);
            }
            $path = base_path('resources\assets\images\products\\' . $product_id . '\\');
            $img->move($path, $name);
        }
        if ($this->storeMultipleImages($product->id, $product->upc, $request->multiple_images, $request->sort) == true) {
            return redirect(route('products.index'));
        }

        // dd($product->categoryId);
    }

    public function storeMultipleImages($id, $upc, $multiple_images, $sort)
    {
        // dd($id, $multiple_images, $sort);
        if (!File::exists(base_path('resources\assets\images\products\\' . $id . '\\'))) {
            File::makeDirectory(base_path('resources\assets\images\products\\' . $id . '\\'), 0775, true);
        }
        $path = base_path('resources\assets\images\products\\' . $id . '\\');
        $i = 0;
        for ($i = 0, $count = count($multiple_images); $i < $count; $i++) {
            $current_image = $multiple_images[$i];
            $current_sort = $sort[$i];
            $name = $upc . '_' . $sort[$i] . '.' . $current_image->getClientOriginalExtension();
            $current_image->move($path, $name);
            ProductImages::create(
                ['productId' => $id, 'image' => $name, 'sort' => $current_sort]
            );
        }
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = Category::all()->whereIn('status', ['Y', 'N']);
        // dd($categories);
        $colors = Color::all()->whereIn('status', 'Y');
        $product = Product::find($id);
        $productImages = ProductImages::where('productId', '=', $id)->get();
        foreach ($productImages as $productImage) {
            $productImage->delete_status = 1;
            $productImage->save();
        }
        // dd($productImages);
        // return $productImages;
        return view('layouts.product.admin.update', compact('categories', 'colors', 'product', 'productImages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $c = $request->all();
        // if ($c['multiple_images'][0]) {
        //     dd($c['multiple_images'][0]);
        // }

        // dd($request->all());

        // base_path('resources\assets\images\products\\' . $product_id . ' \\' . $request->multiple_images[0])
        // $content = File::get(base_path('resources\assets\images\products\\' . $id . ' \\' . $request->multiple_images[0]));
        // dd($content);
        // $new_image = file_get_contents(base_path('resources\assets\images\products\\' . $id . '\\' . $request->multiple_images[0]));
        // $name = $new_image . '.png';
        // $path = base_path(' resources\assets\images\products\updated\\' . $id . '\\');
        // $this->move($path, $name);
        // dd($new_image . '.png');
        // Storage::move(base_path('resources\assets\images\products\\' . $id . '\\' . $request->multiple_images[0]), base_path('resources\assets\images\products\updated\\' . $id . '\\' . 'new'));
        // dd('55');

        $product = Product::find($id);

        if ($request->hasFile('thumbnail')) {
            $product_id = $product->id;
            $img = $request->thumbnail;
            File::delete(base_path('resources\assets\images\products\\' . $product_id . ' \\' . $product->thumbnail));
            $name = 'product_thumbnail' . ' . ' . $img->getClientOriginalExtension();
            $product->thumbnail = $name;
            $product->save();
            // dd($product);
            if (!File::exists(base_path('resources\assets\images\products\thumbnails \\' . $product_id . ' \\'))) {
                // path does not exist
                File::makeDirectory(base_path(' resources\assets\images\products\thumbnails \\' . $product_id . ' \\'), 0775, true);
            }
            $path = base_path(' resources\assets\images\products\thumbnails \\' . $product_id . ' \\');
            $img->move($path, $name);
        }
        $product->fill($request->all());
        $product->save();
        if ($this->updateMultipleImages(
            $request->piId,
            $product->id,
            $request->upc,
            $request->multiple_images,
            $request->sort,
            $request->new_multiple_images,
            $request->new_sort
        ) == true) {
            return redirect(route('products.index'));
        }
        return redirect(route('products.index'));
    }

    public function updateMultipleImages($piId, $id, $upc, $multiple_images, $sort, $new_multiple_images, $new_sort)
    {

        // if ((sizeof($piId) == sizeof($sort) ? (sizeof($piId) < sizeof($multiple_images)) : false) != false) {
        //     for ($j = 0; $j < sizeof($sort); $j++) {
        //         $productImage = ProductImages::where(['id' => $id, 'sort' => $sort[$j]])->get();
        //         // dd($productImage[0]->image);
        //         dd($productImage[0]->image);
        //         if ($productImage->image != $multiple_images[$j] || $productImage->sort != $sort[$j]) {
        //             if (File::exists(base_path('resources\assets\images\products\\' . $id . '\\' . $productImage->image))) {
        //                 File::delete(base_path('resources\assets\images\products\\' . $id . '\\' . $productImage->image));
        //             }
        //             $productImage->delete();
        //         }
        //     }
        // }
        $PImages = ProductImages::find($id)->where('delete_status', 0)->get();
        // dd($PImages);
        for ($d = 0; $d < count($PImages); $d++) {
            // dd($PImages[$d]->exists);
            if ($PImages[$d]->exists()) {
                if (File::exists(base_path('resources\assets\images\products\\' . $id . '\\' . $PImages[$d]->image))) {
                    File::delete(base_path('resources\assets\images\products\\' . $id . '\\' . $PImages[$d]->image));
                }
                if (($key = array_search($PImages[$d]->image, $multiple_images)) !== false) {
                    unset($multiple_images[$key]);
                }
                $PImages[$d]->delete();
            }
        }

        if ($new_multiple_images != null) {
            $filtered_multiple_images = array_filter($new_multiple_images);
            for ($i = 0; $i < count($filtered_multiple_images); $i++) {

                if (is_object($filtered_multiple_images[$i])) {
                    $name = $upc . '_' . $new_sort[$i] . '.' . $filtered_multiple_images[$i]->getClientOriginalExtension();
                    $path = base_path('resources\assets\images\products\\' . $id . '\\');
                    $filtered_multiple_images[$i]->move($path, $name);
                    ProductImages::create(
                        ['productId' => $id, 'image' => $name, 'sort' => $new_sort[$i]]
                    );
                } else {
                    $productImage = ProductImages::find($piId[$i]);
                    if ($productImage->image != $filtered_multiple_images[$i] || $productImage->sort != $new_sort[$i]) {
                        $ext = explode('.', $filtered_multiple_images[$i]);
                        $name = $upc . '_' . $new_sort[$i] . '.' . $ext[1];
                        $oldPath = base_path('resources\assets\images\products\\' . $id . '\\' . $filtered_multiple_images[$i]);
                        $newPath = base_path('resources\assets\images\products\\' . $id . '\\' . $name);
                        rename($oldPath, $newPath);
                        $productImage->image = $name;
                        $productImage->sort = $new_sort[$i];
                        $productImage->save();
                    }
                }
            }
        }
        // dd($piId, $id, $upc, $multiple_images, $sort, $filtered_array, $new_sort);
        // dd(array_filter($multiple_images));
        // dd($piId);
        // if (is_object($multiple_images[0])) {
        //     dd($multiple_images[0]);
        //     // return 'TRYE';
        // }
        // $stored = Storage::get(base_path('resources\assets\images\products\\' . $id . '\\' . ProductImages::find($piId[0])->image));
        // $ext = explode('.', $multiple_old_images_names[0]);
        // dd($piId, $id, $upc, $multiple_images, $sort);

        //  else {
        //     dd(gettype($multiple_images[0]));
        // }

        // dd((sizeof($piId) == sizeof($sort) ? (sizeof($piId) < sizeof($multiple_images)) : false));

        // else {
        //     dd('NNNNN');
        // }
        for ($i = 0; $i < count($piId); $i++) {
            if (is_object($multiple_images[$i])) {
                $productImage = ProductImages::find($piId[$i]);
                if ($productImage->exists()) {
                    if (File::exists(base_path('resources\assets\images\products\\' . $id . '\\' . $productImage->image))) {
                        File::delete(base_path('resources\assets\images\products\\' . $id . '\\' . $productImage->image));
                    }
                }
                $name = $upc . '_' . $sort[$i] . '.' . $multiple_images[$i]->getClientOriginalExtension();
                $path = base_path('resources\assets\images\products\\' . $id . '\\');
                $multiple_images[$i]->move($path, $name);
                // ProductImages::create(
                //     ['productId' => $id, 'image' => $name, 'sort' => $sort[$i]]
                // );
                $productImage->productId = $id;
                $productImage->image = $name;
                $productImage->sort = $sort[$i];
                $productImage->save();
            } else {
                $productImage = ProductImages::find($piId[$i]);

                if ($productImage->image != $multiple_images[$i] || $productImage->sort != $sort[$i]) {
                    $ext = explode('.', $multiple_images[$i]);
                    $name = $upc . '_' . $sort[$i] . '.' . $ext[1];
                    $oldPath = base_path('resources\assets\images\products\\' . $id . '\\' . $multiple_images[$i]);
                    $newPath = base_path('resources\assets\images\products\\' . $id . '\\' . $name);
                    rename($oldPath, $newPath);
                    $productImage->productId = $id;
                    $productImage->image = $name;
                    $productImage->sort = $sort[$i];
                    $productImage->save();
                }
            }
        }
        //     // if (\is_array($multiple_images[$i])) {
        //     //     if (File::exists(base_path('resources\assets\images\products\\' . $id . '\\' . $productImage->image))) {
        //     //         File::delete(base_path('resources\assets\images\products\\' . $id . '\\' . $productImage->image));
        //     //     }
        //     //     $name = $upc . '_' . $sort[$i] . '.' . $multiple_images[$i]->getClientOriginalExtension();
        //     //     $path = base_path('resources\assets\images\products\\' . $id . '\\');
        //     //     $multiple_images[$i]->move($path, $name);
        //     //     ProductImages::updateOrCreate(
        //     //         ['id' => $piId[$i]],
        //     //         ['productId' => $id, 'image' => $name, 'sort' => $sort[$i]]
        //     //     );
        //     // } else { //$productImage->image != $multiple_images[$i]
        //     //     $ext = explode('.', $multiple_images[$i]);
        //     //     $name = $upc . '_' . $sort[$i] . '.' . $ext[1];
        //     //     $oldPath = base_path('resources\assets\images\products\\' . $id . '\\' . $multiple_images[$i]);
        //     //     $newPath = base_path('resources\assets\images\products\\' . $id . '\\' . $name);
        //     //     rename($oldPath, $newPath);
        //     //     $productImage->image = $name;
        //     //     $productImage->sort = $sort[$i];
        //     //     $productImage->save();
        //     // }

        //     // if ($productImage->image != $multiple_images[$i] || $productImage->sort != $sort[$i]) {
        //     //     $ext = explode('.', $multiple_images[$i]);
        //     //     $name = $upc . '_' . $sort[$i] . '.' . $ext[1];
        //     //     $oldPath = base_path('resources\assets\images\products\\' . $id . '\\' . $multiple_images[$i]);
        //     //     $newPath = base_path('resources\assets\images\products\\' . $id . '\\' . $name);
        //     //     rename($oldPath, $newPath);
        //     //     $productImage->image = $name;
        //     //     $productImage->sort = $sort[$i];
        //     //     $productImage->save();
        //     // }

        //     // if ($productImage->image != $multiple_images[$i] && $multiple_images[$i] != null) {

        //     //     if (File::exists(base_path('resources\assets\images\products\\' . $id . '\\' . $productImage->image))) {
        //     //         File::delete(base_path('resources\assets\images\products\\' . $id . '\\' . $productImage->image));
        //     //     }
        //     //     $name = $upc . '_' . $sort[$i] . '.' . $multiple_images[$i]->getClientOriginalExtension();
        //     //     $path = base_path('resources\assets\images\products\\' . $id . '\\');
        //     //     $multiple_images[$i]->move($path, $name);
        //     //     ProductImages::updateOrCreate(
        //     //         ['id' => $piId[$i]],
        //     //         ['productId' => $id, 'image' => $name, 'sort' => $sort[$i]]
        //     //     );
        //     // } else {
        //     //     if ($productImage->sort != $sort[$i]) {
        //     //         $ext = explode('.', $multiple_images[$i]);
        //     //         $name = $upc . '_' . $sort[$i] . '.' . $ext[1];
        //     //         $oldPath = base_path('resources\assets\images\products\\' . $id . '\\' . $multiple_images[$i]);
        //     //         $newPath = base_path('resources\assets\images\products\\' . $id . '\\' . $name);
        //     //         rename($oldPath, $newPath);
        //     //         $productImage->image = $name;
        //     //         $productImage->sort = $sort[$i];
        //     //         $productImage->save();
        //     //     }
        //     // }


        //     // if ($sort[$i] != $productImage->sort) {
        //     //     if (File::exists(base_path('resources\assets\images\products\\' . $id . ' \\' . $productImage->name))) {
        //     //         $ext = explode('.', $productImage->name);
        //     //         $productImage->name = $upc . '_' . $sort[$i] . '.' . $ext[1];
        //     //     }
        //     // }
        // }
        // dd(File::exists(base_path('resources\assets\images\products\\' . $id . '\\' . $multiple_images[0]->getClientOriginalName())));
        // dd($multiple_images[0]->getClientOriginalName());
        // for ($i = 0, $count = count($piId); $i < $count; $i++) {
        //     $current_image_id = $piId[$i];
        //     $current_sort = $sort[$i];
        //     $current_image = $multiple_images[$i];
        //     $old_image_name = $multiple_old_images_names[$i];
        //     if ($multiple_images != null) {

        //         // if ($current_image->getClientOriginalName() != $old_image_name) {
        //         // }
        //         if (in_array($current_image->getClientOriginalName(), $multiple_old_images_names) == false) {
        //             dd('true');
        //             if (File::exists(base_path('resources\assets\images\products\\' . $id . '\\' . $old_image_name))) {
        //                 File::delete(base_path('resources\assets\images\products\\' . $id . '\\' . $old_image_name));
        //                 $name = $upc . '_' . $current_sort . '.' . $current_image->getClientOriginalExtension();
        //                 $current_image->move($path, $name);
        //                 ProductImages::where('id', $current_image_id)
        //                     ->where('destination', 'San Diego')
        //                     ->update(['delayed' => 1]);
        //                 ProductImages::create(
        //                     ['productId' => $id, 'image' => $name, 'sort' => $current_sort]
        //                 );
        //             }
        //         }
        //     } else {
        //         ProductImages::create(
        //             ['productId' => $id, 'image' => $name, 'sort' => $current_sort]
        //         );
        //     }
        // }

        // foreach ($multiple_images as $single_image) {
        //     DB::table('productImages')->where('productId', $id)->insert(
        //         ['image' => $single_image->getClientOriginalName(), 'updated_at' => Carbon::now()]
        //     );
        // }

        // for ($i = 0, $count = count($piId); $i < $count; $i++) {
        //     $current_image_id = $piId[$i];
        //     $current_sort = $sort[$i];
        //     $current_image = $multiple_images[$i];
        //     $old_image_name = $multiple_old_images_names[$i];
        //     if ($current_image != null) {
        //         File::delete(base_path('resources\assets\images\products\\' . $id . ' \\' . $old_image_name));
        //         $name = $upc . '_' . $current_sort . '.' . $current_image->getClientOriginalExtension();
        //         $path = base_path('resources\assets\images\products\\' . $id . ' \\');
        //         $current_image->move($path, $name);
        //         ProductImages::where('id', $current_image_id)
        //             ->where('productId', $piId[$i])
        //             ->update(['image' => $name, 'sort' => $current_sort]);
        //         // $name = 'product_thumbnail' . ' . ' . $img->getClientOriginalExtension();
        //         // $product->thumbnail = $name;
        //         // $product->save();
        //         // dd($product);
        //         // if (!File::exists(base_path('resources\assets\images\products\thumbnails \\' . $product_id . ' \\'))) {
        //         //     // path does not exist
        //         //     File::makeDirectory(base_path(' resources\assets\images\products\thumbnails \\' . $product_id . ' \\'), 0775, true);
        //         // }
        //         // $path = base_path(' resources\assets\images\products\thumbnails \\' . $product_id . ' \\');
        //         // $img->move($path, $name);
        //         // ProductImages::where('id', $current_image_id)->update(['image' => $name]);
        //     }

        //     ProductImages::where('id', $current_image_id)->update(['sort' => $current_sort]);
        // }

        // }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        if ($product->status == 'N') {
            $product->status = 'T';
        } else {
            return ['data' => false, 'message' => 'Product cannot be deleted'];
        }
        $product->save();
        return ['data' => true, 'message' => 'Product deleted successfully'];
    }

    public function deleteMultipleImage(Request $request)
    {
        $productImage = ProductImages::where('id', $request->id)->first();
        // dd(($productImage->delete_status));

        $productImage->delete_status = 0;
        $productImage->save();
        return 'success';
    }


    // Front-side Methods

    public function showAllProducts(Request $request)
    {
        // dd($request->all());
        $colors = Color::all()->where('status', 'Y');
        // $categories = Category::all(['id', 'name', 'status'])->where('status', 'Y');
        $categories = Category::all()->where('status', 'Y');
        // $products = Product::join('categories', 'products.categoryId', '=', 'categories.id')
        //     ->join('colors', 'products.colorId', '=', 'colors.id')
        //     ->join('productImages', 'products.id', '=', 'productImages.productId')
        //     ->select('products.*', 'categories.name as category', 'colors.colorName', 'productImages.*')
        //     ->get()->whereNotIn('status', ['T']);
        // dd($categories);
        // dd($colors);
        $products = Product::all()->where('status', 'Y');
        // dd($products);

        return view('layouts.product.front.products', compact('categories', 'colors', 'products'));
    }

    public function viewProducts(Request $request)
    {
        // var_dump($request->all());
        // die;
        if ($request->filled(['min_price', 'max_price', 'sortType', 'brandId', 'colorId'])) {
            // dd($request->all());
            $products = Product::whereIn('categoryId', $request->brandId)
                ->whereIn('colorId', $request->colorId)
                ->whereBetween('price', [$request->min_price, $request->max_price])
                ->orderBy($request->sortType, $request->orderType)
                ->get();
            // var_dump($products);
        } elseif ($request->filled(['min_price', 'max_price', 'sortType', 'brandId'])) {
            $products = Product::whereIn('categoryId', $request->brandId)
                ->whereBetween('price', [$request->min_price, $request->max_price])
                ->orderBy($request->sortType, $request->orderType)
                ->get();
        } elseif ($request->filled(['min_price', 'max_price', 'sortType', 'colorId'])) {
            $products = Product::whereIn('colorId', $request->colorId)
                ->whereBetween('price', [$request->min_price, $request->max_price])
                ->orderBy($request->sortType, $request->orderType)
                ->get();
        } elseif ($request->filled(['min_price', 'max_price', 'sortType'])) {
            // dd($request->all());
            $products = Product::whereBetween('price', [$request->min_price, $request->max_price])
                ->orderBy($request->sortType, $request->orderType)
                ->get();
        } else {
            dd('NONE');
        }

        if ($request->type == 'list') {
            return view('layouts.product.front.productsList', compact('products'));
        } else {
            return view('layouts.product.front.productsGrid', compact('products'));
        }
    }

    public function showSingleProduct($id)
    {
        $product = Product::find($id);
        // $product = App\Product::find(1);
        $category = Category::find($product->categoryId);
        // dd($category);
        // $productImages = App\ProductImages::where('productId', 1)->get();
        $productImages = ProductImages::where('productId', $id)->get();
        return view('layouts.product.front.productSingle', compact('product', 'productImages', 'category'));
    }
}
