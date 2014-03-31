-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.0.51
-- รุ่นของ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ฐานข้อมูล: `record_boon`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `category`
-- 

CREATE TABLE `category` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `subof` int(11) NOT NULL,
  `is_show` tinyint(4) NOT NULL,
  `link` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `privacy` varchar(100) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- 
-- dump ตาราง `category`
-- 

INSERT INTO `category` VALUES (1, 'recordboon', 0, 1, 'recordboon', '', '', '', '', 0);
INSERT INTO `category` VALUES (2, 'activity_boon', 0, 1, 'activity_boon', '', '', '', '', 0);
INSERT INTO `category` VALUES (3, 'dhamma', 0, 1, 'dhamma', '', '', '', '', 0);
INSERT INTO `category` VALUES (4, 'comment', 0, 0, '', '', '', '', '', 0);
INSERT INTO `category` VALUES (5, 'Pages', 0, 0, 'pages', '', '', '', '', 0);
INSERT INTO `category` VALUES (6, 'Groups', 0, 0, 'groups', '', '', '', '', 0);
INSERT INTO `category` VALUES (7, 'Gallery', 0, 0, 'gallery', '', '', '', '', 0);
INSERT INTO `category` VALUES (11, 'sdfasd', 6, 0, '', '26641375345064.jpg', 'sdfasdf', '', 'Secret', 4);
INSERT INTO `category` VALUES (12, 'efsfs', 6, 0, '', '98941375347320.jpg', 'fsdfsd', '', 'Private', 4);
INSERT INTO `category` VALUES (13, 'cvxc', 6, 0, '', '', 'xcvxcv', '', 'Public', 4);
INSERT INTO `category` VALUES (14, 'test page', 5, 0, '', '86461376377316.jpg', 'sdfsdfsd', 'Temple', '', 6);
INSERT INTO `category` VALUES (15, 'หกดหกฟดห', 5, 0, '', '26261380173112.jpg', 'หกดหกด', 'Temple', '', 1);
INSERT INTO `category` VALUES (16, 'หกดหกด', 5, 0, '', '85361380615482.png', 'หกดหกดหกด', 'Organization', '', 1);
INSERT INTO `category` VALUES (17, 'มีรูป', 6, 0, '', '47071380699799.jpg', 'มีรูป', '', 'Public', 1);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `friend`
-- 

