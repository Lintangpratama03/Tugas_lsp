<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Biodata</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- profile_view.php -->

    <div class="content" id='biodata'>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-dark">Biodata Mahasiswa</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <!-- Move the photo to the left side -->
                                    <div class="photo">
                                        <img src="<?php echo base_url('assets/image/lintang.jpeg'); ?>" alt="Profil Photo" style="width: 150px; height: 200px;">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="row mb-1">
                                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-8">
                                            <label for="nama" class="col-form-label">: Lintang Windy Pratama</label>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                        <div class="col-sm-8">
                                            <label for="nama" class="col-form-label">: 2131730057</label>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <label for="prodi" class="col-sm-2 col-form-label">Prodi</label>
                                        <div class="col-sm-8">
                                            <label for="nama" class="col-form-label">: D3 Manajemen Informatika</label>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <label for="tgl" class="col-sm-2 col-form-label">Tanggal</label>
                                        <div class="col-sm-8">
                                            <label for="nama" class="col-form-label">: 13 November 2023</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>