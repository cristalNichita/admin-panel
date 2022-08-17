<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\ProductCategory;
use App\Traits\UploadImagesTrait;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    use UploadImagesTrait;

    private $productCategory;

    public function __construct(ProductCategory $productCategory) {
        $this->productCategory = $productCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->productCategory->get();

        return view('pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $request->validated();

        $filePath = $this->uploadImage($request);

        $this->productCategory->create([
            'title' => $request->title,
            'image' => $filePath
        ]);

        Session::flash('success', 'Category has been created!');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->productCategory->find($id);

        return view('pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $request->validated();

        $category = $this->productCategory->find($id);
        $image = $request->image ? $this->uploadImage($request) : $category->image;

        $category->update([
            'title' => $request->title,
            'image' => $image
        ]);

        Session::flash('success', 'Category has been updated!');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->productCategory->find($id);
        $category->delete();
        $category->products()->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
