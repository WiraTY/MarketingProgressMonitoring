<!DOCTYPE html>
<html>

<head>
    <title>Halaman Utama</title>
</head>

<body>
    <!-- Konfirmasi penghapusan member -->
    <h2>Delete Member</h2>
    <p>Are you sure you want to delete this member?</p>
    <form action="/member/delete/<?= $member['id_member']; ?>" method="post">
        <button type="submit">Delete</button>
    </form>

</body>

</html>