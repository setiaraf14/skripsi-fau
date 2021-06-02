<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rt;
use App\Models\Rw;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserRoleController extends Controller
{
    protected $rtModel, $rwModel, $userModel;

    public function __construct()
    {
        $this->rtModel = new Rt();
        $this->rwModel = new Rw();
        $this->userModel = new User();
    }

    public function indexRt()
    {
        $rt = $this->rtModel->get();
        return view('backend.user-role.index-rts', compact('rt'));
    }

    public function storeRt(Request $request)
    {
        $rt = $this->rtModel;
        $rt->rt_name = $request->rt_name;
        $rt->save();

        if(!$rt->save()) {
            return redirect('backend/user-rt')->with([
                'message'   => 'Saving role fail',
                'style'     => 'danger'     
            ]);
        }

        return redirect('backend/user-rt')->with([
            'message'   => 'Saving role success',
            'style'     => 'success' 
        ]);
    }

    public function deleteRt(Request $request, $id = null)
    {
        $id = $request->id;
        $rt =  Rt::find($id);
        $rt->delete();
        return redirect()->back()->with([
            'message'   => 'delete rt success',
            'style'     => 'danger'    
        ]);
    }


    public function indexRw()
    {
        $rw = $this->rwModel->get();
        return view('backend.user-role.index-rws', compact('rw'));
    }

    public function storeRw(Request $request)
    {
        $rw = $this->rwModel;
        $rw->rw_name = $request->rw_name;
        $rw->save();

        if(!$rw->save()) {
            return redirect('backend/user-rw')->with([
                'message'   => 'Saving RW fail',
                'style'     => 'danger'     
            ]);
        }

        return redirect('backend/user-rw')->with([
            'message'   => 'Saving RW success',
            'style'     => 'success' 
        ]);
    }

    public function deleteRw(Request $request, $id = null)
    {
        $id = $request->id;
        $rt =  Rw::find($id);
        $rt->delete();
        return redirect()->back()->with([
            'message'   => 'delete RW success',
            'style'     => 'danger'    
        ]);
    }

    public function testFilter(Request $request)
    {
        $filters = $request->only(['search_name','search_rt','search_rw','search_role']);
        $user = $this->filterUser($filters);
        dd($user);
    }

    public function indexUser(Request $request)
    {
        $filters = $request->only(['search_name','search_rt','search_rw','search_role']);
        $user = $this->filterUser($filters);
        return view('backend.user.index-user', compact('user', 'filters'));
    }

    public function filterUser($filter){
        $data = User::with(['rt', 'rw']);
        if(!empty($filter['search_name'])){
            $data = $data->where('name','LIKE','%'.$filter['search_name'].'%');
        }
        if(!empty($filter['search_rt'])){
            $data = $data->whereHas('rt',function($q) use($filter){
                $q->where('rt_name', $filter['search_rt']);
            });
        }

        if(!empty($filter['search_rw'])){
            $data = $data->whereHas('rw',function($q) use($filter){
                $q->where('rw_name', $filter['search_rw']);
            });
        }

        if(!empty($filter['search_role'])){
            $data = $data->where('role_user','LIKE','%'.$filter['search_role'].'%');
        }

        $data->orderBy('id','desc');
        return $data->paginate(25);
    }

    public function registerUser()
    {
        return view('backend.user.register-user');
    }

    public function storeUser(Request $request, $id = null)
    {
        if($request->role_user == 'Ketua-RT') {
            $resultCheckRt = $this->checkStatusRt($request->rt_id, $request->role_user);
            if($resultCheckRt) {
                return redirect('backend/user')->with([
                    'message'   => 'Ketua RT setempat sudah ada',
                    'style'     => 'danger' 
                ]);
            }
        }

        if($request->role_user == 'Ketua-RW') {
            $resultCheckRt = $this->checkStatusRw($request->rw_id, $request->role_user);
            if($resultCheckRt) {
                return redirect('backend/user')->with([
                    'message'   => 'Ketua RW setempat sudah ada',
                    'style'     => 'danger' 
                ]);
            }
        }

        
        Validator::make($request->all(),[
            'name'  => 'required|string|max:255',
            'rt_id' => 'required',
            'rw_id' => 'required',
            'role_user' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required',
        ])->validate();

        if($id){
            $user = User::find($request->id)->with(['rt', 'rw'])->first();
            if(!$user){
                $result['status']   = false;
                $result['message']  = $user;
                return $result;
            }
        }else{
            $user = new User();
        }

        $user->name = $request->name;
        $user->rt_id = $request->rt_id;
        $user->rw_id = $request->rw_id;
        $user->role_user = $request->role_user;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();        

        return redirect('backend/user')->with([
            'message'   => 'Saving User success',
            'style'     => 'success' 
        ]);
    }

    public function editUser(Request $request)
    {
        $user = User::find($request->id);
        return view('backend.user.edit-user', compact('user'));
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return redirect('backend/user')->with([
            'message'   => 'Delete User success',
            'style'     => 'success' 
        ]);
    }

    public function checkStatusRt($noRt, $roleRt){
        $data = User::with(['rt']);

        if(!empty($roleRt)){
            $data = $data->where('role_user', $roleRt);
        }

        if(!empty($noRt)){
            $data = $data->whereHas('rt',function($q) use($noRt){
                $q->where('id', $noRt);
            });
        }

        return $data->first();
    }

    public function checkStatusRw($noRw, $roleRw){
        $data = User::with(['rw']);

        if(!empty($roleRw)){
            $data = $data->where('role_user', $roleRw);
        }

        if(!empty($noRw)){
            $data = $data->whereHas('rw',function($q) use($noRw){
                $q->where('id', $noRw);
            });
        }

        return $data->first();
    }

    public function registerFrontUser(Request $request) 
    {
        Validator::make($request->all(),[
            'name'  => 'required|string|max:255',
            'rt_id' => 'required',
            'rw_id' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required',
        ])->validate();

        $user = new User();

        $user->name = $request->name;
        $user->rt_id = $request->rt_id;
        $user->rw_id = $request->rw_id;
        $user->role_user = 'warga';
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();        

        return redirect('login')->with([
            'message'   => 'Saving User success',
            'style'     => 'success' 
        ]);
    }
}
