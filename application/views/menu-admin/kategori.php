<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-12">
                    <h1>KATEGORI SURAT</h1>
                    <p style="margin-bottom: 5px;">Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat.</p>
                    <p style="margin-bottom: 5px;">Klik "Lihat" pada kolom aksi untuk menampilkan surat.</p>
                </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-body">
                <table id="example" class="table table-hover table-bordered" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">ID Kategori</th>
                            <th width="15%">Nama Kategori</th>
                            <th width="15%">Keterangan</th>
                            <th width="25%">Aksi</th>
                        </tr>
                    </thead>
                </table>
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                <div class="text-left mt-3">
                    <button type="button" class="btn btn-primary" id="tambahKategori">Tambah Kategori</button>
                </div>

                <script>
                    $(document).ready(function() {
                        $("#tambahKategori").on("click", function() {
                            window.location.href = "<?php echo base_url('/tambah-kategori') ?>";
                        });
                    });
                </script>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="exampleModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Kategori Surat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="row">
                                <label for="id" class="col-lg-2 col-form-label">ID Kategori</label>
                                <div class="col-lg-10">
                                    <input type="text" name="id" id="id" class="form-control" disabled>
                                    <small class="text-danger pl-1" id="error-id"></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="nama" class="col-lg-2 col-form-label">Nama Kategori</label>
                                <div class="col-lg-10">
                                    <input type="hidden" name="id" class="form-control">
                                    <input type="text" name="nama" id="nama" class="form-control">
                                    <small class="text-danger pl-1" id="error-nama"></small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label for="keterangan" class="col-lg-2 col-form-label">Keterangan</label>
                                <div class="col-lg-10">
                                    <textarea name="keterangan" id="keterangan" class="form-control" rows="5" style="height: 100px;"></textarea>
                                    <small class="text-danger pl-1" id="error-keterangan"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal-footer d-flex justify-content-start">
                <div class="col-lg-2">
                    <button type="button" id="btn-ubah" onclick="edit_data()" class="btn btn-outline-primary btn-block">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="hapusKategori">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5>Klik hapus jika anda ingin menghapus data ini</h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-warning" type="button" id="btn-hapus" data-dismiss="modal">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>