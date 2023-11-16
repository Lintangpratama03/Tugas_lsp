<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>ARSIP SURAT >> UNGGAH</h1>
                    <p>Unggah surat yang telah terbit pada form ini untuk diarsipkan.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div id='form_surat' class="card">
            <h6 class="card-header">*File Harus Berformat PDF</h6>
            <div class="card-body">
                <div class="form-group row">
                    <label for="labelNomorSurat" class="col-lg-2 col-form-label">Nomor Surat</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="nomorSurat" name="nomorSurat" placeholder="Masukkan nomor surat">
                        <small class="text-danger pl-1" id="error-nomorSurat"></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kategori" class="col-lg-2 col-form-label">Kategori</label>
                    <div class="col-lg-10">
                        <select id="kategori" name="kategori[]" class="form-control kategori" style="width: 100%;">
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($select as $row) : ?>
                                <option value="<?php echo $row->id; ?>">
                                    <?php echo $row->nama_kategori; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger pl-1" id="error-kategori"></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="labelJudul" class="col-lg-2 col-form-label">Judul</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul">
                        <small class="text-danger pl-1" id="error-judul"></small>
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
                            window.location.href = "<?php echo base_url('/arsip') ?>";
                        });
                    });
                </script>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="tambahArsip">
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