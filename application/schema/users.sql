CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `money` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `role` int(11) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `transaction_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;
