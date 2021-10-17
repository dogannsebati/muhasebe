-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 May 2021, 16:29:22
-- Sunucu sürümü: 10.1.36-MariaDB
-- PHP Sürümü: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `muhasebe`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `alacaklar`
--

CREATE TABLE `alacaklar` (
  `alacak_id` int(11) NOT NULL,
  `alacak_isim` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `alacak_aciklama` varchar(1000) COLLATE utf8_turkish_ci NOT NULL,
  `alacak_zaman` date NOT NULL,
  `alacak_tutar` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `alacaklar`
--

INSERT INTO `alacaklar` (`alacak_id`, `alacak_isim`, `alacak_aciklama`, `alacak_zaman`, `alacak_tutar`) VALUES
(1, 'ahmet ', 'ahmetteb alacağım var', '2021-06-23', 2500);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `calisanlar`
--

CREATE TABLE `calisanlar` (
  `calisan_id` int(11) NOT NULL,
  `calisan_isim` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `calisan_yas` int(3) NOT NULL,
  `calisan_bolum` varchar(70) COLLATE utf8_turkish_ci NOT NULL,
  `calisan_maas` float NOT NULL,
  `ise_baslama_tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `calisanlar`
--

INSERT INTO `calisanlar` (`calisan_id`, `calisan_isim`, `calisan_yas`, `calisan_bolum`, `calisan_maas`, `ise_baslama_tarih`) VALUES
(1, 'ahmet bal1', 251, 'grafiker1', 35001, '2020-10-13');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `kullanici_id` int(11) NOT NULL,
  `firma_ismi` varchar(251) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kullanici_email` varchar(70) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_sifre` varchar(70) COLLATE utf8_turkish_ci NOT NULL,
  `yetkili` varchar(85) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`kullanici_id`, `firma_ismi`, `tarih`, `kullanici_email`, `kullanici_sifre`, `yetkili`) VALUES
(1, 'Yazılım Yolcusu', '2021-05-02 10:14:36', 'info@yazilimyolcusu.com', '123456', ''),
(3, '', '2021-05-02 10:23:54', '', '', ''),
(4, 'deneme', '2021-05-02 10:24:12', 'deneme@deneme.com', 'deneme', 'deneme'),
(5, 'deneme', '2021-05-02 10:30:55', 'deneme@abc.com', 'e10adc3949ba59abbe56e057f20f883e', 'deneme deneme');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `masraflar`
--

CREATE TABLE `masraflar` (
  `masraf_id` int(11) NOT NULL,
  `masraf_baslik` varchar(240) COLLATE utf8_turkish_ci NOT NULL,
  `masraf_aciklama` text COLLATE utf8_turkish_ci NOT NULL,
  `masraf_tutar` float NOT NULL,
  `masraf_zaman` date NOT NULL,
  `masraf_kategori` varchar(250) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `masraflar`
--

INSERT INTO `masraflar` (`masraf_id`, `masraf_baslik`, `masraf_aciklama`, `masraf_tutar`, `masraf_zaman`, `masraf_kategori`) VALUES
(4, 'Bilgisayar', 'Kendime bilgisayar aldım', 6900, '2021-04-14', 'genel masraf'),
(5, 'tablet alındı', 'ofise tablet alındı', 1000, '2021-04-16', 'genel masraf');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `nakit`
--

CREATE TABLE `nakit` (
  `nakit_id` int(11) NOT NULL,
  `para_baslik` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `para_aciklama` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `para_gelen` float(20,2) NOT NULL,
  `para_zaman` date NOT NULL,
  `para_giden` float(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `nakit`
--

INSERT INTO `nakit` (`nakit_id`, `para_baslik`, `para_aciklama`, `para_gelen`, `para_zaman`, `para_giden`) VALUES
(1, 'aliye 50 liralık ürün sattım', 'aliye 50 liralık ürün sattım', 50.00, '2021-04-30', 0.00),
(2, 'AHMETTEN ALDIM', 'AHMETTEN ALDIM', 200.00, '2021-05-09', 0.00),
(3, 'veliye boç berdim', '', 0.00, '2021-05-06', 500.00),
(4, 'aliye 50 liralık ürün sattım', 'aliye 50 liralık ürün sattım', 50.00, '2021-04-18', 0.00),
(5, 'AHMETTEN ALDIM', 'AHMETTEN ALDIM', 200.00, '2021-05-28', 0.00),
(6, 'veliye boç berdim', '', 0.00, '2021-05-14', 500.00);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odemeler`
--

CREATE TABLE `odemeler` (
  `odeme_id` int(11) NOT NULL,
  `odeme_baslik` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `odeme_aciklama` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `odeme_kime` varchar(60) COLLATE utf8_turkish_ci NOT NULL,
  `odeme_zaman` date NOT NULL,
  `odeme_tutar` float NOT NULL,
  `para_alinan_zaman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `odemeler`
--

INSERT INTO `odemeler` (`odeme_id`, `odeme_baslik`, `odeme_aciklama`, `odeme_kime`, `odeme_zaman`, `odeme_tutar`, `para_alinan_zaman`) VALUES
(1, 'ahmtten borç aldım', 'dükkan kirası borç', 'ahmet bakkal', '2021-05-20', 1200, '2021-04-21'),
(2, 'Mehmet\'den para aldım', 'Mehmet berberden 200 tl su faturası para aldım', 'Mehmet berberden 200 tl su faturası para aldım', '2021-05-20', 200, '2021-04-14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satislar`
--

CREATE TABLE `satislar` (
  `satis_id` int(11) NOT NULL,
  `satis_baslik` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `satis_aciklama` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `satis_zaman` date NOT NULL,
  `satis_tutar` float NOT NULL,
  `satis_odeme` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `satislar`
--

INSERT INTO `satislar` (`satis_id`, `satis_baslik`, `satis_aciklama`, `satis_zaman`, `satis_tutar`, `satis_odeme`) VALUES
(1, 'oyuncak', 'oyuncak satıldı', '2021-05-03', 20, 'peşin');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `alacaklar`
--
ALTER TABLE `alacaklar`
  ADD PRIMARY KEY (`alacak_id`);

--
-- Tablo için indeksler `calisanlar`
--
ALTER TABLE `calisanlar`
  ADD PRIMARY KEY (`calisan_id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`kullanici_id`);

--
-- Tablo için indeksler `masraflar`
--
ALTER TABLE `masraflar`
  ADD PRIMARY KEY (`masraf_id`);

--
-- Tablo için indeksler `nakit`
--
ALTER TABLE `nakit`
  ADD PRIMARY KEY (`nakit_id`);

--
-- Tablo için indeksler `odemeler`
--
ALTER TABLE `odemeler`
  ADD PRIMARY KEY (`odeme_id`);

--
-- Tablo için indeksler `satislar`
--
ALTER TABLE `satislar`
  ADD PRIMARY KEY (`satis_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `alacaklar`
--
ALTER TABLE `alacaklar`
  MODIFY `alacak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `calisanlar`
--
ALTER TABLE `calisanlar`
  MODIFY `calisan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `kullanici_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `masraflar`
--
ALTER TABLE `masraflar`
  MODIFY `masraf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `nakit`
--
ALTER TABLE `nakit`
  MODIFY `nakit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `odemeler`
--
ALTER TABLE `odemeler`
  MODIFY `odeme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `satislar`
--
ALTER TABLE `satislar`
  MODIFY `satis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
