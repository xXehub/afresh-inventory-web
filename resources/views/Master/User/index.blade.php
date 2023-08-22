@extends('Master.Layouts.app', ['title' => $title])

@section('content')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">User</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-gray">Settings</li>
            <li class="breadcrumb-item text-gray">User</li>
            <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- ROW -->
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3 class="card-title">List User</h3>
                <div>
                    <a class="modal-effect btn btn-primary-light" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#modaldemo8">Tambah Data <i class="fe fe-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-1" width="100%" class="table table-bordered text-nowrap border-bottom dataTable no-footer dtr-inline collapsed">
                        <thead>
                            <th class="border-bottom-0" width="1%">No</th>
                            <th class="border-bottom-0">Foto</th>
                            <th class="border-bottom-0">Nama Lengkap</th>
                            <th class="border-bottom-0">Username</th>
                            <th class="border-bottom-0">Email</th>
                            <th class="border-bottom-0">Role</th>
                            <th class="border-bottom-0" width="1%">Action</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END ROW -->

@include('Master.User.tambah', ['role' => $role])
@include('Master.User.ubah', ['role' => $role])
@include('Master.User.hapus')

<script>
    function update(data) {
        $("#myFormU").attr("action", "{{url('/admin/user')}}/" + data.user_id);
        $("input[name='nmlengkapU']").val(data.user_nmlengkap.replace(/_/g, ' '));
        $("input[name='usernameU']").val(data.user_nama.replace(/_/g, ' '));
        $("input[name='emailU']").val(data.user_email);
        $("select[name='roleU']").val(data.role_id);
        $("input[name='flama']").val(data.user_foto);
        if(data.user_foto != 'undraw_profile.svg'){
            $("#outputImgU").attr("src", "{{asset('storage/users/')}}"+"/"+data.user_foto);
        }
    }

    function hapus(data) {
        $("input[name='iduser']").val(data.user_id);
        $("#vuser").html("user " + "<b>" + data.user_nama + "</b>");
    }

    function validasi(judul, status) {
        swal({
            title: judul,
            type: status,
            confirmButtonText: "Iya."
        });
    }
</script>

@endsection

@section('scripts')
<script>
    var table;
    $(document).ready(function() {
        //datatables
        table = $('#table-1').DataTable({

            "processing": true,
            "serverSide": true,
            "info": true,
            "order": [],
            "lengthMenu": [
                [5, 10, 25, 50, 100],
                [5, 10, 25, 50, 100]
            ],
            "pageLength": 10,

            lengthChange: true,

            "ajax": {
                "url": "{{route('user.getuser')}}",
            },

            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'img',
                    name: 'user_foto',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'user_nmlengkap',
                    name: 'user_nmlengkap',
                },
                {
                    data: 'user_nama',
                    name: 'user_nama',
                },
                {
                    data: 'user_email',
                    name: 'user_email',
                },
                {
                    data: 'role',
                    name: 'role_title'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],

        });
    });
</script>
@endsection