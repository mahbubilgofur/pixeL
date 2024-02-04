<div class="content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <h1>Add Foto</h1>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <?php echo form_open_multipart('foto/add_foto', 'class="foto-form"'); ?>
                    <div class="form-group">
                        <label for="judul_foto">Judul Foto</label>
                        <input type="text" class="form-control" id="judul_foto" name="judul_foto" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_foto">Deskripsi Foto</label>
                        <textarea class="form-control" id="deskripsi_foto" name="deskripsi_foto"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="id_album">ID Album</label>
                        <input type="text" class="form-control" id="id_album" name="id_album" required>
                    </div>
                    <div class="form-group">
                        <label for="id_user">ID User</label>
                        <input type="text" class="form-control" id="id_user" name="id_user" required>
                    </div>
                    <div class="form-group">
                        <label for="lokasi_file">Upload Foto</label>
                        <input type="file" class="form-control" id="lokasi_file" name="lokasi_file" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .content-wrapper {
        margin: 20px;
    }

    .breadcrumb {
        background-color: #fff;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .foto-form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    button {
        cursor: pointer;
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>

</body>

</html>