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
            <div class="row">
                
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

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

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