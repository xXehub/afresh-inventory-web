@extends('Master.Layouts.app', ['title' => $title])
<?php

use App\Models\Admin\AksesModel;
use App\Models\Admin\SubmenuModel; ?>

@section('content')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Akses</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-gray">Settings</li>
            <li class="breadcrumb-item active" aria-current="page">Akses</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- ROW -->
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <h4 class="text-gray">Role</h4>
                            <div class="d-flex">
                                <select name="role" class="form-control">
                                    <option value="">-- Pilih Role --</option>
                                    @foreach($role as $r)
                                    <option value="{{$r->role_id}}" {{$roleid == $r->role_id ? 'selected' : ''}}>{{$r->role_title}}</option>
                                    @endforeach
                                </select>
                                <div class="ms-1">
                                    <button type="submit" onclick="submitRole()" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($detailrole != '')
                    <div class="col-md-7 d-flex justify-content-end align-items-center">
                        <div>
                            @if(Session::get('user')->role_slug != $detailrole->role_slug)
                            <button  class="btn btn-gray me-2" onclick="unsetAll({{$detailrole->role_id}})">Non-aktifkan Semua Akses</button>
                            @else
                            <button disabled class="btn btn-gray me-2">Non-aktifkan Semua Akses</button>
                            @endif
                        </div>
                        <div>
                            <button class="btn btn-primary" onclick="setAll({{$detailrole->role_id}})">Aktifkan Semua Akses</button>
                        </div>
                    </div>
                    @endif
                </div>

                @if($detailrole != '')
                @if(count($menu) > 0)
                <h4 class="text-gray">Hak Akses Menu <span class="badge bg-primary badge-sm">{{$detailrole == '' ? '' : $detailrole->role_title}}</span></h4>
                @endif
                <div class="table-responsive mb-4">
                    <table class="table border text-nowrap text-md-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th width="1%">View</th>
                                <th width="1%">Create</th>
                                <th width="1%">Update</th>
                                <th width="1%">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menu as $m)
                            <tr>
                                <td>
                                    <span class="fw-bold">
                                        {{$m->menu_judul}}
                                    </span>
                                </td>
                                <td>
                                    <?php
                                    $getView = AksesModel::where(array('menu_id' => $m->menu_id, 'role_id' => $roleid, 'akses_type' => 'view'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5" onclick="">
                                        @if($getView == '')
                                        <input type="checkbox" onchange="addAkses('{{$m->menu_id}}', '{{$roleid}}', 'menu', 'view')" name="viewMenu[]" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('{{$m->menu_id}}', '{{$roleid}}', 'menu', 'view')" checked name="viewMenu[]" class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                </td>
                                <td>
                                    @if($getView != '')
                                    <?php
                                    $getCreate = AksesModel::where(array('menu_id' => $m->menu_id, 'role_id' => $roleid, 'akses_type' => 'create'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getCreate == '')
                                        <input type="checkbox" onchange="addAkses('{{$m->menu_id}}', '{{$roleid}}', 'menu', 'create')" name="createMenu[]" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('{{$m->menu_id}}', '{{$roleid}}', 'menu', 'create')" checked name="createMenu[]" class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView != '')
                                    <?php
                                    $getUpdate = AksesModel::where(array('menu_id' => $m->menu_id, 'role_id' => $roleid, 'akses_type' => 'update'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getUpdate == '')
                                        <input type="checkbox" onchange="addAkses('{{$m->menu_id}}', '{{$roleid}}', 'menu', 'update')" name="updateMenu[]" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('{{$m->menu_id}}', '{{$roleid}}', 'menu', 'update')" checked name="updateMenu[]" class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView != '')
                                    <?php
                                    $getDelete = AksesModel::where(array('menu_id' => $m->menu_id, 'role_id' => $roleid, 'akses_type' => 'delete'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getDelete == '')
                                        <input type="checkbox" onchange="addAkses('{{$m->menu_id}}', '{{$roleid}}', 'menu', 'delete')" name="deleteMenu[]" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('{{$m->menu_id}}', '{{$roleid}}', 'menu', 'delete')" checked name="deleteMenu[]" class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if(count($menusub) > 0)
                <h4 class="text-gray">Hak Akses Sub Menu <span class="badge bg-primary badge-sm">{{$detailrole == '' ? '' : $detailrole->role_title}}</span></h4>
                @endif
                @foreach($menusub as $ms)
                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                    <h6 class="fw-bold">{{$ms->menu_judul}}</h6>
                    <?php
                    $getView1 = AksesModel::where(array('menu_id' => $ms->menu_id, 'role_id' => $roleid, 'akses_type' => 'view'))->first();
                    ?>
                    <label class="custom-switch form-switch mb-3">
                        @if($getView1 == '')
                        <input type="checkbox" onchange="addAkses('{{$ms->menu_id}}', '{{$roleid}}', 'menu', 'view')" class="custom-switch-input">
                        @else
                        <input type="checkbox" onchange="removeAkses('{{$ms->menu_id}}', '{{$roleid}}', 'menu', 'view')" checked class="custom-switch-input">
                        @endif
                        <span class="custom-switch-indicator custom-switch-indicator-md"></span>
                    </label>
                </div>
                <div class="table-responsive mb-4">
                    <table class="table border text-nowrap text-md-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th width="1%">View</th>
                                <th width="1%">Create</th>
                                <th width="1%">Update</th>
                                <th width="1%">Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $submenu = SubmenuModel::where('menu_id', '=', $ms->menu_id)->orderBy('submenu_sort', 'ASC')->get();
                            ?>
                            @foreach($submenu as $sm)
                            <tr>
                                <td>
                                    <span class="fw-bold">
                                        {{$sm->submenu_judul}}
                                    </span>
                                </td>
                                <td>
                                    @if($getView1 != '')
                                    <?php
                                    $getView11 = AksesModel::where(array('submenu_id' => $sm->submenu_id, 'role_id' => $roleid, 'akses_type' => 'view'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getView11 == '')
                                        <input type="checkbox" onchange="addAkses('{{$sm->submenu_id}}', '{{$roleid}}', 'submenu', 'view')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('{{$sm->submenu_id}}', '{{$roleid}}', 'submenu', 'view')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses {{$ms->menu_judul}}">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView1 != '')
                                    @if($getView11 != '')
                                    <?php
                                    $getCreate1 = AksesModel::where(array('submenu_id' => $sm->submenu_id, 'role_id' => $roleid, 'akses_type' => 'create'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getCreate1 == '')
                                        <input type="checkbox" onchange="addAkses('{{$sm->submenu_id}}', '{{$roleid}}', 'submenu', 'create')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('{{$sm->submenu_id}}', '{{$roleid}}', 'submenu', 'create')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses {{$ms->menu_judul}}">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView1 != '')
                                    @if($getView11 != '')
                                    <?php
                                    $getUpdate1 = AksesModel::where(array('submenu_id' => $sm->submenu_id, 'role_id' => $roleid, 'akses_type' => 'update'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getUpdate1 == '')
                                        <input type="checkbox" onchange="addAkses('{{$sm->submenu_id}}', '{{$roleid}}', 'submenu', 'update')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('{{$sm->submenu_id}}', '{{$roleid}}', 'submenu', 'update')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses {{$ms->menu_judul}}">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView1 != '')
                                    @if($getView11 != '')
                                    <?php
                                    $getDelete1 = AksesModel::where(array('submenu_id' => $sm->submenu_id, 'role_id' => $roleid, 'akses_type' => 'delete'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getDelete1 == '')
                                        <input type="checkbox" onchange="addAkses('{{$sm->submenu_id}}', '{{$roleid}}', 'submenu', 'delete')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('{{$sm->submenu_id}}', '{{$roleid}}', 'submenu', 'delete')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses {{$ms->menu_judul}}">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                @endforeach

                <div class="d-flex justify-content-between mb-2">
                    <h4 class="text-gray">Hak Akses Settings <span class="badge bg-primary badge-sm">{{$detailrole == '' ? '' : $detailrole->role_title}}</span></h4>
                    <?php
                    $getView2 = AksesModel::where(array('othermenu_id' => 1, 'role_id' => $detailrole->role_id, 'akses_type' => 'view'))->first();
                    ?>
                    @if(Session::get('user')->role_slug != $detailrole->role_slug)
                    <label class="custom-switch form-switch mb-3">
                        @if($getView2 == '')
                        <input type="checkbox" onchange="addAkses('1', '{{$detailrole->role_id}}', 'othermenu', 'view')" class="custom-switch-input">
                        @else
                        <input type="checkbox" onchange="removeAkses('1', '{{$detailrole->role_id}}', 'othermenu', 'view')" checked class="custom-switch-input">
                        @endif
                        <span class="custom-switch-indicator custom-switch-indicator-md"></span>
                    </label>
                    @endif
                </div>

                <div class="table-responsive mb-4">
                    <table class="table border text-nowrap text-md-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th width="1%">View</th>
                                <th width="1%">Create</th>
                                <th width="1%">Update</th>
                                <th width="1%">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span class="fw-bold">
                                        Menu
                                    </span>
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    <?php
                                    $getView21 = AksesModel::where(array('othermenu_id' => 2, 'role_id' => $roleid, 'akses_type' => 'view'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getView21 == '')
                                        <input type="checkbox" onchange="addAkses('2', '{{$roleid}}', 'othermenu', 'view')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('2', '{{$roleid}}', 'othermenu', 'view')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    @if($getView21 != '')
                                    <?php
                                    $getCreate2 = AksesModel::where(array('othermenu_id' => 2, 'role_id' => $roleid, 'akses_type' => 'create'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getCreate2 == '')
                                        <input type="checkbox" onchange="addAkses('2', '{{$roleid}}', 'othermenu', 'create')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('2', '{{$roleid}}', 'othermenu', 'create')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    @if($getView21 != '')
                                    <?php
                                    $getUpdate2 = AksesModel::where(array('othermenu_id' => 2, 'role_id' => $roleid, 'akses_type' => 'update'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getUpdate2 == '')
                                        <input type="checkbox" onchange="addAkses('2', '{{$roleid}}', 'othermenu', 'update')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('2', '{{$roleid}}', 'othermenu', 'update')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    @if($getView21 != '')
                                    <?php
                                    $getDelete2 = AksesModel::where(array('othermenu_id' => 2, 'role_id' => $roleid, 'akses_type' => 'delete'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getDelete2 == '')
                                        <input type="checkbox" onchange="addAkses('2', '{{$roleid}}', 'othermenu', 'delete')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('2', '{{$roleid}}', 'othermenu', 'delete')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fw-bold">
                                        Role
                                    </span>
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    <?php
                                    $getView3 = AksesModel::where(array('othermenu_id' => 3, 'role_id' => $roleid, 'akses_type' => 'view'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getView3 == '')
                                        <input type="checkbox" onchange="addAkses('3', '{{$roleid}}', 'othermenu', 'view')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('3', '{{$roleid}}', 'othermenu', 'view')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    @if($getView3 != '')
                                    <?php
                                    $getCreate3 = AksesModel::where(array('othermenu_id' => 3, 'role_id' => $roleid, 'akses_type' => 'create'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getCreate3 == '')
                                        <input type="checkbox" onchange="addAkses('3', '{{$roleid}}', 'othermenu', 'create')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('3', '{{$roleid}}', 'othermenu', 'create')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    @if($getView3 != '')
                                    <?php
                                    $getUpdate3 = AksesModel::where(array('othermenu_id' => 3, 'role_id' => $roleid, 'akses_type' => 'update'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getUpdate3 == '')
                                        <input type="checkbox" onchange="addAkses('3', '{{$roleid}}', 'othermenu', 'update')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('3', '{{$roleid}}', 'othermenu', 'update')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    @if($getView3 != '')
                                    <?php
                                    $getDelete3 = AksesModel::where(array('othermenu_id' => 3, 'role_id' => $roleid, 'akses_type' => 'delete'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getDelete3 == '')
                                        <input type="checkbox" onchange="addAkses('3', '{{$roleid}}', 'othermenu', 'delete')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('3', '{{$roleid}}', 'othermenu', 'delete')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fw-bold">
                                        User
                                    </span>
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    <?php
                                    $getView4 = AksesModel::where(array('othermenu_id' => 4, 'role_id' => $roleid, 'akses_type' => 'view'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getView4 == '')
                                        <input type="checkbox" onchange="addAkses('4', '{{$roleid}}', 'othermenu', 'view')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('4', '{{$roleid}}', 'othermenu', 'view')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    @if($getView4 != '')
                                    <?php
                                    $getCreate4 = AksesModel::where(array('othermenu_id' => 4, 'role_id' => $roleid, 'akses_type' => 'create'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getCreate4 == '')
                                        <input type="checkbox" onchange="addAkses('4', '{{$roleid}}', 'othermenu', 'create')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('4', '{{$roleid}}', 'othermenu', 'create')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    @if($getView4 != '')
                                    <?php
                                    $getUpdate4 = AksesModel::where(array('othermenu_id' => 4, 'role_id' => $roleid, 'akses_type' => 'update'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getUpdate4 == '')
                                        <input type="checkbox" onchange="addAkses('4', '{{$roleid}}', 'othermenu', 'update')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('4', '{{$roleid}}', 'othermenu', 'update')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    @if($getView4 != '')
                                    <?php
                                    $getDelete4 = AksesModel::where(array('othermenu_id' => 4, 'role_id' => $roleid, 'akses_type' => 'delete'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getDelete4 == '')
                                        <input type="checkbox" onchange="addAkses('4', '{{$roleid}}', 'othermenu', 'delete')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('4', '{{$roleid}}', 'othermenu', 'delete')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                            </tr>
                            @if(Session::get('user')->role_slug != $detailrole->role_slug)
                            <tr>
                                <td>
                                    <span class="fw-bold">
                                        Akses
                                    </span>
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    <?php
                                    $getView5 = AksesModel::where(array('othermenu_id' => 5, 'role_id' => $detailrole->role_id, 'akses_type' => 'view'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getView5 == '')
                                        <input type="checkbox" onchange="addAkses('5', '{{$detailrole->role_id}}', 'othermenu', 'view')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('5', '{{$detailrole->role_id}}', 'othermenu', 'view')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    @if($getView5 != '')
                                    <?php
                                    $getCreate5 = AksesModel::where(array('othermenu_id' => 5, 'role_id' => $detailrole->role_id, 'akses_type' => 'create'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getCreate5 == '')
                                        <input type="checkbox" onchange="addAkses('5', '{{$detailrole->role_id}}', 'othermenu', 'create')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('5', '{{$detailrole->role_id}}', 'othermenu', 'create')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    @if($getView5 != '')
                                    <?php
                                    $getUpdate5 = AksesModel::where(array('othermenu_id' => 5, 'role_id' => $detailrole->role_id, 'akses_type' => 'update'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getUpdate5 == '')
                                        <input type="checkbox" onchange="addAkses('5', '{{$detailrole->role_id}}', 'othermenu', 'update')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('5', '{{$detailrole->role_id}}', 'othermenu', 'update')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    @if($getView5 != '')
                                    <?php
                                    $getDelete5 = AksesModel::where(array('othermenu_id' => 5, 'role_id' => $detailrole->role_id, 'akses_type' => 'delete'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getDelete5 == '')
                                        <input type="checkbox" onchange="addAkses('5', '{{$detailrole->role_id}}', 'othermenu', 'delete')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('5', '{{$detailrole->role_id}}', 'othermenu', 'delete')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                            </tr>
                            @endif

                            <tr>
                                <td>
                                    <span class="fw-bold">
                                        Web
                                    </span>
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    <?php
                                    $getView6 = AksesModel::where(array('othermenu_id' => 6, 'role_id' => $detailrole->role_id, 'akses_type' => 'view'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getView6 == '')
                                        <input type="checkbox" onchange="addAkses('6', '{{$detailrole->role_id}}', 'othermenu', 'view')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('6', '{{$detailrole->role_id}}', 'othermenu', 'view')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    @if($getView6 != '')
                                    <?php
                                    $getCreate6 = AksesModel::where(array('othermenu_id' => 6, 'role_id' => $detailrole->role_id, 'akses_type' => 'create'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getCreate6 == '')
                                        <input type="checkbox" onchange="addAkses('6', '{{$detailrole->role_id}}', 'othermenu', 'create')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('6', '{{$detailrole->role_id}}', 'othermenu', 'create')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    @if($getView6 != '')
                                    <?php
                                    $getUpdate6 = AksesModel::where(array('othermenu_id' => 6, 'role_id' => $detailrole->role_id, 'akses_type' => 'update'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getUpdate6 == '')
                                        <input type="checkbox" onchange="addAkses('6', '{{$detailrole->role_id}}', 'othermenu', 'update')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('6', '{{$detailrole->role_id}}', 'othermenu', 'update')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                                <td>
                                    @if($getView2 != '')
                                    @if($getView6 != '')
                                    <?php
                                    $getDelete6 = AksesModel::where(array('othermenu_id' => 6, 'role_id' => $detailrole->role_id, 'akses_type' => 'delete'))->first();
                                    ?>
                                    <label class="custom-switch form-switch me-5">
                                        @if($getDelete6 == '')
                                        <input type="checkbox" onchange="addAkses('6', '{{$detailrole->role_id}}', 'othermenu', 'delete')" class="custom-switch-input">
                                        @else
                                        <input type="checkbox" onchange="removeAkses('6', '{{$detailrole->role_id}}', 'othermenu', 'delete')" checked class="custom-switch-input">
                                        @endif
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses view">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                    @else
                                    <label class="custom-switch form-switch me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Aktifkan akses Settings">
                                        <input type="checkbox" disabled name="custom-switch-checkbox1" class="custom-switch-input">
                                        <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                                    </label>
                                    @endif
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                @endif

            </div>

        </div>
    </div>
</div>
<!-- END ROW -->

@endsection

@section('scripts')
<script>
    function submitRole() {
        role = $('select[name="role"]').val();
        if (role != '') {
            window.location.href = "{{ url('/admin/akses') }}/" + parseInt(role);
        } else {
            window.location.href = "{{ url('/admin/akses') }}/" + "role";
        }
    }

    function addAkses(idmenu, idrole, type, akses) {
        window.location.href = "{{ url('/admin/akses/addAkses') }}/" + idmenu + '/' + parseInt(idrole) + "/" + type + "/" + akses;
    }

    function removeAkses(idmenu, idrole, type, akses) {
        window.location.href = "{{ url('/admin/akses/removeAkses') }}/" + idmenu + '/' + parseInt(idrole) + "/" + type + "/" + akses;
    }

    function setAll(idrole) {
        window.location.href = "{{ url('/admin/akses/setAll') }}/" + parseInt(idrole);
    }

    function unsetAll(idrole) {
        window.location.href = "{{ url('/admin/akses/unsetAll') }}/" + parseInt(idrole);
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