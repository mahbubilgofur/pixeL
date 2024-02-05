<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?= base_url() ?>css/home.css">
    <link rel="stylesheet" href="<?= base_url() ?>css/responsive.css">
</head>

<body>
    <header>
        <div class="none">
            <div class="logo">
                <a href="<?= base_url('home/tentang') ?>">
                    <img src="<?= base_url('img/logo-galery1.png') ?>" alt="">
                </a>
            </div>
            <div class="mid-h">
                <form action="<?= base_url('home/fitur_cari') ?>" method="get">
                    <div class="cari">
                        <input type="text" name="search" placeholder="  Temukan judul foto......">
                        <div class="cari-usr" type="submit"><img src="<?= base_url('img/carii.png') ?>" alt=""></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="navigation">
            <a href="<?= base_url('/') ?>"><img src="<?= base_url('img/home.png') ?>" alt=""></a>
            <a href="<?= base_url() ?>home/upload_foto"><img src="<?= base_url('img/upload.png') ?>" alt=""></a>
            <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) : ?>
                <a href="<?= base_url('home/profil_foto     ') ?>" class="profil-a">
                    <!-- // -->
                    <?php
                    // Ambil data pengguna dari sesi
                    $user_id = $this->session->userdata('id_user');
                    $user_data = $this->db->get_where('tbl_user', ['id_user' => $user_id])->row_array();

                    // Tampilkan kolom profil sesuai dengan nama file gambar
                    $profil_image = base_url('users/' . $user_data['profil']);
                    ?>
                    <img src="<?= $profil_image ?>" alt="Profile Image">
                    <!-- // -->
                    <span><?php echo $this->session->userdata('username'); ?></span>
                </a>
                <a href="<?= base_url() ?>login/logout"><img src="<?= base_url('img/logout.png') ?>" alt=""></a>
            <?php else : ?>
                <a href="<?= base_url() ?>login"><img src="<?= base_url('img/profil.png') ?>" alt=""></a>
            <?php endif; ?>

        </div>
    </header>