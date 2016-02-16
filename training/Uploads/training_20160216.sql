/*
Navicat MySQL Data Transfer

Source Server         : .
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : training

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-02-16 18:16:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tt_gallery
-- ----------------------------
DROP TABLE IF EXISTS `tt_gallery`;
CREATE TABLE `tt_gallery` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `image_url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tt_gallery
-- ----------------------------
INSERT INTO `tt_gallery` VALUES ('1', 'Uploads/2016-02-16/h-slider-1.jpg', null, '2016-02-16 14:37:46');
INSERT INTO `tt_gallery` VALUES ('2', 'Uploads/2016-02-16/h-slider-2.jpg', null, '2016-02-16 14:37:54');
INSERT INTO `tt_gallery` VALUES ('3', 'Uploads/2016-02-16/h-slider-3.jpg', null, '2016-02-16 14:37:58');

-- ----------------------------
-- Table structure for tt_lesson
-- ----------------------------
DROP TABLE IF EXISTS `tt_lesson`;
CREATE TABLE `tt_lesson` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `open_date` varchar(255) DEFAULT NULL,
  `profile_id` tinyint(4) DEFAULT '0',
  `state` varchar(20) DEFAULT '报名中',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tt_lesson
-- ----------------------------
INSERT INTO `tt_lesson` VALUES ('1', '产品经理周末班', '2月20日', '1', '报名中', '2016-02-16 17:30:17');
INSERT INTO `tt_lesson` VALUES ('2', '产品经理全日班', '2月25日', '1', '已爆满', '2016-02-16 17:30:42');
INSERT INTO `tt_lesson` VALUES ('3', 'UI设计师周末班', '3月5日', '2', '报名中', '2016-02-16 17:30:54');
INSERT INTO `tt_lesson` VALUES ('4', '产品经理全日班', '3月13日', '2', '已爆满', '2016-02-16 17:31:01');

-- ----------------------------
-- Table structure for tt_major
-- ----------------------------
DROP TABLE IF EXISTS `tt_major`;
CREATE TABLE `tt_major` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type_name` varchar(255) NOT NULL DEFAULT '全日班',
  `profile_id` tinyint(4) DEFAULT NULL,
  `descs` varchar(255) DEFAULT NULL,
  `old_price` smallint(6) DEFAULT '0',
  `price` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tt_major
-- ----------------------------
INSERT INTO `tt_major` VALUES ('1', '产品经理', '周末班', '1', '周六或周日上课，每节课4小时，一共1周', '2999', '2999');
INSERT INTO `tt_major` VALUES ('2', '产品经理', '全日班', '1', '周一到周五上课，每节课6小时，一共2周', '3999', '3999');
INSERT INTO `tt_major` VALUES ('3', 'UI设计师', '周末班', '2', '周六或周日上课，每节课4小时，一共1周', '1888', '1888');
INSERT INTO `tt_major` VALUES ('4', 'UI设计师', '全日班', '2', '周一到周五上课，每节课6小时，一共2周', '2888', '2888');

-- ----------------------------
-- Table structure for tt_profile
-- ----------------------------
DROP TABLE IF EXISTS `tt_profile`;
CREATE TABLE `tt_profile` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `profile` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tt_profile
-- ----------------------------
INSERT INTO `tt_profile` VALUES ('1', '产品经理');
INSERT INTO `tt_profile` VALUES ('2', 'UI课程');

-- ----------------------------
-- Table structure for tt_profile_item
-- ----------------------------
DROP TABLE IF EXISTS `tt_profile_item`;
CREATE TABLE `tt_profile_item` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `profile_id` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tt_profile_item
-- ----------------------------
INSERT INTO `tt_profile_item` VALUES ('1', '1.xxxx', '范德萨发生', '1');
INSERT INTO `tt_profile_item` VALUES ('2', '2.xxxx', '发大水范德萨分', '1');
INSERT INTO `tt_profile_item` VALUES ('3', '3,xxx', 'fdsfa', '1');
INSERT INTO `tt_profile_item` VALUES ('4', '4.xxx', 'fdsfsadfasfdfasfds', '1');
INSERT INTO `tt_profile_item` VALUES ('5', '5.ffffff', 'sdfafdsfafsf', '1');
INSERT INTO `tt_profile_item` VALUES ('6', '6.ccc', '官方的撒撒旦发生发生发生范德萨范德萨分', '1');
INSERT INTO `tt_profile_item` VALUES ('7', '1.yyyyyyy', '幅度萨芬', '2');
INSERT INTO `tt_profile_item` VALUES ('8', '2.yuuuuu', 'fdasfasdfdsf', '2');
INSERT INTO `tt_profile_item` VALUES ('9', '3.fffff', 'sdfasdasfs', '2');
INSERT INTO `tt_profile_item` VALUES ('10', '4.gggggggggg', 'fsadfasfs', '2');
INSERT INTO `tt_profile_item` VALUES ('11', '5.cfsdf', 'fdsafdsfsaf', '2');
INSERT INTO `tt_profile_item` VALUES ('12', '6.sdfdsaf', 'fdsafsadf ', '2');

-- ----------------------------
-- Table structure for tt_teacher
-- ----------------------------
DROP TABLE IF EXISTS `tt_teacher`;
CREATE TABLE `tt_teacher` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `come` varchar(255) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `profile_id` tinyint(4) DEFAULT '0',
  `header_image` varchar(255) DEFAULT NULL,
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tt_teacher
-- ----------------------------
INSERT INTO `tt_teacher` VALUES ('1', '非凡', '百度', '高级项目经理', '1', null, '2016-02-16 17:07:34');
INSERT INTO `tt_teacher` VALUES ('2', '超级', '阿里', '中级项目经理', '1', null, '2016-02-16 17:08:03');
INSERT INTO `tt_teacher` VALUES ('3', '天涯', '腾讯', '高级UI设计师', '2', null, '2016-02-16 17:08:37');
INSERT INTO `tt_teacher` VALUES ('4', '芳草', '360', '中级UI设计师', '2', 'Uploads/2016-02-16/friends.png', '2016-02-16 17:08:57');
