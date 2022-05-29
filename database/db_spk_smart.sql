/*
 Navicat Premium Data Transfer

 Source Server         : kominfo
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : db_spk_smart

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 29/05/2022 15:12:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for alternatif
-- ----------------------------
DROP TABLE IF EXISTS `alternatif`;
CREATE TABLE `alternatif`  (
  `kode_alternatif` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_alternatif` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `waktu_latihan` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `prestasi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status` int(1) NULL DEFAULT 1,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`kode_alternatif`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of alternatif
-- ----------------------------
INSERT INTO `alternatif` VALUES ('A1', 'Basket', 'Hari Selasa, pukul 15:00', '- Juara 2 tingkat kabupaten 2018\r\n- Juara 3 tingkat nasional 2017', 1, '2022-05-24 11:47:36', '2022-05-29 11:35:16');
INSERT INTO `alternatif` VALUES ('A2', 'Voli', 'Hari Rabu, pukul 16:00', '- Juara 4 tingkat kabupaten 2019', 1, '2022-05-24 11:53:17', '2022-05-29 11:35:58');
INSERT INTO `alternatif` VALUES ('A3', 'Futsal', 'Hari Rabu, pukul 15:00', '- Juara 5 tingkat kabupaten 2016', 1, '2022-05-24 11:53:18', '2022-05-29 11:36:16');
INSERT INTO `alternatif` VALUES ('A4', 'Palang Merah Remaja', 'Hari Kamis, pukul 16:00', '- Mengikuti jambore nasional 2019', 1, '2022-05-24 11:53:19', '2022-05-29 11:36:36');
INSERT INTO `alternatif` VALUES ('A5', 'Pramuka', 'Hari Jumat, pukul 15:00', '- Mengikuti jambore nasional 2018', 1, '2022-05-28 21:46:09', '2022-05-29 11:36:58');

-- ----------------------------
-- Table structure for hasil
-- ----------------------------
DROP TABLE IF EXISTS `hasil`;
CREATE TABLE `hasil`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pengguna` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kode_alternatif` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nilai` float NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hasil
-- ----------------------------
INSERT INTO `hasil` VALUES (1, '1103423', 'A1', 0.8, '2022-05-29 03:18:38', NULL);

-- ----------------------------
-- Table structure for kriteria
-- ----------------------------
DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria`  (
  `kode_kriteria` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_kriteria` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tipe` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bobot` int(1) NOT NULL,
  `created_at` datetime(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`kode_kriteria`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kriteria
-- ----------------------------
INSERT INTO `kriteria` VALUES ('K1', 'Minat', 'benefit', 2, '2022-05-23 21:24:20');
INSERT INTO `kriteria` VALUES ('K2', 'Bakat', 'benefit', 3, '2022-05-23 21:24:51');
INSERT INTO `kriteria` VALUES ('K3', 'Pengalaman', 'benefit', 2, '2022-05-23 21:25:05');
INSERT INTO `kriteria` VALUES ('K4', 'Prestasi Siswa', 'benefit', 2, '2022-05-23 21:25:17');
INSERT INTO `kriteria` VALUES ('K5', 'Waktu Latihan', 'benefit', 1, '2022-05-23 21:25:53');

-- ----------------------------
-- Table structure for opsi
-- ----------------------------
DROP TABLE IF EXISTS `opsi`;
CREATE TABLE `opsi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kriteria` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `opsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nilai` int(2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of opsi
-- ----------------------------
INSERT INTO `opsi` VALUES (1, 'K1', 'Sangat Tinggi', 4);
INSERT INTO `opsi` VALUES (2, 'K1', 'Tinggi', 3);
INSERT INTO `opsi` VALUES (3, 'K1', 'Cukup', 2);
INSERT INTO `opsi` VALUES (4, 'K1', 'Kurang', 1);
INSERT INTO `opsi` VALUES (5, 'K2', 'Sangat Berbakat', 4);
INSERT INTO `opsi` VALUES (6, 'K2', 'Berbakat', 3);
INSERT INTO `opsi` VALUES (7, 'K2', 'Cukup', 2);
INSERT INTO `opsi` VALUES (8, 'K2', 'Kurang Berbakat', 1);
INSERT INTO `opsi` VALUES (9, 'K3', 'Pengalaman > 2 tahun', 4);
INSERT INTO `opsi` VALUES (10, 'K3', 'Pengalaman > 1 tahun', 3);
INSERT INTO `opsi` VALUES (11, 'K3', 'Pengalaman < 1 tahun', 2);
INSERT INTO `opsi` VALUES (12, 'K3', 'Belum ada pengalaman', 1);
INSERT INTO `opsi` VALUES (13, 'K4', 'Tingkat Nasional', 4);
INSERT INTO `opsi` VALUES (14, 'K4', 'Tingkat Provinsi', 3);
INSERT INTO `opsi` VALUES (15, 'K4', 'Tingkat Kabupaten', 2);
INSERT INTO `opsi` VALUES (16, 'K4', 'Belum', 1);
INSERT INTO `opsi` VALUES (17, 'K5', 'Sesuai', 2);
INSERT INTO `opsi` VALUES (18, 'K5', 'Tidak Sesuai', 1);

-- ----------------------------
-- Table structure for pengguna
-- ----------------------------
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna`  (
  `kode_pengguna` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_lengkap` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `role` int(1) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 1,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`kode_pengguna`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
INSERT INTO `pengguna` VALUES ('1103423', 'Nana Supriatna', 2, 1, '$2y$10$0dOcwvlCYEMctdFMehM1HuDmjXoYwzgiDybZIaCMtTy9e5RPc5eMi', '2022-05-23 16:42:15', '2022-05-28 21:38:20');
INSERT INTO `pengguna` VALUES ('198608231273746328', 'Admin', 1, 1, '$2y$10$XcQledQ4ovCMMMOBNgvc7ehUoRV1Q./NsS9QtTL4oFuTd1t3Rr.6m', '2022-05-23 11:57:40', '2022-05-28 21:38:09');

-- ----------------------------
-- Table structure for penilaian
-- ----------------------------
DROP TABLE IF EXISTS `penilaian`;
CREATE TABLE `penilaian`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kode_pengguna` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_alternatif` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_kriteria` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nilai` float NOT NULL,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_penilaian_1`(`kode_alternatif`) USING BTREE,
  INDEX `fk_penilaian_2`(`kode_kriteria`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penilaian
-- ----------------------------
INSERT INTO `penilaian` VALUES (1, '1103423', 'A1', 'K1', 4, '2022-05-29 00:49:47', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (2, '1103423', 'A1', 'K2', 4, '2022-05-29 00:49:47', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (3, '1103423', 'A1', 'K3', 3, '2022-05-29 00:49:47', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (4, '1103423', 'A1', 'K4', 1, '2022-05-29 00:49:47', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (5, '1103423', 'A1', 'K5', 2, '2022-05-29 00:49:47', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (6, '1103423', 'A2', 'K1', 3, '2022-05-29 01:08:19', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (7, '1103423', 'A2', 'K2', 3, '2022-05-29 01:08:19', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (8, '1103423', 'A2', 'K3', 3, '2022-05-29 01:08:19', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (9, '1103423', 'A2', 'K4', 1, '2022-05-29 01:08:19', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (10, '1103423', 'A2', 'K5', 2, '2022-05-29 01:08:19', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (11, '1103423', 'A3', 'K1', 2, '2022-05-29 01:08:35', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (12, '1103423', 'A3', 'K2', 1, '2022-05-29 01:08:35', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (13, '1103423', 'A3', 'K3', 1, '2022-05-29 01:08:35', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (14, '1103423', 'A3', 'K4', 1, '2022-05-29 01:08:35', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (15, '1103423', 'A3', 'K5', 2, '2022-05-29 01:08:35', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (16, '1103423', 'A4', 'K1', 2, '2022-05-29 01:08:54', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (17, '1103423', 'A4', 'K2', 2, '2022-05-29 01:08:54', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (18, '1103423', 'A4', 'K3', 3, '2022-05-29 01:08:54', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (19, '1103423', 'A4', 'K4', 2, '2022-05-29 01:08:54', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (20, '1103423', 'A4', 'K5', 2, '2022-05-29 01:08:54', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (21, '1103423', 'A5', 'K1', 1, '2022-05-29 01:09:06', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (22, '1103423', 'A5', 'K2', 2, '2022-05-29 01:09:06', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (23, '1103423', 'A5', 'K3', 1, '2022-05-29 01:09:06', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (24, '1103423', 'A5', 'K4', 1, '2022-05-29 01:09:06', '2022-05-29 03:16:03');
INSERT INTO `penilaian` VALUES (25, '1103423', 'A5', 'K5', 1, '2022-05-29 01:42:24', '2022-05-29 03:16:03');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, 'Admin', '2022-05-23 11:45:17');
INSERT INTO `role` VALUES (2, 'Siswa', '2022-05-23 11:54:53');

SET FOREIGN_KEY_CHECKS = 1;
