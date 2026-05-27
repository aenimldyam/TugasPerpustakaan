<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">

        <ol class="breadcrumb">

            <li>
                <a href="#">
                    <span class="glyphicon glyphicon-home"></span>
                </a>
            </li>

            <li class="active">
                Dashboard
            </li>

        </ol>

    </div>

    <div class="row">

        <div class="col-lg-12">

            <h1 class="page-header">
                Dashboard Sistem Perpustakaan
            </h1>

        </div>

    </div>

    <div class="row">

        <div class="col-xs-12 col-md-6 col-lg-3">

            <div class="panel panel-blue panel-widget">

                <div class="row no-padding">

                    <div class="col-sm-3 col-lg-5 widget-left">

                        <em class="glyphicon glyphicon-book glyphicon-l"></em>

                    </div>

                    <div class="col-sm-9 col-lg-7 widget-right">

                        <div class="large">
                            <?= $total_buku ?? 0; ?>
                        </div>

                        <div class="text-muted">
                            Total Buku
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xs-12 col-md-6 col-lg-3">

            <div class="panel panel-orange panel-widget">

                <div class="row no-padding">

                    <div class="col-sm-3 col-lg-5 widget-left">

                        <em class="glyphicon glyphicon-user glyphicon-l"></em>

                    </div>

                    <div class="col-sm-9 col-lg-7 widget-right">

                        <div class="large">
                            <?= $total_anggota ?? 0; ?>
                        </div>

                        <div class="text-muted">
                            Total Anggota
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xs-12 col-md-6 col-lg-3">

            <div class="panel panel-teal panel-widget">

                <div class="row no-padding">

                    <div class="col-sm-3 col-lg-5 widget-left">

                        <em class="glyphicon glyphicon-tags glyphicon-l"></em>

                    </div>

                    <div class="col-sm-9 col-lg-7 widget-right">

                        <div class="large">
                            <?= $total_kategori ?? 0; ?>
                        </div>

                        <div class="text-muted">
                            Total Kategori
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xs-12 col-md-6 col-lg-3">

            <div class="panel panel-red panel-widget">

                <div class="row no-padding">

                    <div class="col-sm-3 col-lg-5 widget-left">

                        <em class="glyphicon glyphicon-th-large glyphicon-l"></em>

                    </div>

                    <div class="col-sm-9 col-lg-7 widget-right">

                        <div class="large">
                            <?= $total_rak ?? 0; ?>
                        </div>

                        <div class="text-muted">
                            Total Rak
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="panel panel-default">

        <div class="panel-heading">

            Selamat Datang

        </div>

        <div class="panel-body">

            <h4>
                Selamat datang di Sistem Informasi Perpustakaan.
            </h4>

            <p>
                Gunakan menu sidebar untuk mengelola data admin,
                anggota, kategori, rak, dan buku perpustakaan.
            </p>

        </div>

    </div>

</div>