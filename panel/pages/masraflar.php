<?php
if (isset($_REQUEST["sayfa"])) {
    //request hem post hem get geleni alır
    $GelenSayfalama = $_REQUEST["sayfa"];
} else {
    $GelenSayfalama = 1;
}

$sql = ('SELECT * FROM masraflar ORDER BY id');
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
                    <h1 class="m-0">Masraflar</h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <button onclick="window.location.href='index.php?page=masraf-ekle'" style="float: right;" class="btn btn-info btn-xs">MASRAF EKLE</button><br><br>
        <div class="container-fluid">
            <!-- Main row -->
            <div class="col-lg-12">
                <form id="masraf-toplu-islem-form">
                    <div id="masraf-toplu-islem-div">
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
                                <button type="button" onclick="masrafTopluIslem('masraf-toplu-islem-form','masraf-toplu-sil');return false;" class="btn btn-primary btn-xs">Uygula</button>
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
                                <th scope="col">Tutar</th>
                                <th scope="col">Zaman</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody id="masraflar-tbody">
                            <?php
                            $sql = ('SELECT * FROM masraflar ORDER BY id ASC LIMIT ' . $SayfalamayaBaslanacakKayitSayisi . ' , ' . $SayfaBasinaGosterelecekKayitSayisi);
                            $masraflar = $db->query($sql);
                            foreach ($masraflar as $masraf) :
                            ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-control" style="width: 16px;" name="masraflar[]" value="<?= $masraf['id'] ?>">
                                    </td>
                                    <th scope="row"><?= $masraf['id']; ?></th>
                                    <td><?= $masraf['masraf_baslik']; ?></td>
                                    <td><?= $masraf['masraf_aciklama']; ?></td>
                                    <td><?= $masraf['masraf_tutar']; ?></td>
                                    <td><?= $masraf['masraf_zaman']; ?></td>
                                    <td><?= $masraf['masraf_kategori']; ?></td>
                                    <td><button onclick="masrafSil('<?= $masraf['id'] ?>', 'masraf-sil');" type="button" class="btn btn-danger btn-circle btn-xs" title="Masraf Sil" style="cursor:pointer;"><i class="fa fa-trash"></i></button>
                                    <button onclick="$(location).attr('href', 'masraf-duzenle-<?= $masraf['id'] ?>');" type="button" class="btn btn-primary btn-circle btn-xs" title="Masraf Düzenle" style="cursor:pointer;"><i class="fa fa-edit"></i></button></td>

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
                            echo "  <span class='Pasif'><a href='masraflar-1'> << </a></span>  ";
                            $SayfalamaIcinSayfaDegeriniBirGeriAl = $GelenSayfalama - 1;
                            echo "  <span class='Pasif'><a href='masraflar-" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'> < </a></span>  ";
                        }

                        for ($SayfalamaIcinSayfaIndexDegeri = $GelenSayfalama - $SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri <= $GelenSayfalama + $SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++) {
                            if (($SayfalamaIcinSayfaIndexDegeri > 0) and ($SayfalamaIcinSayfaIndexDegeri <= $BulunanSayfaSayisi)) {
                                if ($SayfalamaIcinSayfaIndexDegeri == $GelenSayfalama) {
                                    echo  "  <span class='Aktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>  ";
                                } else {
                                    echo " " . "  <span class='Pasif'><a href='masraflar-" . $SayfalamaIcinSayfaIndexDegeri . "' > " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>  ";
                                }
                            }
                        }
                        if ($GelenSayfalama != $BulunanSayfaSayisi) {
                            $SayfalamaIcinSayfaDegeriniBirIleriAl = $GelenSayfalama + 1;
                            echo "  <span class='Pasif'><a href='masraflar-" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'> > </a></span>  ";
                            echo "  <span class='Pasif'><a href='masraflar-" . $BulunanSayfaSayisi . "'> >> </a></span>  ";
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