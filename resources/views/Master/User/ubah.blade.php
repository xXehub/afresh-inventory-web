<!-- MODAL UBAH -->
<div class="modal fade" data-bs-backdrop="static" id="Umodaldemo8">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Ubah User</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" name="myFormU" id="myFormU" enctype="multipart/form-data" onsubmit="return validateFormUpdate()">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="nmlengkapU" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nmlengkapU" class="form-control" placeholder="Nama Lengkap..">
                            </div>
                            <div class="form-group">
                                <label for="usernameU" class="form-label">Username</label>
                                <input type="text" name="usernameU" class="form-control" placeholder="Username..">
                            </div>
                            <div class="form-group">
                                <label for="emailU" class="form-label">Email</label>
                                <input type="email" name="emailU" class="form-control" placeholder="Email@mail.com..">
                            </div>
                            <div class="form-group">
                                <label for="roleU" class="form-label">Role</label>
                                <select name="roleU" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    @foreach($role as $r)
                                    <option value="{{$r->role_id}}">{{$r->role_title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="alert alert-info" role="alert">
                                <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                                <span class="alert-inner--text">Lewati jika tidak ingin merubah password.</span>
                            </div>

                            <div class="form-group">
                                <label for="pwdU" class="form-label">Password</label>
                                <input type="password" name="pwdU" class="form-control" placeholder="Password..">
                            </div>
                            <div class="form-group">
                                <label for="pwdUU" class="form-label">Ulangi Password</label>
                                <input type="password" name="pwdUU" class="form-control" placeholder="Password..">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="alert alert-info" role="alert">
                                <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                                <span class="alert-inner--text">Lewati jika tidak ingin merubah foto.</span>
                            </div>

                            <div class="form-group">
                                <label for="title" class="form-label">Foto</label>
                                <center>
                                    <img src="{{url('/assets/default/users/undraw_profile.svg')}}" width="80%" alt="profile-user" id="outputImgU" class="brround">
                                </center>
                                <input type="hidden" name="flama" id="flama">
                                <input class="form-control mt-5" id="GetFileU" name="photoU" type="file" onchange="VerifyFileNameAndFileSizeU()" accept=".png,.jpeg,.jpg,.svg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan Perubahan <i class="fe fe-check"></i></button>
                    <a href="javascript:void(0)" class="btn btn-light" onclick="resetU()" data-bs-dismiss="modal">Batal <i class="fe fe-x"></i></a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateFormUpdate() {
        const namaL = document.forms["myFormU"]["nmlengkapU"].value;
        const user = document.forms["myFormU"]["usernameU"].value;
        const email = document.forms["myFormU"]["emailU"].value;
        const role = document.forms["myFormU"]["roleU"].value;
        const pwd = document.forms["myFormU"]["pwdU"].value;
        const kpwd = document.forms["myFormU"]["pwdUU"].value;

        resetValidU();

        if (namaL == "") {
            validasi('Nama Lengkap wajib di isi!', 'warning');
            $("input[name='nmlengkapU']").addClass('is-invalid');
            return false;
        } else if (user == '') {
            validasi('Username wajib di isi!', 'warning');
            $("input[name='usernameU']").addClass('is-invalid');
            return false;
        } else if (email == '') {
            validasi('Email wajib di isi!', 'warning');
            $("input[name='emailU']").addClass('is-invalid');
            return false;
        } else if (role == '') {
            validasi('Role wajib di pilih!', 'warning');
            $("select[name='roleU']").addClass('is-invalid');
            return false;
        } else if (pwd !== '' || kpwd !== '') {

            if (pwd.length < 6) {
                validasi('Panjang Password minimal 6 karakter!', 'warning');
                $("input[name='pwdU']").addClass('is-invalid');
                $("input[name='pwdUU']").addClass('is-invalid');
                return false;
            } else if (pwd !== kpwd) {
                validasi('Konfirmasi Password tidak sesuai!', 'warning');
                $("input[name='pwdU']").addClass('is-invalid');
                $("input[name='pwdUU']").addClass('is-invalid');
                return false;
            }

        }

    }

    function resetValidU() {
        $("input[name='nmlengkapU']").removeClass('is-invalid');
        $("input[name='usernameU']").removeClass('is-invalid');
        $("input[name='emailU']").removeClass('is-invalid');
        $("input[name='roleU']").removeClass('is-invalid');
        $("input[name='pwdU']").removeClass('is-invalid');
        $("input[name='pwdUU']").removeClass('is-invalid');
    };

    function resetU() {
        resetValidU();
        $("input[name='nmlengkapU']").val('');
        $("input[name='usernameU']").val('');
        $("input[name='emailU']").val('');
        $("input[name='roleU']").val('');
        $("input[name='pwdU']").val('');
        $("input[name='pwdUU']").val('');
        $("input[name='flama']").val('');
        $("#outputImgU").attr("src", "{{url('/assets/default/users/undraw_profile.svg')}}");
        $("#GetFileU").val('');
    }

    function fileIsValidU(fileName) {
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

    function VerifyFileNameAndFileSizeU() {
        var file = document.getElementById('GetFileU').files[0];


        if (file != null) {
            var fileName = file.name;
            if (fileIsValidU(fileName) == false) {
                validasi('Format bukan gambar!', 'warning');
                document.getElementById('GetFileU').value = null;
                return false;
            }
            var content;
            var size = file.size;
            if ((size != null) && ((size / (1024 * 1024)) > 3)) {
                validasi('Ukuran maximum 1024px', 'warning');
                document.getElementById('GetFileU').value = null;
                return false;
            }

            var ext = fileName.match(/\.([^\.]+)$/)[1];
            ext = ext.toLowerCase();
            // $(".custom-file-label").addClass("selected").html(file.name);
            document.getElementById('outputImgU').src = window.URL.createObjectURL(file);
            return true;

        } else
            return false;
    }
</script>