<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kategori Surat >> Tambah</h1>
                    <p>Tambahkan atau edit data kategori. Jika sudah selesai, jangan lupa untuk mengetik tombol "SIMPAN"</p>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div id='form_kategori' class="card">
            <h6 class="card-header">Tambah Data Kategori</h6>
            <div class="card-body">
                <div class="form-group row">
                    <label for="labelnama" class="col-lg-2 col-form-label">Nama Kategori</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Kategori">
                        <small class="text-danger pl-1" id="error-nama"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="labelketerangan" class="col-lg-2 col-form-label">Keterangan</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan" rows="5" style="height: 100px;"></textarea>
                        <small class="text-danger pl-1" id="error-keterangan"></small>
                    </div>
                </div>
                <hr>
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-between">
                        <button type="button" id="btn-back" class="btn btn-outline-primary">Kembali</button>
                        <button type="button" id="btn-tambah" onclick="insert_data()" class="btn btn-outline-primary">Simpan</button>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $("#btn-back").on("click", function() {
                            window.location.href = "<?php echo base_url('/kategori') ?>";
                        });
                    });
                </script>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="tambahKategori">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5>Klik Simpan Jika anda sudah yakin dengan data yang sudah terisi.</h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" id="btn-cancel">Cancel</button>
                <button class="btn btn-warning" type="button" id="btn-yakin" data-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>