<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Traits\UploadImagesTrait;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    use UploadImagesTrait;

    private $product;
    private $category;

    public function __construct(Product $product, ProductCategory $category) {
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->get();

        return view('pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->get();

        return view('pages.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request->validated();

        $filePath = $this->uploadImage($request);

        $this->product->create([
            'title' => $request->title,
            'image' => $filePath,
            'price' => $request->price,
            'preview_desc' => $request->preview_desc,
            'body' => $request->body,
            'category_id' => $request->category_id
        ]);

        Session::flash('success', 'Product has been created!');

        return redirect(route('admin.products.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->find($id);
        $categories = $this->category->get();

        return view('pages.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $request->validated();

        $category = $this->product->find($id);
        $image = $request->image ? $this->uploadImage($request) : $category->image;

        $category->update([
            'title' => $request->title,
            'image' => $image,
            'price' => $request->price,
            'preview_desc' => $request->preview_desc,
            'body' => $request->body,
            'category_id' => $request->category_id
        ]);

        Session::flash('success', 'Product has been updated!');

        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->product->destroy($id);

        return response()->json([
            'status' => true
        ]);
    }
}
