<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Rt;
use App\Models\Rw;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserRoleController extends Controller
{
    protected $roleModel, $rtModel, $rwModel;

    public function __construct()
    {
        $this->roleModel = new Role();
        $this->rtModel = new Rt();
        $this->rwModel = new Rw();
    }


    public function indexUser() 
    {
        return view('backend.user-role.index-user');
    }


    public function indexRole()
    {
        $role = $this->roleModel->get();
        return view('backend.user-role.index-role', compact('role'));
    }
    
    public function storeRole(Request $request)
    {

        $role = $this->roleModel;
        $role->role_name = $request->role_name;
        $role->save();

        if(!$role->save()) {
            return redirect('backend/user-role/role')->with([
                'message'   => 'Saving role fail',
                'style'     => 'danger'     
            ]);
        }

        return redirect('backend/user-role/role')->with([
            'message'   => 'Saving role success',
            'style'     => 'success' 
        ]);
    }

    public function deleteRole(Request $request, $id = null)
    {
        $id = $request->id;
        $role =  Role::find($id);
        $role->delete();
        return redirect()->back()->with([
            'message'   => 'delete role success',
            'style'     => 'danger'    
        ]);
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

    public function registerUser()
    {
        return view('backend.user.register-user');
    }

    public function storeUser(Request $request)
    {
        Validator::make($request->all(),[
            'name'          => 'required|string|max:255',
            'rt_id' => 'required',
            'rw_id' => 'requierd',
            'role_user_id' => 'required',
            'email'         => 'required|string|email|max:255',
            'password'      => '',
        ])->validate();
    }
}
