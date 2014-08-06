CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `executor_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `executor_data` text CHARACTER SET utf8 NOT NULL,
  `order_data` text CHARACTER SET utf8 NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;
