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
