-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 24, 2017 at 01:30 AM
-- Server version: 5.5.55-0ubuntu0.14.04.1
-- PHP Version: 5.6.30-10+deb.sury.org~trusty+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `proje_takip`
--

-- --------------------------------------------------------

--
-- Table structure for table `ayarlar`
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
-- Dumping data for table `ayarlar`
--

INSERT INTO `ayarlar` (`ayar_id`, `site_baslik`, `site_hakkimizda`, `site_iletisim_eposta`, `site_logo`, `site_anasayfa_logo`) VALUES
(1, 'Proje Takibim', 'Bu site Celal Bayar Üniversitesi - Kırkağaç Meslek Yüksekokulu öğrencileri Yusuf Kaya ve Tayfun Serin tarafından bitirme projesi olarak hazırlanmıştır.', 'info@projetakibim.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dosyalar`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `dosyalar`
--

INSERT INTO `dosyalar` (`dosya_id`, `proje_id`, `dosya_ad`, `dosya_uzantı`, `dosya_yol`, `dosya_link`, `dosya_boyut`) VALUES
(3, 70, '2017-05-17 23.57.46.zip', 'application/zip', '/var/www/html/proje/dosyalar/5 - test/2017-05-17 23.57.46.zip', 'http://localhost/proje/dosyalar//2017-05-17 23.57.46.zip', '90325'),
(4, 67, '2017-05-18 00.08.11.zip', 'application/zip', '/var/www/html/proje/dosyalar/5 - Proje Takip Sistemi/2017-05-18 00.08.11.zip', 'http://localhost/proje/dosyalar//2017-05-18 00.08.11.zip', '90325'),
(5, 71, '2017-05-23 02.29.08.zip', 'application/zip', '/var/www/html/proje/dosyalar/5 - test/2017-05-23 02.29.08.zip', 'http://localhost/proje/dosyalar//2017-05-23 02.29.08.zip', '90325');

-- --------------------------------------------------------

--
-- Table structure for table `kontrol`
--

CREATE TABLE IF NOT EXISTS `kontrol` (
  `kontrol_id` int(11) NOT NULL AUTO_INCREMENT,
  `kontrol_not` text COLLATE utf8_unicode_ci NOT NULL,
  `proje_yuzde` smallint(6) NOT NULL,
  `kontrol_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `proje_id` int(11) NOT NULL,
  `kontrol_baslik` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`kontrol_id`),
  KEY `proje_id` (`proje_id`),
  KEY `proje_id_2` (`proje_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `mesajlar`
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
  KEY `gonderen_id` (`gonderen_id`,`alici_id`),
  KEY `alici_id` (`alici_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `mesajlar`
--

INSERT INTO `mesajlar` (`mesaj_id`, `gonderen_id`, `alici_id`, `mesaj`, `baslik`, `tarih`, `okuma`) VALUES
(7, 1, 5, 'İçerik Örneği', 'Başlık Örneği', '2017-05-20 23:49:48', 1),
(8, 1, 6, 'İçerik Örneği 2', '<b>Başlık Örneği</b>', '2017-05-20 23:49:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ogrenciler`
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
-- Dumping data for table `ogrenciler`
--

INSERT INTO `ogrenciler` (`ogrenci_id`, `proje_id`, `ogrenci_no`, `ogrenci_sifre`, `ogrenci_isim`, `ogrenci_eposta`, `ogrenci_kayit`, `ogrenci_giris`, `resim`) VALUES
(5, NULL, '151809080', 'b45b69c3584350cf9a757654022e73df', 'Yusuf Kaya', 'ysf.ky_1903@hotmail.com', '2017-04-19 21:54:55', '2017-05-23 22:20:37', 'http://localhost/proje/frontend/avatar/1495326927.png'),
(6, NULL, '151809022', 'b45b69c3584350cf9a757654022e73df', 'Tayfun Serin', 'ysf.ky_1903@hotmail.com', '2017-04-19 21:54:55', '2017-05-22 22:55:34', 'http://localhost/proje/frontend/avatar/1495326927.png');

-- --------------------------------------------------------

--
-- Table structure for table `ogretmenler`
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
-- Dumping data for table `ogretmenler`
--

INSERT INTO `ogretmenler` (`ogretmen_id`, `ogretmen_eposta`, `ogretmen_kullaniciadi`, `ogretmen_ad`, `ogretmen_soyad`, `ogretmen_sifre`, `ogretmen_kayit`, `ogretmen_giris`) VALUES
(1, 'admin@admin', 'admin', 'Yetkili', 'Öğretmen', '21232f297a57a5a743894a0e4a801fc3', '0000-00-00 00:00:00', '2017-05-23 22:20:54'),
(2, 'test@test.com', 'test12', 'test ad', 'test soyadı', 'test', '2017-05-07 22:47:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `olaylar`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=235 ;

--
-- Dumping data for table `olaylar`
--

INSERT INTO `olaylar` (`olay_id`, `proje_id`, `ogrenci_id`, `mesaj_id`, `dosya_id`, `olay`, `olay_tip`, `olay_tarih`) VALUES
(96, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-13 16:04:59'),
(97, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-13 17:00:04'),
(98, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-13 17:00:06'),
(102, NULL, 5, NULL, NULL, 'Dosya Silindi', 'dosya-sil', '2017-05-13 18:24:44'),
(108, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-17 20:53:24'),
(109, NULL, 5, NULL, NULL, 'Dosya Silindi', 'dosya-sil', '2017-05-17 20:53:32'),
(112, NULL, 5, NULL, NULL, 'Bir Proje Silindi', 'proje-sil', '2017-05-17 20:54:26'),
(127, NULL, 5, NULL, NULL, 'Çıkış Yapıldı', 'çıkış', '2017-05-17 21:19:49'),
(144, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-19 15:06:59'),
(145, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-19 20:02:41'),
(147, NULL, 5, NULL, NULL, 'Çıkış Yapıldı', 'çıkış', '2017-05-19 20:27:42'),
(148, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-19 20:28:46'),
(188, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-20 19:56:43'),
(189, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-20 22:37:29'),
(192, NULL, 5, NULL, NULL, 'Bir Mesaj Silindi', 'mesaj-sil', '2017-05-20 23:20:42'),
(215, NULL, 5, NULL, NULL, 'Bir Mesaj Silindi', 'mesaj-sil', '2017-05-20 23:48:27'),
(216, NULL, 5, NULL, NULL, 'Bir Mesaj Silindi', 'mesaj-sil', '2017-05-20 23:48:30'),
(217, NULL, 5, NULL, NULL, 'Bir Mesaj Silindi', 'mesaj-sil', '2017-05-20 23:48:32'),
(218, NULL, 5, 7, NULL, 'Mesaj Okundu', 'mesaj-oku', '2017-05-20 23:49:55'),
(219, NULL, 5, 7, NULL, 'Mesaj Okundu', 'mesaj-oku', '2017-05-20 23:54:38'),
(220, NULL, 5, NULL, NULL, 'Çıkış Yapıldı', 'çıkış', '2017-05-21 00:06:01'),
(221, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-21 00:20:28'),
(222, NULL, 5, NULL, NULL, 'Çıkış Yapıldı', 'çıkış', '2017-05-21 00:22:05'),
(223, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-21 00:34:56'),
(224, NULL, 5, NULL, NULL, 'Profil Güncellendi', 'profil-güncellendi', '2017-05-21 00:35:27'),
(225, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-21 01:26:50'),
(226, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-21 15:16:02'),
(227, NULL, 5, NULL, NULL, 'Eposta Değiştirdi', 'eposta-degistirildi', '2017-05-21 15:22:59'),
(228, NULL, 5, NULL, NULL, 'Eposta Değiştirdi', 'eposta-degistirildi', '2017-05-21 15:25:39'),
(229, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-22 22:12:39'),
(230, NULL, 5, NULL, NULL, 'Çıkış Yapıldı', 'çıkış', '2017-05-22 22:13:25'),
(231, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-22 22:55:34'),
(232, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-22 23:28:49'),
(234, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-23 22:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `projeler`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=72 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kontrol`
--
ALTER TABLE `kontrol`
  ADD CONSTRAINT `foreign_key_projeler_id_kontrol_projeler_proje_id` FOREIGN KEY (`proje_id`) REFERENCES `kontrol` (`proje_id`) ON DELETE CASCADE;

--
-- Constraints for table `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD CONSTRAINT `foreign_key_ogrenci_id_mesajlar_alici_id` FOREIGN KEY (`alici_id`) REFERENCES `ogrenciler` (`ogrenci_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foreign_key_ogretmen_id_mesajlar_gonderen_id` FOREIGN KEY (`gonderen_id`) REFERENCES `ogretmenler` (`ogretmen_id`) ON DELETE CASCADE;

--
-- Constraints for table `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD CONSTRAINT `foreign_ogrenciler_proje_id_projeler_proje_id` FOREIGN KEY (`proje_id`) REFERENCES `projeler` (`proje_id`) ON DELETE SET NULL;

--
-- Constraints for table `olaylar`
--
ALTER TABLE `olaylar`
  ADD CONSTRAINT `foreign_dosyalar_dosya_id` FOREIGN KEY (`dosya_id`) REFERENCES `dosyalar` (`dosya_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foreign_mesajlar_mesaj_id` FOREIGN KEY (`mesaj_id`) REFERENCES `mesajlar` (`mesaj_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foreign_ogrenciler_ogrenci_id` FOREIGN KEY (`ogrenci_id`) REFERENCES `ogrenciler` (`ogrenci_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foreign_projeler_proje_id` FOREIGN KEY (`proje_id`) REFERENCES `projeler` (`proje_id`) ON DELETE CASCADE;

--
-- Constraints for table `projeler`
--
ALTER TABLE `projeler`
  ADD CONSTRAINT `foreign_ogrenciler_ogrenci_id_projeler_olusturan_id` FOREIGN KEY (`olusturan_id`) REFERENCES `ogrenciler` (`ogrenci_id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
