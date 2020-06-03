/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : wish

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 02/06/2020 21:46:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for wisher
-- ----------------------------
DROP TABLE IF EXISTS `wisher`;
CREATE TABLE `wisher`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `time` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `likeCount` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wisher
-- ----------------------------
INSERT INTO `wisher` VALUES (1, '777', '77777', '2020-06-02 21:10:27', 2);
INSERT INTO `wisher` VALUES (2, '675', '合肥公交回家', '2020-06-02 21:03:30', 0);
INSERT INTO `wisher` VALUES (3, '546', '4564', '2020-06-02 21:04:56', 0);
INSERT INTO `wisher` VALUES (4, '666', '6666666', '2020-06-02 21:05:51', 0);
INSERT INTO `wisher` VALUES (6, '测试者', '测试内容哈哈哈哈哈哈哈', '2020-06-02 21:20:39', 0);

SET FOREIGN_KEY_CHECKS = 1;
