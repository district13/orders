CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `customer_id` int(10) NOT NULL,
  `executor_id` int(10) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `transaction_id` int(10) unsigned NOT NULL,
  `version` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=108 ;