<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Satış Ekle</h1>
                </div>

                <!-- /.col -->
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <!-- form start -->
                        <form id="satis-ekle-form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="satis_baslik">Başlık</label>
                                    <input type="text" class="form-control" placeholder="Satış başlık giriniz" name="satis_baslik" id="satis_baslik">
                                </div>
                                <div class="form-group">
                                    <label for="satis_aciklama">Açıklama</label>
                                    <input type="text" class="form-control" placeholder="Açıklama giriniz" name="satis_aciklama" id="satis_aciklama">
                                </div>
                                <div class="form-group">
                                    <label for="satis_tutar">Tutar</label>
                                    <input type="text" class="form-control" placeholder="Tutar giriniz" name="satis_tutar" id="satis_tutar">
                                </div>
                                <div class="form-group">
                                    <label for="satis_zaman">Zaman</label>
                                    <input type="date" class="form-control" name="satis_zaman" id="satis_zaman">
                                </div>
                                <div class="form-group">
                                    <label for="satis_odeme">Ödeme</label>
                                    <input type="text" class="form-control"  placeholder="Ödeme giriniz" name="satis_odeme"  id="satis_odeme">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button class="btn btn-primary" onclick="satisEkle('satis-ekle-form','satis-ekle');return false;">Ekle</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>