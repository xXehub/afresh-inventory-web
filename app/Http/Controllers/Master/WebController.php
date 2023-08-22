<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Admin\WebModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class WebController extends Controller
{
    public function index()
    {
        $data["title"] = "Web";
        $data["data"] = WebModel::all();
        return view('Master.Web.index', $data);
    }

    public function update(Request $request, WebModel $web)
    {

        //check if image is uploaded
        if ($request->hasFile('photo')) {

            //upload new image
            $image = $request->file('photo');
            $image->storeAs('public/web', $image->hashName());

            //delete old image
            Storage::delete('public/web/' . $web->web_logo);

            //update post with new image
            $web->update([
                'web_logo' => $image->hashName(),
                'web_nama' => $request->nmweb,
                'web_deskripsi' => $request->desk,
            ]);
        } else {
            $web->update([
                'web_nama' => $request->nmweb,
                'web_deskripsi'   => $request->desk,
            ]);
        }

        $data['title'] = "Web";
        Session::flash('status', 'success');
        Session::flash('msg', 'Berhasil diubah!');

        //redirect to index
        return redirect()->route('web.index')->with($data);
    }

}
