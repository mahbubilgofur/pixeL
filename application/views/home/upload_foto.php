<style>
    .upload_alb {
        width: 100%;
        height: 100vh;
        background-color: #00fbff;
        background-image: linear-gradient(90deg, #00fbff 0%, #fc00ff 100%);
        animation: animasi-homes 5s infinite alternate;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .opti {
        background-color: #00fbff;
        color: black;
    }

    @keyframes animasi-homes {
        0% {
            background-position: left;
        }

        100% {
            background-position: right;
        }
    }

    .upload_alb-b {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: black;
        flex-direction: column;
        width: 300px;
        height: 400px;
        padding: 20px;
        border-radius: 50px;
        box-shadow: 0 0 10px rgb(0, 0, 0);
    }

    .upload_albb {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: 100%;
        height: 100%;
    }

    .type {
        display: flex;
        width: 100%;
        justify-content: center;
        align-items: center;
        color: white;
    }

    p {
        font-size: 13px;
        color: #00fbff;
    }

    .atr {
        display: flex;
        width: 100%;
        justify-content: space-between;
    }

    .kml-alb {
        background-color: #ffffff65;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        font-size: 16px;
    }

    .kml-alb:hover {
        background-color: rgb(0, 155, 155);
        transition: all 0.9s;
        color: black;
    }

    h2 {
        color: #333;
    }

    label {
        color: #00fbff;
        margin-bottom: 5px;
        align-self: flex-start;
    }

    .form-input {
        width: 100%;
        height: 40px;
        margin-bottom: 15px;
        border-radius: 20px;
        border: 1px black;
    }

    .form-inputfile {
        width: 100%;
        height: 40px;
        margin-bottom: 15px;
        border: 1px black;
    }

    .textarea-input {
        border: 1px solid white;
        width: 100%;
        height: 80px;
        margin-bottom: 15px;
        border-radius: 20px;
    }



    .submit-btn {
        background-color: #ffffff65;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        font-size: 16px;
    }

    .submit-btn:hover {
        background-color: rgb(0, 155, 155);
        transition: all 0.9s;
        color: black;
    }
</style>
<div class="upload_alb">
    <div class="upload_alb-b">
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('home/add_foto'); ?>
        <div class="upload_albb">
            <label for="judul_foto">Nama Foto:</label>
            <input type="text" name="judul_foto" class="form-input" placeholder=" Isi Nama Foto" />
            <label for="id_labum">Pilih Nama Foto :</label>
            <select name="id_album" class="form-input" required>
                <?php foreach ($data_album as $album) : ?>
                    <option class="opti" value="<?php echo $album->id_album; ?>"><?php echo $album->nama_album; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="deskripsi_foto">Deskripsi:</label>
            <textarea name="deskripsi_foto" class="textarea-input" required><?php echo set_value('deskripsi_foto'); ?></textarea>
            <label for="lokasi_file">Upload Foto:</label>
            <div class="type">
                <input type="file" name="lokasi_file" class="form-inputfile" required />
                <p>Maksimal Ukuran 1 MB</p>
            </div>
            <div class="atr">
                <a href="javascript:void(0);" onclick="kembali();">
                    <div class="kml-alb">Kembali</div>
                </a>
                <script>
                    function kembali() {
                        window.history.back();
                    }
                </script>
                <input type="submit" value="Simpan" class="submit-btn" />
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
</body>

</html>