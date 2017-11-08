<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\SliderRepository;

class SliderController extends Controller
{   
    protected $sliderRepo;

    function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepo = $sliderRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = $this->sliderRepo->sliderModel()->orderBy('position', 'ASC')->get();

        // return $sliders;
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('image') && $request->url){
            return back()->withError('Only one at a time');
        }

        $this->validate($request, [
            'image' => 'required',
            'position' => 'required|unique:sliders',
        ], [
            'image.required' => 'Image is required',
            'position.unique' => 'position should be unique',
            'position.required' => 'slider position ie required',
        ]);

        $slider = $this->sliderRepo->store($request);

        return back()->withStatus('Slider image uploaded');
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
        $slider = $this->sliderRepo->requiredById($id);

        if($request->hasFile('image') && $request->url){
            return back()->withError('Only one at a time');
        }

        $this->validate($request, [
            'position' => 'required|unique:sliders,position,'.$slider->id,
        ], [
            'position.unique' => 'position should be unique',
            'position.required' => 'slider position ie required',
        ]);

        $slider = $this->sliderRepo->renew($slider, $request);

        return back()->withStatus('slider updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = $this->sliderRepo->requiredById($id);

        $slider->delete();

        return back()->withStatus('Slider deleted');
    }
}
