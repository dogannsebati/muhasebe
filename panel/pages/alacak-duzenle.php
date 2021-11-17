<?php

$id = (int) $FNC->filter($_GET['id']);

$sql = ('SELECT * FROM alacaklar WHERE id = :id');
$sqlValues = ['id' => $id];
$alacaklar = $db->query($sql, $sqlValues);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Alacaklar Düzenle</h1>
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
                        <form id="alacak-duzenle-form">  
                        <input type="hidden" name="id" id="id" value="<?= $alacaklar[0]['id']; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="alacak_isim">Ad Soyad</label>
                                    <input type="text"  class="form-control"  placeholder="Alacak isim soyisim giriniz" name="alacak_isim" id="alacak_isim" value="<?= $alacaklar[0]['alacak_isim']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="calisan_yas">Açıklama</label>
                                    <input type="text" class="form-control"  placeholder="Alacak yaşını giriniz" name="alacak_aciklama" id="alacak_aciklama" value="<?= $alacaklar[0]['alacak_aciklama']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="calisan_bolum">Zaman</label>
                                    <input type="date" class="form-control" placeholder="Alacak zamanı giriniz" name="alacak_zaman" id="alacak_zaman" value="<?= $alacaklar[0]['alacak_zaman']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="calisan_maas">Tutar</label>
                                    <input type="text" class="form-control" placeholder="Alacak tutar giriniz" name="alacak_tutar" id="alacak_tutar" value="<?= $alacaklar[0]['alacak_tutar']; ?>">
                                </div>
                                
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                            <button class="btn btn-primary" onclick="alacakDuzenleme('alacak-duzenle-form','alacak-duzenle');return false;">Düzenle</button>
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