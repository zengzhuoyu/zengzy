CREATE TABLE `zy_article` (
  `art_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `art_title` varchar(100) NOT NULL DEFAULT '""' COMMENT '标题',
  `art_tag` varchar(100) DEFAULT '' COMMENT '关键词',
  `art_description` varchar(255) DEFAULT '' COMMENT '描述',
  `art_thumb` varchar(255) NOT NULL DEFAULT '"http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"' COMMENT '缩略图',
  `art_content` text NOT NULL COMMENT '内容',
  `art_author` varchar(50) DEFAULT '' COMMENT '作者',
  `art_view` int(11) unsigned DEFAULT '0' COMMENT '查看次数',
  `art_createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `art_updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `art_status` tinyint(1) unsigned DEFAULT '0' COMMENT '是否可见：0否；1是',
  `art_order` int(11) unsigned DEFAULT '0' COMMENT '排序',
  `cate_id` int(11) unsigned DEFAULT '0' COMMENT '分类id',
  PRIMARY KEY (`art_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章';

CREATE TABLE `zy_category` (
  `cate_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) NOT NULL DEFAULT '' COMMENT '分类名称',
  `cate_keywords` varchar(255) DEFAULT '' COMMENT '关键词',
  `cate_description` varchar(255) DEFAULT '' COMMENT '描述',
  `cate_view` int(11) unsigned DEFAULT '0' COMMENT '查看次数',
  `cate_order` int(11) unsigned DEFAULT '0' COMMENT '排序',
  `cate_pid` int(11) unsigned DEFAULT '0' COMMENT '父级id',
  `cate_status` tinyint(1) unsigned DEFAULT '1' COMMENT '是否可见：0否；1是',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章分类';

CREATE TABLE `zy_config` (
  `conf_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `conf_title` varchar(50) NOT NULL DEFAULT '""' COMMENT '名称',
  `conf_name` varchar(50) NOT NULL DEFAULT '""' COMMENT '变量',
  `conf_content` text COMMENT '名称值',
  `conf_order` int(11) unsigned DEFAULT '0' COMMENT '排序',
  `conf_tips` varchar(255) DEFAULT '' COMMENT '说明',
  `conf_type` varchar(50) DEFAULT '' COMMENT '字段类型',
  `conf_value` varchar(255) DEFAULT '' COMMENT '类型值',
  PRIMARY KEY (`conf_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='配置项';

CREATE TABLE `zy_nav` (
  `nav_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nav_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '""' COMMENT '名称',
  `nav_description` varchar(100) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '描述',
  `nav_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '""' COMMENT '链接',
  `nav_order` int(11) unsigned DEFAULT '0' COMMENT '排序',
  `nav_status` tinyint(1) unsigned DEFAULT '1' COMMENT '位置：0在首页；1在子页面',
  PRIMARY KEY (`nav_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='自定义导航';

CREATE TABLE `zy_say` (
  `say_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `say_author` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '""' COMMENT '作者',
  `say_content` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '""' COMMENT '内容',
  `say_createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `say_updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `say_order` int(11) unsigned DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`say_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='说说';

CREATE TABLE `zy_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL DEFAULT '""' COMMENT '用户名',
  `user_pass` varchar(255) NOT NULL DEFAULT '""' COMMENT '密码',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员';

/*前台私密文章查看权限字段增加、后台登录权限字段增加*/
ALTER TABLE `zy_user`
ADD COLUMN `h_status`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '前台私密文章登录权限' AFTER `user_pass`,
ADD COLUMN `a_status`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '后台登录权限' AFTER `h_status`;



