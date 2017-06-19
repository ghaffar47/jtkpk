<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Packages;
use App\User;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:super-admin',[
            'only' => ['Packages', 'ActivatePackages', 'DeactivatePackages', 'DeletePackages']
        ]);
    }

    /**

    PAKEJ SISTEM

    */
    public function Packages()
    {
    	return view('admin.packages', ['packages' => Packages::all()]);
    }
    public function ActivatePackages($id)
    {
        $package = Packages::find($id);
        $package->package_status = 1;
        $package->save();

        return redirect('/admin/packages');
    }
    public function DeactivatePackages($id)
    {
        $package = Packages::find($id);
        $package->package_status = 0;
        $package->save();

        return redirect('/admin/packages');   
    }
    public function DeletePackages($id)
    {
        $package = Packages::destroy($id);
        return redirect('/admin/packages');
    }

    /**

    SENARAI PENGGUNA

    */
    public function Users()
    {
    	return view('admin.users', ['users' => User::all()]);
    }
    public function SaveUser(Request $r)
    {
        if ($r->_uid != 0 || $r->_uid != '0')
        {
            $_user = User::find($r->_uid);
            foreach ($_user->roles()->get() as $_role) {
                $_user->deleteRole($_role->role);
            }

            # Update User Data
            $user = User::find($r->_uid);
            $user->name = $r->_name;
            $user->email = $r->_email;
            if (strlen($r->_pwd) != 0) {
                $user->password = bcrypt($r->_pwd);
            }
            if (count($r->_usergroups) != 0) {
                foreach ($r->_usergroups as $add_role) {
                    $user->addRole($add_role);
                }
            }
            $user->gred = (strlen($r->_gred) != 0) ? $r->_gred:DB::raw('NULL');
            $user->kod_jpn = (strlen($r->_kodjpn) != 0) ? $r->_kodjpn:DB::raw('NULL');
            $user->kod_ppd = (strlen($r->_kodppd) != 0) ? $r->_kodppd:DB::raw('NULL');
            $user->kod_jabatan = (strlen($r->_kodsek) != 0) ? $r->_kodsek:DB::raw('NULL');
            $user->save();
        }
        else
        {
            # Create New User
            $user = new User;
            $user->name = $r->_name;
            $user->email = $r->_email;
            $user->password = bcrypt($r->_pwd);
            $user->gred = (strlen($r->_gred) != 0) ? $r->_gred:DB::raw('NULL');
            $user->kod_jpn = (strlen($r->_kodjpn) != 0) ? $r->_kodjpn:DB::raw('NULL');
            $user->kod_ppd = (strlen($r->_kodppd) != 0) ? $r->_kodppd:DB::raw('NULL');
            $user->kod_jabatan = (strlen($r->_kodsek) != 0) ? $r->_kodsek:DB::raw('NULL');
            $user->save();

            $_user = User::find($user->id);
            if (count($r->_usergroups) != 0) {
                foreach ($r->_usergroups as $role) {
                    $_user->addRole($role);
                }
            }
            $_user->save();
        }

        return redirect('/admin/users');
    }
    public function GetUser(Request $r, $id)
    {
        $user = User::find($id);
        $name = $user->name;
        $email = $user->email;
        if ($user->roles()->count() > 0)
        {
            foreach ($user->roles()->get() as $_role) {
                $role[] = '"'.$_role->role.'"';
            }
            $roles = implode(',', $role);
        }
        
        $gred = $user->gred;
        $kodjpn = $user->kod_jpn;
        $kodppd = $user->kod_ppd;
        $kodjab = $user->kod_jabatan;
        
        echo "$('#_uid').val('$id');";
        echo "$('#UserDialog').modal('show');";

        echo "$('#_name').val('$name');";
        echo "$('#_email').val('$email');";
        if ($user->roles()->count() > 0)
        {
            echo "$('#_usergroups').val([$roles]).trigger(\"change\");";
        }

        echo "$('#_gred').val(\"$gred\").trigger(\"change\");";
        echo "$('#_kodjpn').val(\"$kodjpn\").trigger(\"change\");";
        echo "$('#_kodppd').val(\"$kodppd\").trigger(\"change\");";
        echo "$('#_kodsek').val(\"$kodjab\").trigger(\"change\");";
    }
    public function DeleteUser($id)
    {
        $package = User::destroy($id);
        return redirect('/admin/users');
    }
}
