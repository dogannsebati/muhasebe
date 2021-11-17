<?php

$id = (int) $FNC->filter($_GET['id']);

$sql = ('SELECT * FROM nakit WHERE id = :id');
$sqlValues = ['id' => $id];
$nakit = $db->query($sql, $sqlValues);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nakit Düzenle</h1>
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
                        <form id="nakit-duzenle-form">
                            <input type="hidden" name="id" id="id" value="<?= $nakit[0]['id']; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="para_baslik">Başlık</label>
                                    <input type="text" class="form-control" placeholder="Başlık giriniz" name="para_baslik" id="para_baslik" value="<?= $nakit[0]['para_baslik'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="para_aciklama">Açıklama</label>
                                    <input type="text" class="form-control" placeholder="Açıklama giriniz" name="para_aciklama" id="para_aciklama" value="<?= $nakit[0]['para_aciklama'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="para_gelen">Gelen Para</label>
                                    <input type="text" class="form-control" placeholder="Gelen tutarı giriniz" name="para_gelen" id="para_gelen" value="<?= $nakit[0]['para_gelen'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="para_giden">Giden Para</label>
                                    <input type="text" class="form-control" placeholder="Giden tutarı giriniz" name="para_giden" id="para_giden" value="<?= $nakit[0]['para_giden'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="para_zaman">Zaman</label>
                                    <input type="date" class="form-control" name="para_zaman" id="para_zaman" value="<?= $nakit[0]['para_zaman'] ?>">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button class="btn btn-primary" onclick="nakitDuzenle('nakit-duzenle-form','nakit-duzenle');return false;">Düzenle</button>
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