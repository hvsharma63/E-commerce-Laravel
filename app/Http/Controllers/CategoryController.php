<?php

namespace App\Http\Controllers;

use File;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Category::all()->whereIn('status', ['Y', 'N']);

        return view('layouts.category.admin.index')->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('layouts.category.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['alpha_dash', 'unique:categories', 'required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png'],
        ]);

        if ($validator->fails()) {
            return redirect('admin/categories/create')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('image')) {
            $img = $request->image;
            $name = 'category' . '.' . $img->getClientOriginalExtension();
            $category = Category::create($request->all());
            $category->image = $name;
            $category->save();
            $catid = $category->id;
            if (!File::exists(base_path('resources\assets\images\categories\\' . $catid . '\\'))) {
                File::makeDirectory(base_path('resources\assets\images\categories\\' . $catid . '\\'), 0775, true);
            }
            $path = base_path('resources\assets\images\categories\\' . $catid . '\\');
            $img->move($path, $name);
        }
        session()->put('success', 'Category created successfully.');
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::find($id);
        return view('layouts.category.admin.update')->with('Category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // dd($id);
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            // 'name' => [
            //     'required', 'alpha_dash', 'string', 'max:255',
            //     function ($attribute, $value, $fail) {
            //         $n = Category::where('name', $value)->count();
            //         if ($n > 1) {
            //             $fail($attribute . ' already exists');
            //         }
            //     }, 'bail', ' unique:categories',
            // ],
            'name' => [
                'required', 'alpha_dash', 'string', 'max:255',
            ],

            // 'image' => ['required', 'image', 'mimes:jpeg,png'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $category = Category::find($id);

        if ($request->hasFile('image')) {
            $catid = $category->id;
            File::delete(base_path('resources\assets\images\categories\\' . $catid . '\\' . $category->photo));
            $img = $request->image;
            $name = 'category' . '.' . $img->getClientOriginalExtension();
            // dd($request->image->getClientOriginalName());
            $category->image = $name;
            $category->save();
            // dd($category);
            $catid = $category->id;
            if (!File::exists(base_path('resources\assets\images\categories\\' . $catid . '\\'))) {
                // path does not exist
                File::makeDirectory(base_path('resources\assets\images\categories\\' . $catid . '\\'), 0775, true);
            }
            $path = base_path('resources\assets\images\categories\\' . $catid . '\\');
            $img->move($path, $name);
        }
        if ($request->name) {
            $category->name = $request->name;
        }
        $category->save();
        session()->put('success', 'Category updated!');
        return redirect(route('categories.index'));
    }

    public function changeStatus(Request $request)
    {
        $category = Category::find($request->id);
        // dd(Product::where('categoryId', $request->id)->first()->status);

        if ((Product::where('categoryId', '=', $request->id))->exists()) {
            return ['data' => false, 'message' => 'You cannot change ths status of the category, as it is in use.'];
        } else {
            if ($category->status == 'N') {
                $category->status = 'Y';
            } else {
                $category->status = 'N';
            }
        }
        $category->save();
        return ['data' => true, 'message' => 'Category Status Changed'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // print_r($request->all());
        // die;
        $category = Category::find($request->id);
        if ($category->status == 'N') {
            $category->status = 'T';
        } else {
            return ['data' => false, 'message' => 'Category cannot be deleted'];
        }
        $category->save();
        return ['data' => true, 'message' => 'Category deleted successfully'];
    }

    public function checkCategoryName(Request $request)
    {
        // print_r($request->all());
        // die;
        if (Category::where('name', $request->name)->exists()) {
            return ['data' => false, 'message' => 'This Category already exists'];
        } else {
            return ['data' => true];
        }
    }

    // Front-side or User-side Methods
}
