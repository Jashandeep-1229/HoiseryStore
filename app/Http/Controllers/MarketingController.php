<?php

namespace App\Http\Controllers;

use App\Models\Marketing;
use App\Models\AccountMaster;
use Illuminate\Http\Request;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;
use Netflie\WhatsAppCloudApi\Message\Media\LinkID;
use Netflie\WhatsAppCloudApi\Message\Template\Component;
use Netflie\WhatsAppCloudApi\Message\Media\MediaObjectID;

class MarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AccountMaster::where('phone_no','!=','')->whereIn('from',['Vendor','Customer'])->where('status',1)->get()->groupBy('city');
        return view('admin.marketing.index',compact('data'));
    }
    public function edit_modal(Request $request,$id){
        $data = AccountMaster::where('phone_no','!=','')->whereIn('from',['Vendor','Customer'])->where('status',1)->get()->groupBy('city');
        $key_value = $request->key_value;
        $marketing = Marketing::find($id);
        return view('admin.marketing.modal',compact('marketing','key_value','data'));
        
    }
    public function datatable(Request $request){
        $number = 50;
        if($request->value){
            $number = $request->value;
        }
        $querry = Marketing::latest();
        if($request->search){
            $querry->where('select_type','like','%'.$request->search.'%');
        }
        $marketing = $querry->where('deleted_at', null)->paginate($number);
        return view('admin.marketing.datatable',compact('marketing'));
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
        $marketing = new Marketing;
        $marketing->message_type = $request->message_type;
        if($request->hasFile('file')){

            $file = $request->file;
            $random_file_name = rand(0000,9990);
            $file_name = 'marketing-'.time() . $random_file_name . '.' . $file->getClientOriginalExtension();
            $file->move(public_path().'/uploads/marketing/',$file_name);
            $marketing->file = '/uploads/marketing/'.$file_name;
        }
        $marketing->selected_customer = json_encode($request->selected_customer);
        if($request->is_auto == 'on'){
            $marketing->is_auto = 1;
        }
        else{
            $marketing->is_auto = 0;
        }   
        $marketing->message_date = $request->message_date;
        $marketing->message = $request->message;
        $marketing->status = 0;
        $marketing->save();
        $data = [
            'result' => 1,
            'message' => 'Created Succcessfully',
        ];
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marketing  $marketing
     * @return \Illuminate\Http\Response
     */
    public function show(Marketing $marketing)
    {
        //
    }
    public function change_status($id)
    {
        $marketing = Marketing::find($id);
        if($marketing->status == 1){
            $marketing->status = 0;
        }
        else{
            $marketing->status = 1;
        }
        $marketing->update();
        return 1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marketing  $marketing
     * @return \Illuminate\Http\Response
     */
    public function edit(Marketing $marketing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marketing  $marketing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $key_value = $request->key_value;
        $marketing = Marketing::find($id);
        $request->validate([
            'file' => 'file|max:25600', // max:25600 means 25MB limit
        ]);


        if ($request->hasFile('file')){
            $randomString = rand(0000,9990);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileName = $randomString . '.' . $extension;
            $request->file('file')->move(public_path('images'), $fileName);
            $marketing->file = "/images/". $fileName;
        }


        $marketing->message_type = $request->message_type;
        $marketing->selected_customer = json_encode($request->selected_customer);
        if($request->is_auto == 'on'){
            $marketing->is_auto = 1;
        }
        else{
            $marketing->is_auto = 0;
        }   
        $marketing->message_date = $request->message_date;
        $marketing->message = $request->message;
        $marketing->update();

        $data = [
            'result' => 1,
            'messgage' => 'Updated Successfully',
        ]; 
    
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marketing  $marketing
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $marketing = Marketing::find($id);
        $marketing->delete();
        $data = [
            'result' => 1,
            'message' => 'Deleted Succcessfully',
        ];
        return $data;
    }
    public function send_whatsapp($id){
        $marketing = Marketing::find($id);
        $file = url($marketing->file);
        foreach(json_decode($marketing->selected_customer) ?? [] as $cust){
            $cust = AccountMaster::find($cust);
            $message_template = 'text_message';
            $component_header = [];
            if($marketing->message_type == 'Image'){
                $message_template = 'image_message';
                $component_header = [[
                    'type' => 'image',
                    'image' => [
                        'link' => $file,
                    ],
                ]];
            }
            if($marketing->message_type == 'Video'){
                $message_template = 'video_message';
                $component_header = [[
                    'type' => 'video',
                    'video' => [
                        'link' => $file,
                    ],
                ]];
            }
            if($marketing->message_type == 'PDF'){
                $message_template = 'pdf_message';
                $component_header = [[
                    'type' => 'document',
                    'document' => [
                        'link' => $file,
                        "filename" => 'Catalogue.pdf',
                    ],
                ]];
            }
            $component_body = [
                [
                    'type' => 'text',
                    'text' =>  $marketing->message,
                ],
            ];
            $component_buttons = [];
            $components = new Component($component_header, $component_body, $component_buttons);
            $number = '91'.$cust->phone_no;
            $whatsapp_cloud_api = new WhatsAppCloudApi([
                'from_phone_number_id' => '863369476858208',
                'access_token' => 'EAAaIAlVcpmEBPuUr4ogekO8qbMLHhBz95xYO9vFQgNF2eE0v82wbXIgy0k9UZABpI7ZBLWjzCin6PRl5St6bcYXaLuhIpRSY5uuB2wwbMN6rRvEE51cCDXJH5BzGxLeCRZChh3UiSEyKJb3X9azIlHu7aEGLRkSS3yN2M2LydHjRd4QeywnaZBRjDMTFKysZC3gZDZD',
            ]);
            // dd($message_template,$number);
            $whatsapp_cloud_api->sendTemplate($number, $message_template, 'en', $components);
            $cust->is_whatsapp = 0;
            $cust->update();
        }
        $marketing->status = 1;
        $marketing->update();

        return 1;
    }
}
