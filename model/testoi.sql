-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 08 Novembre 2016 à 08:58
-- Version du serveur: 5.5.52-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.20

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `testoi`
--

-- --------------------------------------------------------

--
-- Structure de la table `arg`
--

CREATE TABLE IF NOT EXISTS `arg` (
  `arg_id` int(10) NOT NULL AUTO_INCREMENT,
  `debat_id` int(10) NOT NULL,
  `arg_lib_fr` varchar(1000) NOT NULL,
  `arg_rank` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`arg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Contenu de la table `arg`
--

INSERT INTO `arg` (`arg_id`, `debat_id`, `arg_lib_fr`, `arg_rank`) VALUES
(1, 3, 'Nous sommes carnivore, nous élevons et tuons des animaux pour vivre.', 16),
(2, 3, 'Le gavage est une pratique qui contraint l''animal à manger contre son gré, c''est une forme de torture.', 16),
(3, 4, 'La loi du talion :"œil pour œil, dent pour dent" est une pratique qui ajoute la souffrance à la souffrance', 16),
(4, 4, 'Un criminel en prison coûte de l''argent à la société', 16),
(5, 4, 'Un criminel en prison peut s’évader et recommencer ses délits', 16),
(6, 4, 'Les erreurs judiciaires sont nombreuses et ne permettent pas de décider de la mort de quelqu''un', 16),
(7, 4, 'Qui a le droit de décider de la vie ou de la mort d''une autre personne.', 16),
(8, 5, 'Le lib&eacute;ralisme abouti &agrave; la fusion successive des entreprises pour ne finir qu&#039;avec un unique acteur', 17),
(9, 5, 'Le marché se purge naturellement de ses entreprises faibles pour ne garder que les meilleures', 16),
(10, 5, 'Lorsque l''entreprise est au dessus des lois de l’état, l''argent est plus important que l''humain', 16),
(11, 5, 'Le libéralisme permet la spéculation sur les matières premières, sources d''immenses famines.', 16),
(12, 6, 'L''émotion n''existe pas dans le temps, ce n''est qu''un message éphémère, contrairement à une législation qui guide un peuple dans la durée', 16),
(16, 3, 'L''animal s’habitue au gavage et n''en souffre plus. ', 16),
(17, 9, 'La délocalisation permet d''augmenter le niveau de vie des pays les moins développés.', 16),
(18, 10, 'Un produit unique est plus facilement maintenable.', 16),
(19, 10, 'L''unicité du produit permet de capitaliser sur son usage et donc permet une utilisation plus facile', 16),
(20, 9, 'La délocalisation peut ruiner des régions entières et les plonger dans la pauvreté pendant plusieurs années.', 16),
(21, 6, 'L''avancée des lois est ralentie par les pouvoirs en place', 16),
(22, 6, 'La réflexion ne s''oppose pas à la réactivité', 16),
(23, 10, 'Un acteur dominant dans un secteur économique le déstabilise.', 16),
(44, 12, 'L&#039;agriculture peut nourrir 7 millards d&#039;&ecirc;tres humains, le probl&egrave;me est ailleurs. ', 16),
(45, 12, 'Les pays ayant une densit&eacute; de population faible leur donne des avantages &eacute;conomiques (mati&egrave;re premi&egrave;re, pollution)', 16);

-- --------------------------------------------------------

--
-- Structure de la table `debat`
--

CREATE TABLE IF NOT EXISTS `debat` (
  `debat_id` int(10) NOT NULL AUTO_INCREMENT,
  `debat_lib_fr` varchar(1000) NOT NULL,
  `debat_rank` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`debat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `debat`
--

INSERT INTO `debat` (`debat_id`, `debat_lib_fr`, `debat_rank`) VALUES
(3, 'Le gavage des oies est acceptable?', 16),
(4, 'Est ce que la peine de mort est une réaction positive?', 16),
(5, 'Le libéralisme est il constructif?', 22),
(6, 'Comment peut-on associer la législation avec la réalité de terrain de manière réactive, cohérente et soutenable?', 16),
(9, 'La délocalisation est-elle soutenable?', 16),
(10, 'L''unicité d''un produit comme l''iPhone ou le système Windows est-il un atout pour le consommateur?', 16),
(12, 'Sommes nous trop nombreux sur terre?', 23),
(14, 'La religion est-elle un vecteur de cohésion sociale?', 16);

-- --------------------------------------------------------

--
-- Structure de la table `justif`
--

CREATE TABLE IF NOT EXISTS `justif` (
  `justif_id` int(10) NOT NULL AUTO_INCREMENT,
  `justif_url` varchar(1000) NOT NULL,
  `justif_lib_fr` varchar(1000) NOT NULL,
  `justif_rank` int(10) NOT NULL DEFAULT '0',
  `arg_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`justif_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `justif`
--

INSERT INTO `justif` (`justif_id`, `justif_url`, `justif_lib_fr`, `justif_rank`, `arg_id`) VALUES
(1, 'url', 'justification fr', 0, 1),
(2, 'url', 'justification fr', 0, 2),
(3, 'url', 'justification fr', 0, 3),
(4, 'url', 'justification fr', 0, 4),
(5, 'url', 'justification fr', 0, 5),
(6, 'url', 'justification fr', 0, 6),
(7, 'url', 'justification fr', 0, 7),
(8, 'url', 'justification fr', 0, 8),
(9, 'url', 'justification fr', 0, 9),
(10, 'url', 'justification fr', 0, 10),
(11, 'url', 'justification fr', 0, 11),
(12, 'http://www.lemonde.fr/politique/article/2011/11/22/l-emotion-fait-la-loi-une-habitude-depuis-2002_1606906_823448.html', 'Un fait divers associé à une loi est une mécanique sans fin', 0, 12);

-- --------------------------------------------------------

--
-- Structure de la table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_lib` varchar(1000) NOT NULL,
  `log_ip` varchar(30) NOT NULL,
  PRIMARY KEY (`log_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `param`
--

CREATE TABLE IF NOT EXISTS `param` (
  `param_id` int(10) NOT NULL AUTO_INCREMENT,
  `param_lib` varchar(100) NOT NULL,
  `param_value` varchar(1000) NOT NULL,
  `param_statut` varchar(100) NOT NULL,
  PRIMARY KEY (`param_id`),
  UNIQUE KEY `param_lib` (`param_lib`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `param`
--

INSERT INTO `param` (`param_id`, `param_lib`, `param_value`, `param_statut`) VALUES
(1, 'prop_arg_rank_default', '10', ''),
(2, 'prop_arg_u_rank_default', '10', ''),
(3, 'prop_debat_rank_default', '10', ''),
(4, 'prop_arg_rank_validation', '15', ''),
(5, 'prop_debat_rank_validation', '15', ''),
(6, 'prop_arg_u_rank_validation', '15', ''),
(7, 'prop_arg_rank_delete', '0', ''),
(8, 'prop_arg_u_rank_delete', '0', ''),
(9, 'prop_debat_rank_delete', '0', '');

-- --------------------------------------------------------

--
-- Structure de la table `prop`
--

CREATE TABLE IF NOT EXISTS `prop` (
  `prop_id` int(10) NOT NULL AUTO_INCREMENT,
  `prop_link_id` int(10) DEFAULT NULL,
  `prop_lib_fr` varchar(1000) NOT NULL,
  `prop_type` varchar(10) NOT NULL,
  `prop_rank` int(10) NOT NULL DEFAULT '10',
  `prop_ip` varchar(30) NOT NULL,
  `prop_user_mail` int(10) NOT NULL,
  PRIMARY KEY (`prop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Contenu de la table `prop`
--

INSERT INTO `prop` (`prop_id`, `prop_link_id`, `prop_lib_fr`, `prop_type`, `prop_rank`, `prop_ip`, `prop_user_mail`) VALUES
(80, 0, 'Dans quelles mesures l&#039;immigration est positive?', 'debat', 12, '127.0.0.1', 0),
(81, 12, 'L&rsquo;&eacute;conomie nous pousse &agrave; vivre comme des am&eacute;ricains, il faudrait 6 plan&egrave;tes, pourquoi ne pas r&eacute;duire la natalit&eacute;?', 'arg', 11, '127.0.0.1', 0),
(82, 45, 'Les pays ayant une densit&eacute; de population faible leur donne des avantages &eacute;conomiques avec beaucoup de mati&egrave;re premi&egrave;re par habitant.', 'arg_u', 11, '127.0.0.1', 0),
(83, 0, 'Est ce que le fait de donner le choix aux gens de travailler ou non, permettrait d&#039;avoir assez d&#039;actifs?', 'debat', 11, '127.0.0.1', 0),
(84, 0, 'Si tout le monde &eacute;tait comme vous, qu&#039;est ce qui irait mieux?', 'debat', 10, '127.0.0.1', 0),
(85, 0, 'Est ce que les femmes aiment se maquiller, acheter des habits et mettre des talons?', 'debat', 10, '127.0.0.1', 0),
(86, 0, 'Sommes nous responsable de la plupart de nos propres probl&egrave;mes de sant&eacute;s', 'debat', 10, '127.0.0.1', 0),
(87, 0, 'Puis je cr&eacute;er un lien d&#039;amiti&eacute; avec certaines personnes sans faire d&#039;efforts?', 'debat', 10, '127.0.0.1', 0),
(88, 0, 'Est ce que ce qui est durable dure longtemps?', 'debat', 10, '127.0.0.1', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_mail` varchar(30) NOT NULL,
  `user_pasw` varchar(100) NOT NULL,
  `user_actif` int(1) NOT NULL DEFAULT '0',
  `user_rank` int(10) NOT NULL DEFAULT '1',
  `created_at` date NOT NULL,
  UNIQUE KEY `user_mail` (`user_mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Structure de la table `user_histo`
--

CREATE TABLE IF NOT EXISTS `user_histo` (
  `user_mail` varchar(30) NOT NULL,
  `user_histo_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `debat_id` int(11) NOT NULL,
  `arg_id` int(10) NOT NULL,
  `user_histo_action` varchar(100) NOT NULL,
  `user_ip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
