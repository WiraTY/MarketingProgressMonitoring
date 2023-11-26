<!DOCTYPE html>
<html>

<head>
    <title>Halaman Utama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <!-- Form tambah member -->
    <h2>Add Member</h2>
    <form action="/member/create" method="post">
        <div>
            <label for="id_group">Group</label>
            <select class="form-select" aria-label="Default select example" name="id_group" id="id_group">
                <?php foreach ($groups as $group) : ?>
                    <option value="<?= $group['id_group']; ?>"><?= $group['nama_group']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="nama_member" class="form-label">Nama Member</label>
            <input type="text" class="form-control" name="nama_member" id="nama_member">
        </div>
        <div class="mb-3">
            <label for="alamat_member" class="form-label">Alamat Member</label>
            <input type="text" class="form-control" name="alamat_member" id="alamat_member">
        </div>
        <div class="mb-3">
            <label for="email_member" class="form-label">Email Member</label>
            <input type="text" class="form-control" name="email_member" id="email_member">
        </div>
        <div class="mb-3">
            <label for="telp_member" class="form-label">Telp Member</label>
            <input type="text" class="form-control" name="telp_member" id="telp_member">
        </div>
        <div class="mb-3">
            <label for="password_member" class="form-label">Password Member</label>
            <input type="password" class="form-control" name="password_member" id="password_member">
        </div>
        <!-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> -->
        <?= csrf_field(); ?>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</body>

</html>