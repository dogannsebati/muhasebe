<?php
require_once(realpath(__DIR__ . '/../') . '/' . 'inc/function.php');
isset($_POST['islem_turu']) ? $action = $FNC->filter($_POST['islem_turu']) : exit();


if ($action == 'admin-giris') {
    $kulad = $FNC->filter($_POST['kulad']);
    $sifre = $FNC->filter($_POST['sifre']);
    if ($kulad == null || $kulad == "") {
        $FNC->sendResult(false, 'Kullanıcı adı boş olamaz !', 'kulad');
    } else if ($sifre == null || $sifre == "") {
        $FNC->sendResult(false, 'Şifre boş olamaz !', 'sifre');
    } else if (strlen($sifre) < 6) {
        $FNC->sendResult(false, 'Şifre 6 haneden kısa olamaz !', 'sifre');
    } else {
        $sql = ('SELECT * FROM uyeler WHERE kulad = :kulad AND sifre = :sifre LIMIT 1');
        $sqlValues = ['kulad' => $kulad, 'sifre' => $FNC->sifreleme($sifre)];
        $kontrol = $db->query($sql, $sqlValues);
        if (count($kontrol) > 0) {
            $SH->setAdminSession($kontrol[0]);
            $FNC->sendResult(true, 'Giriş başarılı. Yönlendiriliyorsunuz.');
        } else {
            $FNC->sendResult(false, 'Kullanıcı adınız ya da şifre yanlış kontrol ediniz !');
        }
    }
}

