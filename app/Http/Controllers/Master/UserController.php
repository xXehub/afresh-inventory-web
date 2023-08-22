<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Admin\RoleModel;
use App\Models\Admin\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $data["title"] = "User";
        $data["role"] = RoleModel::latest()->get();
        return view('Master.User.index', $data);
    }

    public function profile(UserModel $user)
    {
        $data["title"] = "Profile";
        $data["data"] = UserModel::leftJoin('tbl_role', 'tbl_role.role_id', '=', 'tbl_user.role_id')->select()->where('tbl_user.user_id', '=', $user->user_id)->first();
        return view('Master.User.profile', $data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = UserModel::leftJoin('tbl_role', 'tbl_role.role_id', '=', 'tbl_user.role_id')->select()->orderBy('user_id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('img', function ($row) {
                    if ($row->user_foto == "undraw_profile.svg") {
                        $img = '<span class="avatar avatar-lg brround cover-image" data-bs-image-src="' . url('assets/images/users/14.jpg') . '" style="background: url(&quot;' . url('/assets/default/users') . '/' . $row->user_foto . '&quot;) center center;"></span>';
                    } else {
                        $img = '<span class="avatar avatar-lg brround cover-image" data-bs-image-src="' . url('assets/images/users/14.jpg') . '" style="background: url(&quot;' . asset('storage/users/' . $row->user_foto) . '&quot;) center center;"></span>';
                    }

                    return $img;
                })
                ->addColumn('role', function ($row) {
                    $badge = '<span class="badge bg-primary badge-sm  me-1 mb-1 mt-1">' . $row->role_title . '</span>';

                    return $badge;
                })
                ->addColumn('action', function ($row) {
                    $array = array(
                        "user_id" => $row->user_id,
                        "user_nama" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->user_nama)),
                        "user_nmlengkap" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->user_nmlengkap)),
                        "user_foto" => $row->user_foto,
                        "role_id" => $row->role_id,
                        "user_email" => $row->user_email
                    );
                    $button = '';
                    $button .= '
                    <div class="g-2">
                        <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick=hapus(' . json_encode($array) . ')><span class="fe fe-trash-2 fs-14"></span></a>
                    </div>
                    ';
                    return $button;
                })
                ->rawColumns(['action', 'img', 'role'])->make(true);
        }
    }

    public function store(Request $request)
    {
        $img = "";

        //upload image
        if ($request->file('photo') == null) {
            $img = "undraw_profile.svg";
        } else {
            $image = $request->file('photo');
            $image->storeAs('public/users/', $image->hashName());
            $img = $image->hashName();
        }


        //create post
        UserModel::create([
            'user_foto' => $img,
            'user_nmlengkap' => $request->nmlengkap,
            'user_nama'   => $request->username,
            'user_email' => $request->email,
            'role_id' => $request->role,
            'user_password' => md5($request->pwd)
        ]);

        $data['title'] = "User";
        Session::flash('status', 'success');
        Session::flash('msg', 'Berhasil ditambah!');

        //redirect to index
        return redirect()->route('user.index')->with($data);
    }

    public function update(Request $request, UserModel $user)
    {

        //check if image is uploaded
        if ($request->hasFile('photoU')) {

            //upload new image
            $image = $request->file('photoU');
            $image->storeAs('public/users', $image->hashName());

            //delete old image
            Storage::delete('public/users/' . $user->user_foto);

            if ($request->pwd == '') {
                //update post with new image
                $user->update([
                    'user_foto'     => $image->hashName(),
                    'user_nmlengkap' => $request->nmlengkapU,
                    'user_nama'   => $request->usernameU,
                    'user_email' => $request->emailU,
                    'role_id' => $request->roleU,
                ]);
            } else {
                //update post with new image
                $user->update([
                    'user_foto'     => $image->hashName(),
                    'user_nmlengkap' => $request->nmlengkapU,
                    'user_nama'   => $request->usernameU,
                    'user_email' => $request->emailU,
                    'role_id' => $request->roleU,
                    'user_password' => md5($request->pwdU)
                ]);
            }
        } else {
            if ($request->pwd == '') {
                //update post without image
                $user->update([
                    'user_nmlengkap' => $request->nmlengkapU,
                    'user_nama'   => $request->usernameU,
                    'user_email' => $request->emailU,
                    'role_id' => $request->roleU,
                ]);
            } else {
                //update post with new image
                $user->update([
                    'user_nmlengkap' => $request->nmlengkapU,
                    'user_nama'   => $request->usernameU,
                    'user_email' => $request->emailU,
                    'role_id' => $request->roleU,
                    'user_password' => md5($request->pwdU)
                ]);
            }
        }

        $data['title'] = "User";
        Session::flash('status', 'success');
        Session::flash('msg', 'Berhasil diubah!');

        //redirect to index
        return redirect()->route('user.index')->with($data);
    }

    public function updatePassword(Request $request, UserModel $user)
    {
        $checkPassword = UserModel::where(array('user_id' => $user->user_id, 'user_password' => md5($request->currentpassword)))->count();
        if ($checkPassword > 0) {
            $user->update([
                'user_password' => md5($request->newpassword)
            ]);
            Session::flash('status', 'success');
            Session::flash('msg', 'Password berhasil di ubah!');
        } else {
            Session::flash('status', 'error');
            Session::flash('msg', 'Password saat ini tidak sama dengan password lama!');
            Session::flash('currentpassword', $request->currentpassword);
            Session::flash('newpassword', $request->newpassword);
            Session::flash('confirmpassword', $request->confirmpassword);
        }

        $data['title'] = "Profile";
        //redirect to index
        return redirect(url('admin/profile/' . $user->user_id))->with($data);
    }

    public function updateProfile(Request $request, UserModel $user)
    {

        //check if image is uploaded
        if ($request->hasFile('photoU')) {

            //upload new image
            $image = $request->file('photoU');
            $image->storeAs('public/users', $image->hashName());

            //delete old image
            Storage::delete('public/users/' . $user->user_foto);

            //update post with new image
            $user->update([
                'user_foto'  => $image->hashName(),
                'user_nmlengkap' => $request->nmlengkap,
                'user_nama'   => $request->username,
                'user_email' => $request->email,
            ]);
        } else {
            //update post without image
            $user->update([
                'user_nmlengkap' => $request->nmlengkap,
                'user_nama'   => $request->username,
                'user_email' => $request->email,
            ]);
        }

        $data['title'] = "Profile";
        Session::flash('status', 'success');
        Session::flash('msg', 'Profile Berhasil diubah!');

        //redirect to index
        return redirect(url('admin/profile/' . $user->user_id))->with($data);
    }

    public function hapus(Request $request)
    {
        $detail = UserModel::findOrFail($request->iduser);

        //delete image
        Storage::delete('public/users/' . $detail->user_foto);

        //delete post
        UserModel::findOrFail($request->iduser)->delete();

        $data['title'] = "User";
        Session::flash('status', 'success');
        Session::flash('msg', 'Berhasil dihapus!');

        //redirect to index
        return redirect()->route('user.index')->with($data);
    }
}
