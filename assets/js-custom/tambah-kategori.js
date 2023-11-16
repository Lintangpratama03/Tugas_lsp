get_data();
$(function () {
	bsCustomFileInput.init();
});

function delete_error() {
    $("#error-keterangan").hide();
    $("#error-kategori").hide();
}

function insert_data() {
    var formData = new FormData();
    formData.append("keterangan", $("[name='keterangan']").val());
    formData.append("nama", $("[name='nama']").val());
    openTambahKategoriModal()
        .then(function () {
            return $.ajax({
                type: "POST",
                url: base_url + "/" + _controller + "/insert_data",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false
            });
        })
        .then(function (response) {
            delete_error();

            if (response.errors) {
                for (var fieldName in response.errors) {
                    $("#error-" + fieldName).show();
                    $("#error-" + fieldName).html(response.errors[fieldName]);
                }
            } else if (response.success) {
                window.location.href = "/Tugas_lsp/kategori";
            }
        })
        .catch(function (error) {
            console.error("AJAX Error: " + error);
        });
}

function openTambahKategoriModal() {
    return new Promise(function (resolve, reject) {
        $('#tambahKategori').modal('show');

        $('#btn-cancel').on('click', function () {
            $('#tambahKategori').modal('hide');
            reject();
        });
        $('#tambahKategori').on('hidden.bs.modal', function () {
            resolve();
        });
    });
}
