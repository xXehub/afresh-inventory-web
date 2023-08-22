<!-- MODAL EFFECTS -->
<div class="modal fade" data-bs-backdrop="static" id="Umodaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Ubah Menu</h6><button aria-label="Close" onclick="resetU()" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" name="myFormU" id="myFormU" enctype="multipart/form-data" onsubmit="return validateFormUpdate()">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="uicon" class="form-label">Icon</label>
                        <span class="text-gray d-block mb-1">Cari & salin nama dari Icon <a target="_blank" href="https://feathericons.com/">https://feathericons.com/</a></span></span>
                        <div class="input-group">
                            <span class="input-group-text bg-gray-light" id="basic-addon1">fe-</span>
                            <input type="text" id="uicon" name="uicon" class="form-control" placeholder="home" aria-label="icon" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ujudul" class="form-label">Judul</label>
                        <input type="text" id="ujudul" name="ujudul" class="form-control" placeholder="Judul Menu">
                    </div>
                    <div class="form-group">
                        <label for="type" class="form-label">Type</label>
                        <select name="utype" class="form-control" onchange="setTypeU()">
                            <option value="">-- Pilih --</option>
                            <option value="1">Menu</option>
                            <option value="2">Sub Menu</option>
                        </select>
                    </div>
                    <div class="form-group d-none" id="vTypeMenuU">
                        <label for="Uredirect" class="form-label">Redirect</label>
                        <input type="text" id="uredirect" name="uredirect" class="form-control" placeholder="/redirect">
                    </div>
                    <div class="form-group d-none" id="vTypeSubU">
                        <div class="d-flex justify-content-end mb-2">
                            <input type="hidden" id="urandkey">
                            <button type="button" onclick="addSubU()" class="btn btn-primary-light">Tambah Sub Menu <i class="fa fa-plus"></i></button>
                        </div>
                        <ul class="list-group" id="ulistsub"></ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan Perubahan <i class="fe fe-check"></i></button>
                    <a href="javascript:void(0)" onclick="resetU()" class="btn btn-light" data-bs-dismiss="modal">Batal <i class="fe fe-x"></i></a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateFormUpdate() {
        const icon = document.forms["myFormU"]["uicon"].value;
        const judul = document.forms["myFormU"]["ujudul"].value;
        const redirect = document.forms["myFormU"]["uredirect"].value;
        const type = document.forms["myFormU"]["utype"].value;

        if (icon == "") {
            validasi('Icon wajib di isi!', 'warning');
            $("input[name='uicon']").addClass('is-invalid');
            return false;
        } else if (judul == '') {
            validasi('Judul wajib di isi!', 'warning');
            $("input[name='ujudul']").addClass('is-invalid');
            return false;
        } else if (type == '') {
            validasi('Type wajib di pilih!', 'warning');
            $("input[name='utype']").addClass('is-invalid');
            return false;
        } else if (type == 1) {
            if (redirect == "") {
                validasi('Redirect wajib di isi!', 'warning');
                $("input[name='uredirect']").addClass('is-invalid');
                return false;
            }
        } else if (type == 2) {
            if ($('#ulistsub li').length == 0) {
                validasi('Belum ada Sub Menu!', 'warning');
                return false;
            }
        }

    }

    function resetU() {
        $("input[name='uicon']").val('');
        $("input[name='ujudul']").val('');
        $("select[name='utype']").val('');
        $("input[name='uredirect']").val('');
        $("#ulistsub").empty();
        setTypeU();
    }

    document.getElementById('urandkey').value = makeid(10);

    function setTypeU() {
        if ($("select[name='utype']").val() == 1) {
            $("#vTypeMenuU").removeClass('d-none');
            $("#vTypeSubU").addClass('d-none');
        } else if ($("select[name='utype']").val() == 2) {
            $("#vTypeMenuU").addClass('d-none');
            $("#vTypeSubU").removeClass('d-none');
        } else {
            $("#vTypeMenuU").addClass('d-none');
            $("#vTypeSubU").addClass('d-none');
        }
    }

    function setSub(data) {
        for (let i = 0; i < data.length; i++) {
            const key = $("#urandkey").val();
            $("#ulistsub").append('<li class="list-group-item list-sub-menu p-0" id="' + key + '">' +
                '<div class="d-flex">' +
                '<input type="text" autocomplete="off" value="' + data[i].submenu_judul + '" name="usubjudul[]" class="form-control border-0 me-4" placeholder="Sub Menu">' +
                '<input type="text" autocomplete="off" value="' + data[i].submenu_redirect + '" name="uredirectsub[]" class="form-control border-0" placeholder="/redirect">' +
                '<div class="p-2"><button onclick="hapusSubU(`' + key + '`)" type="button" class="btn btn-danger-light"><i class="fa fa-trash"></i></button></div>' +
                '</div>' +
                '</li>'
            );
            $("#urandkey").val(makeid(10));
        }
    }

    function addSubU() {
        const key = $("#urandkey").val();
        $("#ulistsub").append('<li class="list-group-item list-sub-menu p-0" id="' + key + '">' +
            '<div class="d-flex">' +
            '<input type="text" autocomplete="off" name="usubjudul[]" class="form-control border-0 me-4" placeholder="Sub Menu">' +
            '<input type="text" autocomplete="off" name="uredirectsub[]" class="form-control border-0" placeholder="/redirect">' +
            '<div class="p-2"><button onclick="hapusSub(`' + key + '`)" type="button" class="btn btn-danger-light"><i class="fa fa-trash"></i></button></div>' +
            '</div>' +
            '</li>'
        );
        $("#urandkey").val(makeid(10));
    }

    function hapusSubU(key) {
        $("#" + key).remove();
    }
</script>