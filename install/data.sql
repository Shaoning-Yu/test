/*
Navicat MySQL Data Transfer
Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : max
Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001
Date: 2019-04-26 23:42:40
*/
SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for mkcms_ad
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_ad`;
CREATE TABLE `mkcms_ad` (
  `id` smallint(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `pic` text,
  `catid` varchar(255) DEFAULT NULL,
  `miaoshu` varchar(255) DEFAULT NULL,
  `picurl` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mkcms_adclass
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_adclass`;
CREATE TABLE `mkcms_adclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mkcms_adclass
-- ----------------------------
INSERT INTO `mkcms_adclass` VALUES ('1', '播放前广告');
INSERT INTO `mkcms_adclass` VALUES ('2', '首页导航下方广告');
INSERT INTO `mkcms_adclass` VALUES ('3', '首页抢先看上方广告');
INSERT INTO `mkcms_adclass` VALUES ('4', '首页电影上方广告');
INSERT INTO `mkcms_adclass` VALUES ('5', '首页剧集上方广告');
INSERT INTO `mkcms_adclass` VALUES ('6', '首页娱乐资讯上方广告');
INSERT INTO `mkcms_adclass` VALUES ('7', '首页综艺上方广告');
INSERT INTO `mkcms_adclass` VALUES ('8', '首页搞笑视频上方广告');
INSERT INTO `mkcms_adclass` VALUES ('9', '首页动漫上方广告');
INSERT INTO `mkcms_adclass` VALUES ('10', '友情链接上方广告');
INSERT INTO `mkcms_adclass` VALUES ('11', '电影栏目页广告');
INSERT INTO `mkcms_adclass` VALUES ('12', '剧集栏目页广告');
INSERT INTO `mkcms_adclass` VALUES ('13', '动漫栏目页广告');
INSERT INTO `mkcms_adclass` VALUES ('14', '综艺栏目页广告');
INSERT INTO `mkcms_adclass` VALUES ('15', 'YY栏目页广告');
INSERT INTO `mkcms_adclass` VALUES ('16', '娱乐栏目页广告');
INSERT INTO `mkcms_adclass` VALUES ('17', '音乐栏目页广告');
INSERT INTO `mkcms_adclass` VALUES ('18', '搞笑栏目页广告');
INSERT INTO `mkcms_adclass` VALUES ('19', '音乐MV栏目页广告');
INSERT INTO `mkcms_adclass` VALUES ('20', '电视直播页面广告');
INSERT INTO `mkcms_adclass` VALUES ('21', '尝鲜栏目页面广告');
INSERT INTO `mkcms_adclass` VALUES ('22', '播放页排行榜下方广告');

-- ----------------------------
-- Table structure for mkcms_book
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_book`;
CREATE TABLE `mkcms_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  `userid` varchar(11) DEFAULT NULL,
  `Reply` text,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mkcms_book
-- ----------------------------

-- ----------------------------
-- Table structure for mkcms_fav
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_fav`;
CREATE TABLE `mkcms_fav` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mkcms_fav
-- ----------------------------

-- ----------------------------
-- Table structure for mkcms_link
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_link`;
CREATE TABLE `mkcms_link` (
  `l_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `l_name` varchar(64) NOT NULL DEFAULT '',
  `l_url` varchar(255) NOT NULL DEFAULT '',
  `l_logo` varchar(255) NOT NULL DEFAULT '',
  `l_type` tinyint(1) NOT NULL DEFAULT '0',
  `l_sort` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`l_id`),
  KEY `l_sort` (`l_sort`),
  KEY `l_type` (`l_type`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mkcms_link
-- ----------------------------

-- ----------------------------
-- Table structure for mkcms_manager
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_manager`;
CREATE TABLE `mkcms_manager` (
  `m_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `m_name` varchar(32) NOT NULL DEFAULT '',
  `m_password` varchar(32) NOT NULL DEFAULT '',
  `m_levels` varchar(32) NOT NULL DEFAULT '',
  `m_random` varchar(32) NOT NULL DEFAULT '',
  `m_status` tinyint(1) NOT NULL DEFAULT '0',
  `m_logintime` int(10) NOT NULL DEFAULT '0',
  `m_loginip` int(15) NOT NULL DEFAULT '0',
  `m_loginnum` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`m_id`),
  KEY `m_status` (`m_status`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mkcms_manager
-- ----------------------------
INSERT INTO `mkcms_manager` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'b,c,d,e,f,g,h,i,j', '897de67740645ef418d8915547298d4c', '1', '1503380295', '2130706433', '0');

