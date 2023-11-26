<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?= base_url('assets/css/froala_editor.pkgd.min.css') ?>" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="<?= csrf_hash() ?>">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <!-- FontAwesome JS-->
    <script defer src="<?= base_url('assets/plugins/fontawesome/js/all.min.js') ?>"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="<?= base_url('assets/css/portal.css') ?>">

    <script src="<?= base_url('assets/js/tinymce.min.js') ?>" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#progress',
        });
        tinymce.init({
            selector: '#progress_tambah',
            inline: true,
            hidden_input: false
        });
    </script>
</head>

<body class="app">

    <?= $this->include('layout/header'); ?>

    <?= $this->renderSection('content'); ?>


    <!-- <script type="text/javascript" src="<?= base_url('assets/js/froala_editor.pkgd.min.js') ?>"></script>
    <script>
        var editor = new FroalaEditor('#example');
    </script> -->

    <!-- Javascript -->
    <script src="<?= base_url('assets/plugins/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>

    <!-- Page Specific JS -->
    <script src="<?= base_url('assets/js/app.js') ?>"></script>

    <script>
        // Ambil URL halaman saat ini
        var currentURL = window.location.href;

        // Dapatkan semua tautan menu
        var menuLinks = document.querySelectorAll(".app-menu a.nav-link");

        // Loop melalui setiap tautan menu dan periksa URL saat ini
        menuLinks.forEach(function(link) {
            // Ubah URL "progress/edit/" menjadi "progress/daftar" sebelum membandingkannya
            var modifiedURL = currentURL.replace("progress/edit/", "progress/daftar");
            if (modifiedURL.includes(link.href)) {
                // Tambahkan kelas "active" ke elemen <a> terkait
                link.classList.add("active");
            }
        });
    </script>

    <script>
        const showPasswordButtons = document.querySelectorAll('.show-password-button');
        showPasswordButtons.forEach(button => {
            const passwordInput = button.parentElement.querySelector('input[type="password"]');
            button.addEventListener('click', () => {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    button.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    passwordInput.type = 'password';
                    button.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });
        });
    </script>

    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                placeholder: 'Hello stand alone ui',
                tabsize: 2,
                height: 500,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files, editor, welEditable) {
                        for (var i = files.length - 1; i >= 0; i--) {
                            sendFile(file[i], this);
                        }
                    },
                    onMediaDelete: function(target) {
                        $.delete(target[0].src);
                    }
                },
            })
        });

        function sendFile(file, el) {
            var form_data = new FormData();
            form_data.append('file', file);
            $.ajax({
                data: form_data,
                type: "POST",
                url: 'editor-upload.php',
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    $(el).summernote('editor.insertImage', url);
                }
            })
        }
    </script> -->

    <!-- iki seng empan -->
    <script>
        function getNewCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }
        $('.summernote').summernote({
            callbacks: {
                onImageUpload: function(files) {
                    for (let i = 0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                },
                onMediaDelete: function(target) {
                    $.delete(target[0].src);
                }
            },
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 500,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        $.upload = function(file) {
            let out = new FormData();
            out.append('file', file, file.name);
            // Mengambil token CSRF yang baru
            const csrfToken = getNewCsrfToken();

            // Menggunakan token CSRF yang baru dalam permintaan AJAX
            out.append('csrf_test_name', csrfToken);

            // Add the CSRF token to the headers
            const headers = {
                'X-CSRF-TOKEN': csrfToken
            };

            $.ajax({
                method: 'POST',
                url: '<?php echo site_url('progress/uploadGambar') ?>',
                contentType: false,
                cache: false,
                processData: false,
                data: out,
                headers: headers, // Include the headers here
                success: function(img) {
                    $('.summernote').summernote('insertImage', img);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        };
        $.delete = function(src) {
            $.ajax({
                method: 'POST',
                url: '<?php echo site_url('progress/deleteGambar') ?>',
                cache: false,
                data: {
                    src: src
                },
                success: function(response) {
                    console.log(response);
                }

            });
        };
    </script>

    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#progress'), {
                ckfinder: {
                    uploadUrl: 'fileupload.php'
                }
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            })
    </script> -->

    <!-- tess summernote -->
    <!-- <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                callbacks: {
                    onImageUpload: function(files) {
                        uploadImage(files[0]);
                    }
                }
            });

            function uploadImage(file) {
                var formData = new FormData();
                formData.append('file', file);

                $.ajax({
                    url: '<?= base_url('upload/image'); ?>',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        $('.summernote').summernote('insertImage', url);
                    },
                    error: function(data) {
                        console.error(data);
                    }
                });
            }
        });
    </script> -->
</body>

</html>