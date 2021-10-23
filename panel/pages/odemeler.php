<?php
if (isset($_REQUEST["sayfa"])) {
    //request hem post hem get geleni alır
    $GelenSayfalama = $_REQUEST["sayfa"];
} else {
    $GelenSayfalama = 1;
}

$sql = ('SELECT * FROM odemeler ORDER BY id');
$toplam = $db->query($sql);

$SayfaBasinaGosterelecekKayitSayisi = 10;
$ToplamKayitSayisi = count($toplam);
$SayfalamayaBaslanacakKayitSayisi  = ($GelenSayfalama * $SayfaBasinaGosterelecekKayitSayisi) - $SayfaBasinaGosterelecekKayitSayisi;

//ceil fonksiyonu doublleri tama çevirir mesela 2.8 i 3 yapar üste yuvarlar
$BulunanSayfaSayisi = ceil($ToplamKayitSayisi / $SayfaBasinaGosterelecekKayitSayisi);

// mesela 3. sayfadayım solda 1 ve 2 sağda 3 ve 4 diyecek 
//ya da 500 sayfadayım 498 499 500 501 502 şeklinde
$SayfalamaIcinSolVeSagButonSayisi = 2;

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ödemeler</h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <button onclick="window.location.href='index.php?page=odeme-ekle'" style="float: right;" class="btn btn-info btn-xs">ÖDEME EKLE</button><br><br>
        <div class="container-fluid">
            <!-- Main row -->
            <div class="col-lg-12">
                <form id="odeme-toplu-islem-form">
                    <div id="odeme-toplu-islem-div">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputState">Seçilenler için uygula</label>
                                <select class="form-control" name="toplu-islem" id="toplu-islem">
                                    <option value="1">Seçilileri Sil</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <button type="button" onclick="odemeTopluIslem('odeme-toplu-islem-form','odeme-toplu-sil');return false;" class="btn btn-primary btn-xs">Uygula</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" class="form-control" style="width: 16px;" id="select_all"></th>
                                <th scope="col">#</th>
                                <th scope="col">Başlık</th>
                                <th scope="col">Açıklama</th>
                                <th scope="col">Kime</th>
                                <th scope="col">Zaman</th>
                                <th scope="col">Tutar</th>
                                <th scope="col">Alınan Zaman</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody id="odemeler-tbody">
                            <?php
                            $sql = ('SELECT * FROM odemeler ORDER BY id ASC LIMIT ' . $SayfalamayaBaslanacakKayitSayisi . ' , ' . $SayfaBasinaGosterelecekKayitSayisi);
                            $odemeler = $db->query($sql);
                            foreach ($odemeler as $odeme) :
                            ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-control" style="width: 16px;" name="odemeler[]" value="<?= $odeme['id'] ?>">
                                    </td>
                                    <th scope="row"><?= $odeme['id']; ?></th>
                                    <td><?= $odeme['odeme_baslik']; ?></td>
                                    <td><?= $odeme['odeme_aciklama']; ?></td>
                                    <td><?= $odeme['odeme_kime']; ?></td>
                                    <td><?= $odeme['odeme_zaman']; ?></td>
                                    <td><?= $odeme['odeme_tutar']; ?></td>
                                    <td><?= $odeme['para_alinan_zaman']; ?></td>
                                    <td><button onclick="odemeSil('<?= $odeme['id'] ?>', 'odeme-sil');" type="button" class="btn btn-danger btn-circle btn-xs" title="Ödeme Sil" style="cursor:pointer;"><i class="fa fa-trash"></i></button>
                                    <button onclick="$(location).attr('href', 'odeme-duzenle-<?= $odeme['id'] ?>');" type="button" class="btn btn-primary btn-circle btn-xs" title="Ödeme Düzenle" style="cursor:pointer;"><i class="fa fa-edit"></i></button></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
                <div class="SayfalamaAlaniKapsayicisi">
                    <div class="SayfalamaAlaniIciMetinAlaniKapsayicisi">
                        Toplam <?php echo $BulunanSayfaSayisi;  ?> sayfada, <?php echo $ToplamKayitSayisi; ?> adet kayıt bulunmaktadır.
                    </div>

                    <div class="SayfalamaAlaniIciNumaralandirmaKapsayicisi">
                        <?php
                        //demekki kullanıcı ilk sayfada değil 
                        if ($GelenSayfalama > 1) {
                            echo "  <span class='Pasif'><a href='odemeler-1'> << </a></span>  ";
                            $SayfalamaIcinSayfaDegeriniBirGeriAl = $GelenSayfalama - 1;
                            echo "  <span class='Pasif'><a href='odemeler-" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'> < </a></span>  ";
                        }

                        for ($SayfalamaIcinSayfaIndexDegeri = $GelenSayfalama - $SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri <= $GelenSayfalama + $SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++) {
                            if (($SayfalamaIcinSayfaIndexDegeri > 0) and ($SayfalamaIcinSayfaIndexDegeri <= $BulunanSayfaSayisi)) {
                                if ($SayfalamaIcinSayfaIndexDegeri == $GelenSayfalama) {
                                    echo  "  <span class='Aktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>  ";
                                } else {
                                    echo " " . "  <span class='Pasif'><a href='odemeler-" . $SayfalamaIcinSayfaIndexDegeri . "' > " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>  ";
                                }
                            }
                        }
                        if ($GelenSayfalama != $BulunanSayfaSayisi) {
                            $SayfalamaIcinSayfaDegeriniBirIleriAl = $GelenSayfalama + 1;
                            echo "  <span class='Pasif'><a href='odemeler-" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'> > </a></span>  ";
                            echo "  <span class='Pasif'><a href='odemeler-" . $BulunanSayfaSayisi . "'> >> </a></span>  ";
                        }
                        ?>
                    </div>

                </div>
            </div>
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>