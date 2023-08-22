@extends('Master.Layouts.app', ['title' => $title])

@section('content')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Pengaturan Website</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-gray">Admin</li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan Website</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<div class="row">
    <div class="col-12 col-md-12 col-lg-6 mb-4">
        <div class="card border-0 shadow">
            <div class="card-header">
                <h6 class="fw-bold mt-2">Profil Website</h6>
            </div>
            <div class="card-body">
                @foreach($data as $d)

                <div class="text-center py-5 mb-4">
                    @if($d->web_logo == '' || $d->web_logo == 'default.png')
                    <img src="{{ url('assets/default/web/default.png') }}" alt="logo" width="120">
                    @else
                    <img src="{{asset('storage/web/' . $d->web_logo)}}" alt="logo" width="120">
                    @endif
                </div>

                @endforeach

                <div class="d-flex justify-content-between mx-4">
                    <h6 class="mr-4">Judul Website</h6>
                    <h6 class="font-weight-bold">{{$d->web_nama}}</h6>
                </div>

                <hr class="">

                <div class="d-flex justify-content-between mx-4">
                    <h6 class="mr-4">Deskripsi</h6>
                    <h6 class="font-weight-bold">{{$d->web_deskripsi == "" ? "-" : $d->web_deskripsi}}</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-6 mb-4">
        <form action="{{ route('web.update', $d->web_id) }}" method="POST" name="myForm" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="card shadow border-0">
                <div class="card-header">
                    <h6 class="mt-2 fw-bold">Ubah Pengaturan</h6>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="alert alert-info alert-icon d-flex shadow" role="alert">
                        <div class="alert-icon-aside">
                            <i class="fa fa-exclamation-circle"></i>
                        </div>
                        <div class="alert-icon-content ms-1 mt-1">
                            <h6 class="alert-heading">Extensi Gambar</h6>
                            .jpg .jpeg .png
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="formFile" class="form-label mt-0">Logo</label>
                        <input class="form-control" id="GetFile" name="photo" type="file" accept=".png,.jpeg,.jpg,.svg" onchange="VerifyFileNameAndFileSize()">
                    </div>

                    <div class="form-group">
                        <label>Judul Website</label>
                        <input type="text" class="form-control" name="nmweb" value="{{$d->web_nama}}">
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Website</label>
                        <textarea name="desk" rows="5" class="form-control">{{$d->web_deskripsi}}</textarea>
                    </div>


                </div>

                <div class="card-footer">
                    <div class="mb-2">
                        <button type="submit" class="btn btn-success btn-md shadow">Simpan Perubahan
                            <i class="fa fa-check-circle"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function validateForm() {
        var nmweb = document.forms["myForm"]["nmweb"].value;

        if (nmweb == "") {
            validasi('Judul Website wajib di isi!', 'warning');
            $("input[name='nmweb']").addClass('is-invalid');
            return false;
        }

    }

    function validasi(judul, status) {
        swal({
            title: judul,
            type: status,
            confirmButtonText: "Iya."
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
            return true;

        } else
            return false;
    }
</script>
@endsection