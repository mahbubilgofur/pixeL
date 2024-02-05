<div class="content-homes">
    <div class="homes">
        <div class="home-content">
            <div class="bts-homes">
                <div class="l-homes">
                    <div class="bts-l-homes">
                        <div class="top-r">
                            <h4>Selamat Datang di BOBBYPixel!</h4>
                        </div>
                        <div class="bttom-r">
                            <h1>Jelajahi dan Temukan Keindahan dalam Setiap Pixel di BOBBYPixel!</h1>
                        </div>
                    </div>
                </div>
                <div class="r-homes">
                    <div class="r-homes-bts">
                        <div class="content-r-homes">
                            <img src="<?= base_url('img/content.png') ?>" alt="">
                        </div>
                        <div class="lc-homes">
                            <div class="l-upt">
                                <img src="<?= base_url('img/uplod.png') ?>" alt="">
                            </div>
                            <div class="r-upt">
                                <h3>UPLOAD</h3>
                                <h5>Foto Anda</h5>
                            </div>
                        </div>
                        <div class="mid-homes"><img src="<?= base_url('img/love.png') ?>" alt=""></div>
                        <div class="rc-homes">
                            <div class="t-kmn">
                                <img src="<?= base_url('img/komen.png') ?>" alt="">
                            </div>
                            <div class="b-kmn">
                                <h4>KOMENTAR</h4>
                            </div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                // Menambahkan kelas "masuk" ke elemen ketika halaman dimuat
                                document.querySelector('.bts-l-homes').classList.add('masuk');
                                document.querySelector('.r-homes-bts').classList.add('masuk');
                                document.querySelector('.cnt-awl').classList.add('masuk');
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="cnt-awl">
            <?php foreach ($albums as $album) : ?>
                <a href="<?= base_url('home/foto/' . $album->id_album) ?>">
                    <div class="album">
                        <div class="t">
                            <img src="<?= base_url() ?>albums/<?php echo $album->cover; ?>" alt="">
                        </div>
                        <div class="b">
                            <h1><?php echo $album->nama_album; ?></h1>
                            <!-- <p><?php echo $album->deskripsi; ?></p> -->
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="content-album-fotos">
        <?php foreach ($fotos as $foto) : ?>
            <div class="foto-cont">
                <img src="<?= base_url() ?>fotos/<?php echo $foto->lokasi_file; ?>" alt="">
            </div>
        <?php endforeach; ?>
    </div>
    <a href="<?= base_url('home/tentang') ?>">
        <div class="tentang-pixel">
            <p>❔</p>
        </div>
    </a>
</div>
</body>

</html>

</body>

</html>