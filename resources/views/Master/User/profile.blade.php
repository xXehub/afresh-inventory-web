@extends('Master.Layouts.app', ['title' => $title])

@section('content')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Profile</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-gray">User</li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<div class="row mb-5">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit Password</div>
            </div>
            <form action="{{url('/admin/updatePassword').'/'.$data->user_id}}" method="POST" name="myFormP" enctype="multipart/form-data" onsubmit="return validatePassword()">
                @csrf
                <div class="card-body">
                    <div class="text-center chat-image mb-5">
                        <div class="avatar avatar-xxl chat-profile mb-3 brround">
                            @if($data->user_foto == 'undraw_profile.svg' || $data->user_foto == '')
                            <img src="{{url('/assets/default/users/undraw_profile.svg')}}" alt="profile-user">
                            @else
                            <img src="{{asset('storage/users/'.$data->user_foto)}}" alt="profile-user">
                            @endif
                        </div>
                        <div class="main-chat-msg-name me-4">
                            <h5 class="mb-1 text-dark fw-semibold">{{$data->user_nmlengkap}}</h5>
                            <p class="text-muted mt-0 mb-0 pt-0 fs-13">{{$data->role_title}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password Saat Ini</label>
                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                            <a href="javascript:void(0)" tabindex="-1" class="input-group-text bg-white text-muted">
                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                            </a>
                            <input class="input100 form-control" value="{{Session::get('currentpassword')}}" name="currentpassword" type="password" placeholder="Password Saat Ini">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password Baru</label>
                        <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                            <a href="javascript:void(0)" tabindex="-1" class="input-group-text bg-white text-muted">
                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                            </a>
                            <input class="input100 form-control" value="{{Session::get('newpassword')}}" name="newpassword" type="password" placeholder="Password Baru">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password</label>
                        <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                            <a href="javascript:void(0)" tabindex="-1" class="input-group-text bg-white text-muted">
                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                            </a>
                            <input class="input100 form-control" value="{{Session::get('confirmpassword')}}" type="password" name="confirmpassword" placeholder="Konfirmasi Password">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="javascript:void(0)" onclick="resetP()" class="btn btn-danger my-1">Batal</a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Profile</h3>
            </div>
            <form action="{{url('/admin/updateProfile').'/'.$data->user_id}}" method="POST" name="myFormUpdate" enctype="multipart/form-data" onsubmit="return validateUpdate()">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nmlengkap">Nama Lengkap</label>
                        <input type="text" name="nmlengkap" value="{{$data->user_nmlengkap}}" class="form-control" id="nmlengkap" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="username">Nama User</label>
                        <input type="text" name="username" value="{{$data->user_nama}}" class="form-control" id="username" placeholder="Nama User">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{$data->user_email}}" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="img">Foto</label>
                        <input class="form-control" id="GetFile" name="photoU" type="file" onchange="VerifyFileNameAndFileSize()" accept=".png,.jpeg,.jpg,.svg">
                    </div>

                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    <a href="{{url('/admin/profile')}}/{{Session::get('user')->user_id}}" class="btn btn-danger my-1">Batal</a>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script>
    function validatePassword() {
        const current = document.forms["myFormP"]["currentpassword"].value;
        const newp = document.forms["myFormP"]["newpassword"].value;
        const confirm = document.forms["myFormP"]["confirmpassword"].value;

        resetValidP();

        if (current == "") {
            validasi('Masukan Password Saat Ini!', 'warning');
            $("input[name='currentpassword']").addClass('is-invalid');
            return false;
        }
        if (newp == "") {
            validasi('Masukan Password Baru!', 'warning');
            $("input[name='newpassword']").addClass('is-invalid');
            return false;
        }
        if (confirm == "") {
            validasi('Masukan Konfirmasi Password!', 'warning');
            $("input[name='confirmpassword']").addClass('is-invalid');
            return false;
        } else if (newp !== '' || confirm !== '') {

            if (newp.length < 6) {
                validasi('Panjang Password minimal 6 karakter!', 'warning');
                $("input[name='newpassword']").addClass('is-invalid');
                $("input[name='confirmpassword']").addClass('is-invalid');
                return false;
            } else if (newp !== confirm) {
                validasi('Konfirmasi Password tidak sesuai!', 'warning');
                $("input[name='newpassword']").addClass('is-invalid');
                $("input[name='confirmpassword']").addClass('is-invalid');
                return false;
            }
        }
    }

    function validateUpdate() {
        const nmlengkap = document.forms["myFormUpdate"]["nmlengkap"].value;
        const username = document.forms["myFormUpdate"]["username"].value;
        const email = document.forms["myFormUpdate"]["email"].value;

        resetValid();

        if (nmlengkap == "") {
            validasi('Nama Lengkap Wajib di isi!', 'warning');
            $("input[name='nmlengkap']").addClass('is-invalid');
            return false;
        } else if (username == "") {
            validasi('Nama User Wajib di isi!', 'warning');
            $("input[name='username']").addClass('is-invalid');
            return false;
        } else if (email == "") {
            validasi('Email Wajib di isi!', 'warning');
            $("input[name='email']").addClass('is-invalid');
            return false;
        }
    }

    function resetValidP() {
        $("input[name='currentpassword']").removeClass('is-invalid');
        $("input[name='newpassword']").removeClass('is-invalid');
        $("input[name='confirmpassword']").removeClass('is-invalid');
    };

    function resetValid() {
        $("input[name='nmlengkap']").removeClass('is-invalid');
        $("input[name='username']").removeClass('is-invalid');
        $("input[name='email']").removeClass('is-invalid');
    };

    function resetP() {
        resetValidP();
        $("input[name='currentpassword']").val('');
        $("input[name='newpassword']").val('');
        $("input[name='confirmpassword']").val('');
    }

    function validasi(judul, status) {
        swal({
            title: judul,
            type: status,
            confirmButtonText: "OK"
        });
    }

    function fileIsValid(fileName) {
        var ext = fileName.match(/\.([^\.]+)$/)[1];
        ext = ext.toLowerCase();
        var isValid = true;
        switch (ext) {
            case 'png':
            case 'jpeg':
            case 'jpg':
            case 'svg':
                break;
            default:
                this.value = '';
                isValid = false;
        }
        return isValid;
    }

    function VerifyFileNameAndFileSize() {
        var file = document.getElementById('GetFile').files[0];


        if (file != null) {
            var fileName = file.name;
            if (fileIsValid(fileName) == false) {
                validasi('Format bukan gambar!', 'warning');
                document.getElementById('GetFile').value = null;
                return false;
            }
            var content;
            var size = file.size;
            if ((size != null) && ((size / (1024 * 1024)) > 3)) {
                validasi('Ukuran maximum 1024px', 'warning');
                document.getElementById('GetFile').value = null;
                return false;
            }

            var ext = fileName.match(/\.([^\.]+)$/)[1];
            ext = ext.toLowerCase();
            // $(".custom-file-label").addClass("selected").html(file.name);
            // document.getElementById('outputImg').src = window.URL.createObjectURL(file);
            return true;

        } else
            return false;
    }
</script>
@endsection