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
            <div class="top-profil-cnt">
                <p>Edit Profil</p>
            </div>
            <?php echo form_open_multipart('home/update/' . $user->id_user, 'class="user-form"'); ?>
            <div class="mid-profil-cnt">
                <input type="file" class="form-control" id="profil_image" name="profil_image" accept="image/*">
                <?php if (!empty($user->profil)) : ?>
                    <div class="mt-2">
                        <img src="<?php echo base_url('users/' . $user->profil); ?>" alt="Profil Image" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                <?php endif; ?>
                <input type="hidden" name="old_profil_image" value="<?php echo $user->profil; ?>">
            </div>

            <div class="bottom-profil-cnt">
                <div class="input-form-cnt">
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $user->username; ?>" required>
                </div>

                <div class="input-form-cnt">
                    <input type="email" name="email" placeholder="email" value="<?= set_value('email', $user->email); ?>">
                    <?php echo form_error('email'); ?>
                </div>

                <div class="simpan-profil">
                    <input type="submit" name="simpan_profil" value="Simpan">
                </div>
            </div>
            <style>
                input[type="submit"] {
                    cursor: pointer;
                    border-radius: 20px;
                    width: 100%;
                    height: 100%;
                    border: 1px solid #0000001b;
                }

                input[type="submit"] {
                    background-color: #0000001b;
                    border-radius: 20px;
                    width: 100%;
                    height: 100%;
                    border: 1px solid #0000001b;
                }
            </style>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Memantau perubahan pada input username
                    var usernameInput = document.getElementById("username");
                    var usernameDisplay = document.getElementById("usernameDisplay");

                    usernameInput.addEventListener("input", function() {
                        var newUsername = usernameInput.value;
                        usernameDisplay.textContent = "Username Display: " + newUsername;
                    });

                    // Memantau perubahan pada input email
                    var emailInput = document.querySelector('input[name="email"]');
                    var emailDisplay = document.getElementById("emailDisplay");

                    emailInput.addEventListener("input", function() {
                        var newEmail = emailInput.value;
                        emailDisplay.textContent = "Email Display: " + newEmail;
                    });
                });
            </script>

            <?php echo form_close(); ?>


        </div>
    </div>
</div>
</body>

</html>