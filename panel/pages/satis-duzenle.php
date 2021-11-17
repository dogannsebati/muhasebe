<?php

$id = (int) $FNC->filter($_GET['id']);

$sql = ('SELECT * FROM satislar WHERE id = :id');
$sqlValues = ['id' => $id];
$satislar = $db->query($sql, $sqlValues);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Satışlar Düzenle</h1>
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
                        <form id="satis-duzenle-form">  
                        <input type="hidden" name="id" id="id" value="<?= $satislar[0]['id']; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="satis_baslik">Başlık</label>
                                    <input type="text"  class="form-control"  placeholder="Satış başlık giriniz" name="satis_baslik" id="satis_baslik" value="<?= $satislar[0]['satis_baslik']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="satis_aciklama">Açıklama</label>
                                    <input type="text" class="form-control"  placeholder="Satış açıklama giriniz" name="satis_aciklama" id="satis_aciklama" value="<?= $satislar[0]['satis_aciklama']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="satis_zaman">Zaman</label>
                                    <input type="date" class="form-control" placeholder="Satış zamanı giriniz" name="satis_zaman" id="satis_zaman" value="<?= $satislar[0]['satis_zaman']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="satis_tutar">Tutar</label>
                                    <input type="text" class="form-control" placeholder="Satış tutar giriniz" name="satis_tutar" id="satis_tutar" value="<?= $satislar[0]['satis_tutar']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="satis_odeme">Ödeme</label>
                                    <input type="text" class="form-control" placeholder="Satış ödeme giriniz" name="satis_odeme" id="satis_odeme" value="<?= $satislar[0]['satis_odeme']; ?>">
                                </div>
                                
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                            <button class="btn btn-primary" onclick="satisDuzenleme('satis-duzenle-form','satis-duzenle');return false;">Düzenle</button>
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