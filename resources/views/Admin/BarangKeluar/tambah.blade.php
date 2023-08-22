<!-- MODAL TAMBAH -->
<div class="modal fade" data-bs-backdrop="static" id="modaldemo8">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Tambah Barang Keluar</h6><button aria-label="Close" onclick="reset()" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bkkode" class="form-label">Kode Barang Keluar <span class="text-danger">*</span></label>
                            <input type="text" name="bkkode" readonly class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="tglkeluar" class="form-label">Tanggal Keluar <span class="text-danger">*</span></label>
                            <input type="text" name="tglkeluar" class="form-control datepicker-date" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <input type="text" name="tujuan" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode Barang <span class="text-danger me-1">*</span>
                                <input type="hidden" id="status" value="false">
                                <div class="spinner-border spinner-border-sm d-none" id="loaderkd" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control" autocomplete="off" name="kdbarang" placeholder="">
                                <button class="btn btn-primary-light" onclick="searchBarang()" type="button"><i class="fe fe-search"></i></button>
                                <button class="btn btn-success-light" onclick="modalBarang()" type="button"><i class="fe fe-box"></i></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" id="nmbarang" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" class="form-control" id="satuan" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis</label>
                                    <input type="text" class="form-control" id="jenis" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jml" class="form-label">Jumlah Keluar <span class="text-danger">*</span></label>
                            <input type="text" name="jml" value="0" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary d-none" id="btnLoader" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <a href="javascript:void(0)" onclick="checkForm()" id="btnSimpan" class="btn btn-primary">Simpan <i class="fe fe-check"></i></a>
                <a href="javascript:void(0)" class="btn btn-light" onclick="reset()" data-bs-dismiss="modal">Batal <i class="fe fe-x"></i></a>
            </div>
        </div>
    </div>
</div>


@section('formTambahJS')
<script>
    $('input[name="kdbarang"]').keypress(function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            getbarangbyid($('input[name="kdbarang"]').val());
        }
    });

    function modalBarang() {
        $('#modalBarang').modal('show');
        $('#modaldemo8').addClass('d-none');
        $('input[name="param"]').val('tambah');
        resetValid();
        table2.ajax.reload();
    }

    function searchBarang() {
        getbarangbyid($('input[name="kdbarang"]').val());
        resetValid();
    }

    function getbarangbyid(id) {
        $("#loaderkd").removeClass('d-none');
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/barang/getbarang') }}/" + id,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                if (data.length > 0) {
                    $("#loaderkd").addClass('d-none');
                    $("#status").val("true");
                    $("#nmbarang").val(data[0].barang_nama);
                    $("#satuan").val(data[0].satuan_nama);
                    $("#jenis").val(data[0].jenisbarang_nama);
                } else {
                    $("#loaderkd").addClass('d-none');
                    $("#status").val("false");
                    $("#nmbarang").val('');
                    $("#satuan").val('');
                    $("#jenis").val('');
                }
            }
        });
    }

    function checkForm() {
        const tglkeluar = $("input[name='tglkeluar']").val();
        const status = $("#status").val();
        const jml = $("input[name='jml']").val();
        setLoading(true);
        resetValid();

        if (tglkeluar == "") {
            validasi('Tanggal Keluar wajib di isi!', 'warning');
            $("input[name='tglkeluar']").addClass('is-invalid');
            setLoading(false);
            return false;
        } else if (status == "false") {
            validasi('Barang wajib di pilih!', 'warning');
            $("input[name='kdbarang']").addClass('is-invalid');
            setLoading(false);
            return false;
        } else if (jml == "" || jml == "0") {
            validasi('Jumlah Keluar wajib di isi!', 'warning');
            $("input[name='jml']").addClass('is-invalid');
            setLoading(false);
            return false;
        } else {
            submitForm();
        }

    }

    function submitForm() {
        const bkkode = $("input[name='bkkode']").val();
        const tglkeluar = $("input[name='tglkeluar']").val();
        const kdbarang = $("input[name='kdbarang']").val();
        const tujuan = $("input[name='tujuan']").val();
        const jml = $("input[name='jml']").val();

        $.ajax({
            type: 'POST',
            url: "{{ route('barang-keluar.store') }}",
            enctype: 'multipart/form-data',
            data: {
                bkkode: bkkode,
                tglkeluar: tglkeluar,
                barang: kdbarang,
                tujuan: tujuan,
                jml: jml
            },
            success: function(data) {
                $('#modaldemo8').modal('toggle');
                swal({
                    title: "Berhasil ditambah!",
                    type: "success"
                });
                table.ajax.reload(null, false);
                reset();

            }
        });
    }

    function resetValid() {
        $("input[name='tglkeluar']").removeClass('is-invalid');
        $("input[name='kdbarang']").removeClass('is-invalid');
        $("input[name='tujuan']").removeClass('is-invalid');
        $("input[name='jml']").removeClass('is-invalid');
    };

    function reset() {
        resetValid();
        $("input[name='bkkode']").val('');
        $("input[name='tglkeluar']").val('');
        $("input[name='kdbarang']").val('');
        $("input[name='tujuan']").val('');
        $("input[name='jml']").val('0');
        $("#nmbarang").val('');
        $("#satuan").val('');
        $("#jenis").val('');
        $("#status").val('false');
        setLoading(false);
    }

    function setLoading(bool) {
        if (bool == true) {
            $('#btnLoader').removeClass('d-none');
            $('#btnSimpan').addClass('d-none');
        } else {
            $('#btnSimpan').removeClass('d-none');
            $('#btnLoader').addClass('d-none');
        }
    }
</script>
@endsection