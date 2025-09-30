<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index');
    }
    public function datatable(Request $request){
        $number = $request->value ?? 50;
        $querry = Category::query();
        if($request->search){
            $querry->where('name','like','%'.$request->search.'%');
        }
        $category = $querry->latest()->paginate($number);
        return view('admin.category.datatable',compact('category'));
    }
    public function edit_modal(Request $request){
        $category = Category::find($request->id);
        return view('admin.category.modal',compact('category'));
    }
    public function store(Request $request)
    {
        $category = Category::find($request->category_id);
        if($category){
            $check = Category::where('name',$request->name)->where('id','!=',$category->id)->first();
            if($check){
                $data = [
                    'result' => -1,
                    'message' => 'Category Name Already Used',
                    'from' => 'Category',
                ];
            }else{
                $category->name = $request->name;
                $category->save();
                $data = [
                    'result' => 1,
                    'message' => 'Category Updated Successfully',
                    'from' => 'Category',
                ];
            }
        }else{
            $check = Category::where('name',$request->name)->first();
            if($check){
                $data = [
                    'result' => -1,
                    'message' => 'Category Name Already Used',
                    'from' => 'Category',
                ];
            }else{
                $category = new Category();
                $category->name = $request->name;
                $category->created_by_id = auth()->user()->id;
                $category->status = 1;
                $category->save();
                $data = [
                    'result' => 1,
                    'message' => 'Category Added Successfully',
                    'from' => 'Category',
                ];
            }
        }
        return $data;
    }
    public function category_list(Request $request)
    {
        $category = Category::all();
        return view('admin.category.category_list',compact('category'));
    }

    public function change_status($id){
        $category = Category::find($id);
        if($category){
            $category->status = $category->status == 1 ? 0 : 1;
            $category->save();
            $data = [
                'result' => 1,
                'message' => 'Status Changed Successfully'
            ];
        }
        
        return $data;
    }
    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        $data = 
        [
            'result' => 1,
            'message' => 'Deleted Successfully',
        ];
        return $data;
    }



}
