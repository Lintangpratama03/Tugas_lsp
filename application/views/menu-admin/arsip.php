<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>ARSIP SURAT</h1>
                    <p style="margin-bottom: 5px;">Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.</p>
                    <p style="margin-bottom: 5px;">Klik "Lihat" pada kolom aksi untuk menampilkan surat.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="content" max-height=200px height=200px>
        <div class="card">
            <div class="card-body">
                <table id="example" class="table table-hover table-bordered" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nomer Surat</th>
                            <th width="15%">Kategori</th>
                            <th width="15%">Judul</th>
                            <th width="20%">Waktu</th>
                            <th width="25%">Aksi</th>
                        </tr>
                    </thead>
                </table>
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                <div class="text-left mt-3">
                    <button type="button" class="btn btn-primary" id="arsipkanButton">Arsipkan Surat</button>
                </div>
                <script>
                    $(document).ready(function() {
                        $("#arsipkanButton").on("click", function() {
                            window.location.href = "<?php echo base_url('/tambah-arsip') ?>";
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
                <h4 class="modal-title">Preview Surat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="row">
                                <label for="nama" class="col-lg-2 col-form-label">Nama Surat</label>
                                <div class="col-lg-10">
                                    <input type="hidden" name="id" class="form-control">
                                    <input type="text" name="nama" id="nama" class="form-control" disabled>
                                    <small class="text-danger pl-1" id="error-nama"></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="labelPdf" class="col-lg-2 col-form-label">File Surat (PDF)</label>
                            <div class="col-lg-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="pdf" id="pdf">
                                    <label class="custom-file-label" for="card" id="label" name="label">Pilih file</label>
                                    <small class="text-danger pl-1" id="error-pdf"></small>
                                </div>
                                <span id="selectedFileName"></span>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <embed src="" type="application/pdf" width="100%" height="600" />
                        </div>

                    </div>
                </div>
            </div>


            <div class="modal-footer d-flex justify-content-start">
                <div class="col-lg-3">
                    <button type="button" id="btn-download" data-id="{{id}}" class="btn btn-outline-success btn-block">Unduh</button>
                </div>
                <div class="col-lg-3">
                    <button type="button" id="btn-update" onclick="update_data()" class="btn btn-outline-primary btn-block">Update file</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="hapusArsip">
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