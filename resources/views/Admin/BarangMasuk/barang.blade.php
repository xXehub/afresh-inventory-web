<!-- MODAL BARANG -->
<div class="modal fade" data-bs-backdrop="static" style="overflow-y:scroll;" id="modalBarang">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Pilih Barang</h6><button onclick="resetB('tambah')" aria-label="Close" class="btn-close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body p-4 pb-5">
                <input type="hidden" value="tambah" name="param">
                <input type="hidden" id="randkey">
                <div class="table-responsive">
                    <table id="table-2" width="100%" class="table table-bordered text-nowrap border-bottom dataTable no-footer dtr-inline collapsed">
                        <thead>
                            <th class="border-bottom-0" width="1%">No</th>
                            <th class="border-bottom-0">Gambar</th>
                            <th class="border-bottom-0">Kode Barang</th>
                            <th class="border-bottom-0">Nama Barang</th>
                            <th class="border-bottom-0">Jenis</th>
                            <th class="border-bottom-0">Satuan</th>
                            <th class="border-bottom-0">Merk</th>
                            <th class="border-bottom-0">Stok</th>
                            <th class="border-bottom-0">Harga</th>
                            <th class="border-bottom-0" width="1%">Action</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('formOtherJS')
<script>
    document.getElementById('randkey').value = makeid(10);

    function resetB() {
        param = $('input[name="param"]').val();
        if (param == 'tambah') {
            $('#modalBarang').modal('hide');
            $('#modaldemo8').removeClass('d-none');
        } else {
            $('#modalBarang').modal('hide');
            $('#Umodaldemo8').removeClass('d-none');
        }

    }

    function pilihBarang(data) {
        const key = $("#randkey").val();
        $("#status").val("true");
        $("input[name='kdbarang']").val(data.barang_kode);
        $("#nmbarang").val(data.barang_nama.replace(/_/g, ' '));
        $("#satuan").val(data.satuan_nama.replace(/_/g, ' '));
        $("#jenis").val(data.jenisbarang_nama.replace(/_/g, ' '));
        $('#modaldemo8').removeClass('d-none');
        $('#modalBarang').modal('hide');
    }

    function pilihBarangU(data) {
        const key = $("#randkey").val();
        $("#statusU").val("true");
        $("input[name='kdbarangU']").val(data.barang_kode);
        $("#nmbarangU").val(data.barang_nama.replace(/_/g, ' '));
        $("#satuanU").val(data.satuan_nama.replace(/_/g, ' '));
        $("#jenisU").val(data.jenisbarang_nama.replace(/_/g, ' '));
        $('#Umodaldemo8').removeClass('d-none');
        $('#modalBarang').modal('hide');
    }

    var table2;
    $(document).ready(function() {
        //datatables
        table2 = $('#table-2').DataTable({

            "processing": true,
            "serverSide": true,
            "info": false,
            "order": [],
            "ordering": false,
            "scrollX": false,
            // "lengthMenu": [
            //     [5, 10, 25, 50, 100],
            //     [5, 10, 25, 50, 100]
            // ],
            "pageLength": 10,

            "lengthChange": true,

            "ajax": {
                "url": "{{url('admin/barang/listbarang')}}/param",
                "data": function(d) {
                    d.param = $('input[name="param"]').val();
                }
            },

            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'img',
                    name: 'barang_foto',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'barang_kode',
                    name: 'barang_kode',
                },
                {
                    data: 'barang_nama',
                    name: 'barang_nama',
                },
                {
                    data: 'jenisbarang',
                    name: 'jenisbarang_nama',
                },
                {
                    data: 'satuan',
                    name: 'satuan_nama',
                },
                {
                    data: 'merk',
                    name: 'merk_nama'
                },
                {
                    data: 'totalstok',
                    name: 'barang_stok'
                },
                {
                    data: 'currency',
                    name: 'barang_harga'
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

    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
</script>
@endsection