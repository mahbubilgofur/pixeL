<div class="content">
    <div class="cnt">
        <a href="javascript:void(0);" class="kembali" onclick="kembali();">
            < </a>
                <?php if (empty($photos)) : ?>
                    <p>Tidak Ada Foto Yang Di Upload</p>
                <?php else : ?>
                    <?php foreach ($photos as $photo) : ?>
                        <a href="<?= base_url() ?>home/detail_foto/<?php echo $photo['id_foto']; ?>">
                            <!-- Tombol untuk kembali -->
                            <div class="foto">
                                <div class="top-fotos">
                                    <div class="left-profil">
                                        <img src="<?php echo base_url('users/' . $photo['profil']); ?>" alt="Profil Image">
                                    </div>
                                    <div class="right-profil">
                                        <p><?php echo $photo['username']; ?></p>
                                    </div>
                                </div>
                                <div class="t-t">
                                    <img src="<?= base_url() ?>fotos/<?php echo $photo['lokasi_file']; ?>" alt="">
                                </div>
                                <div class="b-b">
                                    <div class="b-h2">
                                        <p><?php echo $photo['tgl_unggah']; ?></p>
                                    </div>
                                    <div class="b-b-b">
                                        <p><img src="<?= base_url('img/love.png') ?>" alt=""><?php echo $likes[$photo['id_foto']]; ?></p>
                                        <p><img src="<?= base_url('img/komen.png') ?>" alt=""><?php echo $komentars[$photo['id_foto']]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
                <script>
                    function kembali() {
                        window.history.back();
                    }
                </script>
    </div>
</div>
</body>

</html>