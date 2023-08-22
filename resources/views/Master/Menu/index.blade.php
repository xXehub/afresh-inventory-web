@extends('Master.Layouts.app', ['title' => $title])

<?php

use App\Models\Admin\SubmenuModel;
?>

@section('content')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Menu</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-gray">Settings</li>
            <li class="breadcrumb-item active" aria-current="page">Menu</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- Row -->
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3 class="card-title">List Menu</h3>
                <div>
                    <a class="modal-effect btn btn-primary-light" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#modaldemo8">Tambah Data <i class="fe fe-plus"></i></a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table border text-nowrap text-md-nowrap table-bordered mb-0">
                        <thead>
                            <tr>
                                <th class="border-bottom-0" width="1%">Sort</th>
                                <th class="border-bottom-0" width="1%">Icon</th>
                                <th class="border-bottom-0">Judul</th>
                                <th class="border-bottom-0">Type</th>
                                <th class="border-bottom-0">Redirect</th>
                                <th class="border-bottom-0" width="1%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>
                                <td>
                                    <span class="me-4">{{$d->menu_sort}}</span>
                                    <button type="button" onclick="sortup('{{$d->menu_sort}}')" class="btn btn-icon btn-sm {{$d->menu_sort == 1 ? 'btn-gray' : 'btn-success'}}" {{$d->menu_sort == 1 ? "disabled" : ""}}><i class="fe fe-arrow-up"></i></button>
                                    <button type="button" onclick="sortdown('{{$d->menu_sort}}')" class="btn btn-icon btn-sm {{$d->menu_sort == count($data) ? 'btn-gray' : 'btn-success'}}" {{$d->menu_sort == count($data) ? "disabled" : ""}}><i class="fe fe-arrow-down"></i></button>
                                </td>
                                <td align="center"><i class="fe fe-{{$d->menu_icon}} text-primary"></i></td>
                                <td>{{$d->menu_judul}}</td>
                                <td>
                                    @if($d->menu_type == 1)
                                    <span class="badge bg-primary badge-sm mb-1 mt-1">Menu</span>
                                    @elseif($d->menu_type == 2)
                                    <span class="badge bg-success badge-sm mb-1 mt-1">Sub Menu</span>
                                    @endif
                                </td>
                                <td>
                                    @if($d->menu_type == 1)
                                    <span class="text-gray fw-medium">{{$d->menu_redirect}}</span>
                                    @elseif($d->menu_type == 2)
                                    <?php
                                    $submenu = SubmenuModel::where('menu_id', '=', $d->menu_id)->orderBy('submenu_sort', 'ASC')->get();
                                    ?>
                                    @foreach($submenu as $sub)
                                    <div>
                                        <span class="badge bg-success badge-sm me-1 mb-1 mt-1">{{$sub->submenu_judul}}</span>
                                        <span class="badge bg-default text-gray badge-sm mb-1 mt-1">{{$sub->submenu_redirect}}</span>
                                    </div>
                                    @endforeach

                                    @endif
                                </td>
                                <td>
                                    <div class="g-2">
                                        @if($d->menu_type == 1)
                                        <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick="update({{$d}})"><span class="fe fe-edit text-success fs-14"></span></a>
                                        @elseif($d->menu_type == 2)
                                        <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick="updatewithsub({{$d}},{{$submenu}})"><span class="fe fe-edit text-success fs-14"></span></a>
                                        @endif
                                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick="hapus({{$d}})"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->

@include('Master.Menu.tambah')
@include('Master.Menu.ubah')
@include('Master.Menu.hapus')

<script>
    function sortup(sort) {
        window.location.href = "{{ url('/admin/menu/sortup') }}/" + sort;
    }

    function sortdown(sort) {
        window.location.href = "{{ url('/admin/menu/sortdown') }}/" + sort;
    }
</script>

<script>
    function update(data) {
        $("#myFormU").attr("action", "{{url('/admin/menu')}}/" + data.menu_id);
        $("input[name='uicon']").val(data.menu_icon);
        $("input[name='ujudul']").val(data.menu_judul);
        $("select[name='utype']").val(data.menu_type);
        $("input[name='uredirect']").val(data.menu_redirect);
        setTypeU();
    }

    function updatewithsub(data,sub) {
        $("#myFormU").attr("action", "{{url('/admin/menu')}}/" + data.menu_id);
        $("input[name='uicon']").val(data.menu_icon);
        $("input[name='ujudul']").val(data.menu_judul);
        $("select[name='utype']").val(data.menu_type);
        $("input[name='uredirect']").val(data.menu_redirect);
        setTypeU();
        setSub(sub);
    }

    function hapus(data) {
        $("input[name='idmenu']").val(data.menu_id);
        $("#vmenu").html("menu " + "<b>" + data.menu_judul + "</b>");
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