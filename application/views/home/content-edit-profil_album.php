<div class="edit-profil-cnt">
    <div class="sidbar-profil">
        <!-- Isi sidebar di sini -->
        <?php
        // Ambil data pengguna dari sesi
        $user_id = $this->session->userdata('id_user');
        $user_data = $this->db->get_where('tbl_user', ['id_user' => $user_id])->row_array();

        // Tampilkan kolom profil sesuai dengan nama file gambar
        $profil_image = base_url('users/' . $user_data['profil']);
        ?>
        <a href="<?= base_url('home/editprofil/' . $user_data['id_user']) ?>">Edit Profil</a>
        <a href="<?= base_url('home/edit_album') ?>">Edit Album</a>
        <a href="<?= base_url('home/edit_foto') ?>">Edit Foto</a>
    </div>
    <div class="content-profil-cnt">
        <?php foreach ($albums as $album) : ?>
            <div class="album-profil">
                <div class="kiri-profil">
                    <img src="<?= base_url() ?>albums/<?php echo $album->cover; ?>" alt="">
                </div>
                <div class="kanan-profil">
                    <div class="top-prl">
                        <h1><?php echo $album->nama_album; ?></h1>
                    </div>
                    <div class="bottom-prl">
                        <h5><?php echo $album->tgl_buat; ?></h5>
                    </div>
                    <div class="delete-albums">
                        <a href="<?php echo base_url('home/delete_albums/' . $album->id_album); ?>" class="hapus-albums" onclick="return confirm('yakin mau hapus?')"><img src="<?= base_url('img/delete.png') ?>" alt=""></a>
                        <a href="<?= base_url('home/edit_profil_albums/' . $album->id_album) ?>" class="edit-albums">
                            <img src="<?= base_url('img/edit.png') ?>" alt=""></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
</body>

</html>