-- ----------------------------
-- Table structure for mkcms_nav
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_nav`;
CREATE TABLE `mkcms_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_name` varchar(255) DEFAULT NULL,
  `n_url` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mkcms_nav
-- ----------------------------

-- ----------------------------
-- Table structure for mkcms_play
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_play`;
CREATE TABLE `mkcms_play` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mkcms_slideshow
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_slideshow`;
CREATE TABLE `mkcms_slideshow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(255) DEFAULT NULL,
  `s_parent` varchar(255) DEFAULT NULL,
  `s_order` int(11) DEFAULT NULL,
  `s_url` varchar(255) DEFAULT NULL,
  `s_picture` varchar(255) DEFAULT NULL,
  `s_content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mkcms_slideshow`
--
INSERT INTO `mkcms_slideshow` VALUES (6,'米酷资源网','1',6,'https://micool.net','http://v.micool.top/images/slide.png',NULL);


-- ----------------------------
-- Table structure for mkcms_system
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_system`;
CREATE TABLE `mkcms_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(255) DEFAULT NULL,
  `s_domain` varchar(255) DEFAULT NULL,
  `s_seoname` varchar(255) DEFAULT NULL,
  `s_keywords` varchar(255) DEFAULT NULL,
  `s_description` varchar(255) DEFAULT NULL,
  `s_cache` varchar(255) DEFAULT NULL,
  `s_wei` varchar(255) DEFAULT NULL,
  `s_user` varchar(255) DEFAULT NULL,
  `s_slow` varchar(255) DEFAULT NULL,
  `s_logo` varchar(255) DEFAULT NULL,
  `s_weixin` varchar(255) DEFAULT NULL,
  `s_dashang` varchar(255) DEFAULT NULL,
  `s_mjk` varchar(255) DEFAULT NULL,
  `s_jiekou` text,
  `s_copyright` text,
  `s_changyan` text,
  `s_alipay` varchar(255) DEFAULT NULL,
  `s_appid` varchar(255) DEFAULT NULL,
  `s_appkey` varchar(255) DEFAULT NULL,
  `s_shoukuan` varchar(255) DEFAULT NULL,
  `s_qqun` varchar(255) DEFAULT NULL,
  `s_token` varchar(255) DEFAULT NULL,
  `s_bdyun` varchar(255) DEFAULT NULL,
  `s_tongji` text,
  `s_qianxian` varchar(255) DEFAULT NULL,
  `s_dianying` varchar(255) DEFAULT NULL,
  `s_dianshi` varchar(255) DEFAULT NULL,
  `s_zongyi` varchar(255) DEFAULT NULL,
  `s_dongman` varchar(255) DEFAULT NULL,
  `s_tuiguang` varchar(255) DEFAULT NULL,
  `s_shoufei` text,
  `s_cishu` varchar(255) DEFAULT NULL,
  `s_gx` varchar(255) DEFAULT NULL,
  `s_hong` varchar(255) DEFAULT NULL,
  `s_gonggao` text,
  `s_bofang` varchar(255) DEFAULT NULL,
  `s_guanzhu` text,
  `s_fengmian` varchar(255) DEFAULT NULL,
  `s_mail` varchar(255) DEFAULT NULL,
  `s_smtp` varchar(255) DEFAULT NULL,
  `s_muser` varchar(255) DEFAULT NULL,
  `s_mpwd` varchar(255) DEFAULT NULL,
  `s_wappid` varchar(255) DEFAULT NULL,
  `s_wkey` varchar(255) DEFAULT NULL,
  `s_tixing` varchar(255) DEFAULT NULL,
  `s_appewm` varchar(255) DEFAULT NULL,
  `s_appbt` varchar(255) DEFAULT NULL,
  `s_apppic` varchar(255) DEFAULT NULL,
  `s_appurl` varchar(255) DEFAULT NULL,
  `s_gg` varchar(255) DEFAULT NULL,
  `s_hctime` varchar(255) DEFAULT NULL,
  `s_beijing` varchar(255) DEFAULT NULL,
  `s_dianyingnew` varchar(255) DEFAULT NULL,
  `s_dongmannew` varchar(255) DEFAULT NULL,
  `s_zongyinew` varchar(255) DEFAULT NULL,
  `s_zhifu` varchar(255) DEFAULT NULL,
  `s_tuijian` text,
  `s_wxguanzhu` varchar(255) DEFAULT NULL,
  `s_smsname` varchar(255) DEFAULT NULL,
  `s_smspass` varchar(255) DEFAULT NULL,
  `s_miaoshu` varchar(255) DEFAULT NULL,
  `s_hz` varchar(255) DEFAULT NULL,
  `s_yq` varchar(255) DEFAULT NULL,
  `s_autoqx` varchar(255) DEFAULT NULL,
  `s_mv` varchar(255) DEFAULT NULL,
  `s_zixun` varchar(255) DEFAULT NULL,
  `s_yy` varchar(255) DEFAULT NULL,
  `s_cxzy` varchar(255) DEFAULT NULL,
  `s_dataoke` varchar(255) DEFAULT NULL,
  `s_dataokeid` varchar(255) DEFAULT NULL,
  `s_tk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mkcms_system
-- ----------------------------
INSERT INTO `mkcms_system` VALUES (1,'米酷影视','http://v.micool.top/','米酷影视 - 在线免费高清电影！','电影,视频大全,在线高清电影,付费电影,免费电影,剧集,电影,在线观看,VIP高清电影直播','米酷影视，是专门做剧集,电影等在线播放服务，本页面提供电影的相关内容。','0','1','0','1','/images/logo.png','/images/code.jpg','/images/qrcode.png','http://jx2.micool.cc/index.php?url=','官网$','本网站内容收集于互联网，米酷影视不承担任何由于内容的合法性及健康性所引起的争议和法律责任<br />\r\nCopyright &copy;&nbsp; 米酷影视 版权所有','','','','','','','1222','jingpin','','1','1','1','1','1','0','鸭王,鸭王2,','5','1','0','公告：欢迎光临米酷影院，建议手机安装app观看，为了本站的收入，广告是必不可少的，请点击一下广告！让本站走的更远！','10',NULL,NULL,'0','ssl://smtp.163.com','','',NULL,NULL,'','/images/code.jpg','/images/3.png','/images/2.png','','1','10','','','','','1',NULL,NULL,'','','0','1','1','1','1','1','1','http://cj.131zy.net/inc/feifei3/','http://demo.dataoke.com/','774639','1');

-- ----------------------------
-- Table structure for mkcms_user
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_user`;
CREATE TABLE `mkcms_user` (
  `u_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `u_qid` varchar(32) NOT NULL DEFAULT '',
  `u_name` varchar(32) NOT NULL DEFAULT '',
  `u_password` varchar(32) NOT NULL DEFAULT '',
  `u_qq` varchar(16) NOT NULL DEFAULT '',
  `u_email` varchar(32) NOT NULL DEFAULT '',
  `u_phone` varchar(16) NOT NULL DEFAULT '',
  `u_status` tinyint(1) NOT NULL DEFAULT '0',
  `u_flag` tinyint(1) NOT NULL DEFAULT '0',
  `u_question` varchar(255) NOT NULL DEFAULT '',
  `u_answer` varchar(255) NOT NULL DEFAULT '',
  `u_group` smallint(6) NOT NULL DEFAULT '0',
  `u_points` smallint(6) NOT NULL DEFAULT '0',
  `u_regtime` char(255) NOT NULL DEFAULT '0',
  `u_logintime` char(255) NOT NULL DEFAULT '0',
  `u_loginnum` smallint(6) NOT NULL DEFAULT '0',
  `u_extend` smallint(6) NOT NULL DEFAULT '0',
  `u_loginip` char(15) NOT NULL DEFAULT '0',
  `u_random` varchar(32) NOT NULL DEFAULT '',
  `u_fav` text NOT NULL,
  `u_plays` text NOT NULL,
  `u_downs` text NOT NULL,
  `u_start` int(10) NOT NULL DEFAULT '0',
  `u_end` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`u_id`),
  KEY `u_group` (`u_group`),
  KEY `u_status` (`u_status`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Table structure for mkcms_userka
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_userka`;
CREATE TABLE `mkcms_userka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `money` varchar(255) DEFAULT NULL,
  `jifen` varchar(255) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mkcms_userka
-- ----------------------------
INSERT INTO `mkcms_userka` VALUES ('1', '包月会员', '30', '5', '50', '2');

-- ----------------------------
-- Table structure for mkcms_user_card
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_user_card`;
CREATE TABLE `mkcms_user_card` (
  `c_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `c_number` varchar(16) NOT NULL DEFAULT '',
  `c_pass` varchar(8) NOT NULL DEFAULT '' COMMENT '分类',
  `c_money` int(11) NOT NULL DEFAULT '0' COMMENT '天数',
  `c_used` tinyint(1) NOT NULL DEFAULT '0',
  `c_sale` tinyint(1) NOT NULL DEFAULT '0',
  `c_user` varchar(255) DEFAULT '0',
  `c_addtime` int(10) NOT NULL DEFAULT '0',
  `c_usetime` int(10) NOT NULL DEFAULT '0',
  `c_userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`c_id`),
  KEY `c_used` (`c_used`),
  KEY `c_sale` (`c_sale`),
  KEY `c_user` (`c_user`),
  KEY `c_addtime` (`c_addtime`),
  KEY `c_usetime` (`c_usetime`)
) ENGINE=MyISAM AUTO_INCREMENT=360 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for mkcms_user_cardclass
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_user_cardclass`;
CREATE TABLE `mkcms_user_cardclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `card_id` varchar(255) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mkcms_user_group
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_user_group`;
CREATE TABLE `mkcms_user_group` (
  `ug_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `ug_name` varchar(32) NOT NULL DEFAULT '',
  `ug_type` varchar(255) NOT NULL DEFAULT '',
  `ug_popedom` varchar(32) NOT NULL DEFAULT '',
  `ug_upgrade` smallint(6) NOT NULL DEFAULT '0',
  `ug_popvalue` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ug_id`),
  KEY `ug_upgrade` (`ug_upgrade`),
  KEY `ug_popvalue` (`ug_popvalue`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mkcms_user_group
-- ----------------------------
INSERT INTO `mkcms_user_group` VALUES ('1', '普通会员', '', '', '0', '1');
INSERT INTO `mkcms_user_group` VALUES ('2', '金牌会员', '', '', '10', '0');
INSERT INTO `mkcms_user_group` VALUES ('3', '超级会员', '', '', '500', '0');

-- ----------------------------
-- Table structure for mkcms_user_pay
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_user_pay`;
CREATE TABLE `mkcms_user_pay` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_order` varchar(255) NOT NULL DEFAULT '0',
  `p_uid` varchar(255) NOT NULL DEFAULT '0',
  `p_price` varchar(255) NOT NULL DEFAULT '0',
  `p_time` int(10) NOT NULL DEFAULT '0',
  `p_point` varchar(255) NOT NULL DEFAULT '0',
  `p_status` tinyint(1) NOT NULL DEFAULT '0',
  `p_group` smallint(255) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `p_order` (`p_order`),
  KEY `p_uid` (`p_uid`),
  KEY `p_status` (`p_status`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mkcms_user_pay
-- ----------------------------

-- ----------------------------
-- Table structure for mkcms_user_visit
-- ----------------------------
DROP TABLE IF EXISTS `mkcms_user_visit`;
CREATE TABLE `mkcms_user_visit` (
  `uv_id` int(11) NOT NULL AUTO_INCREMENT,
  `uv_uid` int(11) DEFAULT '0',
  `uv_ip` int(10) NOT NULL DEFAULT '0',
  `uv_ly` varchar(128) NOT NULL DEFAULT '',
  `uv_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uv_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mkcms_user_visit
-- ----------------------------