<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <ol class="breadcrumb">

            <li>
                <a href="#">
                    <span class="glyphicon glyphicon-home"></span>
                </a>
            </li>

            <li class="active">Input Data Buku</li>

        </ol>
    </div>

    <div class="panel panel-default">

        <div class="panel-body">

            <h3>Input Buku</h3>

            <hr>

            <form
                action="<?= base_url('admin/simpan-buku');?>"
                method="post"
                enctype="multipart/form-data">

                <div class="form-group">
                    <label>Judul Buku</label>

                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        required>
                </div>

                <div class="form-group">
                    <label>Pengarang</label>

                    <input
                        type="text"
                        name="pengarang"
                        class="form-control"
                        required>
                </div>

                <div class="form-group">
                    <label>Penerbit</label>

                    <input
                        type="text"
                        name="penerbit"
                        class="form-control"
                        required>
                </div>

                <div class="form-group">
                    <label>Tahun</label>

                    <input
                        type="number"
                        name="tahun"
                        class="form-control"
                        required>
                </div>

                <div class="form-group">
                    <label>Jumlah Eksemplar</label>

                    <input
                        type="number"
                        name="jumlah"
                        class="form-control"
                        required>
                </div>

                <div class="form-group">

                    <label>Kategori Buku</label>

                    <select name="kategori" class="form-control">

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        <?php foreach($kategori as $k){ ?>

                        <option value="<?= $k['id_kategori'];?>">

                            <?= $k['nama_kategori'];?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">

                    <label>Rak</label>

                    <select name="rak" class="form-control">

                        <option value="">
                            -- Pilih Rak --
                        </option>

                        <?php foreach($rak as $r){ ?>

                        <option value="<?= $r['id_rak'];?>">

                            <?= $r['nama_rak'];?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">

                    <label>Keterangan</label>

                    <textarea
                        name="keterangan"
                        class="form-control"></textarea>

                </div>

                <div class="form-group">

                    <label>Cover Buku</label>

                    <input
                        type="file"
                        name="cover"
                        class="form-control">

                </div>

                <div class="form-group">

                    <label>E-Book</label>

                    <input
                        type="file"
                        name="ebook"
                        class="form-control">

                </div>

                <button class="btn btn-primary">
                    Simpan
                </button>

                <button type="reset" class="btn btn-danger">
                    Reset
                </button>

            </form>

        </div>

    </div>

</div>