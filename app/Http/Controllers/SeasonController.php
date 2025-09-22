<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.season.index');
    }
    public function datatable(Request $request){
        $number = $request->value ?? 50;
        $querry = Season::query();
        if($request->search){
            $querry->where('name','like','%'.$request->search.'%');
        }
        $season = $querry->latest()->paginate($number);
        return view('admin.season.datatable',compact('season'));
    }
    public function edit_modal(Request $request){
        $season = Season::find($request->id);
        return view('admin.season.modal',compact('season'));
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
        $season = Season::find($request->season_id);
        if($season){
            $check = Season::where('name',$request->name)->where('id','!=',$season->id)->first();
            if($check){
                $data = [
                    'result' => -1,
                    'message' => 'Season Name Already Used'
                ];
            }else{
                $season->name = $request->name;
                $season->save();
                $data = [
                    'result' => 1,
                    'message' => 'Season Updated Successfully'
                ];
            }
        }else{
            $check = Season::where('name',$request->name)->first();
            if($check){
                $data = [
                    'result' => -1,
                    'message' => 'Season Name Already Used'
                ];
            }else{
                $season = new Season();
                $season->name = $request->name;
                $season->status = 1;
                $season->save();
                $data = [
                    'result' => 1,
                    'message' => 'Season Added Successfully'
                ];
            }
        }
        return $data;
    }
    public function change_status($id){
        $season = Season::find($id);
        if($season){
            $season->status = $season->status == 1 ? 0 : 1;
            $season->save();
            $data = [
                'result' => 1,
                'message' => 'Status Changed Successfully'
            ];
        }
        
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function show(Season $season)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function edit(Season $season)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Season $season)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $season = Season::find($id);
        $season->delete();
        return 1;
    }
}
