<?= $this->extend('template/template') ?>
<?= $this->Section('content'); ?>

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title mb-0"><?= $title ?></h1>
            <hr class="mb-4">
            <?php if (session()->get('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>
            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table  app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">No</th>
                                            <th class="cell">Tanggal Kirim Email</th>
                                            <th class="cell">Nama Perusahaan</th>
                                            <th class="cell">Negara Perusahaan</th>
                                            <th class="cell">Status Terkirim</th>
                                            <th class="cell">Progress</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($members as $member) : ?>
                                            <tr>
                                                <td class="cell"><?= $i++; ?></td>
                                                <td class="cell"><span class="truncate"><?= $member['tgl_kirim_email']; ?></span></td>
                                                <td class="cell"><?= $member['nama_perusahaan']; ?></td>
                                                <td class="cell"><?= $member['negara_perusahaan']; ?></td>
                                                <td class="cell">
                                                    <?php if ($member['status_terkirim'] === 'Terkirim') : ?>
                                                        <span class="badge bg-success"><?= $member['status_terkirim']; ?></span>
                                                    <?php elseif ($member['status_terkirim'] === 'Gagal') : ?>
                                                        <span class="badge bg-danger"><?= $member['status_terkirim']; ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="cell"><?= $member['progress']; ?></td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="<?= base_url('progress/edit/' . $member['id_kirim_email']); ?>">Edit</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div><!--//table-responsive-->
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//tab-pane-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->

    <?= $this->endSection('content'); ?>