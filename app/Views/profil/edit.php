<?= $this->extend('template/template') ?>
<?= $this->Section('content'); ?>

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title"><?= $title ?></h1>
            <hr class="mb-4">

            <div class="row g-4 settings-section">

                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">

                        <div class="app-card-body">
                            <?php if (session()->get('success')) : ?>
                                <div class="alert alert-success">
                                    <?= session()->get('success') ?>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->has('error')) : ?>
                                <div class="alert alert-danger">
                                    <?= session('error') ?>
                                </div>
                            <?php endif; ?>
                            <form class="form" action="<?= base_url('profil/proses_edit/' . session()->get('id_member')); ?>" method="post">
                                <div class="mb-3">
                                    <label for="nama_member" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama_member" name="nama_member" value="<?= session()->get('nama_member') ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email_member" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email_member" name="email_member" value="<?= session()->get('email_member') ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat_member" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat_member" name="alamat_member" rows="4" cols="50" style="height:100%;"><?= session()->get('alamat_member') ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="telp_member" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="telp_member" name="telp_member" value="<?= session()->get('telp_member') ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password_lama" class="form-label">Password Lama</label>
                                    <div class="input-group ">
                                        <input type="password" class="form-control" id="password_lama" name="password_lama" required>
                                        <button class="btn rounded-end btn-outline-success show-password-button" type="button">
                                            <h6 toggle="#password-field" class="fas fa-eye"></h6>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="password_baru" class="form-label">Password Baru</label>
                                    <div class="input-group ">
                                        <input type="password" class="form-control" id="password_baru" name="password_baru" required>
                                        <button class="btn rounded-end btn-outline-success show-password-button" type="button">
                                            <h6 toggle="#password-field" class="fas fa-eye"></h6>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                                    <div class="input-group ">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                        <button class="btn rounded-end btn-outline-success show-password-button" type="button">
                                            <h6 toggle="#password-field" class="fas fa-eye"></h6>
                                        </button>
                                    </div>
                                </div>
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn app-btn-primary">Simpan</button>
                            </form>
                        </div><!--//app-card-body-->

                    </div><!--//app-card-->
                </div>
            </div><!--//row-->

            <hr class="my-4">
        </div><!--//container-fluid-->
    </div><!--//app-content-->
</div><!--//app-wrapper-->

<?= $this->endSection('content'); ?>