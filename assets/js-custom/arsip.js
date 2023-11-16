get_data();

$("#hapusArsip").on("show.bs.modal", function (e) {
	var button = $(e.relatedTarget);
	var id = button.data("id");
	var modalButton = $(this).find("#btn-hapus");
	modalButton.attr("onclick", "delete_data(" + id + ")");
});

function submit(x) {
	$.ajax({
		type: "POST",
		data: "id=" + x,
		url: base_url + "/" + _controller + "/get_data_id",
		dataType: "json",
		success: function (hasil) {
			$("[name='id']").val(hasil[0].id);
			$("[name='nama']").val(hasil[0].judul);
            var url = hasil[0].file_name;
			$("embed").attr("src", base_url + "assets/surat/" + url);
		},
	  });
}

function get_data() {
	$.ajax({
		url: base_url + "/" + _controller + "/get_data",
		method: "GET",
		dataType: "json",
		success: function (data) {
			var table = $("#example").DataTable({
				destroy: true,
				colReorder: true,
				scrollY: 200,
				data: data,
				columns: [
					{
						data: null,
						render: function (data, type, row, meta) {
							return meta.row + 1;
						},
					},
					{ data: "no_surat" },
					{ data: "nama_kategori" },
					{ data: "judul" },
					{ data: "waktu" },
					{
						data: null,
						className: "text-center",
						render: function (data, type, row) {
							return (
								'<button class="btn btn-danger" data-toggle="modal" data-target="#hapusArsip" title="hapus" data-id="' +
								row.id +
								'"><i class="fa-solid fa-trash-can"></i></button> ' +
								'<button class="btn btn-warning" title="download" data-id="' +
								row.id +
								'" data-file="' + row.file_name + '" onclick="download_data(this)"><i class="fa-solid fa-download"></i></button> ' +
								'<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" title="edit" onclick="submit(' +
								row.id +
								')"><i class="fa-solid fa-eye"></i></button> '
								
							);
						},
					},					
				],
			});
		},
		error: function (xhr, textStatus, errorThrown) {
			console.log(xhr.statusText);
		},
	});
}
function download_data(button) {
    var file_name = $(button).data("file");
	window.location.href = base_url + "assets/surat/" + file_name;
    $.ajax({
        type: "GET",
        url: base_url + "./assets/surat/" + file_name,
        success: function (data) {
            // Create a temporary anchor element and trigger the download
            var a = document.createElement('a');
            a.href = data.url; // Assuming your server returns the file URL
            a.download = file_name;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        },
        error: function (xhr, textStatus, errorThrown) {
            console.log(xhr.statusText);
        }
    });
}


function update_data() {
	var formData = new FormData();
	formData.append("id", $("[name='id']").val());

	var fileInput = $("[name='pdf']")[0];
	if (fileInput.files.length > 0) {
		formData.append("pdf", fileInput.files[0]);
	}

	$.ajax({
		type: "POST",
		url: base_url + _controller + "/edit_data",
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (response) {
			if (response.errors) {
				delete_error();
				for (var fieldName in response.errors) {
					$("#error-" + fieldName).show();
					$("#error-" + fieldName).html(response.errors[fieldName]);
				}
			} else if (response.success) {
				$("#exampleModal").modal("hide");
				$("body").append(response.success);
				get_data();
			}
		},
		error: function (xhr, status, error) {
			console.error("AJAX Error: " + error);
		},
	});
}

function delete_data(x) {
	$.ajax({
		type: "POST",
		data: "id=" + x,
		dataType: "json",
		url: base_url + _controller + "/delete_data",
		success: function (response) {
			console.log(response);
			$("body").append(response.success);
			get_data();
		},
	});
}

$("#btn-download").on("click", function () {
    var id = $("[name='id']").val();
    download_dataa(id);
});

function download_dataa(id) {
    $.ajax({
        type: "POST",
        data: { id: id },
        dataType: "json",
        url: base_url + _controller + "/download_file",
        success: function (response) {
            if (response.success) {
                // Download the file using the generated URL
                window.location.href = response.url;
            } else {
                console.log("Error downloading file.");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error: " + error);
        },
    });
}