CREATE TABLE `friend` (
  `id` bigint(20) NOT NULL auto_increment,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `status_id` tinyint(4) NOT NULL,
  `send_date` datetime NOT NULL,
  `accept_date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- dump ตาราง `friend`
-- 

INSERT INTO `friend` VALUES (4, 1, 5, 2, '2013-07-04 10:44:55', '2013-07-08 10:08:18');
INSERT INTO `friend` VALUES (5, 1, 2, 2, '2013-07-08 15:46:26', '2013-07-08 16:54:30');
INSERT INTO `friend` VALUES (6, 1, 3, 2, '2013-07-08 16:23:42', '2013-07-08 17:05:04');
INSERT INTO `friend` VALUES (7, 1, 4, 2, '2013-07-08 16:24:07', '2013-08-07 11:52:02');
INSERT INTO `friend` VALUES (8, 6, 7, 1, '2013-07-08 17:45:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `nodes`
-- 

CREATE TABLE `nodes` (
  `id` bigint(20) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `picture` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `hide` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- 
-- dump ตาราง `nodes`
-- 

INSERT INTO `nodes` VALUES (1, 'กิจกรรมบุญ', '{"text":"\\u0e01\\u0e34\\u0e08\\u0e01\\u0e23\\u0e23\\u0e21\\u0e1a\\u0e38\\u0e0d","location":"\\u0e01\\u0e34\\u0e08\\u0e01\\u0e23\\u0e23\\u0e21\\u0e1a\\u0e38\\u0e0d"}', '2013-09-26 00:00:00', '2013-09-26 12:41:25', '', 1, 2, 0, 0);
INSERT INTO `nodes` VALUES (2, 'ธรรมะและข้อคิด', '{"text":"\\u0e18\\u0e23\\u0e23\\u0e21\\u0e30\\u0e41\\u0e25\\u0e30\\u0e02\\u0e49\\u0e2d\\u0e04\\u0e34\\u0e14","samma":"\\u0e18\\u0e23\\u0e23\\u0e21\\u0e30\\u0e41\\u0e25\\u0e30\\u0e02\\u0e49\\u0e2d\\u0e04\\u0e34\\u0e14","time_samati":"\\u0e18\\u0e23\\u0e23\\u0e21\\u0e30\\u0e41\\u0e25\\u0e30\\u0e02\\u0e49\\u0e2d\\u0e04\\u0e34\\u0e14","goodness":"\\u0e18\\u0e23\\u0e23\\u0e21\\u0e30\\u0e41\\u0e25\\u0e30\\u0e02\\u0e49\\u0e2d\\u0e04\\u0e34\\u0e14"}', '2013-09-26 00:00:00', '2013-09-26 12:42:57', '', 1, 3, 0, 0);
INSERT INTO `nodes` VALUES (3, 'test', 'test', '2013-09-26 00:00:00', '2013-09-26 12:48:26', '', 1, 1, 0, 0);
INSERT INTO `nodes` VALUES (4, '-', '1', '2013-09-26 12:58:22', '2013-09-26 12:58:22', '', 3, 4, 3, 0);
INSERT INTO `nodes` VALUES (5, '-', '2', '2013-09-26 12:58:31', '2013-09-26 12:58:31', '', 1, 4, 3, 0);
INSERT INTO `nodes` VALUES (6, 'หกดกห', 'ดหกดกหด', '2013-09-26 00:00:00', '2013-09-26 13:25:34', '28511380173134.jpg', 1, 15, 0, 0);
INSERT INTO `nodes` VALUES (7, '-', 'asdasd', '2013-09-26 13:26:08', '2013-09-26 13:26:08', '', 3, 4, 6, 0);
INSERT INTO `nodes` VALUES (8, '-', 'sdf', '2013-09-26 14:47:17', '2013-09-26 14:47:17', '', 1, 4, 6, 0);
INSERT INTO `nodes` VALUES (9, '-', 'ssa', '2013-09-26 16:08:10', '2013-09-26 16:08:10', '', 1, 4, 6, 0);
INSERT INTO `nodes` VALUES (10, '-', '111', '2013-09-26 16:08:17', '2013-09-26 16:08:17', '', 3, 4, 6, 0);
INSERT INTO `nodes` VALUES (11, 'asdasd', '["41051380183996Frame for advertisement news.jpg","66151380183996Fruit-Basket-15-RE340VED1Q-1024x768.jpg","13071380183996Fruit-Basket-16-DLVQOAAATM-1024x768.jpg","18961380183996IMG_3371.JPG"]', '2013-09-26 00:00:00', '2013-09-26 16:26:36', '', 1, 7, 0, 0);
INSERT INTO `nodes` VALUES (12, 'asdasd', '["21991380184018Frame for advertisement news.jpg","50311380184018Fruit-Basket-15-RE340VED1Q-1024x768.jpg","98491380184018Fruit-Basket-16-DLVQOAAATM-1024x768.jpg","92761380184018IMG_3371.JPG"]', '2013-09-26 00:00:00', '2013-09-26 16:26:58', '', 1, 7, 0, 0);
INSERT INTO `nodes` VALUES (13, 'asdasd', 'asdasd', '2013-09-26 00:00:00', '2013-09-27 11:22:53', '66161380252173.png', 1, 1, 0, 0);
INSERT INTO `nodes` VALUES (14, 'sdfsdfsdfsdf', '{"text":"sdfsdfsdfsdf","samma":"sdfsdfsdfsdf","time_samati":"sdfsdfsdfsdf","goodness":"sdfsdfsdfsdf"}', '2013-09-27 00:00:00', '2013-09-27 12:58:29', '26551380257909.jpg', 1, 3, 0, 0);
INSERT INTO `nodes` VALUES (15, 'czxczxc', '{"text":"zxczxc","location":"zxc"}', '2013-09-27 00:00:00', '2013-09-27 13:00:22', '9991380258022.jpg', 1, 2, 0, 0);
INSERT INTO `nodes` VALUES (16, '-', 'bbb', '2013-09-27 13:06:25', '2013-09-27 13:06:25', '', 3, 4, 15, 0);
INSERT INTO `nodes` VALUES (17, '-', 'aaa', '2013-09-27 13:06:59', '2013-09-27 13:06:59', '', 3, 4, 15, 0);
INSERT INTO `nodes` VALUES (18, 'ฟหก', 'ฟหก', '2013-09-27 00:00:00', '2013-09-27 14:47:44', '', 1, 11, 0, 0);
INSERT INTO `nodes` VALUES (19, '-', '%E0%B8%9F%E0%B8%AB%E0%B8%81', '2013-09-27 14:47:47', '2013-09-27 14:47:47', '', 1, 4, 18, 0);
INSERT INTO `nodes` VALUES (20, 'asd', 'asdasdasdas', '2013-09-24 00:00:00', '2013-09-30 11:14:08', '1691380510848.jpg', 3, 1, 0, 0);
INSERT INTO `nodes` VALUES (21, '-', '112233', '2013-09-30 11:26:34', '2013-09-30 11:26:34', '', 3, 4, 20, 0);
INSERT INTO `nodes` VALUES (22, 'นั่งสมาธิ', 'ทดสอบอีกครั้ง นั่งสมาธิ', '2013-09-24 00:00:00', '2013-09-30 16:26:42', '82281380529602.JPG', 1, 15, 0, 0);
INSERT INTO `nodes` VALUES (23, 'xzcxczx', 'czxczxc', '2013-02-10 00:00:00', '2013-10-02 15:32:18', '43211380699138.png', 1, 11, 0, 1);
INSERT INTO `nodes` VALUES (24, '-', '%E0%B8%97%E0%B8%94%E0%B8%AA%E0%B8%AD%E0%B8%9A%E0%B8%84%E0%B8%AD%E0%B8%A1%E0%B9%80%E0%B8%A1%E0%B9%89%E0%B8%99', '2013-10-02 15:38:44', '2013-10-02 15:38:44', '', 1, 4, 23, 0);
INSERT INTO `nodes` VALUES (25, '-', 'qaz', '2013-10-11 15:50:36', '2013-10-11 15:50:36', '', 1, 4, 12, 0);
INSERT INTO `nodes` VALUES (26, 'หผปแป', 'แผแผปแ', '2013-10-21 00:00:00', '2013-10-21 12:10:18', '', 1, 1, 0, 0);
INSERT INTO `nodes` VALUES (27, '-', 'sadsd', '2013-10-28 10:44:57', '2013-10-28 10:44:57', '', 1, 4, 26, 0);
INSERT INTO `nodes` VALUES (28, '-', 'asdasd', '2013-10-28 10:44:59', '2013-10-28 10:44:59', '', 1, 4, 26, 0);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `notify`
-- 

CREATE TABLE `notify` (
  `id` int(11) NOT NULL auto_increment,
  `message` varchar(255) NOT NULL,
  `Isreaded` tinyint(4) NOT NULL,
  `type_id` tinyint(4) NOT NULL,
  `user_receive_id` int(11) NOT NULL,
  `user_send_id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL,
  `datetime_noti` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- 
-- dump ตาราง `notify`
-- 

INSERT INTO `notify` VALUES (1, '1', 0, 0, 1, 3, 3, '2013-09-26 12:58:22');
INSERT INTO `notify` VALUES (2, '2', 0, 0, 1, 1, 3, '2013-09-26 12:58:31');
INSERT INTO `notify` VALUES (3, 'asdasd', 0, 0, 1, 3, 6, '2013-09-26 13:26:08');
INSERT INTO `notify` VALUES (4, 'sdf', 0, 0, 1, 1, 6, '2013-09-26 14:47:17');
INSERT INTO `notify` VALUES (5, 'ssa', 0, 0, 1, 1, 6, '2013-09-26 16:08:10');
INSERT INTO `notify` VALUES (6, '111', 0, 0, 1, 3, 6, '2013-09-26 16:08:17');
INSERT INTO `notify` VALUES (7, 'bbb', 0, 0, 1, 3, 15, '2013-09-27 13:06:25');
INSERT INTO `notify` VALUES (8, 'aaa', 0, 0, 1, 3, 15, '2013-09-27 13:06:59');
INSERT INTO `notify` VALUES (9, 'ฟหก', 0, 0, 1, 1, 18, '2013-09-27 14:47:47');
INSERT INTO `notify` VALUES (10, '112233', 0, 0, 3, 3, 20, '2013-09-30 11:26:34');
INSERT INTO `notify` VALUES (11, 'ทดสอบคอมเม้น', 0, 0, 1, 1, 23, '2013-10-02 15:38:44');
INSERT INTO `notify` VALUES (12, 'qaz', 0, 0, 1, 1, 12, '2013-10-11 15:50:36');
INSERT INTO `notify` VALUES (13, 'sadsd', 0, 0, 1, 1, 26, '2013-10-28 10:44:57');
INSERT INTO `notify` VALUES (14, 'asdasd', 0, 0, 1, 1, 26, '2013-10-28 10:44:59');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `satoo`
-- 

CREATE TABLE `satoo` (
  `user_id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`,`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `satoo`
-- 

INSERT INTO `satoo` VALUES (1, 3);
INSERT INTO `satoo` VALUES (1, 13);
INSERT INTO `satoo` VALUES (1, 18);
INSERT INTO `satoo` VALUES (1, 22);
INSERT INTO `satoo` VALUES (1, 23);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `users`
-- 

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `address` text NOT NULL,
  `email` varchar(150) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `permission` enum('admin','user') NOT NULL,
  `user_id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `group_id` int(11) default NULL,
  `member_groups` text NOT NULL,
  `satoo_pages` text NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- 
-- dump ตาราง `users`
-- 

INSERT INTO `users` VALUES (1, 'Narongsak', 'Kabkaew', 'jeef', '100ca074c52cffee8ce02a0b2fc288bc', 23, 'male', '5/49 moo2 saimai bkk', 'saimaiazz@gmail.com', '0859186191', 'admin', 0, 'profilepic76061379493175.png', 0, '11,12,13', '14,15');
INSERT INTO `users` VALUES (2, 'jjj', 'jjj', 'jjj', 'b176ad7e7753a1c24751490097ad292e', 0, 'male', 'jjj', 'jjj@jjj.jjj', 'jjj', '', 0, 'profilepic12661380275991.jpg', NULL, '12', '');
INSERT INTO `users` VALUES (3, 'bbb', 'bbb', 'bbb', '08f8e0260c64418510cefb2b06eee5cd', 0, 'male', 'aaa', 'saimaiaz1z@gmail.com', '0859186191', '', 0, 'profilepic11031380171664.jpg', NULL, '13,11', '15,15');
INSERT INTO `users` VALUES (4, 'ggg', 'ggg', 'ggg', 'c4ca4238a0b923820dcc509a6f75849b', 12, 'male', 'asd', 'asda@ads.asd', '1223', 'user', 0, 'profilepic76261372145605.jpg', NULL, '11', '');
INSERT INTO `users` VALUES (5, 'ttt', 'ttt', 'ttt', 'dc9e9e2eaf8da1d634e890b503ee881c', 11, 'male', 'sdfsdf', 'saima@sdf.dsf', '02230232', 'user', 0, 'profilepic49981371184312.jpg', NULL, '13', '');
INSERT INTO `users` VALUES (6, 'qqq', 'qqq', 'qqq', 'b2ca678b4c936f905fb82f2733f5297f', 23, 'female', 'sdfsdf', 'sfd@df.sfd', '023234', 'user', 0, 'profilepic7411371183955.jpg', NULL, '', '14');
INSERT INTO `users` VALUES (7, 'jeef', 'narongsak', 'jeef2', '01d51da211eec82e24aa54db1f9a1763', 11, 'male', 'sdfsdf', 'sfasdd@df.sfd', '02230232', 'user', 0, 'profilepic36221371811694.JPG', NULL, '', '');
INSERT INTO `users` VALUES (8, 'newuser', 'lastname_newuser', 'newuser', 'c4ca4238a0b923820dcc509a6f75849b', 23, 'female', 'newuser newuser', 'saimaiazz2@gmail.com', '0859186191', 'user', 0, '', NULL, '', '');
INSERT INTO `users` VALUES (9, 'newuser2', 'newuser2', 'newuser2', 'c4ca4238a0b923820dcc509a6f75849b', 23, 'male', 'newuser2', 'newuser2@d.d', '0859186191', 'user', 0, '', NULL, '', '');
INSERT INTO `users` VALUES (10, 'newuser3', 'newuser3', 'newuser3', '83f798003fbfc4ed7855e1975609d8e4', 23, 'female', 'newuser3', 'saimaiazz23@gmail.com', '0859186191', 'user', 0, '', NULL, '', '');
INSERT INTO `users` VALUES (11, 'newuser4', 'newuser4', 'newuser4', '95dc9705bb83154f5d6ebc6b163908a3', 23, 'male', 'newuser4', 'newuser4@d.d', '0859186191', 'user', 0, '', NULL, '', '');
INSERT INTO `users` VALUES (12, 'newuser4', 'newuser4', 'newuser5', '8f7da89a19968e2976d6abeba02ec659', 23, 'male', 'newuser4', 'newuser5@d.d', '0859186191', 'user', 0, '', NULL, '', '');
INSERT INTO `users` VALUES (13, 'p', 'p', 'p', '83878c91171338902e0fe0fb97a8c47a', 22, '', 'p', 'p@p.p', 'p', '', 0, '', NULL, '', '');
INSERT INTO `users` VALUES (15, 'ppp', 'ppp', 'ppp', 'c4ca4238a0b923820dcc509a6f75849b', 1, 'male', 'sdsdf', 'p@p.s', '02123123123', '', 0, 'profilepic90501380172184.jpg', NULL, '', '');