if ($action == 'masraf-ekle') {
    $masraf_baslik = $FNC->filter($_POST['masraf_baslik']); //telefon aldım
    $masraf_aciklama = $FNC->filter($_POST['masraf_aciklama']);
    $masraf_zaman = $FNC->filter($_POST['masraf_zaman']);
    $masraf_kategori = $FNC->filter($_POST['masraf_kategori']);
    $masraf_tutar = $FNC->filter($_POST['masraf_tutar']);

    if ($masraf_baslik == null || $masraf_baslik == "") {
        $FNC->sendResult(false, 'Masraf başlık boş olamaz !');
    } else if ($masraf_aciklama == null || $masraf_aciklama == "") {
        $FNC->sendResult(false, 'Masraf açıklama boş olamaz !');
    } else if ($masraf_zaman == null || $masraf_zaman == "") {
        $FNC->sendResult(false, 'Masraf zaman boş olamaz !');
    } else if ($masraf_kategori == null || $masraf_kategori == "") {
        $FNC->sendResult(false, 'Masraf kategori boş olamaz !');
    } else if ($masraf_tutar == null || $masraf_tutar == "") {
        $FNC->sendResult(false, 'Masraf tutar boş olamaz !');
    } else {
        $sql = ('INSERT INTO masraflar SET
        masraf_baslik      = :masraf_baslik,
        masraf_aciklama    = :masraf_aciklama,
        masraf_zaman       = :masraf_zaman,
        masraf_kategori    = :masraf_kategori,
        masraf_tutar       = :masraf_tutar ');

        $sqlValues = ['masraf_baslik' => $masraf_baslik, 'masraf_aciklama' => $masraf_aciklama, 'masraf_zaman' => $masraf_zaman, 'masraf_kategori' => $masraf_kategori, 'masraf_tutar' => $masraf_tutar]; //telefon aldım 
        $kontrol = $db->query($sql, $sqlValues);
        if ($kontrol) {
            $FNC->sendResult(true, 'Masraf eklendi!');
        } else {
            $FNC->sendResult(false, 'Masraf ekleme hata !');
        }
    }
}

if ($action == 'masraf-sil') {
    if ($_POST['id'] <= 0) {
        $FNC->sendResult(false, 'Id sıfırdan küçük ya da eşit olamaz');
    }
    $sql = ('DELETE FROM masraflar WHERE id = :id');
    $sqlValues = ['id' => (int) $FNC->filter($_POST['id'])];
    $kontrol = $db->query($sql, $sqlValues);
    if ($kontrol) {
        $FNC->sendResult(true, 'Masraf başarıyla silindi');
    } else {
        $FNC->sendResult(false, 'Masraf silme hata !');
    }
}

if ($action == 'masraf-toplu-sil') {
    $say = 0;
    if (isset($_POST['masraflar'])) {
        $idler = $_POST['masraflar'];
        foreach ($idler as $id) {
            $sql = ('DELETE FROM masraflar WHERE id = :id');
            $sqlValues = ['id' => $id];
            $kontrol = $db->query($sql, $sqlValues);
            if ($kontrol) {
                $say = $say + 1;
            }
        }
        if ($say == count($idler)) {
            $FNC->sendResult(true, 'Masraflar başarıyla silindi');
        } else {
            $FNC->sendResult(true, 'Masraflar toplu silme hata #1');
        }
    } else {
        $FNC->sendResult(true, 'Masraflar toplu silme hata #2');
    }
}


if ($action == 'masraf-duzenle') {
    $id = (int)$FNC->filter($_POST['id']);
    $masraf_baslik = $FNC->filter($_POST['masraf_baslik']);
    $masraf_aciklama = $FNC->filter($_POST['masraf_aciklama']);
    $masraf_zaman = $FNC->filter($_POST['masraf_zaman']);
    $masraf_kategori = $FNC->filter($_POST['masraf_kategori']);
    $masraf_tutar = $FNC->filter($_POST['masraf_tutar']);
    if ($id <= 0) {
        $FNC->sendResult(false, 'Id sıfırdan küçük ya da eşit olamaz');
    } else if ($masraf_baslik == null || $masraf_baslik == "") {
        $FNC->sendResult(false, 'Masraf başlık boş olamaz !');
    } else if ($masraf_aciklama == null || $masraf_aciklama == "") {
        $FNC->sendResult(false, 'Masraf açıklama boş olamaz !');
    } else if ($masraf_zaman == null || $masraf_zaman == "") {
        $FNC->sendResult(false, 'Masraf zaman boş olamaz !');
    } else if ($masraf_kategori == null || $masraf_kategori == "") {
        $FNC->sendResult(false, 'Masraf kategori boş olamaz !');
    } else if ($masraf_tutar == null || $masraf_tutar == "") {
        $FNC->sendResult(false, 'Masraf tutar boş olamaz !');
    } else {
        $sql = ('UPDATE masraflar SET
        masraf_baslik      = :masraf_baslik,
        masraf_aciklama    = :masraf_aciklama,
        masraf_zaman       = :masraf_zaman,
        masraf_kategori    = :masraf_kategori,
        masraf_tutar       = :masraf_tutar WHERE id = :id ');

        $sqlValues = ['masraf_baslik' => $masraf_baslik, 'masraf_aciklama' => $masraf_aciklama, 'masraf_zaman' => $masraf_zaman, 'masraf_kategori' => $masraf_kategori, 'masraf_tutar' => $masraf_tutar, 'id' => $id]; //telefon aldım 
        $kontrol = $db->query($sql, $sqlValues);
        if ($kontrol) {
            $FNC->sendResult(true, 'Masraf düzenlendi!');
        } else {
            $FNC->sendResult(false, 'Masraf düzenleme hata !');
        }
    }
}


if ($action == 'odeme-ekle') {
    $odeme_baslik = $FNC->filter($_POST['odeme_baslik']); //telefon aldım
    $odeme_aciklama = $FNC->filter($_POST['odeme_aciklama']);
    $odeme_kime = $FNC->filter($_POST['odeme_kime']);
    $odeme_zaman = $FNC->filter($_POST['odeme_zaman']);
    $odeme_tutar = $FNC->filter($_POST['odeme_tutar']);
    $para_alinan_zaman = $FNC->filter($_POST['para_alinan_zaman']);

    if ($odeme_baslik == null || $odeme_baslik == "") {
        $FNC->sendResult(false, 'Ödeme başlık boş olamaz !');
    } else if ($odeme_aciklama == null || $odeme_aciklama == "") {
        $FNC->sendResult(false, 'Ödeme açıklama boş olamaz !');
    } else if ($odeme_kime == null || $odeme_kime == "") {
        $FNC->sendResult(false, 'İsim boş olamaz !');
    } else if ($odeme_zaman == null || $odeme_zaman == "") {
        $FNC->sendResult(false, 'Ödeme zaman boş olamaz !');
    } else if ($odeme_tutar == null || $odeme_tutar == "") {
        $FNC->sendResult(false, 'Ödeme tutar boş olamaz !');
    } else if ($para_alinan_zaman == null || $para_alinan_zaman == "") {
        $FNC->sendResult(false, 'Ödeme alınan zaman boş olamaz  !');
    } else {
        $sql = ('INSERT INTO odemeler SET
        odeme_baslik      = :odeme_baslik,
        odeme_aciklama    = :odeme_aciklama,
        odeme_kime       = :odeme_kime,
        odeme_zaman    = :odeme_zaman,
        odeme_tutar       = :odeme_tutar,
        para_alinan_zaman       = :para_alinan_zaman ');

        $sqlValues = ['odeme_baslik' => $odeme_baslik, 'odeme_aciklama' => $odeme_aciklama, 'odeme_kime' => $odeme_kime, 'odeme_zaman' => $odeme_zaman, 'odeme_tutar' => $odeme_tutar, 'para_alinan_zaman' => $para_alinan_zaman]; //telefon aldım 
        $kontrol = $db->query($sql, $sqlValues);
        if ($kontrol) {
            $FNC->sendResult(true, 'Ödeme eklendi!');
        } else {
            $FNC->sendResult(false, 'Ödeme ekleme hata !');
        }
    }
}

if ($action == 'odeme-sil') {
    if ($_POST['id'] <= 0) {
        $FNC->sendResult(false, 'Id sıfırdan küçük ya da eşit olamaz');
    }
    $sql = ('DELETE FROM odemeler WHERE id = :id');
    $sqlValues = ['id' => (int) $FNC->filter($_POST['id'])];
    $kontrol = $db->query($sql, $sqlValues);
    if ($kontrol) {
        $FNC->sendResult(true, 'Ödeme başarıyla silindi');
    } else {
        $FNC->sendResult(false, 'Ödeme silme hata !');
    }
}

if ($action == 'odeme-toplu-sil') {
    $say = 0;
    if (isset($_POST['odemeler'])) {
        $idler = $_POST['odemeler'];
        foreach ($idler as $id) {
            $sql = ('DELETE FROM odemeler WHERE id = :id');
            $sqlValues = ['id' => $id];
            $kontrol = $db->query($sql, $sqlValues);
            if ($kontrol) {
                $say = $say + 1;
            }
        }
        if ($say == count($idler)) {
            $FNC->sendResult(true, 'Ödemeler başarıyla silindi');
        } else {
            $FNC->sendResult(true, 'Ödemeler toplu silme hata #1');
        }
    } else {
        $FNC->sendResult(true, 'Ödemeler toplu silme hata #2');
    }
}


if ($action == 'odeme-duzenle') {
    $id = (int)$FNC->filter($_POST['id']);
    $odeme_baslik = $FNC->filter($_POST['odeme_baslik']);
    $odeme_aciklama = $FNC->filter($_POST['odeme_aciklama']);
    $odeme_kime = $FNC->filter($_POST['odeme_kime']);
    $odeme_zaman = $FNC->filter($_POST['odeme_zaman']);
    $odeme_tutar = $FNC->filter($_POST['odeme_tutar']);
    $para_alinan_zaman = $FNC->filter($_POST['para_alinan_zaman']);

    if ($id <= 0) {
        $FNC->sendResult(false, 'Id sıfırdan küçük ya da eşit olamaz');
    } else if ($odeme_baslik == null || $odeme_baslik == "") {
        $FNC->sendResult(false, 'Ödeme başlık boş olamaz !');
    } else if ($odeme_aciklama == null || $odeme_aciklama == "") {
        $FNC->sendResult(false, 'Ödeme açıklama boş olamaz !');
    } else if ($odeme_kime == null || $odeme_kime == "") {
        $FNC->sendResult(false, 'İsim boş olamaz !');
    } else if ($odeme_zaman == null || $odeme_zaman == "") {
        $FNC->sendResult(false, 'Ödeme zaman boş olamaz !');
    } else if ($odeme_tutar == null || $odeme_tutar == "") {
        $FNC->sendResult(false, 'Ödeme tutar boş olamaz !');
    } else if ($para_alinan_zaman == null || $para_alinan_zaman == "") {
        $FNC->sendResult(false, 'Ödeme alınan zaman boş olamaz  !');
    } else {
        $sql = ('UPDATE odemeler SET
        odeme_baslik      = :odeme_baslik,
        odeme_aciklama    = :odeme_aciklama,
        odeme_kime       = :odeme_kime,
        odeme_zaman    = :odeme_zaman,
        odeme_tutar       = :odeme_tutar,
        para_alinan_zaman       = :para_alinan_zaman WHERE id = :id');

        $sqlValues = ['odeme_baslik' => $odeme_baslik, 'odeme_aciklama' => $odeme_aciklama, 'odeme_kime' => $odeme_kime, 'odeme_zaman' => $odeme_zaman, 'odeme_tutar' => $odeme_tutar, 'para_alinan_zaman' => $para_alinan_zaman ,'id' => $id]; //telefon aldım 
        $kontrol = $db->query($sql, $sqlValues);
        if ($kontrol) {
            $FNC->sendResult(true, 'Ödeme güncellendi!');
        } else {
            $FNC->sendResult(false, 'Ödeme güncelleme hata !');
        }
    }
}

if ($action == 'personel-ekle') {
    $calisan_isim = $FNC->filter($_POST['calisan_isim']); //telefon aldım
    $calisan_yas = $FNC->filter($_POST['calisan_yas']);
    $calisan_bolum = $FNC->filter($_POST['calisan_bolum']);
    $calisan_maas = $FNC->filter($_POST['calisan_maas']);
    $ise_baslama_tarih = $FNC->filter($_POST['ise_baslama_tarih']);
   

    if ($calisan_isim == null || $calisan_isim == "") {
        $FNC->sendResult(false, 'Personel isim boş olamaz !');
    } else if ($calisan_yas == null || $calisan_yas == "") {
        $FNC->sendResult(false, 'Personel yaş boş olamaz !');
    } else if ($calisan_bolum == null || $calisan_bolum == "") {
        $FNC->sendResult(false, 'Personel Bölümü boş olamaz !');
    } else if ($ise_baslama_tarih == null || $ise_baslama_tarih == "") {
        $FNC->sendResult(false, 'Personel Başlama boş olamaz !');
    }else if ($calisan_maas == null || $calisan_maas == "") {
        $FNC->sendResult(false, 'Personel Maaş boş olamaz !');
    }  else {
        $sql = ('INSERT INTO personel SET
        calisan_isim      = :calisan_isim,
        calisan_yas    = :calisan_yas,
        calisan_bolum      = :calisan_bolum,
        calisan_maas      = :calisan_maas,
        ise_baslama_tarih    = :ise_baslama_tarih');

        $sqlValues = ['calisan_isim' => $calisan_isim, 'calisan_yas' => $calisan_yas, 'calisan_bolum' => $calisan_bolum, 'calisan_maas' => $calisan_maas, 'ise_baslama_tarih' => $ise_baslama_tarih]; //telefon aldım 
        $kontrol = $db->query($sql, $sqlValues);
        if ($kontrol) {
            $FNC->sendResult(true, 'Personel eklendi!');
        } else {
            $FNC->sendResult(false, 'Personel ekleme hata !');
        }
    }
}

if ($action == 'personel-sil') {
    if ($_POST['id'] <= 0) {
        $FNC->sendResult(false, 'Id sıfırdan küçük ya da eşit olamaz');
    }
    $sql = ('DELETE FROM personel WHERE id = :id');
    $sqlValues = ['id' => (int) $FNC->filter($_POST['id'])];
    $kontrol = $db->query($sql, $sqlValues);
    if ($kontrol) {
        $FNC->sendResult(true, 'Personel başarıyla silindi');
    } else {
        $FNC->sendResult(false, 'Personel silme hata !');
    }
}


if ($action == 'personel-duzenle') {
    $id = (int)$FNC->filter($_POST['id']);
    $calisan_isim = $FNC->filter($_POST['calisan_isim']); //telefon aldım
    $calisan_yas = $FNC->filter($_POST['calisan_yas']);
    $calisan_bolum = $FNC->filter($_POST['calisan_bolum']);
    $calisan_maas = $FNC->filter($_POST['calisan_maas']);
    $ise_baslama_tarih = $FNC->filter($_POST['ise_baslama_tarih']);
   

    if ($id <= 0) {
        $FNC->sendResult(false, 'Id sıfırdan küçük ya da eşit olamaz');
    }else if ($calisan_isim == null || $calisan_isim == "") {
        $FNC->sendResult(false, 'Personel isim boş olamaz !');
    } else if ($calisan_yas == null || $calisan_yas == "") {
        $FNC->sendResult(false, 'Personel yaş boş olamaz !');
    } else if ($calisan_bolum == null || $calisan_bolum == "") {
        $FNC->sendResult(false, 'Personel Bölümü boş olamaz !');
    } else if ($ise_baslama_tarih == null || $ise_baslama_tarih == "") {
        $FNC->sendResult(false, 'Personel Başlama boş olamaz !');
    }else if ($calisan_maas == null || $calisan_maas == "") {
        $FNC->sendResult(false, 'Personel Maaş boş olamaz !');
    }  else {
        $sql = ('UPDATE personel SET
        calisan_isim      = :calisan_isim,
        calisan_yas    = :calisan_yas,
        calisan_bolum      = :calisan_bolum,
        calisan_maas      = :calisan_maas,
        ise_baslama_tarih    = :ise_baslama_tarih WHERE id = :id');

        $sqlValues = ['calisan_isim' => $calisan_isim, 'calisan_yas' => $calisan_yas, 'calisan_bolum' => $calisan_bolum, 'calisan_maas' => $calisan_maas, 'ise_baslama_tarih' => $ise_baslama_tarih,'id' => $id]; //telefon aldım 
        $kontrol = $db->query($sql, $sqlValues);
        if ($kontrol) {
            $FNC->sendResult(true, 'Personel düzenlendi!');
        } else {
            $FNC->sendResult(false, 'Personel düzenleme hata !');
        }
    }
}

if ($action == 'personel-toplu-sil') {
    $say = 0;
    if (isset($_POST['personeller'])) {
        $idler = $_POST['personeller'];
        foreach ($idler as $id) {
            $sql = ('DELETE FROM personel WHERE id = :id');
            $sqlValues = ['id' => $id];
            $kontrol = $db->query($sql, $sqlValues);
            if ($kontrol) {
                $say = $say + 1;
            }
        }
        if ($say == count($idler)) {
            $FNC->sendResult(true, 'Personel başarıyla silindi');
        } else {
            $FNC->sendResult(true, 'Personel toplu silme hata #1');
        }
    } else {
        $FNC->sendResult(true, 'Personel toplu silme hata #2');
    }
}


if ($action == 'alacak-ekle') {
    $alacak_isim = $FNC->filter($_POST['alacak_isim']); //telefon aldım
    $alacak_aciklama = $FNC->filter($_POST['alacak_aciklama']);
    $alacak_tutar = $FNC->filter($_POST['alacak_tutar']);
    $alacak_zaman = $FNC->filter($_POST['alacak_zaman']);
   

    if ($alacak_isim == null || $alacak_isim == "") {
        $FNC->sendResult(false, 'Alacak isim boş olamaz !');
    } else if ($alacak_aciklama == null || $alacak_aciklama == "") {
        $FNC->sendResult(false, 'Açıklama boş olamaz !');
    } else if ($alacak_tutar == null || $alacak_tutar == "") {
        $FNC->sendResult(false, 'Tutar boş olamaz !');
    } else if ($alacak_zaman == null || $alacak_zaman == "") {
        $FNC->sendResult(false, 'Zaman boş olamaz !');
    }  else {
        $sql = ('INSERT INTO alacaklar SET
        alacak_isim      = :alacak_isim,
        alacak_aciklama    = :alacak_aciklama,
        alacak_tutar      = :alacak_tutar,
        alacak_zaman      = :alacak_zaman');

        $sqlValues = ['alacak_isim' => $alacak_isim, 'alacak_aciklama' => $alacak_aciklama, 'alacak_tutar' => $alacak_tutar, 'alacak_zaman' => $alacak_zaman]; //telefon aldım 
        $kontrol = $db->query($sql, $sqlValues);
        if ($kontrol) {
            $FNC->sendResult(true, 'Alacak eklendi!');
        } else {
            $FNC->sendResult(false, 'Alacak ekleme hata !');
        }
    }
}
if ($action == 'alacak-duzenle') {
    $id = (int)$FNC->filter($_POST['id']);
    $alacak_isim = $FNC->filter($_POST['alacak_isim']); //telefon aldım
    $alacak_aciklama = $FNC->filter($_POST['alacak_aciklama']);
    $alacak_tutar = $FNC->filter($_POST['alacak_tutar']);
    $alacak_zaman = $FNC->filter($_POST['alacak_zaman']);
    
   

    if ($id <= 0) {
        $FNC->sendResult(false, 'Id sıfırdan küçük ya da eşit olamaz');
    }else if ($alacak_isim == null || $alacak_isim == "") {
        $FNC->sendResult(false, 'Alacak isim boş olamaz !');
    } else if ($alacak_aciklama == null || $alacak_aciklama == "") {
        $FNC->sendResult(false, 'Alacak açıklama yaş boş olamaz !');
    } else if ($alacak_tutar == null || $alacak_tutar == "") {
        $FNC->sendResult(false, 'Alacak tutar boş olamaz !');
    } else if ($alacak_zaman == null || $alacak_zaman == "") {
        $FNC->sendResult(false, 'Alacak zamanı boş olamaz !');

    }  else {
        $sql = ('UPDATE alacaklar SET
        alacak_isim      = :alacak_isim,
        alacak_aciklama    = :alacak_aciklama,
        alacak_tutar      = :alacak_tutar,
        alacak_zaman      = :alacak_zaman WHERE id = :id');

        $sqlValues = ['alacak_isim' => $alacak_isim, 'alacak_aciklama' => $alacak_aciklama, 'alacak_tutar' => $alacak_tutar, 'alacak_zaman' => $alacak_zaman,'id' => $id]; //telefon aldım 
        $kontrol = $db->query($sql, $sqlValues);
        if ($kontrol) {
            $FNC->sendResult(true, 'Alacak düzenlendi!');
        } else {
            $FNC->sendResult(false, 'Alacak düzenleme hata !');
        }
    }
}

if ($action == 'alacak-sil') {
    if ($_POST['id'] <= 0) {
        $FNC->sendResult(false, 'Id sıfırdan küçük ya da eşit olamaz');
    }
    $sql = ('DELETE FROM alacaklar WHERE id = :id');
    $sqlValues = ['id' => (int) $FNC->filter($_POST['id'])];
    $kontrol = $db->query($sql, $sqlValues);
    if ($kontrol) {
        $FNC->sendResult(true, 'Alacak başarıyla silindi');
    } else {
        $FNC->sendResult(false, 'Alacak silme hata !');
    }
}
if ($action == 'alacak-toplu-sil') {
    $say = 0;
    if (isset($_POST['alacaklar'])) {
        $idler = $_POST['alacaklar'];
        foreach ($idler as $id) {
            $sql = ('DELETE FROM alacaklar WHERE id = :id');
            $sqlValues = ['id' => $id];
            $kontrol = $db->query($sql, $sqlValues);
            if ($kontrol) {
                $say = $say + 1;
            }
        }
        if ($say == count($idler)) {
            $FNC->sendResult(true, 'Alacaklar başarıyla silindi');
        } else {
            $FNC->sendResult(true, 'Alacaklar toplu silme hata #1');
        }
    } else {
        $FNC->sendResult(true, 'Alacakar toplu silme hata #2');
    }
}

if($action == "satis-ekle"){
    $satis_baslik = $FNC->filter($_POST['satis_baslik']);
    $satis_aciklama = $FNC->filter($_POST['satis_aciklama']);
    $satis_tutar = $FNC->filter($_POST['satis_tutar']);
    $satis_zaman = $FNC->filter($_POST['satis_zaman']);
    $satis_odeme = $FNC->filter($_POST['satis_odeme']);

    if ($satis_baslik == null || $satis_baslik == "") {
        $FNC->sendResult(false, 'Başlık boş olamaz !');
    } else if ($satis_aciklama == null || $satis_aciklama == "") {
        $FNC->sendResult(false, 'Açıklama boş olamaz !');
    } else if ($satis_tutar == null || $satis_tutar == "") {
        $FNC->sendResult(false, 'Tutar boş olamaz !');
    } else if ($satis_zaman == null || $satis_zaman == "") {
        $FNC->sendResult(false, 'Zaman boş olamaz !');
    } else if ($satis_odeme == null || $satis_odeme == "") {
        $FNC->sendResult(false, 'Ödeme boş olamaz !');
    }  else {
        $sql = ('INSERT INTO satislar SET
        satis_baslik      = :satis_baslik,
        satis_aciklama    = :satis_aciklama,
        satis_tutar      = :satis_tutar,
        satis_zaman      = :satis_zaman,
        satis_odeme      = :satis_odeme ');

        $sqlValues = ['satis_baslik' => $satis_baslik, 'satis_aciklama' => $satis_aciklama, 'satis_tutar' => $satis_tutar, 'satis_zaman' => $satis_zaman, 'satis_odeme' => $satis_odeme]; //telefon aldım 
        $kontrol = $db->query($sql, $sqlValues);
        if ($kontrol) {
            $FNC->sendResult(true, 'Satış eklendi!');
        } else {
            $FNC->sendResult(false, 'Satış ekleme hata !');
        }
    }
}

if ($action == 'satis-sil') {
    if ($_POST['id'] <= 0) {
        $FNC->sendResult(false, 'Id sıfırdan küçük ya da eşit olamaz');
    }
    $sql = ('DELETE FROM satislar WHERE id = :id');
    $sqlValues = ['id' => (int) $FNC->filter($_POST['id'])];
    $kontrol = $db->query($sql, $sqlValues);
    if ($kontrol) {
        $FNC->sendResult(true, 'Satış başarıyla silindi');
    } else {
        $FNC->sendResult(false, 'Satış silme hata !');
    }
}


if($action == "satis-duzenle"){
    $id = (int)$FNC->filter($_POST['id']);
    $satis_baslik = $FNC->filter($_POST['satis_baslik']);
    $satis_aciklama = $FNC->filter($_POST['satis_aciklama']);
    $satis_tutar = $FNC->filter($_POST['satis_tutar']);
    $satis_zaman = $FNC->filter($_POST['satis_zaman']);
    $satis_odeme = $FNC->filter($_POST['satis_odeme']);

    if ($id <= 0) {
        $FNC->sendResult(false, 'Id sıfırdan küçük ya da eşit olamaz');
    }else if ($satis_baslik == null || $satis_baslik == "") {
        $FNC->sendResult(false, 'Başlık boş olamaz !');
    } else if ($satis_aciklama == null || $satis_aciklama == "") {
        $FNC->sendResult(false, 'Açıklama boş olamaz !');
    } else if ($satis_tutar == null || $satis_tutar == "") {
        $FNC->sendResult(false, 'Tutar boş olamaz !');
    } else if ($satis_zaman == null || $satis_zaman == "") {
        $FNC->sendResult(false, 'Zaman boş olamaz !');
    } else if ($satis_odeme == null || $satis_odeme == "") {
        $FNC->sendResult(false, 'Ödeme boş olamaz !');
    }  else {
        $sql = ('UPDATE satislar SET
        satis_baslik      = :satis_baslik,
        satis_aciklama    = :satis_aciklama,
        satis_tutar      = :satis_tutar,
        satis_zaman      = :satis_zaman,
        satis_odeme      = :satis_odeme WHERE id = :id ');

        $sqlValues = ['satis_baslik' => $satis_baslik, 'satis_aciklama' => $satis_aciklama, 'satis_tutar' => $satis_tutar, 'satis_zaman' => $satis_zaman, 'satis_odeme' => $satis_odeme, 'id' => $id]; //telefon aldım 
        $kontrol = $db->query($sql, $sqlValues);
        if ($kontrol) {
            $FNC->sendResult(true, 'Satış düzenlendi!');
        } else {
            $FNC->sendResult(false, 'Satış düzenleme hata !');
        }
    }
}

if ($action == 'satis-toplu-sil') {
    $say = 0;
    if (isset($_POST['satislar'])) {
        $idler = $_POST['satislar'];
        foreach ($idler as $id) {
            $sql = ('DELETE FROM satislar WHERE id = :id');
            $sqlValues = ['id' => $id];
            $kontrol = $db->query($sql, $sqlValues);
            if ($kontrol) {
                $say = $say + 1;
            }
        }
        if ($say == count($idler)) {
            $FNC->sendResult(true, 'Satışlar başarıyla silindi');
        } else {
            $FNC->sendResult(true, 'Satışlar toplu silme hata #1');
        }
    } else {
        $FNC->sendResult(true, 'Satışlar toplu silme hata #2');
    }
}


if($action == "nakit-ekle"){
    $para_baslik = $FNC->filter($_POST['para_baslik']);
    $para_aciklama = $FNC->filter($_POST['para_aciklama']);
    $para_gelen = $FNC->filter($_POST['para_gelen']);
    $para_giden = $FNC->filter($_POST['para_giden']);
    $para_zaman = $FNC->filter($_POST['para_zaman']);

    if ($para_baslik == null || $para_baslik == "") {
        $FNC->sendResult(false, 'Başlık boş olamaz !');
    } else if ($para_aciklama == null || $para_aciklama == "") {
        $FNC->sendResult(false, 'Açıklama boş olamaz !');
    } else if ($para_gelen == null || $para_gelen == "") {
        $FNC->sendResult(false, 'Gelen Tutar boş olamaz !');
    } else if ($para_giden == null || $para_giden == "") {
        $FNC->sendResult(false, 'Giden Tutar olamaz !');
    } else if ($para_zaman == null || $para_zaman == "") {
        $FNC->sendResult(false, 'Zaman boş olamaz !');
    }  else {
        $sql = ('INSERT INTO nakit SET
        para_baslik      = :para_baslik,
        para_aciklama    = :para_aciklama,
        para_gelen      = :para_gelen,
        para_giden      = :para_giden,
        para_zaman      = :para_zaman ');

        $sqlValues = ['para_baslik' => $para_baslik, 'para_aciklama' => $para_aciklama, 'para_gelen' => $para_gelen, 'para_giden' => $para_giden, 'para_zaman' => $para_zaman]; //telefon aldım 
        $kontrol = $db->query($sql, $sqlValues);
        if ($kontrol) {
            $FNC->sendResult(true, 'Nakit eklendi!');
        } else {
            $FNC->sendResult(false, 'Nakit ekleme hata !');
        }
    }
}


if($action == "nakit-duzenle"){
    $id = (int)$FNC->filter($_POST['id']);
    $para_baslik = $FNC->filter($_POST['para_baslik']);
    $para_aciklama = $FNC->filter($_POST['para_aciklama']);
    $para_gelen = $FNC->filter($_POST['para_gelen']);
    $para_giden = $FNC->filter($_POST['para_giden']);
    $para_zaman = $FNC->filter($_POST['para_zaman']);

    if ($id <= 0) {
        $FNC->sendResult(false, 'Id sıfırdan küçük ya da eşit olamaz');
    }else if ($para_baslik == null || $para_baslik == "") {
        $FNC->sendResult(false, 'Başlık boş olamaz !');
    } else if ($para_aciklama == null || $para_aciklama == "") {
        $FNC->sendResult(false, 'Açıklama boş olamaz !');
    } else if ($para_gelen == null || $para_gelen == "") {
        $FNC->sendResult(false, 'Gelen Tutar boş olamaz !');
    } else if ($para_giden == null || $para_giden == "") {
        $FNC->sendResult(false, 'Giden Tutar olamaz !');
    } else if ($para_zaman == null || $para_zaman == "") {
        $FNC->sendResult(false, 'Zaman boş olamaz !');
    }  else {
        $sql = ('UPDATE nakit SET
        para_baslik      = :para_baslik,
        para_aciklama    = :para_aciklama,
        para_gelen      = :para_gelen,
        para_giden      = :para_giden,
        para_zaman      = :para_zaman WHERE id = :id ');

        $sqlValues = ['para_baslik' => $para_baslik, 'para_aciklama' => $para_aciklama, 'para_gelen' => $para_gelen, 'para_giden' => $para_giden, 'para_zaman' => $para_zaman,'id' => $id]; //telefon aldım 
        $kontrol = $db->query($sql, $sqlValues);
        if ($kontrol) {
            $FNC->sendResult(true, 'Nakit düzenlendi!');
        } else {
            $FNC->sendResult(false, 'Nakit düzenleme hata !');
        }
    }
}


if ($action == 'nakit-toplu-sil') {
    $say = 0;
    if (isset($_POST['nakitler'])) {
        $idler = $_POST['nakitler'];
        foreach ($idler as $id) {
            $sql = ('DELETE FROM nakit WHERE id = :id');
            $sqlValues = ['id' => $id];
            $kontrol = $db->query($sql, $sqlValues);
            if ($kontrol) {
                $say = $say + 1;
            }
        }
        if ($say == count($idler)) {
            $FNC->sendResult(true, 'Nakitler başarıyla silindi');
        } else {
            $FNC->sendResult(true, 'Nakitler toplu silme hata #1');
        }
    } else {
        $FNC->sendResult(true, 'Nakitler toplu silme hata #2');
    }
}

if ($action == 'nakit-sil') {
    if ($_POST['id'] <= 0) {
        $FNC->sendResult(false, 'Id sıfırdan küçük ya da eşit olamaz');
    }
    $sql = ('DELETE FROM nakit WHERE id = :id');
    $sqlValues = ['id' => (int) $FNC->filter($_POST['id'])];
    $kontrol = $db->query($sql, $sqlValues);
    if ($kontrol) {
        $FNC->sendResult(true, 'Nakit başarıyla silindi');
    } else {
        $FNC->sendResult(false, 'Nakit silme hata !');
    }
}
