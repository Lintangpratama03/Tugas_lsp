function submit() {
    $.ajax({
        type: "POST",
        data: "id=" + x,
        url: base_url + "/" + _controller + "/get_data_id",
        dataType: "json",
        success: function (hasil) {
            $("[name='id']").val(hasil[0].id);
            $("[name='nama']").val(hasil[0].nama);
            $("[name='prodi']").val(hasil[0].prodi);
            $("[name='nim']").val(hasil[0].nim);
        },
    });
delete_form();
delete_error();
}