<!DOCTYPE html>
<html lang="en">

<?php

use App\Models\Admin\BarangkeluarModel;
use App\Models\Admin\BarangmasukModel;
use Carbon\Carbon;
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$web->web_deskripsi}}">
    <meta name="author" content="{{$web->web_nama}}">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- FAVICON -->
    @if($web->web_logo == '' || $web->web_logo == 'default.png')
    <link rel="shortcut icon" type="image/x-icon" href="{{url('/assets/default/web/default.png')}}" />
    @else
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('storage/web/' . $web->web_logo)}}" />
    @endif

    <title>{{$title}}</title>

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        #table1 {
            border-collapse: collapse;
            width: 100%;
            margin-top: 32px;
        }

        #table1 td,
        #table1 th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table1 th {
            padding-top: 12px;
            padding-bottom: 12px;
            color: black;
            font-size: 12px;
        }

        #table1 td {
            font-size: 11px;
        }

        .font-medium {
            font-weight: 500;
        }

        .font-bold {
            font-weight: 600;
        }

        .d-2 {
            display: flex;
            align-items: flex-start;
            margin-top: 32px;
        }
    </style>

</head>

<body onload="window.print()">

    <center>
        @if($web->web_logo == '' || $web->web_logo == 'default.png')
        <img src="{{url('/assets/default/web/default.png')}}" width="80px" alt="">
        @else
        <img src="{{url('/assets/default/web/default.png')}}" width="80px" alt="">
        @endif
    </center>

    <center>
        <h1 class="font-medium">Laporan Stok Barang</h1>
        @if($tglawal == '')
        <h4 class="font-medium">Semua Tanggal</h4>
        @else
        <h4 class="font-medium">{{Carbon::parse($tglawal)->translatedFormat('d F Y')}} - {{Carbon::parse($tglakhir)->translatedFormat('d F Y')}}</h4>
        @endif
    </center>

    <table border="1" id="table1">
        <thead>
            <tr>
                <th align="center" width="1%">NO</th>
                <th>KODE BARANG</th>
                <th>BARANG</th>
                <th>STOK AWAL</th>
                <th>JML MASUK</th>
                <th>JML KELUAR</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach($data as $d)
            <?php 
            if($tglawal == ''){
                $jmlmasuk = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')->leftJoin('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_barangmasuk.customer_id')->where('tbl_barangmasuk.barang_kode', '=', $d->barang_kode)->sum('tbl_barangmasuk.bm_jumlah');
            }else{
                $jmlmasuk = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')->leftJoin('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_barangmasuk.customer_id')->where('tbl_barangmasuk.barang_kode', '=', $d->barang_kode)->whereBetween('bm_tanggal', [$tglawal, $tglakhir])->sum('tbl_barangmasuk.bm_jumlah');
            }

            if ($tglawal != '') {
                $jmlkeluar = BarangkeluarModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangkeluar.barang_kode')->whereBetween('bk_tanggal', [$tglawal, $tglakhir])->where('tbl_barangkeluar.barang_kode', '=', $d->barang_kode)->sum('tbl_barangkeluar.bk_jumlah');
            } else {
                $jmlkeluar = BarangkeluarModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangkeluar.barang_kode')->where('tbl_barangkeluar.barang_kode', '=', $d->barang_kode)->sum('tbl_barangkeluar.bk_jumlah');
            }

            $totalStok = $d->barang_stok + ($jmlmasuk-$jmlkeluar);
            ?>
            <tr>
                <td align="center">{{$no++}}</td>
                <td>{{$d->barang_kode}}</td>
                <td>{{$d->barang_nama}}</td>
                <td align="center">{{$d->barang_stok}}</td>
                <td align="center">{{$jmlmasuk}}</td>
                <td align="center">{{$jmlkeluar}}</td>
                <td align="center">{{$totalStok}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>