<div class="content">
    <div class="cnt">
        <a href="javascript:void(0);" class="kembali" onclick="kembali();">&lt;</a>
        <?php if (empty($photos)) : ?>
            <p>Tidak Ada Foto Yang Di Upload</p>
        <?php else : ?>
            <?php
            // Hitung jumlah like untuk setiap foto
            foreach ($photos as &$photo) {
                // Pastikan $likes[$photo['id_foto']] berisi data yang dapat dihitung
                if (isset($likes[$photo['id_foto']])) {
                    // Anda dapat mengkonversi string ke integer jika perlu
                    $photo['jumlah_like'] = (int)$likes[$photo['id_foto']];
                } else {
                    // Jika tidak ada data, jumlah like diatur menjadi 0
                    $photo['jumlah_like'] = 0;
                }
            }

            // Fungsi pembanding untuk mengurutkan berdasarkan jumlah like
            function compareLikes($a, $b)
            {
                if ($a['jumlah_like'] == $b['jumlah_like']) {
                    return 0;
                }
                return ($a['jumlah_like'] > $b['jumlah_like']) ? -1 : 1;
            }

            // Mengurutkan array $photos berdasarkan jumlah like
            usort($photos, 'compareLikes');

            // Sekarang $photos telah diurutkan berdasarkan jumlah like dari yang paling banyak ke yang paling sedikit
            ?>
            <?php foreach ($photos as $photo) : ?>
                <!-- Tombol untuk kembali -->
                <div class="foto">
                    <div class="top-fotos">
                        <?php
                        $id_user_login = $this->session->userdata('id_user');
                        $target_url = ($id_user_login && $photo['id_user'] == $id_user_login) ? base_url('home/profil_foto/' . $photo['id_user']) : base_url('home/profil_users/' . $photo['id_user']);
                        ?>
                        <a href="<?= $target_url ?>">

                            <div class="left-profil">
                                <img src="<?= base_url('users/' . $photo['profil']); ?>" alt="Profil Image">
                            </div>
                            <div class="right-profil">
                                <p><?= $photo['username']; ?></p>
                            </div>
                        </a>
                    </div>
                    <div class="t-t">
                        <img src="<?= base_url('fotos/' . $photo['lokasi_file']); ?>" alt="">
                        <div class="b-b">
                            <div class="b-h2">
                                <p><?= $photo['tgl_unggah']; ?></p>
                            </div>
                            <div class="b-b-b">
                                <?php if ($role_id == 1 || $role_id == 2) : ?>
                                    <?php if ($like[$photo['id_foto']]) : ?>
                                        <a href="<?= base_url('home/remove_like1/' . $photo['id_foto']); ?>"><img src="<?= base_url('img/likesL.png') ?>" alt=""><?= $likes[$photo['id_foto']]; ?></a>
                                    <?php else : ?>
                                        <a href="<?= base_url('home/add_like1/' . $photo['id_foto']); ?>"> <img src="<?= base_url('img/putihL.png') ?>" alt=""><?= $likes[$photo['id_foto']]; ?></a>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <a href=" <?= base_url('login') ?>">
                                        <img src="<?= base_url('img/putihL.png') ?>" alt=""><?= $likes[$photo['id_foto']]; ?>
                                    </a>
                                <?php endif; ?>
                                <a class="openModal" data-photo-id="<?= $photo['id_foto']; ?>">
                                    <p><img src="<?= base_url('img/komen.png') ?>" alt=""><?= count($komentars[$photo['id_foto']]); ?></p>
                                </a>
                                <p><img src="<?= base_url('img/view.png') ?>" alt=""><?= $jumlah_view[$photo['id_foto']]; ?></p>
                            </div>
                        </div>
                        <div id="modal_<?= $photo['id_foto']; ?>" class="modals">
                            <div class="mdls">
                                <span class="close">&times;</span>
                                <div class="left-mdls">
                                    <img src="<?= base_url('fotos/' . $photo['lokasi_file']); ?>" alt="">
                                </div>
                                <div class="right-mdls">
                                    <div class="r-mdls">
                                        <div class="top-mdls">
                                            <?php
                                            $id_user_login = $this->session->userdata('id_user');
                                            $target_url = ($id_user_login && $photo['id_user'] == $id_user_login) ? base_url('home/profil_foto/' . $photo['id_user']) : base_url('home/profil_users/' . $photo['id_user']);
                                            ?>
                                            <?php if ($photo) : ?>
                                                <a href="<?= $target_url ?>">
                                                    <img src="<?= base_url('users/' . $photo['profil']); ?>" alt="Profil Image">
                                                    <p><?= $photo['username'] ?></p>
                                                <?php endif; ?>
                                                </a>
                                        </div>
                                        <p><?= $photo['deskripsi_foto'] ?></p>
                                        <div class="mid-mdls">
                                            <?php foreach ($komentars[$photo['id_foto']] as $komentar) : ?>
                                                <div class="komen-user">
                                                    <div class="komen-user1">
                                                        <img src="<?php echo base_url('users/' . $komentar['profil']); ?>" alt="Profil Image">
                                                        <h4><?= $komentar['username'] ?></h4>
                                                    </div>
                                                    <div class="komen-user2">
                                                        <p><?= $komentar['isi_komentar'] ?></p>
                                                    </div>
                                                    <div class="tgl-komen">
                                                        <p><?= $komentar['tgl_komentar'] ?></p>
                                                        <?php if ($komentar['id_user'] == $this->session->userdata('id_user')) : ?>
                                                            <?php if ($role_id == 1 || $role_id == 2) : ?>
                                                                <a href="<?= base_url('home/hapus_foto/' . $komentar['id_komen']) ?>"><img src="<?= base_url('img/delete.png') ?>" alt=""></a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="bottom-mdls">
                                            <div class="top-mdls-1">
                                                <div class="top-likes">
                                                    <?php if ($role_id == 1 || $role_id == 2) : ?>
                                                        <?php if ($like[$photo['id_foto']]) : ?>
                                                            <a href="<?= base_url('home/remove_like1/' . $photo['id_foto']); ?>"><img src="<?= base_url('img/likesL.png') ?>" alt=""><?= $likes[$photo['id_foto']]; ?></a>
                                                        <?php else : ?>
                                                            <a href="<?= base_url('home/add_like1/' . $photo['id_foto']); ?>"><img src="<?= base_url('img/putihL.png') ?>" alt=""><?= $likes[$photo['id_foto']]; ?></a>
                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        <a href="<?= base_url('login') ?>">
                                                            <img src="<?= base_url('img/putihL.png') ?>" alt=""><?= $likes[$photo['id_foto']]; ?>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="bottom-tgl">
                                                <p><?= $photo['tgl_unggah'] ?></p>
                                            </div>
                                            <div class="bwh-mdls-1">
                                                <form action="<?= base_url('home/add_komentar_foto') ?>" method="post">
                                                    <div class="bottom-m">
                                                        <input type="hidden" name="id_foto" value="<?= $photo['id_foto'] ?>">
                                                        <input type="text" name="isi_komentar" id="" placeholder="  Komentar.....">
                                                        <button type="submit"><img src="<?= base_url('img/kirim.png') ?>" alt=""></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var emojiButton = document.getElementById('emojiButton');
                emojiButton.addEventListener('click', function() {
                    openEmojiPanel();
                });

                function openEmojiPanel() {
                    // Mengirimkan perintah windows + .
                    var keyEvent = new KeyboardEvent('keydown', {
                        code: 'Period',
                        key: '.',
                        ctrlKey: true,
                        shiftKey: false,
                        altKey: false,
                        metaKey: true,
                        repeat: false,
                        bubbles: true,
                        cancelable: true
                    });
                    document.dispatchEvent(keyEvent);
                }
            });

            function kembali() {
                window.history.back();
            }

            document.addEventListener("DOMContentLoaded", function() {
                var openModalButtons = document.querySelectorAll(".openModal");

                openModalButtons.forEach(function(button) {
                    button.addEventListener("click", function() {
                        var photoId = this.getAttribute("data-photo-id");
                        var modalId = "modal_" + photoId;
                        var modal = document.getElementById(modalId);
                        var span = modal.querySelector(".close");

                        modal.style.display = "block";

                        span.onclick = function() {
                            modal.style.display = "none";
                        }

                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }
                    });
                });
            });
        </script>
    </div>
</div>

</body>

</html>