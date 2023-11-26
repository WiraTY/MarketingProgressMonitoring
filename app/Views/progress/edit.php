<?= $this->extend('template/template') ?>
<?= $this->Section('content'); ?>

<!-- <?php 
    include('connection.php');
    if(isset($_REQUEST['submit']))
    {
        $content = $_REQUEST['content'];

        $insert_query = mysqli_query($connection, "insert into  tb_progress set progress='$progress'");
        if ($insert_query) {
            $msg = "Data Inserted";
        } else {
            $msg = "Error";
        }
        
    }
?> -->

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title"><?= $title ?></h1>
            <hr class="mb-4">

                <div class="col-12 col-md-0">
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
                            <form class="form" action="<?= base_url('progress/proses_edit/' . $kirim_email['id_kirim_email']); ?>" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Tanggal Kirim Email<span class="ms-2" data-bs-container="body" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="top" data-bs-content="This is a Bootstrap popover example. You can use popover to provide extra info."></label>
                                    <input type="date" class="form-control" id="tgl_kirim_email" name="tgl_kirim_email" value="<?= $kirim_email['tgl_kirim_email']; ?>" required readonly aria-disabled="true">
                                </div>
                                <div class="mb-3">
                                    <label for="nama_member" class="form-label" hidden>Nama Member</label>
                                    <select type="text" class="form-select" id="nama_member" name="nama_member" required hidden>
                                        <?php foreach ($nama_members as $nama_member) : ?>
                                            <option value="<?= $nama_member['id_member']; ?>" <?= ($nama_member['nama_member'] == session()->get('nama_member')) ? 'selected' : ''; ?>>
                                                <?= $nama_member['nama_member']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Perusahaan" value="<?= $kirim_email['nama_perusahaan']; ?>" required readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="negara_perusahaan" class="form-label">Negara Perusahaan</label>
                                    <input type="text" class="form-control" id="negara_perusahaan" name="negara_perusahaan" placeholder="Negara Perusahaan" value="<?= $kirim_email['negara_perusahaan']; ?>" required readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="status_terkirim" class="form-label">Status Terkirim</label>
                                    <input type="text" class="form-control" id="status_terkirim" name="status_terkirim" placeholder="Negara Perusahaan" value="<?= $kirim_email['status_terkirim']; ?>" required readonly>
                                </div>
                                <!-- <div class="mb-3">
                                    <label for="progress" class="form-label">Progress</label>
                                    <textarea class="form-control" id="progress" name="progress" rows="4" cols="50" style="height:100%;"><?= $kirim_email['progress']; ?></textarea>
                                </div> -->
                                <div class="mb-3">
                                    <label for="progress" class="form-label">Progress</label>
                                    <textarea class="form-control summernote" id="progress" name="progress" rows="4" cols="50" style="height:100%;"><?= $kirim_email['progress']; ?></textarea>
                                </div>
                                <!-- <div class="mb-3">
                                    <label for="progress" class="form-label">Progress</label>
                                    <div id="example">
                                        <?= $kirim_email['progress']; ?>
                                    </div>
                                </div> -->
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn app-btn-primary">Simpan</button>
                            </form>
                        </div><!--//app-card-body-->

                    </div><!--//app-card-->
                </div>

            <hr class="my-4">
        </div><!--//container-fluid-->
    </div><!--//app-content-->
</div><!--//app-wrapper-->

<?= $this->endSection('content'); ?>