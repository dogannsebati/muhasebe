<?php
if (isset($_REQUEST["sayfa"])) {
    //request hem post hem get geleni alır
    $GelenSayfalama = $_REQUEST["sayfa"];
} else {
    $GelenSayfalama = 1;
}

$sql = ('SELECT * FROM personel ORDER BY id');
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
                    <h1 class="m-0">Personeller</h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <button onclick="window.location.href='index.php?page=personel-ekle'" style="float: right;" class="btn btn-info btn-xs">PERSONEL EKLE</button><br><br>
        <div class="container-fluid">
            <!-- Main row -->
            <div class="col-lg-12">
                <form id="personel-toplu-islem-form">
                    <div id="personel-toplu-islem-div">
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
                                <button type="button" onclick="personelTopluIslem('personel-toplu-islem-form','personel-toplu-sil');return false;" class="btn btn-primary btn-xs">Uygula</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" class="form-control" style="width: 16px;" id="select_all"></th>
                                <th scope="col">#</th>
                                <th scope="col">Ad Soyad</th>
                                <th scope="col">Yaş</th>
                                <th scope="col">Bölüm</th>
                                <th scope="col">Maaş</th>
                                <th scope="col">Başlama Tarihi</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody id="masraflar-tbody">
                            <?php
                            $sql = ('SELECT * FROM personel ORDER BY id ASC LIMIT ' . $SayfalamayaBaslanacakKayitSayisi . ' , ' . $SayfaBasinaGosterelecekKayitSayisi);
                            $personeller = $db->query($sql);
                            foreach ($personeller as $personel) :
                            ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-control" style="width: 16px;" name="personeller[]" value="<?= $personel['id'] ?>">
                                    </td>
                                    <th scope="row"><?= $personel['id']; ?></th>
                                    <td><?= $personel['calisan_isim']; ?></td>
                                    <td><?= $personel['calisan_yas']; ?></td>
                                    <td><?= $personel['calisan_bolum']; ?></td>
                                    <td><?= $personel['calisan_maas']; ?></td>
                                    <td><?= $personel['ise_baslama_tarih']; ?></td>
                                    <td><button onclick="personelSil('<?= $personel['id'] ?>', 'personel-sil');" type="button" class="btn btn-danger btn-circle btn-xs" title="Personel Sil" style="cursor:pointer;"><i class="fa fa-trash"></i></button>
                                    <button onclick="$(location).attr('href', 'personel-duzenle-<?= $personel['id'] ?>');" type="button" class="btn btn-primary btn-circle btn-xs" title="Personel Düzenle" style="cursor:pointer;"><i class="fa fa-edit"></i></button></td>

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
                            echo "  <span class='Pasif'><a href='personel-1'> << </a></span>  ";
                            $SayfalamaIcinSayfaDegeriniBirGeriAl = $GelenSayfalama - 1;
                            echo "  <span class='Pasif'><a href='personel-" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'> < </a></span>  ";
                        }

                        for ($SayfalamaIcinSayfaIndexDegeri = $GelenSayfalama - $SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri <= $GelenSayfalama + $SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++) {
                            if (($SayfalamaIcinSayfaIndexDegeri > 0) and ($SayfalamaIcinSayfaIndexDegeri <= $BulunanSayfaSayisi)) {
                                if ($SayfalamaIcinSayfaIndexDegeri == $GelenSayfalama) {
                                    echo  "  <span class='Aktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>  ";
                                } else {
                                    echo " " . "  <span class='Pasif'><a href='personel-" . $SayfalamaIcinSayfaIndexDegeri . "' > " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>  ";
                                }
                            }
                        }
                        if ($GelenSayfalama != $BulunanSayfaSayisi) {
                            $SayfalamaIcinSayfaDegeriniBirIleriAl = $GelenSayfalama + 1;
                            echo "  <span class='Pasif'><a href='personel-" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'> > </a></span>  ";
                            echo "  <span class='Pasif'><a href='personel-" . $BulunanSayfaSayisi . "'> >> </a></span>  ";
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