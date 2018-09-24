-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 24 sep. 2018 à 22:59
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `oc_blog`
--
CREATE DATABASE IF NOT EXISTS `oc_blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `oc_blog`;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_bin NOT NULL,
  `created_at` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `content`, `created_at`, `post_id`, `user_id`) VALUES
(1, 'Test', 1537722060, 16, 1),
(2, 'Test', 1537722171, 16, 1),
(3, 'Test', 1537722173, 16, 1),
(4, 'Test', 1537722328, 16, 1),
(5, 'Test', 1537722440, 16, 1),
(6, 'Test', 1537722444, 16, 1),
(7, 'Test', 1537722514, 16, 1),
(8, 'Test', 1537722534, 16, 1),
(9, 'Test', 1537722546, 16, 1),
(10, 'Test', 1537722575, 16, 1),
(11, 'Test', 1537722584, 16, 1),
(12, 'Test', 1537722631, 16, 1),
(13, 'Test', 1537722638, 16, 1),
(14, 'Salut', 1537722670, 16, 13),
(15, 'Salut', 1537722769, 16, 13),
(16, 'Salut', 1537722935, 16, 13),
(17, 'Salut', 1537723000, 16, 13),
(18, 'Salut', 1537723140, 16, 13),
(19, 'Salut', 1537723173, 16, 13),
(20, 'Salut', 1537723238, 16, 13),
(21, 'Salut', 1537723249, 16, 13),
(22, 'Salut', 1537723253, 16, 13),
(23, 'Salut', 1537723262, 16, 13),
(24, 'Salut', 1537723277, 16, 13),
(25, 'Salut', 1537723309, 16, 13),
(26, 'Salut', 1537723365, 16, 13),
(27, 'Salut', 1537723367, 16, 13),
(28, 'Salut', 1537723443, 16, 13),
(29, 'Salut', 1537723452, 16, 13),
(30, 'Salut', 1537723494, 16, 13),
(31, 'Salut', 1537723530, 16, 13),
(32, 'Salut', 1537723538, 16, 13),
(33, 'Salut', 1537723624, 16, 13),
(34, 'Salut', 1537723815, 16, 13),
(35, 'Salut', 1537723825, 16, 13),
(36, 'test', 1537828938, 14, 1);

-- --------------------------------------------------------

--
-- Structure de la table `comment_reports`
--

DROP TABLE IF EXISTS `comment_reports`;
CREATE TABLE IF NOT EXISTS `comment_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`comment_id`),
  KEY `comment_id` (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `comment_reports`
--

INSERT INTO `comment_reports` (`id`, `user_id`, `comment_id`) VALUES
(1, 1, 1),
(3, 1, 2),
(4, 13, 1),
(11, 13, 7),
(12, 13, 8),
(9, 13, 12);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `published` tinyint(4) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `published`, `created_at`, `updated_at`, `user_id`) VALUES
(10, 'Chapitre 1 - Nullam sed mollis mi, eget egestas magna', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Ut lacinia eros et mollis egestas. Pellentesque porttitor tortor sem, finibus condimentum est venenatis a. Pellentesque id scelerisque velit. In quis vulputate purus. In quis tincidunt sapien, quis bibendum erat. Curabitur ut aliquam diam. Phasellus at dolor consequat nulla semper ornare at eu quam. Phasellus gravida vestibulum nisi, in mollis tortor bibendum pretium. Etiam fringilla posuere dolor, sit amet varius ex auctor nec. Praesent malesuada sagittis mattis. Vivamus gravida sem nec magna pulvinar, vel pretium purus pretium. Donec ut libero lectus. Quisque non libero in tellus euismod dignissim ac non ante. Integer sodales purus eros, id sagittis arcu pulvinar non.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Fusce eros lacus, tempus a sollicitudin non, pretium a tortor. Duis ut mi convallis, commodo quam in, imperdiet metus. Suspendisse potenti. Duis fermentum finibus nunc. Duis sed rhoncus ipsum. Aliquam volutpat facilisis lacus et sagittis. Etiam ut tempor nunc, eget lacinia mi. Pellentesque ante ipsum, scelerisque id lectus ut, interdum dapibus elit. Morbi varius lacinia sagittis.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nullam sed mollis mi, eget egestas magna. Mauris iaculis metus lectus, vel volutpat dui venenatis eu. Cras lacinia maximus leo, id euismod felis efficitur vel. Mauris auctor sit amet libero quis euismod. Aliquam sollicitudin eros non nulla mollis, at luctus felis fermentum. Curabitur gravida dignissim porttitor. Suspendisse auctor rutrum felis, vitae faucibus libero semper sit amet.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nulla facilisi. Nulla facilisi. Morbi sit amet egestas nunc. Mauris eleifend nunc sed laoreet gravida. Sed iaculis, ex eget luctus vulputate, neque odio elementum leo, ac molestie tortor lorem tristique urna. Vestibulum quis consequat velit, sit amet posuere turpis. Nam suscipit ipsum eu sapien posuere finibus. Nulla facilisi. Fusce vestibulum, augue vel facilisis elementum, quam tellus pulvinar urna, eu vulputate turpis erat nec lacus. Quisque nec mauris ac odio ultrices iaculis.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nam faucibus elit eget neque faucibus, vel consectetur metus placerat. Pellentesque volutpat, enim et semper rutrum, leo felis ultrices augue, laoreet scelerisque augue quam sed leo. Vestibulum eu consequat tortor. Nam ultricies tellus a nulla accumsan bibendum. Sed elementum tempor sapien et lobortis. Vivamus cursus vitae nisi a viverra. Vivamus sed velit urna. Proin eget nisi sit amet augue lacinia hendrerit nec auctor elit. Aliquam odio metus, interdum sed fringilla sed, consequat sit amet lacus. Fusce laoreet dui quis magna sollicitudin, quis mattis mauris scelerisque. Pellentesque ac sagittis lacus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cras sem neque, interdum a accumsan vel, eleifend vel urna.</p>', 1, 1537370843, 1537829658, 1),
(11, 'Chapitre 2 - Praesent maximus, metus eget efficitur rutrum', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nulla facilisi. In dapibus nisl nisi, sed tincidunt purus laoreet eu. Nulla non odio iaculis, semper orci sed, pretium justo. Ut nec libero non quam efficitur condimentum. Fusce consectetur ex vel felis laoreet sollicitudin. Pellentesque vel erat id tellus cursus fringilla nec at magna. Fusce a consectetur dolor. Donec nunc nulla, euismod nec urna sed, volutpat egestas felis. Suspendisse dolor diam, aliquam et ipsum eu, accumsan efficitur mauris. Duis et ligula fringilla ligula euismod ullamcorper. Duis dignissim placerat lorem, quis cursus lorem interdum vel. Aliquam felis massa, molestie id facilisis vitae, varius id urna. Pellentesque enim justo, auctor eu viverra non, faucibus quis lacus. Aliquam convallis, nisi sed ullamcorper pretium, ipsum nulla rutrum sem, eu viverra justo tortor ut orci. Nullam in risus felis.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Praesent maximus, metus eget efficitur rutrum, felis odio tempor ante, in lacinia metus purus et felis. Nulla facilisi. Nulla eleifend velit ac blandit egestas. Donec ante odio, faucibus id mollis eu, egestas vel mi. Ut eget sem non lorem efficitur sollicitudin. Etiam ipsum mauris, suscipit rhoncus nulla eget, imperdiet vehicula est. Sed dapibus efficitur velit, quis viverra odio gravida vel. Cras tincidunt cursus eros, sit amet aliquam lacus mollis eget. Ut eu interdum enim, sodales malesuada lectus. Aliquam mollis odio vitae massa blandit, et hendrerit mi faucibus. Sed vitae nulla odio. Proin porta nisl ac tortor dapibus, eget finibus enim consectetur.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc a pharetra quam. Ut et turpis nisi. Quisque nec fringilla erat, semper tincidunt mauris. Vestibulum tincidunt nibh ut metus bibendum, at consequat urna porta. Fusce condimentum sapien sed neque molestie tristique. Vestibulum sagittis eleifend ipsum, id ultrices quam fermentum eget. Cras egestas sapien ac laoreet rhoncus. Praesent eget eleifend ligula. Sed massa sapien, mollis malesuada placerat sit amet, pulvinar quis nunc. Vivamus a magna vehicula, faucibus felis a, commodo nulla.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nunc at orci rutrum, egestas quam vel, imperdiet turpis. Nam posuere est sed pulvinar consequat. Morbi gravida bibendum arcu, eu laoreet purus condimentum et. Nam suscipit velit lacus, eu vestibulum lorem lobortis id. Nam mauris ante, semper vitae feugiat ac, lacinia in ante. Phasellus malesuada euismod viverra. Vivamus non dolor sed ante porttitor imperdiet. Curabitur rutrum pretium ex nec tempus. Pellentesque rutrum elit in interdum auctor. Integer non quam faucibus, rhoncus ex at, fermentum libero. Vivamus aliquet justo ligula, at rutrum libero viverra nec. Maecenas tristique mi at ipsum euismod ultricies. Duis semper, elit a bibendum aliquam, massa neque facilisis augue, eu pharetra nisi sem at felis. Praesent ipsum tellus, congue vitae est ac, finibus ornare lectus. Donec vitae tempor mauris, quis congue turpis. Phasellus fermentum nunc ut dui dapibus, sed porttitor sem consectetur.</p>', 1, 1537370860, 1537829666, 1),
(12, 'Chapitre 3 - Duis nec nisl nec erat sagittis semper', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Vestibulum non maximus nulla. Sed vulputate id diam fermentum vehicula. Nam posuere lorem ut augue ullamcorper, eu ultricies massa tincidunt. Integer mi enim, fermentum sed tempor nec, commodo vitae ipsum. Praesent tortor leo, ullamcorper et ex eget, feugiat iaculis felis. Quisque auctor est vitae nulla faucibus, luctus dictum quam interdum. Nulla suscipit velit at magna auctor eleifend. Integer imperdiet molestie turpis, ac mattis massa dictum aliquet. Cras lobortis dui sit amet tincidunt aliquam. Nullam aliquam turpis ac ex bibendum efficitur. Suspendisse malesuada ipsum a interdum accumsan. Vestibulum vitae massa in massa commodo fringilla. Etiam vitae ligula nisi. Aenean ut suscipit augue, sed pellentesque urna. Quisque ut ante laoreet, tincidunt dui at, bibendum magna.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nulla aliquet sagittis hendrerit. Nulla eu nisi consectetur, consequat dui non, molestie sapien. Donec scelerisque, purus non laoreet luctus, eros sem ullamcorper enim, et iaculis mauris orci sit amet dui. Donec lorem lacus, faucibus sit amet felis in, luctus posuere ex. Aenean lacinia posuere nisi dictum tristique. Mauris finibus bibendum nulla eu luctus. Nam eget lacus eget arcu rutrum pharetra in vitae tortor. Donec facilisis dolor dui, nec ultricies quam pulvinar at.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Duis nec nisl nec erat sagittis semper. Sed porta vestibulum nisi id auctor. Donec blandit sem eu sem faucibus, ac fermentum erat imperdiet. Ut tortor libero, semper in nulla eu, sodales luctus felis. Donec a commodo orci. Aenean suscipit quis eros ac cursus. Proin aliquet scelerisque orci ut feugiat. Curabitur porttitor ultricies mauris, id euismod quam mattis sollicitudin. Donec commodo dolor nec nulla porttitor, a pretium ligula elementum. Aenean quis porttitor magna. Duis id cursus quam. Ut feugiat, ipsum non porta posuere, dolor ex lobortis lacus, eget fermentum leo velit et ex. Vestibulum feugiat molestie enim, sed auctor nunc egestas quis. Nullam nec mi pharetra, condimentum nisi nec, rutrum massa. Fusce eu cursus massa, quis dapibus sem. Nunc eu viverra orci.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Aliquam semper, nisl in volutpat convallis, ex neque luctus ante, eget tristique sapien ex tempus erat. Curabitur eu congue justo. Proin condimentum tempor lacus id euismod. Suspendisse potenti. Nunc suscipit molestie consectetur. Sed eu mollis dolor, a mollis diam. Morbi ullamcorper faucibus justo, id lobortis erat rhoncus non. Morbi nisl eros, finibus in ultricies sed, vulputate id est.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc vestibulum tempor libero, at varius arcu dapibus ut. Vestibulum aliquam mi a metus mollis, at ultricies nulla consequat. Donec tempus est sit amet mi finibus sagittis. Etiam libero magna, aliquam eu dolor et, congue sollicitudin lectus. Mauris ultricies massa eu mauris lacinia maximus. In efficitur lorem in massa laoreet, in laoreet velit semper. Maecenas placerat leo a congue vulputate. Proin imperdiet fringilla erat eget elementum. Ut et finibus arcu. Sed semper tincidunt ornare. Mauris pellentesque tortor sem, euismod semper justo molestie a.</p>', 1, 1537370876, 1537829676, 1),
(14, 'Chapitre 4 - Donec at augue vel nisi mollis placerat', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Sed euismod et nunc ut porttitor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis eget augue turpis. Etiam rutrum consectetur massa, ac molestie nunc imperdiet id. Proin posuere sapien a sapien pretium aliquet nec ac ante. Nunc a augue rutrum, eleifend lorem vel, pretium enim. Pellentesque efficitur massa enim, id consectetur ipsum posuere id. Vivamus lobortis, tellus a vulputate sagittis, sapien metus hendrerit ante, a placerat sapien velit quis lectus. Nullam id posuere est. Proin non mollis tellus. Phasellus ornare massa in nulla egestas commodo. Mauris at consequat sapien, rhoncus mattis purus. Nam malesuada dui in aliquam tincidunt. Donec sed odio sed sapien varius accumsan eget non diam. Nulla commodo blandit lectus, at accumsan magna maximus eget.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Donec at augue vel nisi mollis placerat. Nulla mattis velit arcu, eget faucibus quam auctor nec. In hac habitasse platea dictumst. Cras vel erat quam. Etiam fermentum placerat tincidunt. Donec tincidunt sit amet dui et viverra. Donec justo ante, facilisis non commodo at, ullamcorper in orci. Pellentesque in pretium lectus. Aliquam pretium enim erat, vitae facilisis nibh accumsan in. Nulla quis fermentum urna, non porttitor eros. Ut iaculis tortor ac odio efficitur vulputate. Vivamus ligula neque, ullamcorper nec viverra quis, egestas quis ante.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Curabitur porttitor molestie dapibus. Nullam placerat mollis nisi, quis tincidunt leo semper eu. Morbi scelerisque congue magna in hendrerit. In hac habitasse platea dictumst. Nullam hendrerit facilisis mi quis bibendum. Integer non justo turpis. Praesent in dui sit amet orci tempor molestie. Mauris vulputate lacinia velit, sed hendrerit sapien. Aliquam blandit neque felis, non tincidunt metus maximus quis. Maecenas ac nisl eget neque luctus cursus. Duis et massa nisi.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi porta imperdiet leo nec posuere. Etiam nisi tellus, pulvinar non sem quis, vehicula pharetra tortor. Donec lectus enim, suscipit at placerat sed, viverra eget arcu. Integer et sem odio. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam non porta elit. Integer eu dapibus neque, vitae interdum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam sollicitudin ultricies tellus.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Phasellus ac dui in purus vehicula elementum. Curabitur eget ligula euismod, sodales enim et, blandit est. Duis quis urna lacinia sapien euismod commodo a in eros. Proin vehicula faucibus mollis. Nullam porta metus fringilla facilisis sagittis. Nulla aliquam, mauris aliquam fermentum tempus, tortor velit bibendum libero, ut pulvinar lacus ex vel magna. Duis feugiat erat a hendrerit aliquam. Suspendisse bibendum justo vel nisi dignissim, vel porta mi suscipit. Maecenas sit amet ante lobortis, lacinia nisl eget, imperdiet odio. Vivamus ullamcorper fermentum ex id venenatis. Vivamus vel blandit eros. Maecenas eget enim ipsum. Donec lobortis orci a enim mattis aliquam. Praesent sagittis bibendum iaculis.</p>', 1, 1537370907, 1537829684, 1),
(15, 'Chapitre 5 - Proin a metus erat', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nulla non lacus vitae metus finibus sagittis vitae a nisl. Aliquam diam quam, finibus sed lobortis sit amet, euismod at est. Morbi quis accumsan nulla. Suspendisse potenti. Integer dui turpis, efficitur vitae lectus in, efficitur eleifend tortor. Suspendisse id odio in dolor vestibulum ornare. Suspendisse aliquet mattis euismod.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Vestibulum id nisi ut risus sollicitudin volutpat. Phasellus elit turpis, egestas in congue a, suscipit vitae lorem. Pellentesque faucibus, nulla nec luctus laoreet, enim ante aliquam massa, in elementum enim dolor ut sem. Duis cursus leo nec lorem scelerisque malesuada. Suspendisse tincidunt arcu sit amet rhoncus tempor. Maecenas aliquam hendrerit congue. Sed faucibus velit vel nunc ullamcorper ultricies. Duis placerat congue diam, et accumsan nibh volutpat ac. Maecenas malesuada interdum maximus. Etiam consequat convallis ligula, id auctor mauris dapibus vitae.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Cras ut egestas nisi, non faucibus ex. Curabitur et nisl malesuada leo fermentum malesuada. Sed vel turpis id urna pellentesque faucibus vel sit amet turpis. Vestibulum ornare non felis vel mattis. Integer ut augue quis ex consectetur malesuada. Nullam vestibulum tempus quam sit amet fermentum. Nulla fermentum ultricies urna, at facilisis mauris pellentesque non. Quisque et nisi tincidunt, mattis lectus quis, elementum odio. Curabitur hendrerit elit lorem, sit amet interdum lorem elementum eget. Nunc cursus libero ac semper lobortis. Cras malesuada in nisl quis laoreet. Etiam maximus vulputate eros, ac sagittis lorem lacinia eu. Fusce quis justo eros. Pellentesque ut ligula porttitor, rhoncus mi sit amet, facilisis ligula.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Proin a metus erat. Etiam lobortis nunc non velit volutpat volutpat. Vivamus fermentum massa sit amet rhoncus vehicula. Suspendisse consectetur dolor ligula, quis venenatis enim varius non. Nam in risus vehicula, cursus ipsum vel, dapibus est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam dignissim orci quam, at posuere elit dignissim et. Nunc et lectus nec diam condimentum feugiat at et ligula. Nam pellentesque tortor sapien, vitae luctus sem tincidunt sit amet. Donec bibendum purus nec sodales ultricies. Morbi feugiat ullamcorper nunc. Nullam tortor metus, pulvinar at justo non, blandit tincidunt tellus. Vivamus ut porttitor turpis, eget ultrices felis. Cras eu nulla id enim imperdiet tempus. Aliquam ac tortor varius, varius nunc in, sollicitudin quam. Maecenas erat nisl, lacinia eget interdum quis, tempor vel mauris.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Mauris consectetur nibh at aliquam mollis. Duis aliquam odio eget purus sollicitudin ultrices. Phasellus ultricies, massa vitae rutrum euismod, lacus neque scelerisque ipsum, sagittis fringilla tellus erat vitae lacus. Vivamus iaculis, tellus sit amet faucibus malesuada, ex nisl ullamcorper velit, nec pellentesque tortor neque sit amet magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed sed nunc lectus. Etiam sem nisl, pretium ut sodales nec, volutpat vitae quam. Mauris et tempus augue. Ut congue fringilla nisi, eget mattis urna accumsan id. Donec a laoreet mauris, nec tempor sem. Aenean tincidunt eget nulla eget suscipit. Vestibulum ut libero in mi bibendum rhoncus. Donec consectetur nibh vitae ex fermentum, eget mattis purus luctus. Nunc interdum varius purus, sit amet elementum mauris congue nec. Suspendisse et urna et nibh congue faucibus. Etiam maximus tellus placerat, convallis magna et, blandit quam.</p>', 1, 1537370924, 1537829691, 1),
(16, 'Chapitre 6 - Etiam interdum rhoncus risu', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\"><em>Sed massa arcu, viverra eget elit nec, tempor pellentesque dolor. Phasellus quis interdum neque. Pellentesque ac blandit tortor. Donec efficitur efficitur magna, id molestie nunc laoreet at. Vestibulum at nibh ut ipsum vulputate mollis id lacinia odio. Aliquam sodales, sem et placerat mollis, ex nisi blandit enim, ac consectetur lectus dui eget lectus. Proin congue imperdiet pharetra. Ut arcu massa, ultrices eu fermentum at, finibus in diam. Ut pretium sit amet nisl a placerat. Nullam dignissim purus a sem rutrum tincidunt. Nunc non neque sollicitudin, semper enim non, venenatis urna. Vivamus faucibus ipsum in mauris mollis tincidunt. Suspendisse libero urna, accumsan non magna sed, posuere interdum ligula. Donec imperdiet laoreet erat id suscipit. Proin vel dapibus nunc.</em></p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\"><strong>Proin ultricies facilisis faucibus. Integer volutpat magna non velit auctor, et blandit tortor auctor. Etiam quis quam vel dolor iaculis rhoncus ac non elit. Mauris dignissim ligula vitae justo ornare hendrerit. Maecenas faucibus arcu sed ex finibus, vel suscipit mi porta. Duis malesuada nisi justo. Praesent cursus, eros eget rhoncus malesuada, quam velit ultrices ligula, ac suscipit lectus purus vitae erat. Vivamus at tincidunt justo. Sed placerat nisl consequat eros suscipit feugiat. Fusce tincidunt, velit vel aliquam gravida, neque lorem tempor augue, quis interdum tortor lacus ultricies risus. Pellentesque felis nisl, luctus sed massa ut, semper pharetra purus.</strong></p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; text-align: center;\">Etiam interdum rhoncus risus, quis viverra magna dapibus eget. Maecenas pellentesque mauris nibh, sit amet pretium sem viverra non. Proin porta risus quis arcu egestas rutrum. Nullam non odio sed erat fringilla pharetra nec efficitur diam. Suspendisse suscipit turpis sem. Praesent tempus, tellus in ultricies feugiat, diam sem convallis lectus, ac ultricies sapien eros nec libero. Maecenas viverra viverra felis, non finibus ante auctor vitae. Morbi a lorem turpis. Pellentesque volutpat ligula nec risus pellentesque pretium. Curabitur dolor libero, condimentum id commodo quis, facilisis ut ligula. Nulla cursus vitae mi sit amet rutrum.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; text-align: right;\">Pellentesque lobortis nunc diam, quis hendrerit arcu fermentum a. In sed nisi efficitur, semper quam sed, eleifend ex. Sed in quam nec libero scelerisque posuere. Nam luctus mauris eu metus pulvinar, eget sagittis eros ultrices. Duis tempus quam eu congue rhoncus. Sed facilisis egestas viverra. Nulla fringilla elit in auctor feugiat. Etiam ac placerat lacus. Praesent eget fermentum arcu. Maecenas aliquam dapibus mauris, et congue libero suscipit vel. Sed feugiat sem sed nisl tincidunt aliquam.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px 0px 0px 30px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nullam quis vehicula eros. Quisque quis lobortis purus, quis consequat mauris. Proin eu quam ac augue rhoncus congue. Proin pulvinar purus sit amet ex pellentesque viverra. Curabitur tempus purus in libero sollicitudin, et dignissim ligula consectetur. Pellentesque tempor orci non lectus condimentum vehicula. Morbi egestas arcu vitae lorem ultrices, ac suscipit sem vehicula. Proin eleifend consectetur enim at tincidunt. Morbi sed arcu eget metus efficitur mattis. Etiam at gravida libero, eu viverra velit. Donec ut diam et ex commodo aliquet. Proin porttitor, mi vitae imperdiet euismod, elit dolor feugiat lorem, vitae tempor orci est eget arcu. Vestibulum eu lacus maximus, mattis elit sed, pretium purus. Maecenas vitae justo lacus. Curabitur luctus odio felis.</p>', 1, 1537370940, 1537829710, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) COLLATE utf8_bin NOT NULL,
  `role` enum('admin','mod','user') COLLATE utf8_bin NOT NULL DEFAULT 'user',
  `password` varchar(256) COLLATE utf8_bin NOT NULL,
  `display_name` varchar(42) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `display_name` (`display_name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `role`, `password`, `display_name`) VALUES
(1, 'pisani.florian@gmail.com', 'admin', '$2y$10$jIqmZBDxVituo7Aqp0TzCObxjT0wQvlb8hle5ALK8bHi74qDW2n.C', 'Jean Forteroche'),
(13, 'stanof.pisanif@gmail.com', 'user', '$2y$10$.Dz5g33JeBwku3cvJId5XOOV7T9d7bOlx22e.3xsUyVGESmbpdLsu', 'Stanof');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comment_reports`
--
ALTER TABLE `comment_reports`
  ADD CONSTRAINT `comment_reports_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_reports_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
