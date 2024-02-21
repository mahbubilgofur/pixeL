<div class="edit-profil-cnt">
    <div class="sidbar-profil">
        <?php
        // Ambil data pengguna dari sesi
        $user_id = $this->session->userdata('id_user');
        $user_data = $this->db->get_where('tbl_user', ['id_user' => $user_id])->row_array();

        // Tampilkan kolom profil sesuai dengan nama file gambar
        $profil_image = base_url('users/' . $user_data['profil']);
        ?>
        <!-- Isi sidebar di sini -->
        <a href="<?= base_url('home/editprofil/' . $user_data['id_user']) ?>">Edit Profil</a>
        <a href="<?= base_url('home/edit_foto') ?>">Edit Foto</a>
    </div>
    <div class="content-profil-cnt">
        <div class="cnt-profil-kanan">
            <?php if ($foto) : ?>
                <?php echo form_open_multipart('home/update_fotos/' . $foto->id_foto, 'class="foto-form"'); ?>
                <div class="bottom-profil-cnt">
                    <div class="input-form-cnt">
                        <input type="text" class="form-input" id="judul_foto" name="judul_foto" value="<?php echo $foto->judul_foto; ?>" required>
                    </div>
                    <div class="input-form-cnt">
                        <textarea class="form-inoputan" id="deskripsi_foto" name="deskripsi_foto"><?php echo $foto->deskripsi_foto; ?></textarea>
                    </div>
                    <div class="input-form-cnt">
                        <input type="file" class="form-input" id="lokasi_file" name="lokasi_file">
                    </div>
                </div>
                <div class="simpan-profil">
                    <input type="submit" name="simpan_profil" value="Update">
                </div>

                <!-- <small>Gambar saat ini: <img src="<?= base_url('fotos/' . $foto->lokasi_file); ?>" alt="Preview" width="100"></small> -->
                <?php echo form_close(); ?>
            <?php else : ?>
                <p>Data foto tidak ditemukan.</p>
            <?php endif; ?>

        </div>
    </div>
</div>
</body>

</html>