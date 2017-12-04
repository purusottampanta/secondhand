<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\CommentRepository;

class CommentController extends Controller
{
    protected $productRepo;
    protected $commentRepo;

    function __construct(ProductRepository $productRepo, CommentRepository $commentRepo)
    {
        $this->middleware('auth');
        $this->productRepo = $productRepo;
        $this->commentRepo = $commentRepo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $productId)
    {
        $product = $this->productRepo->requiredById($productId);

        $comment = $this->commentRepo->getNew();

        $comment->comment = $request->comment;
        $comment->user_id = authUser()->id;
        $comment->parent_id = $request->parent_id ? $request->parent_id : null;
        
        $product->comments()->save($comment);

        return back();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
