<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Alacak Ekle</h1>
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
                        <form id="alacak-ekle-form">  
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="alacak_isim">Ad Soyad</label>
                                    <input type="text"  class="form-control"  placeholder="Alacak isim soyisim giriniz" name="alacak_isim" id="alacak_isim">
                                </div>
                                <div class="form-group">
                                    <label for="alacak_aciklama">Açıklama</label>
                                    <input type="text" class="form-control"  placeholder="Açıklama giriniz" name="alacak_aciklama" id="alacak_aciklama">
                                </div>
                                <div class="form-group">
                                    <label for="alacak_tutar">Tutar</label>
                                    <input type="text" class="form-control" placeholder="Tutar giriniz" name="alacak_tutar" id="alacak_tutar" >
                                </div>
                                <div class="form-group">
                                    <label for="alacak_zaman">Zaman</label>
                                    <input type="date" class="form-control" name="alacak_zaman" id="alacak_zaman" >
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button class="btn btn-primary" onclick="alacakEkle('alacak-ekle-form','alacak-ekle');return false;">Ekle</button>
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