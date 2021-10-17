<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Masraf Ekle</h1>
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
                        <form id="masraf-ekle-form" autocomplete="off"> 
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="masraf_baslik">Başlık</label>
                                    <input type="text" class="form-control" id="masraf_baslik" name="masraf_baslik" placeholder="Masraf başlığını giriniz">
                                </div>
                                <div class="form-group">
                                    <label for="masraf_aciklama">Açıklama</label>
                                    <input type="text" class="form-control" name="masraf_aciklama" id="masraf_aciklama" placeholder="Masraf açıklama giriniz">
                                </div>
                                <div class="form-group">
                                    <label for="masraf_zaman">Zaman</label>
                                    <input type="date" class="form-control" name="masraf_zaman" id="masraf_zaman" placeholder="Masraf tarih giriniz">
                                </div>
                                <div class="form-group">
                                    <label for="masraf_kategori">Kategori</label>
                                    <input type="text" class="form-control" name="masraf_kategori" id="masraf_kategori" placeholder="Masraf kategori giriniz">
                                </div>
                                <div class="form-group">
                                    <label for="masraf_tutar">Tutar</label>
                                    <input type="text" class="form-control" name="masraf_tutar" id="masraf_tutar" placeholder="Masraf tutar giriniz">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button class="btn btn-primary" onclick="masrafEkle('masraf_ekle-form','masraf-ekle');return false;">Ekle</button>
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