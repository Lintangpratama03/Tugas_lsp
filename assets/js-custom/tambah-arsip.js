get_data();
$(function () {
	bsCustomFileInput.init();
});

function delete_error() {
    $("#error-judul").hide();
    $("#error-kategori").hide();
    $("#error-nomorSurat").hide();
    $("#error-pdf").hide();
}

function insert_data() {
    var formData = new FormData();
    formData.append("judul", $("[name='judul']").val());
    formData.append("nomorSurat", $("[name='nomorSurat']").val());
    formData.append("kategori", $("#kategori").val());

    var pdfInput = $("[name='pdf']")[0];
    if (pdfInput.files.length > 0) {
        formData.append("pdf", pdfInput.files[0]);
    }

    openTambahArsipModal()
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
                window.location.href = "/Tugas_lsp/arsip";
            }
        })
        .catch(function (error) {
            console.error("AJAX Error: " + error);
        });
}

function openTambahArsipModal() {
    return new Promise(function (resolve, reject) {
        $('#tambahArsip').modal('show');

        $('#btn-cancel').on('click', function () {
            $('#tambahArsip').modal('hide');
            reject();
        });
        $('#tambahArsip').on('hidden.bs.modal', function () {
            resolve();
        });
    });
}

document.getElementById('pdf').addEventListener('change', function () {
    var fileInput = this;
    var label = document.getElementById('label');
    var selectedFileName = document.getElementById('selectedFileName');

    if (fileInput.files.length > 0) {
        label.textContent = fileInput.files[0].name;
        selectedFileName.textContent = "File selected: " + fileInput.files[0].name;
    } else {
        label.textContent = "Pilih file";
        selectedFileName.textContent = "";
    }
});
