-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2017 at 11:00 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `dosyalar`
--

INSERT INTO `dosyalar` (`dosya_id`, `proje_id`, `dosya_ad`, `dosya_uzantı`, `dosya_yol`, `dosya_link`, `dosya_boyut`) VALUES
(3, 70, '2017-05-17 23.57.46.zip', 'application/zip', '/var/www/html/proje/dosyalar/5 - test/2017-05-17 23.57.46.zip', 'http://localhost/proje/dosyalar//2017-05-17 23.57.46.zip', '90325'),
(4, 67, '2017-05-18 00.08.11.zip', 'application/zip', '/var/www/html/proje/dosyalar/5 - Proje Takip Sistemi/2017-05-18 00.08.11.zip', 'http://localhost/proje/dosyalar//2017-05-18 00.08.11.zip', '90325');

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
  KEY `proje_id` (`proje_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kontrol`
--

INSERT INTO `kontrol` (`kontrol_id`, `kontrol_not`, `proje_yuzde`, `kontrol_tarih`, `proje_id`, `kontrol_baslik`) VALUES
(1, 'Proje devam etsin.', 10, '2017-05-13 15:39:21', 66, 'Bu bir kontrol testi'),
(2, 'test 2', 50, '2017-05-13 15:39:39', 66, 'test');

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
  KEY `gonderen_id` (`gonderen_id`,`alici_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ogrenciler`
--

INSERT INTO `ogrenciler` (`ogrenci_id`, `proje_id`, `ogrenci_no`, `ogrenci_sifre`, `ogrenci_isim`, `ogrenci_eposta`, `ogrenci_kayit`, `ogrenci_giris`, `resim`) VALUES
(5, 71, '151809080', 'b45b69c3584350cf9a757654022e73df', 'Yusuf Kaya', 'ysf.ky_1903@hotmail.com', '2017-04-19 21:54:55', '2017-05-20 19:56:43', 'http://localhost/proje/frontend/avatar/1493780797.jpg'),
(6, 67, '151809010', 'c336268b8ed95daaf5818f3c14c45c75', 'John Doe', 'pvpc11@hotmail.com', '2017-05-13 12:50:27', '2017-05-17 21:20:00', 'http://localhost/proje/frontend/avatar/user.png'),
(7, 71, '151809022', 'c336268b8ed95daaf5818f3c14c45c75', 'Tayfun Serin', 'pvpc11@hotmail.com', '2017-05-13 12:50:27', '2017-05-17 21:20:00', 'http://localhost/proje/frontend/avatar/user.png');

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
(1, 'admin@admin', 'admin', 'Test', 'Test Soyisim', '21232f297a57a5a743894a0e4a801fc3', '0000-00-00 00:00:00', '2017-05-19 20:27:46'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=189 ;

--
-- Dumping data for table `olaylar`
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
(107, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-13 18:28:20'),
(108, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-17 20:53:24'),
(109, NULL, 5, NULL, NULL, 'Dosya Silindi', 'dosya-sil', '2017-05-17 20:53:32'),
(112, NULL, 5, NULL, NULL, 'Bir Proje Silindi', 'proje-sil', '2017-05-17 20:54:26'),
(118, NULL, 6, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-17 21:04:35'),
(119, 67, 6, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-17 21:05:27'),
(120, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-17 21:05:49'),
(121, 67, 6, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-17 21:05:54'),
(122, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-17 21:06:16'),
(123, 67, 6, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-17 21:06:38'),
(124, NULL, 6, NULL, NULL, 'Çıkış Yapıldı', 'çıkış', '2017-05-17 21:07:24'),
(125, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-17 21:07:58'),
(126, 67, 5, NULL, 4, 'Dosya Yüklendi', 'dosya-yukle', '2017-05-17 21:08:11'),
(127, NULL, 5, NULL, NULL, 'Çıkış Yapıldı', 'çıkış', '2017-05-17 21:19:49'),
(128, NULL, 6, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-17 21:20:00'),
(130, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-17 21:20:41'),
(131, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-17 21:20:48'),
(133, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-17 21:21:20'),
(135, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-17 21:22:36'),
(137, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-17 21:24:00'),
(139, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-17 21:26:56'),
(140, 67, 6, NULL, NULL, 'Projeden Çıkıldı', 'proje-cik', '2017-05-17 21:27:00'),
(141, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-17 21:27:20'),
(142, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-17 21:27:32'),
(143, 67, 6, NULL, NULL, 'Projeden Çıkıldı', 'proje-cik', '2017-05-17 21:27:41'),
(144, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-19 15:06:59'),
(145, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-19 20:02:41'),
(146, 67, 5, NULL, NULL, 'Projeden Çıkıldı', 'proje-cik', '2017-05-19 20:09:47'),
(147, NULL, 5, NULL, NULL, 'Çıkış Yapıldı', 'çıkış', '2017-05-19 20:27:42'),
(148, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-19 20:28:46'),
(149, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 20:28:56'),
(150, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 20:30:06'),
(151, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 20:30:13'),
(152, 67, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 20:34:16'),
(153, NULL, 5, NULL, NULL, 'Proje Ekibi Oluşturuldu', 'proje-ekip', '2017-05-19 20:34:47'),
(154, NULL, 5, NULL, NULL, 'Proje Eklendi', 'proje-eklendi', '2017-05-19 20:34:47'),
(155, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 20:43:56'),
(156, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 20:59:05'),
(157, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 20:59:15'),
(158, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:00:12'),
(159, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:00:22'),
(160, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:08:54'),
(161, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:09:08'),
(162, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:09:29'),
(163, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:16:42'),
(164, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:18:49'),
(165, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:19:06'),
(166, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:27:46'),
(167, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:28:05'),
(168, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:28:26'),
(169, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:31:37'),
(170, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:31:45'),
(171, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:43:43'),
(172, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:43:50'),
(173, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:47:33'),
(174, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:47:38'),
(175, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:48:11'),
(176, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:48:17'),
(177, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:54:46'),
(178, NULL, 5, NULL, NULL, 'Proje Güncellendi', 'proje-güncellendi', '2017-05-19 21:54:52'),
(179, NULL, 5, NULL, NULL, 'Bir Proje Silindi', 'proje-sil', '2017-05-19 22:02:31'),
(180, NULL, 5, NULL, NULL, 'Proje Ekibi Oluşturuldu', 'proje-ekip', '2017-05-19 22:10:23'),
(181, NULL, 5, NULL, NULL, 'Proje Eklendi', 'proje-eklendi', '2017-05-19 22:10:23'),
(182, NULL, 5, NULL, NULL, 'Bir Proje Silindi', 'proje-sil', '2017-05-19 22:10:35'),
(183, NULL, 5, NULL, NULL, 'Proje Ekibi Oluşturuldu', 'proje-ekip', '2017-05-19 22:12:13'),
(184, NULL, 5, NULL, NULL, 'Proje Eklendi', 'proje-eklendi', '2017-05-19 22:12:13'),
(185, NULL, 5, NULL, NULL, 'Bir Proje Silindi', 'proje-sil', '2017-05-19 22:14:23'),
(186, 71, 5, NULL, NULL, 'Proje Ekibi Oluşturuldu', 'proje-ekip', '2017-05-19 22:15:19'),
(187, 71, 5, NULL, NULL, 'Proje Eklendi', 'proje-eklendi', '2017-05-19 22:15:19'),
(188, NULL, 5, NULL, NULL, 'Giriş Yapıldı', 'giriş', '2017-05-20 19:56:43');

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
-- Dumping data for table `projeler`
--

INSERT INTO `projeler` (`proje_id`, `proje_no`, `proje_konu`, `proje_amac`, `proje_tur`, `olusturan_id`, `proje_dosya`, `proje_uygunluk`, `proje_olusturma`, `proje_bitirme`, `proje_duzenleme`) VALUES
(67, 1, 'Proje Takip Sistemi', 'Projeleri internet üzerinden takip etmek', 2, NULL, '/var/www/html/proje/dosyalar/5 - Proje Takip Sistemi', 1, '2017-05-13 15:43:33', '2017-05-26 15:43:59', '2017-05-13 15:44:14'),
(71, NULL, 'test', 'test', 2, 5, '/var/www/html/proje/dosyalar/5 - test', NULL, '2017-05-19 22:15:18', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mesajlar`
--
ALTER TABLE `mesajlar`
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
  ADD CONSTRAINT `foreign_projeler_proje_id` FOREIGN KEY (`proje_id`) REFERENCES `projeler` (`proje_id`) ON DELETE SET NULL;

--
-- Constraints for table `projeler`
--
ALTER TABLE `projeler`
  ADD CONSTRAINT `foreign_ogrenciler_ogrenci_id_projeler_olusturan_id` FOREIGN KEY (`olusturan_id`) REFERENCES `ogrenciler` (`ogrenci_id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
