<?php

$id = (int) $FNC->filter($_GET['id']);

$sql = ('SELECT * FROM personel WHERE id = :id');
$sqlValues = ['id' => $id];
$personel = $db->query($sql, $sqlValues);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Personel Düzenle</h1>
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
                        <form id="personel-duzenle-form">  
                        <input type="hidden" name="id" id="id" value="<?= $personel[0]['id']; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="calisan_isim">Ad Soyad</label>
                                    <input type="text"  class="form-control"  placeholder="Çalışan isim soyisim giriniz" name="calisan_isim" id="calisan_isim" value="<?= $personel[0]['calisan_isim']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="calisan_yas">Yaş</label>
                                    <input type="text" class="form-control"  placeholder="Çalışanın yaşını giriniz" name="calisan_yas" id="calisan_yas" value="<?= $personel[0]['calisan_yas']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="calisan_bolum">Bölüm</label>
                                    <input type="text" class="form-control" placeholder="Çalışanın bölümünü giriniz" name="calisan_bolum" id="calisan_bolum" value="<?= $personel[0]['calisan_bolum']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="calisan_maas">Maaş</label>
                                    <input type="text" class="form-control" placeholder="Çalışan maaş giriniz" name="calisan_maas" id="calisan_maas" value="<?= $personel[0]['calisan_maas']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="ise_baslama_tarih">İşe Başlama Tarihi</label>
                                    <input type="date" class="form-control" name="ise_baslama_tarih" id="ise_baslama_tarih" value="<?= $personel[0]['ise_baslama_tarih']; ?>">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                            <button class="btn btn-primary" onclick="personelDuzenle('personel-duzenle-form','personel-duzenle');return false;">Düzenle</button>
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