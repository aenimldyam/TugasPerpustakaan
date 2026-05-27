<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <span class="glyphicon glyphicon-home"></span>
                </a>
            </li>

            <li class="active">Master Data Buku</li>
        </ol>
    </div>

    <div class="panel panel-default">

        <div class="panel-body">

            <h3>
                Master Data Buku

                <a href="<?= base_url('admin/input-data-buku');?>">

                    <button type="button" class="btn btn-sm btn-primary pull-right">
                        Input Buku
                    </button>

                </a>
            </h3>

            <hr />

            <table
                data-toggle="table"
                data-show-refresh="true"
                data-show-toggle="true"
                data-show-columns="true"
                data-search="true"
                data-pagination="true">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Rak</th>
                        <th>Pengarang</th>
                        <th>Opsi</th>
                    </tr>

                </thead>

                <tbody>

                    <?php
                    $no = 0;

                    foreach($data_buku as $data){
                    ?>

                    <tr>

                        <td><?= $no=$no+1;?></td>

                        <td>

                            <img
                                src="<?= base_url('uploads/buku/'.$data['cover_buku']);?>"
                                width="70">

                        </td>

                        <td><?= $data['judul_buku'];?></td>

                        <td><?= $data['nama_kategori'] ?? '-';?></td>

                        <td><?= $data['nama_rak'] ?? '-';?></td>

                        <td><?= $data['pengarang'];?></td>

                        <td>

                            <a href="<?= base_url('admin/edit-data-buku/'.sha1($data['id_buku']));?>">

                                <button type="button" class="btn btn-sm btn-success">
                                    Edit
                                </button>

                            </a>

                            <a href="#" onclick="hapus('<?= sha1($data['id_buku']);?>')">

                                <button type="button" class="btn btn-sm btn-danger">
                                    Hapus
                                </button>

                            </a>

                        </td>

                    </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script type="text/javascript">

function hapus(id){

    swal({
        title : "Hapus Buku?",
        text : "Data akan terhapus permanen!",
        icon : "warning",
        buttons : true,
    })

    .then(ok => {

        if(ok){

            window.location.href =
            "<?= base_url('admin/hapus-data-buku/');?>"+id;

        }

    })

}

</script>