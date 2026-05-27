<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <ul class="nav menu">
        <!-- DASHBOARD -->
        <li class="<?= (uri_string() == 'admin/dashboard-admin') ? 'active' : ''; ?>">
            <a href="<?= base_url('admin/dashboard-admin'); ?>">
                <span class="glyphicon glyphicon-home"></span>
                Dashboard
            </a>
        </li>
        <!-- ADMIN -->
        <li class="<?= (uri_string() == 'admin/master-data-admin'
        || uri_string() == 'admin/input-data-admin'
        || strpos(uri_string(), 'admin/edit-data-admin') !== false)
        ? 'active' : ''; ?>">
            <a href="<?= base_url('admin/master-data-admin'); ?>">
                <span class="glyphicon glyphicon-briefcase"></span>
                Master Data Admin
            </a>
        </li>
        <!-- BUKU -->
        <li class="<?= (uri_string() == 'admin/master-data-buku'
        || uri_string() == 'admin/input-data-buku'
        || strpos(uri_string(), 'admin/edit-data-buku') !== false)
        ? 'active' : ''; ?>">
            <a href="<?= base_url('admin/master-data-buku'); ?>">
                <span class="glyphicon glyphicon-briefcase"></span>
                Master Data Buku
            </a>
        </li>
        <!-- ANGGOTA -->
        <li class="<?= (uri_string() == 'admin/master-data-anggota'
        || uri_string() == 'admin/input-data-anggota'
        || strpos(uri_string(), 'admin/edit-data-anggota') !== false)
        ? 'active' : ''; ?>">
            <a href="<?= base_url('admin/master-data-anggota'); ?>">
                <span class="glyphicon glyphicon-briefcase"></span>
                Master Data Anggota
            </a>
        </li>
        <!-- KATEGORI -->
        <li class="<?= (uri_string() == 'admin/master-data-kategori'
        || uri_string() == 'admin/input-data-kategori'
        || strpos(uri_string(), 'admin/edit-data-kategori') !== false)
        ? 'active' : ''; ?>">
            <a href="<?= base_url('admin/master-data-kategori'); ?>">
                <span class="glyphicon glyphicon-briefcase"></span>
                Master Data Kategori
            </a>
        </li>
        <!-- RAK -->
        <li class="<?= (uri_string() == 'admin/master-data-rak'
        || uri_string() == 'admin/input-data-rak'
        || strpos(uri_string(), 'admin/edit-data-rak') !== false)
        ? 'active' : ''; ?>">
            <a href="<?= base_url('admin/master-data-rak'); ?>">
                <span class="glyphicon glyphicon-briefcase"></span>
                Master Data Rak
            </a>
        </li>
        <!-- TRANSAKSI -->
        <li class="parent ">
            <a data-toggle="collapse" href="#sub-item-1">
                <span class="glyphicon glyphicon-flash"></span>
                Transaksi
                <span
                    data-toggle="collapse"
                    href="#sub-item-1"
                    class="icon pull-right">
                    <em class="glyphicon glyphicon-s glyphicon-plus"></em>
                </span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li>
                    <a href="#">
                        <span class="glyphicon glyphicon-share-alt"></span>
                        Peminjaman
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="glyphicon glyphicon-share-alt"></span>
                        Pengembalian
                    </a>
                </li>
            </ul>
        </li>
        <!-- LAPORAN -->
        <li class="parent ">
            <a data-toggle="collapse" href="#sub-item-2">
                <span class="glyphicon glyphicon-file"></span>
                Laporan
                <span
                    data-toggle="collapse"
                    href="#sub-item-2"
                    class="icon pull-right">
                    <em class="glyphicon glyphicon-s glyphicon-plus"></em>
                </span>
            </a>
            <ul class="children collapse" id="sub-item-2">
                <li>
                    <a href="#">
                        <span class="glyphicon glyphicon-share-alt"></span>
                        Laporan Buku
                    </a>
                </li>
            </ul>
        </li>
        <li role="presentation" class="divider"></li>
        <!-- LOGOUT -->
        <li>
            <a href="<?= base_url('admin/logout'); ?>">
                <span class="glyphicon glyphicon-log-out"></span>
                Logout
            </a>
        </li>
    </ul>
    <div class="attribution">
        Template by
        <a href="http://www.medialoot.com/item/lumino-admin-bootstrap-template/">
            Medialoot
        </a>
    </div>
</div>