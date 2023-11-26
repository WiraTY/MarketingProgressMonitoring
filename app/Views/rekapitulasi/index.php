<?= $this->extend('template/template') ?>
<?= $this->Section('content'); ?>

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0"><?= $title ?></h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <form method="get">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

                                <div class="col-auto">
                                    <select class="form-select w-auto" name="bulan" id="bulan">
                                        <option value="all" <?= $selectedBulan === 'all' ? 'selected' : ''; ?>>Semua Bulan</option>
                                        <?php for ($bulan = 1; $bulan <= 12; $bulan++) : ?>
                                            <option value="<?= $bulan; ?>" <?= $bulan == $selectedBulan ? 'selected' : ''; ?>>
                                                <?= date('F', mktime(0, 0, 0, $bulan, 1)); ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="col-auto">
                                    <select class="form-select w-auto" name="tahun" id="tahun">
                                        <option value="all" <?= $selectedTahun === 'all' ? 'selected' : ''; ?>>Semua Tahun</option>
                                        <?php for ($tahun = 2022; $tahun <= date('Y'); $tahun++) : ?>
                                            <option value="<?= $tahun; ?>" <?= $tahun == $selectedTahun ? 'selected' : ''; ?>>
                                                <?= $tahun; ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <input class="btn app-btn-secondary" type="submit" value="Filter">
                                </div>
                            </div><!--//row-->
                        </form>

                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->


            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <!-- <a href="/member/create">Add Member</a> -->
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th>Nama Member</th>
                                            <?php for ($i = 1; $i <= 31; $i++) : ?>
                                                <th><?= $i; ?></th>
                                            <?php endfor; ?>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if (empty($laporan)) : ?>
                                            <tr>
                                                <td class="text-center" colspan="33">Tidak ada data kirim email</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php $i = 1; ?>
                                            <?php foreach ($nama_members as $member) : ?>
                                                <tr>
                                                    <td><?= $member['nama_member']; ?></td>
                                                    <?php
                                                    $total = 0;
                                                    for ($i = 1; $i <= 31; $i++) :
                                                        //menampilkan laporan berdasarkan member dari controller
                                                        $count = isset($laporan[$member['nama_member']]['tgl_' . $i]) ? $laporan[$member['nama_member']]['tgl_' . $i] : 0;
                                                        $total += $count;
                                                    ?>
                                                        <td class="text-center"><?= $count; ?></td>
                                                    <?php endfor; ?>
                                                    <td class="text-center"><strong><?= $total; ?></strong></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
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