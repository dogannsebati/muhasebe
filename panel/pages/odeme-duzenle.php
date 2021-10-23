<?php

$id = (int) $FNC->filter($_GET['id']);

$sql = ('SELECT * FROM odemeler WHERE id = :id');
$sqlValues = ['id' => $id];
$odeme = $db->query($sql, $sqlValues);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ödeme Düzenle</h1>
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
                        <form id="odeme-duzenle-form">  
                        <input type="hidden" name="id" id="id" value="<?= $odeme[0]['id'] ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="odeme_baslik">Başlık</label>
                                    <input type="text"  class="form-control"  placeholder="Ödeme başlığını giriniz" name="odeme_baslik" id="odeme_baslik" value="<?= $odeme[0]['odeme_baslik'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="odeme_aciklama">Açıklama</label>
                                    <input type="text" class="form-control"  placeholder="Ödeme açıklama giriniz" name="odeme_aciklama" id="odeme_aciklama" value="<?= $odeme[0]['odeme_aciklama'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="odeme_kime">Ödeme Kime Yapılacak</label>
                                    <input type="text" class="form-control"  placeholder="İsim giriniz" name="odeme_kime" id="odeme_kime" value="<?= $odeme[0]['odeme_kime'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="odeme_zaman">Zaman</label>
                                    <input type="date" class="form-control" placeholder="Ödeme tarih giriniz" name="odeme_zaman" id="odeme_zaman" value="<?= $odeme[0]['odeme_zaman'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="odeme_tutar">Tutar</label>
                                    <input type="text" class="form-control" placeholder="Ödeme tutar giriniz" name="odeme_tutar" id="odeme_tutar" value="<?= $odeme[0]['odeme_tutar'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="para_alinan_zaman">Alınan Zaman</label>
                                    <input type="date" class="form-control" placeholder="Ödeme tarih giriniz" name="para_alinan_zaman" id="para_alinan_zaman" value="<?= $odeme[0]['para_alinan_zaman'] ?>">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button class="btn btn-primary" onclick="odemeDuzenle('odeme-duzenle-form','odeme-duzenle');return false;">Düzenle</button>
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