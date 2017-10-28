<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Repositories\Eloquent\ProductRepository;

class ProductController extends Controller
{
    protected $productRepo;

    function __construct(ProductRepository $productRepo)
    {
        $this->middleware('auth');
        $this->productRepo = $productRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->q;
        $condition = $request->condition;
        $category = $request->category;
        $status = $request->status;
        $price = $request->price;
        $negotiable = $request->negotiable;
        $discount = $request->discount;
        $home_delivery = $request->home_delivery;
        $featured = $request->featured;
        $sort = $request->sort;

        $products = $this->productRepo->fetchAll()->paginate(20);

        return view('admin.products.index', compact('products', 'q', 'condition', 'category', 'status', 'price', 'negotiable', 'discount', 'home_delivery', 'featured', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $product = $this->productRepo->store($request);

        return back()->withStatus('Product created');
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
    public function edit($slug)
    {
        $product = $this->productRepo->requiredBySlug($slug);

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = $this->productRepo->requiredById($id);

        $product = $this->productRepo->renew($product, $request);

        return redirect()->route('admin.products.index')->withStatus('Product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productRepo->requiredById($id)->delete();

        return back()->withStatus('Product successfully deleted');
    }
}
