<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.brand.index');
    }
    public function datatable(Request $request){
        $number = $request->value ?? 50;
        $querry = Brand::query();
        if($request->search){
            $querry->where('name','like','%'.$request->search.'%');
        }
        $brand = $querry->latest()->paginate($number);
        return view('admin.brand.datatable',compact('brand'));
    }
    public function edit_modal(Request $request){
        $brand = Brand::find($request->id);
        return view('admin.brand.modal',compact('brand'));
    }

    public function brand_list(Request $request)
    {
        $brand = Brand::all();
        return view('admin.brand.brand_list',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand = Brand::find($request->brand_id);
        if($brand){
            $check = Brand::where('name',$request->name)->where('id','!=',$brand->id)->first();
            if($check){
                $data = [
                    'result' => -1,
                    'message' => 'Brand Name Already Used',
                    'from' => 'Brand'
                ];
            }else{
                $brand->name = $request->name;
                $brand->save();
                $data = [
                    'result' => 1,
                    'message' => 'Brand Updated Successfully',
                    'from' => 'Brand'
                ];
            }
        }else{
            $check = Brand::where('name',$request->name)->first();
            if($check){
                $data = [
                    'result' => -1,
                    'message' => 'Brand Name Already Used',
                    'from' => 'Brand'
                ];
            }else{
                $brand = new Brand();
                $brand->name = $request->name;
                $brand->created_by_id = auth()->user()->id;
                $brand->status = 1;
                $brand->save();
                $data = [
                    'result' => 1,
                    'message' => 'Brand Added Successfully',
                    'from' => 'Brand'
                ];
            }
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }
    public function change_status($id){
        $brand = Brand::find($id);
        if($brand){
            $brand->status = $brand->status == 1 ? 0 : 1;
            $brand->save();
            $data = [
                'result' => 1,
                'message' => 'Status Changed Successfully'
            ];
        }
        
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        $data = 
        [
            'result' => 1,
            'message' => 'Deleted Successfully',
        ];
        return $data;
    }
}
