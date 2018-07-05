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
        $is_direct = $request->is_direct;

        $return_status = $request->return_status;

        $products = $this->productRepo->fetchAll()->paginate(20);
// return $products;
        if ($return_status) {
            return view('admin.products.index', compact('products', 'q', 'condition', 'category', 'status', 'price', 'negotiable', 'discount', 'home_delivery', 'featured', 'sort', 'is_direct'))->withStatus($return_status);
        }

        return view('admin.products.index', compact('products', 'q', 'condition', 'category', 'status', 'price', 'negotiable', 'discount', 'home_delivery', 'featured', 'sort', 'is_direct'));
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

        if ($request->ajax()) {
            return $product->id;
        }

        return back()->withStatus('Product created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = $this->productRepo->requiredBySlug($slug)->load('images');

        return view('admin.products.show', compact('product'));
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
    public function update(Request $request, $id)
    {
        $product = $this->productRepo->requiredById($id);

        $product = $this->productRepo->renew($product, $request);

        if ($request->ajax()) {
            return $request->all();
        }

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

    public function updateStatus(Request $request, $id)
    {
        if(!$request->has('status')){
            return back()->withErrors(['status' => 'Status field is required'])->withError('Status field is required');
        }

        $product = $this->productRepo->requiredById($id);

        $product->update(['status' => $request->status]);

        return redirect()->route('admin.products.index')->withStatus('Product status updated');
    }

    public function updateImageOnly(Request $request, $id)
    {
        $product = $this->productRepo->requiredById($id);

        if ($request->hasFile('image')) {
            if ($request->is_from_create && $request->is_from_create == 'yes') {

                $data = $this->productRepo->uploadPhoto($request->file('image'), "uploads/products/{$product->id}", null, 380, 284, 190);

                $product->images()->create(['image_name' => $data['originalFileName'], 'image_path' => $data['photo_path'], 'mime_type' => $data['mime_type'], 'image_size' => $data['file_size']]);
            }
        }

        return 'success';
    }
}
