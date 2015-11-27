-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2015 at 05:02 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `leperso`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `title` varchar(127) COLLATE utf8_bin NOT NULL,
  `content` varchar(2046) COLLATE utf8_bin NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `id_user`, `title`, `content`, `date`) VALUES
(2, 7, 'Resolut1on''s reponse to Empire''s incredible 2-0 over Vega', 'In an unpredictable turn of events the winners of ESL One New York ru Vega Squadron are out of the DreamLeague Season 4 LAN Finals, having racked up their second defeat at Dreamhack Winter 2015. This means that Team Empire, a team in poor form in the recent months but recently boosted by the addition of former-Navi player ua Gleb ''Funn1k'' Lipatnikov will now face the Frankfurt Major winner world OG.', '2015-11-27 10:59:27'),
(3, 7, 'Resolut1on''s reponse to Empire''s incredible 2-0 over Vega', 'In an unpredictable turn of events the winners of ESL One New York ru Vega Squadron are out of the DreamLeague Season 4 LAN Finals, having racked up their second defeat at Dreamhack Winter 2015. This means that Team Empire, a team in poor form in the recent months but recently boosted by the addition of former-Navi player ua Gleb ''Funn1k'' Lipatnikov will now face the Frankfurt Major winner world OG.', '2015-11-27 11:01:24'),
(7, 7, 'Christmas Charity Magic! Organisers unite to collect for Food For The Hungry', 'A magical time of year is about to get even more magical. A special seasonal event called Christmas Charity Magic has been announced, and it is special indeed. The unique factor of this event is that all proceeds go to charity and that anyone can participate. How Anti-Mage will respond to this most magical of seasons is unclear.\r\nThe project is a collaborative effort by Dreamz.\r\nThe project is a collaborative effort by Dreamz Media, G2A, Twitch, Egamingbets and FaceIT. There is heavy emphasis on selflessness, with all the money from tickets going to the Food For The Hungry charity, with FaceIT and Dreamz Media contributing an additional $2 for the first 10,000 tickets!\r\n\r\n\r\nSource: Saber-PandaAnother festive feature is inclusiveness, as FaceIT will organize online qualifiers, which any and all teams can participate in. Viewers will be able to watch the qualifier matches through DotaTV, granted that they have a ticket.\r\n\r\nThe last thing that makes this season so special (besides when it is played) is that it strives to "break the monotony of Dota". This will be achieved by allowing teams to decide which mode they will be playing, by crossing out unwanted modes from a list before the match.\r\n\r\n8 teams will be invited directly to the main bracket, as listed below (will be updated).', '2015-11-27 15:30:14'),
(8, 7, 'Pajkatt''s Shadow Blade Tiny obliterates Vega with over 9,600 damage', 'As predicted in our preview yesterday, Vega did drag their series with eu 4 Clovers & Lepricon to the third game, and eu 4 Clovers & Lepricon did pull off the surprise win we knew they were capable of. It was nl Alaan ''Bamboe'' Faraj who drew the score level with a victory in game two, but Pajkatt''s unusual Tiny build tore Vega to shreds with 1600 damage crits and almost 10K damage during the final fight of the game.\r\nSetting: The stage was set for the final game of the best-of-3, and 4C&L got the upper-hand in the draft. Vega picked Io first, a hero that analyst Luminous said they have struggled on. 4C&L responded by picking up the Tiny to avoid giving Vega the combo, and followed it up by also nicking Winter Wyvern, a go-to hero for the Russian team.\r\n\r\n\r\nPPD is part of the DL talent deskThird pick for 4C&L was Bane, which was predicted by Evil Geniuses us Peter ''ppd'' Dager, who is part of the talent desk at the DreamLeague Season 4 LAN finals in Sweden.\r\n\r\nThe TI5 winner commented Tiny and Bane is a phenomanal combination in particular in mid lane. \r\n\r\nAs the draft entered the final phase it was clear Vega were lacking team fight but a last pick Silencer was an ingenious answer to the shortcomings of their heroes. \r\n\r\nThe pick was something Niqua commended in the post-match interview, but the Swede said they just baited out the Global Silence and then went in guns blazing later on in the game. ', '2015-11-27 15:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(31) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(4, 'dspx', '$2y$10$hcLCVcnsPsTZ1FV1SSxwceQDZWaBH0cK0DA4KZak9NjTmr5nkhTvm'),
(7, 'Dispix', '$2y$10$chRgK0cOAe/n3Ou00CFJpudkvfDf5Zi7Q6pG/OGEOKcG55slOsDJ6'),
(8, 'connard', '$2y$10$L6tGjyJ86A0Shs1vFRl62uLHMwoxxCLJtb5P9sn12T.xgVMEZbLiW');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
