<!-- MODAL EFFECTS -->
<div class="modal fade" data-bs-backdrop="static" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Tambah Menu</h6><button onclick="reset()" aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" action="{{ route('menu.store') }}" name="myForm" enctype="multipart/form-data" onsubmit="return validateForm()">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul" class="form-label">Icon</label>
                        <span class="text-gray d-block mb-1">Cari & salin nama dari Icon <a target="_blank" href="https://feathericons.com/">https://feathericons.com/</a></span></span>
                        <div class="input-group">
                            <span class="input-group-text bg-gray-light" id="basic-addon1">fe-</span>
                            <input type="text" name="icon" class="form-control" placeholder="home" aria-label="icon" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" id="judul" name="judul" class="form-control" placeholder="Judul Menu">
                    </div>
                    <div class="form-group">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" class="form-control" onchange="setType()">
                            <option value="">-- Pilih --</option>
                            <option value="1">Menu</option>
                            <option value="2">Sub Menu</option>
                        </select>
                    </div>
                    <div class="form-group d-none" id="vTypeMenu">
                        <label for="redirect" class="form-label">Redirect</label>
                        <input type="text" id="redirect" name="redirect" class="form-control" placeholder="/redirect">
                    </div>
                    <div class="form-group d-none" id="vTypeSub">
                        <div class="d-flex justify-content-end mb-2">
                            <input type="hidden" id="randkey">
                            <button type="button" onclick="addSub()" class="btn btn-primary-light">Tambah Sub Menu <i class="fa fa-plus"></i></button>
                        </div>
                        <ul class="list-group" id="listsub"></ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan <i class="fe fe-check"></i></button>
                    <a href="javascript:void(0)" onclick="reset()" class="btn btn-light" data-bs-dismiss="modal">Batal <i class="fe fe-x"></i></a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        const icon = document.forms["myForm"]["icon"].value;
        const judul = document.forms["myForm"]["judul"].value;
        const type = document.forms["myForm"]["type"].value;
        const redirect = document.forms["myForm"]["redirect"].value;

        if (icon == "") {
            validasi('Icon wajib di isi!', 'warning');
            $("input[name='icon']").addClass('is-invalid');
            return false;
        } else if (judul == '') {
            validasi('Judul wajib di isi!', 'warning');
            $("input[name='judul']").addClass('is-invalid');
            return false;
        } else if (type == '') {
            validasi('Type wajib di pilih!', 'warning');
            $("input[name='type']").addClass('is-invalid');
            return false;
        } else if (type == 1) {
            if (redirect == "") {
                validasi('Redirect wajib di isi!', 'warning');
                $("input[name='redirect']").addClass('is-invalid');
                return false;
            }
        } else if (type == 2) {
            if ($('#listsub li').length == 0){
                validasi('Belum ada Sub Menu!', 'warning');
                return false;
            }
        }

    }

    function reset() {
        $("input[name='icon']").val('');
        $("input[name='judul']").val('');
        $("select[name='type']").val('');
        $("input[name='redirect']").val('');
        $("#listsub").empty();
        setType();
    }

    document.getElementById('randkey').value = makeid(10);

    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    function setType() {
        $("#listsub").empty();
        if ($("select[name='type']").val() == 1) {
            $("#vTypeMenu").removeClass('d-none');
            $("#vTypeSub").addClass('d-none');
        } else if ($("select[name='type']").val() == 2) {
            $("#vTypeMenu").addClass('d-none');
            $("#vTypeSub").removeClass('d-none');
        } else {
            $("#vTypeMenu").addClass('d-none');
            $("#vTypeSub").addClass('d-none');
        }
    }


    function addSub() {
        const key = $("#randkey").val();
        $("#listsub").append('<li class="list-group-item list-sub-menu p-0" id="' + key + '">' +
            '<div class="d-flex">' +
            '<input type="text" autocomplete="off" required name="subjudul[]" class="form-control border-0 me-4" placeholder="Sub Menu">' +
            '<input type="text" autocomplete="off" required name="redirectsub[]" class="form-control border-0" placeholder="/redirect">' +
            '<div class="p-2"><button onclick="hapusSub(`' + key + '`)" type="button" class="btn btn-danger-light"><i class="fa fa-trash"></i></button></div>' +
            '</div>' +
            '</li>'
        );
        $("#randkey").val(makeid(10));
    }

    function hapusSub(key) {
        $("#" + key).remove();
    }
</script>