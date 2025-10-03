<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
       return view('admin.employee.index');
    }

    public function datatable(Request $request)
    {
        if(auth()->user()->role_as == 'Admin'){
            $users = User::query();
        } else {
            $users = User::where('created_by_id', auth()->user()->id);
        }
        if($request->search){
            $users->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }
        // Optionally filter by role_as if sent from frontend
        if($request->role_as){
            $users->where('role_as', $request->role_as);
        }
        $users = $users->latest()->paginate($request->value);
        return view('admin.employee.datatable', compact('users'));
    }

    public function edit_modal(Request $request)
    {
        $user = User::find($request->id);
        
        return view('admin.employee.modal', compact('user'));
    }

    public function store(Request $request){
        $user = User::find($request->user_id);

        if ($user) {
            // Update case
            $check = User::where('email', $request->email)
                ->where('id', '!=', $user->id)
                ->first();

            if ($check) {
                $data = [
                    'result'  => -1,
                    'message' => 'Email Already Used',
                    'from'    => 'User',
                ];
            } else {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->show_password = $request->password;
                $user->role_as = $request->role_as;
                $user->status = 1;
                $user->created_by_id = auth()->user()->id;
                $user->save();

                $data = [
                    'result'  => 1,
                    'message' => 'User Updated Successfully',
                    'from'    => 'User',
                ];
            }
        } else {
            // New user case
            $check = User::where('email', $request->email)->first();

            if ($check) {
                $data = [
                    'result'  => -1,
                    'message' => 'Email Already Used',
                    'from'    => 'User',
                ];
            } else {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->show_password = $request->password;
                $user->role_as = $request->role_as;
                $user->status = 1;
                $user->created_by_id = auth()->user()->id;
                $user->save();

                $data = [
                    'result'  => 1,
                    'message' => 'User Added Successfully',
                    'from'    => 'User',
                ];
            }
        }

        return $data;

    }
 
    public function delete(Request $request){
        $user = User::find($request->id);
        $user->delete();
        return response()->json(['result' => 1, 'message' => 'User deleted successfully']);
    }

    public function change_status(Request $request){
        $user = User::find($request->id);
        $user->status = $request->status == 1 ? 1 : 0;
        $user->save();
        return response()->json(['result' => 1, 'message' => 'User status changed successfully']);
    }

    public function sub_user_index($id, Request $request){
        $user = User::find($id);
        $category = json_decode($user->category_id ?? '[]', true);
        $categories = Category::whereIn('id', $category)->where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.employee.sub_user_index', compact('user', 'categories'));
    }
    
    public function sub_user_datatable(Request $request,$id){
        $query = User::where('role_as', 'Sub Admin')->where('sub_admin_id',$id);
        if($request->search){
            $query->where(function($q)use($request){
                $q->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }
        $users = $query->latest()->paginate($request->value);
        return view('admin.employee.sub_user_datatable', compact('users'));
    }
}
