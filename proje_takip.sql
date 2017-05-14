-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 13 May 2017, 21:47:04
-- Sunucu sürümü: 5.5.55-0ubuntu0.14.04.1
-- PHP Sürümü: 5.6.30-10+deb.sury.org~trusty+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `proje_takip`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE IF NOT EXISTS `ayarlar` (
  `ayar_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_baslik` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_hakkimizda` text COLLATE utf8_unicode_ci NOT NULL,
  `site_iletisim_eposta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_anasayfa_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ayar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`ayar_id`, `site_baslik`, `site_hakkimizda`, `site_iletisim_eposta`, `site_logo`, `site_anasayfa_logo`) VALUES
(1, 'Proje Takibim', 'Bu site Celal Bayar Üniversitesi - Kırkağaç Meslek Yüksekokulu öğrencileri Yusuf Kaya ve Tayfun Serin tarafından bitirme projesi olarak hazırlanmıştır.', 'info@projetakibim.com', '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dosyalar`
--

CREATE TABLE IF NOT EXISTS `dosyalar` (
  `dosya_id` int(11) NOT NULL AUTO_INCREMENT,
  `proje_id` int(11) NOT NULL,
  `dosya_ad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dosya_uzantı` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dosya_yol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dosya_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dosya_boyut` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`dosya_id`),
  KEY `proje_id` (`proje_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `dosyalar`
--

INSERT INTO `dosyalar` (`dosya_id`, `proje_id`, `dosya_ad`, `dosya_uzantı`, `dosya_yol`, `dosya_link`, `dosya_boyut`) VALUES
(2, 67, '2017-05-13 21.28.15.zip', 'application/zip', '/var/www/html/proje/dosyalar/5 - Proje Takip Sistemi/2017-05-13 21.28.15.zip', 'http://localhost/proje/dosyalar//2017-05-13 21.28.15.zip', '90325');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kontrol`
--

CREATE TABLE IF NOT EXISTS `kontrol` (
  `kontrol_id` int(11) NOT NULL AUTO_INCREMENT,
  `kontrol_not` text COLLATE utf8_unicode_ci NOT NULL,
  `proje_yuzde` smallint(6) NOT NULL,
  `kontrol_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `proje_id` int(11) NOT NULL,
  `kontrol_baslik` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`kontrol_id`),
  KEY `proje_id` (`proje_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `kontrol`
--

INSERT INTO `kontrol` (`kontrol_id`, `kontrol_not`, `proje_yuzde`, `kontrol_tarih`, `proje_id`, `kontrol_baslik`) VALUES
(1, 'Proje devam etsin.', 10, '2017-05-13 15:39:21', 66, 'Bu bir kontrol testi'),
(2, 'test 2', 50, '2017-05-13 15:39:39', 66, 'test');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesajlar`
--

CREATE TABLE IF NOT EXISTS `mesajlar` (
  `mesaj_id` int(11) NOT NULL AUTO_INCREMENT,
  `gonderen_id` int(11) NOT NULL,
  `alici_id` int(11) NOT NULL,
  `mesaj` text COLLATE utf8_unicode_ci NOT NULL,
  `baslik` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `okuma` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mesaj_id`),
  KEY `gonderen_id` (`gonderen_id`,`alici_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciler`
--

CREATE TABLE IF NOT EXISTS `ogrenciler` (
  `ogrenci_id` int(11) NOT NULL AUTO_INCREMENT,
  `proje_id` int(11) DEFAULT NULL,
  `ogrenci_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ogrenci_sifre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ogrenci_isim` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `ogrenci_eposta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ogrenci_kayit` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ogrenci_giris` timestamp NULL DEFAULT NULL,
  `resim` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ogrenci_id`),
  UNIQUE KEY `ogrenci_no` (`ogrenci_no`,`ogrenci_eposta`),
  KEY `proje_id` (`proje_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Tablo döküm verisi `ogrenciler`
--

INSERT INTO `ogrenciler` (`ogrenci_id`, `proje_id`, `ogrenci_no`, `ogrenci_sifre`, `ogrenci_isim`, `ogrenci_eposta`, `ogrenci_kayit`, `ogrenci_giris`, `resim`) VALUES
(5, 67, '151809080', 'b45b69c3584350cf9a757654022e73df', 'Yusuf Kaya', 'ysf.ky_1903@hotmail.com', '2017-04-19 21:54:55', '2017-05-13 17:00:06', 'http://localhost/proje/frontend/avatar/1493780797.jpg'),
(6, 67, '151809010', 'c336268b8ed95daaf5818f3c14c45c75', 'John Doe', 'pvpc11@hotmail.com', '2017-05-13 12:50:27', '2017-05-13 13:31:01', 'http://localhost/proje/frontend/avatar/user.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogretmenler`
--

CREATE TABLE IF NOT EXISTS `ogretmenler` (
  `ogretmen_id` int(11) NOT NULL AUTO_INCREMENT,
  `ogretmen_eposta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ogretmen_kullaniciadi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ogretmen_ad` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ogretmen_soyad` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ogretmen_sifre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ogretmen_kayit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ogretmen_giris` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ogretmen_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `ogretmenler`
--

INSERT INTO `ogretmenler` (`ogretmen_id`, `ogretmen_eposta`, `ogretmen_kullaniciadi`, `ogretmen_ad`, `ogretmen_soyad`, `ogretmen_sifre`, `ogretmen_kayit`, `ogretmen_giris`) VALUES
(1, 'admin@admin', 'admin', 'Test', 'Test Soyisim', '21232f297a57a5a743894a0e4a801fc3', '0000-00-00 00:00:00', '2017-05-13 18:28:51'),
(2, 'test@test.com', 'test12', 'test ad', 'test soyadı', 'test', '2017-05-07 22:47:48', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `olaylar`
--

CREATE TABLE IF NOT EXISTS `olaylar` (
  `olay_id` int(11) NOT NULL AUTO_INCREMENT,
  `proje_id` int(11) DEFAULT NULL,
  `ogrenci_id` int(11) DEFAULT NULL,
  `mesaj_id` int(11) DEFAULT NULL,
  `dosya_id` int(11) DEFAULT NULL,
  `olay` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `olay_tip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `olay_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`olay_id`),
  KEY `proje_id` (`proje_id`,`ogrenci_id`,`mesaj_id`,`dosya_id`),
  KEY `proje_id_2` (`proje_id`),
  KEY `ogrenci_id` (`ogrenci_id`),
  KEY `mesaj_id` (`mesaj_id`),
  KEY `dosya_id` (`dosya_id`),
  KEY `proje_id_3` (`proje_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=108 ;

--
-- Tablo döküm verisi `olaylar`
--

INSERT INTO `olaylar` (`olay_id`, `proje_id`, `ogrenci_id`, `mesaj_id`, `dosya_id`, `olay`, `olay_tip`, `olay_tarih`) VALUES
(94, 67, 5, NULL, NULL, 'Proje Ekibi Oluşturuldu', 'proje-ekip', '2017-05-13 15:43:33'),
(95, 67, 5, NULL, NULL, 'Proje Eklendi', 'proje-eklendi', '2017-05-13 15:43:33'),
(96, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-13 16:04:59'),
(97, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-13 17:00:04'),
(98, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-13 17:00:06'),
(99, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-13 18:21:53'),
(101, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-13 18:24:37'),
(102, NULL, 5, NULL, NULL, 'Dosya Silindi', 'dosya-sil', '2017-05-13 18:24:44'),
(103, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-13 18:26:35'),
(104, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-13 18:26:52'),
(105, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-13 18:27:47'),
(106, 67, 5, NULL, 2, 'Dosya Yüklendi', 'dosya-yukle', '2017-05-13 18:28:15'),
(107, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-13 18:28:20');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `projeler`
--

CREATE TABLE IF NOT EXISTS `projeler` (
  `proje_id` int(11) NOT NULL AUTO_INCREMENT,
  `proje_no` int(11) DEFAULT NULL,
  `proje_konu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proje_amac` text COLLATE utf8_unicode_ci NOT NULL,
  `proje_tur` tinyint(4) NOT NULL,
  `olusturan_id` int(11) DEFAULT NULL,
  `proje_dosya` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proje_uygunluk` tinyint(1) DEFAULT NULL,
  `proje_olusturma` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `proje_bitirme` timestamp NULL DEFAULT NULL,
  `proje_duzenleme` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`proje_id`),
  UNIQUE KEY `proje_no` (`proje_no`),
  KEY `olusturan_id` (`olusturan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=68 ;

--
-- Tablo döküm verisi `projeler`
--

INSERT INTO `projeler` (`proje_id`, `proje_no`, `proje_konu`, `proje_amac`, `proje_tur`, `olusturan_id`, `proje_dosya`, `proje_uygunluk`, `proje_olusturma`, `proje_bitirme`, `proje_duzenleme`) VALUES
(67, 1, 'Proje Takip Sistemi', 'Projeleri internet üzerinden takip etmek', 2, 5, '/var/www/html/proje/dosyalar/5 - Proje Takip Sistemi', 1, '2017-05-13 15:43:33', '2017-05-26 15:43:59', '2017-05-13 15:44:14');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD CONSTRAINT `foreign_key_ogretmen_id_mesajlar_gonderen_id` FOREIGN KEY (`gonderen_id`) REFERENCES `ogretmenler` (`ogretmen_id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD CONSTRAINT `foreign_ogrenciler_proje_id_projeler_proje_id` FOREIGN KEY (`proje_id`) REFERENCES `projeler` (`proje_id`) ON DELETE SET NULL;

--
-- Tablo kısıtlamaları `olaylar`
--
ALTER TABLE `olaylar`
  ADD CONSTRAINT `foreign_mesajlar_mesaj_id` FOREIGN KEY (`mesaj_id`) REFERENCES `mesajlar` (`mesaj_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foreign_dosyalar_dosya_id` FOREIGN KEY (`dosya_id`) REFERENCES `dosyalar` (`dosya_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foreign_ogrenciler_ogrenci_id` FOREIGN KEY (`ogrenci_id`) REFERENCES `ogrenciler` (`ogrenci_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foreign_projeler_proje_id` FOREIGN KEY (`proje_id`) REFERENCES `projeler` (`proje_id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `projeler`
--
ALTER TABLE `projeler`
  ADD CONSTRAINT `foreign_ogrenciler_ogrenci_id_projeler_olusturan_id` FOREIGN KEY (`olusturan_id`) REFERENCES `ogrenciler` (`ogrenci_id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
