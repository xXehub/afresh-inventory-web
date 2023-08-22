@extends('Master.Layouts.app', ['title' => $title])

@section('content')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Role</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-gray">Settings</li>
            <li class="breadcrumb-item text-gray">User</li>
            <li class="breadcrumb-item active" aria-current="page">Role</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- Row -->
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3 class="card-title">List Role</h3>
                <div>
                    <a class="modal-effect btn btn-primary-light" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#modaldemo8">Tambah Data <i class="fe fe-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-1" width="100%" class="table table-bordered text-nowrap border-bottom dataTable no-footer dtr-inline collapsed">
                        <thead>
                            <th class="border-bottom-0" width="1%">No</th>
                            <th class="border-bottom-0">Title</th>
                            <th class="border-bottom-0">Slug</th>
                            <th class="border-bottom-0">Description</th>
                            <th class="border-bottom-0" width="1%">Action</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->

@include('Master.Role.tambah')
@include('Master.Role.ubah')
@include('Master.Role.hapus')

<script>
    function update(data) {
        $("#myFormU").attr("action", "{{url('/admin/role')}}/" + data.role_id);
        $("input[name='utitle']").val(data.role_title.replace(/_/g, ' '));
        $("textarea[name='udesc']").val(data.role_desc.replace(/_/g, ' '));
    }

    function hapus(data) {
        $("input[name='idrole']").val(data.role_id);
        $("#vrole").html("role "+"<b>"+data.role_title+"</b>");
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
                "url": "{{route('role.getrole')}}",
            },

            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'role_title',
                    name: 'role_title',
                },
                {
                    data: 'role_slug',
                    name: 'role_slug',
                },
                {
                    data: 'role_desc',
                    name: 'role_desc'
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