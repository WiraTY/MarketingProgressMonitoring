<?= $this->extend('template/template') ?>
<?= $this->Section('content'); ?>

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title"><?= $title ?></title></h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <?php if (session()->has('errors')) : ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php foreach (session('errors') as $error) : ?>
                                            <li><?= esc($error) ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php endif ?>
                            <form class="form" action="<?= base_url('progress/prosses_tambah'); ?>" method="post">
                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Tanggal Kirim Email<span class="ms-2" data-bs-container="body" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="top" data-bs-content="This is a Bootstrap popover example. You can use popover to provide extra info."></label>
                                    <input type="date" class="form-control" id="tgl_kirim_email" name="tgl_kirim_email" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="id_member" class="form-label" hidden>Nama Member</label>
                                    <select type="text" class="form-select" id="id_member" name="id_member" required hidden>
                                        <?php foreach ($members as $member) : ?>
                                            <option value="<?= $member['id_member']; ?>" <?= ($member['nama_member'] == session()->get('nama_member')) ? 'selected' : ''; ?>>
                                                <?= $member['nama_member']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Nama Perusahaan">
                                </div>
                                <?php
                                // Sertakan file countries.php
                                include 'countries.php';
                                ?>
                                <div class="mb-3">
                                    <label for="negara_perusahaan" class="form-label">Negara Perusahaan</label>
                                    <select type="text" class="form-select" id="negara_perusahaan" name="negara_perusahaan" required>
                                        <?php foreach ($countries as $country) : ?>
                                            <option value="<?= $country; ?>"><?= $country; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status_terkirim" class="form-label">Status Terkirim</label>
                                    <select type="text" class="form-select" id="status_terkirim" name="status_terkirim" required>
                                        <option value="Terkirim">Terkirim</option>
                                        <option value="Gagal">Gagal</option>
                                    </select>
                                </div>
                                <input type="hidden" id="progress_tambah" name="progress_tambah" value="Mengirim Email Pada Tanggal sesuai kolom tgl_kirim_email">
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn app-btn-primary">Tambah</button>
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