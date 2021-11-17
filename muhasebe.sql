-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Kas 2021, 21:02:38
-- Sunucu sürümü: 10.4.21-MariaDB
-- PHP Sürümü: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `id` int(11) NOT NULL,
  `alacak_isim` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `alacak_aciklama` varchar(1000) COLLATE utf8_turkish_ci NOT NULL,
  `alacak_zaman` date NOT NULL,
  `alacak_tutar` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `masraflar`
--

CREATE TABLE `masraflar` (
  `id` int(11) NOT NULL,
  `masraf_baslik` varchar(240) COLLATE utf8_turkish_ci NOT NULL,
  `masraf_aciklama` text COLLATE utf8_turkish_ci NOT NULL,
  `masraf_tutar` float NOT NULL,
  `masraf_zaman` date NOT NULL,
  `masraf_kategori` varchar(250) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `masraflar`
--

INSERT INTO `masraflar` (`id`, `masraf_baslik`, `masraf_aciklama`, `masraf_tutar`, `masraf_zaman`, `masraf_kategori`) VALUES
(8, 'denemeson', 'denemesons', 1213230000, '2021-11-13', 'tesad');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `nakit`
--

CREATE TABLE `nakit` (
  `id` int(11) NOT NULL,
  `para_baslik` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `para_aciklama` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `para_gelen` float(20,2) NOT NULL,
  `para_zaman` date NOT NULL,
  `para_giden` float(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odemeler`
--

CREATE TABLE `odemeler` (
  `id` int(11) NOT NULL,
  `odeme_baslik` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `odeme_aciklama` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `odeme_kime` varchar(60) COLLATE utf8_turkish_ci NOT NULL,
  `odeme_zaman` date NOT NULL,
  `odeme_tutar` float NOT NULL,
  `para_alinan_zaman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personel`
--

CREATE TABLE `personel` (
  `id` int(11) NOT NULL,
  `calisan_isim` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `calisan_yas` int(3) NOT NULL,
  `calisan_bolum` varchar(70) COLLATE utf8_turkish_ci NOT NULL,
  `calisan_maas` float NOT NULL,
  `ise_baslama_tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satislar`
--

CREATE TABLE `satislar` (
  `id` int(11) NOT NULL,
  `satis_baslik` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `satis_aciklama` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `satis_zaman` date NOT NULL,
  `satis_tutar` float NOT NULL,
  `satis_odeme` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `id` int(11) NOT NULL,
  `kulad` varchar(255) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `ad_soyad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `kulad`, `sifre`, `ad_soyad`) VALUES
(1, 'test', 'aa6d3f1978af4eeb0d77a6e0e3789ff5cef43462', 'Sebati Doğan');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `alacaklar`
--
ALTER TABLE `alacaklar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `masraflar`
--
ALTER TABLE `masraflar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `nakit`
--
ALTER TABLE `nakit`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `odemeler`
--
ALTER TABLE `odemeler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `personel`
--
ALTER TABLE `personel`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `satislar`
--
ALTER TABLE `satislar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `alacaklar`
--
ALTER TABLE `alacaklar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `masraflar`
--
ALTER TABLE `masraflar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `nakit`
--
ALTER TABLE `nakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `odemeler`
--
ALTER TABLE `odemeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `personel`
--
ALTER TABLE `personel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `satislar`
--
ALTER TABLE `satislar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
