-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 05:18 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbgestoutdoorxpto`
--
CREATE DATABASE IF NOT EXISTS `dbgestoutdoorxpto` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dbgestoutdoorxpto`;

-- --------------------------------------------------------

--
-- Table structure for table `tbadministrador`
--

CREATE TABLE `tbadministrador` (
  `codadmin` int(11) NOT NULL,
  `nomecompleto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbadministrador`
--

INSERT INTO `tbadministrador` (`codadmin`, `nomecompleto`) VALUES
(16, 'Rui Malemba');

-- --------------------------------------------------------

--
-- Table structure for table `tbcliente`
--

CREATE TABLE `tbcliente` (
  `coduser` int(11) NOT NULL,
  `nomecompleto` varchar(50) NOT NULL,
  `tipodecliente` enum('Particular','Empresa') NOT NULL,
  `actividadedaempresa` varchar(50) DEFAULT NULL,
  `fknacionalidade` int(11) NOT NULL,
  `estado` enum('activado','desativado') NOT NULL,
  `fkadmin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbcliente`
--

INSERT INTO `tbcliente` (`coduser`, `nomecompleto`, `tipodecliente`, `actividadedaempresa`, `fknacionalidade`, `estado`, `fkadmin`) VALUES
(23, 'José Domingos', 'Empresa', 'Tecnologias sem fio', 1, 'activado', 16),
(26, 'Júlia Camana', 'Particular', 'Nenhum', 1, 'activado', 16),
(46, 'Kuenda Mayeye', 'Particular', 'nenhuma', 1, 'desativado', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbcomuna`
--

CREATE TABLE `tbcomuna` (
  `codcomuna` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `fkmunicipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbcomuna`
--

INSERT INTO `tbcomuna` (`codcomuna`, `nome`, `fkmunicipio`) VALUES
(1, 'Quicombo', 19),
(2, 'Gungo', 19),
(10, 'Maianga', 31),
(11, 'Ingombota', 31),
(12, 'Camama', 58),
(13, 'Benfica', 58);

-- --------------------------------------------------------

--
-- Table structure for table `tbgestor`
--

CREATE TABLE `tbgestor` (
  `coduser` int(11) NOT NULL,
  `nomecompleto` varchar(50) NOT NULL,
  `fkadmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbgestor`
--

INSERT INTO `tbgestor` (`coduser`, `nomecompleto`, `fkadmin`) VALUES
(37, 'Yuri Lucas', 16),
(49, 'eehhh', 16);

-- --------------------------------------------------------

--
-- Table structure for table `tbmunicipio`
--

CREATE TABLE `tbmunicipio` (
  `codmunicipio` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `fkprovincia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbmunicipio`
--

INSERT INTO `tbmunicipio` (`codmunicipio`, `nome`, `fkprovincia`) VALUES
(1, 'Caxito', 1),
(2, 'Ambriz', 1),
(3, 'Nambuangongo', 1),
(4, 'Benguela', 2),
(5, 'Lobito', 2),
(6, 'Cubal', 2),
(7, 'Kuito', 3),
(8, 'Cunhinga', 3),
(9, 'Camacupa', 3),
(10, 'Cabinda', 4),
(11, 'Buco-Zau', 4),
(12, 'Landana', 4),
(13, 'Menongue', 5),
(14, 'Cuchi', 5),
(15, 'Cuito Cuanavale', 5),
(16, 'Ndalatando', 6),
(17, 'Golungo Alto', 6),
(18, 'Ambaca', 6),
(19, 'Sumbe', 7),
(20, 'Porto Amboim', 7),
(21, 'Quibala', 7),
(22, 'Ondjiva', 8),
(23, 'Cahama', 8),
(24, 'Namacunde', 8),
(25, 'Huambo', 9),
(26, 'Caála', 9),
(27, 'Londuimbali', 9),
(28, 'Lubango', 10),
(29, 'Humpata', 10),
(30, 'Quilengues', 10),
(31, 'Luanda', 11),
(32, 'Belas', 11),
(33, 'Viana', 11),
(34, 'Dundo', 12),
(35, 'Chitato', 12),
(36, 'Cambulo', 12),
(37, 'Saurimo', 13),
(38, 'Cacolo', 13),
(39, 'Dala', 13),
(40, 'Malanje', 14),
(41, 'Cacuso', 14),
(42, 'Calandula', 14),
(55, 'Mbanza Congo', 18),
(56, 'Soyo', 18),
(57, 'Nzeto', 18),
(58, 'Talatona', 11),
(59, 'Cacuaco', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbnacionalidade`
--

CREATE TABLE `tbnacionalidade` (
  `codnacionalidade` int(11) NOT NULL,
  `nacionalidade` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbnacionalidade`
--

INSERT INTO `tbnacionalidade` (`codnacionalidade`, `nacionalidade`) VALUES
(9, 'Albânia'),
(10, 'Alemanha'),
(11, 'Andorra'),
(1, 'Angola'),
(12, 'Armênia'),
(13, 'Áustria'),
(14, 'Azerbaijão'),
(15, 'Bélgica'),
(16, 'Bielorrússia'),
(17, 'Bósnia e Herzegovina'),
(2, 'Brasil'),
(18, 'Bulgária'),
(3, 'Cabo Verde'),
(20, 'Chipre'),
(19, 'Croácia'),
(21, 'Dinamarca'),
(22, 'Eslováquia'),
(23, 'Eslovênia'),
(24, 'Espanha'),
(25, 'Estônia'),
(26, 'Finlândia'),
(27, 'França'),
(28, 'Geórgia'),
(29, 'Grécia'),
(4, 'Guiné-Bissau'),
(30, 'Hungria'),
(31, 'Irlanda'),
(32, 'Islândia'),
(33, 'Itália'),
(34, 'Letônia'),
(35, 'Liechtenstein'),
(36, 'Lituânia'),
(37, 'Luxemburgo'),
(38, 'Malta'),
(5, 'Moçambique'),
(39, 'Moldávia'),
(40, 'Mônaco'),
(41, 'Montenegro'),
(42, 'Noruega'),
(43, 'Países Baixos'),
(44, 'Polônia'),
(6, 'Portugal'),
(45, 'Reino Unido'),
(46, 'República Tcheca'),
(47, 'Romênia'),
(48, 'Rússia'),
(49, 'San Marino'),
(7, 'São Tomé e Príncipe'),
(50, 'Sérvia'),
(51, 'Suécia'),
(52, 'Suíça'),
(8, 'Timor-Leste'),
(53, 'Turquia'),
(54, 'Ucrânia'),
(55, 'Vaticano');

-- --------------------------------------------------------

--
-- Table structure for table `tboutdoor`
--

CREATE TABLE `tboutdoor` (
  `codoutdoor` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `preco` decimal(10,0) NOT NULL,
  `fkgestor` int(11) NOT NULL,
  `fkcomuna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbprovincia`
--

CREATE TABLE `tbprovincia` (
  `codprovincia` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbprovincia`
--

INSERT INTO `tbprovincia` (`codprovincia`, `nome`) VALUES
(1, 'Bengo'),
(2, 'Benguela'),
(3, 'Bié'),
(4, 'Cabinda'),
(5, 'Cuando Cubango'),
(6, 'Cuanza Norte'),
(7, 'Cuanza Sul'),
(8, 'Cunene'),
(9, 'Huambo'),
(10, 'Huíla'),
(11, 'Luanda'),
(12, 'Lunda Norte'),
(13, 'Lunda Sul'),
(14, 'Malanje'),
(15, 'Moxico'),
(16, 'Namibe'),
(17, 'Uíge'),
(18, 'Zaire');

-- --------------------------------------------------------

--
-- Table structure for table `tbsolicitacaaluguer`
--

CREATE TABLE `tbsolicitacaaluguer` (
  `fkcliente` int(11) NOT NULL,
  `fkoutdoor` int(11) NOT NULL,
  `comprovativopagamento` varchar(50) DEFAULT NULL,
  `datainicio` date NOT NULL,
  `datafim` date NOT NULL,
  `imagemoutdoor` varchar(50) DEFAULT NULL,
  `estado` enum('aprovado','reprovado','aguardaresposta') DEFAULT NULL,
  `fkgestor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `coduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_` varchar(50) NOT NULL,
  `telemovel` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fkcomuna` int(11) NOT NULL,
  `morada` varchar(50) NOT NULL,
  `fotografia` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`coduser`, `username`, `password_`, `telemovel`, `email`, `fkcomuna`, `morada`, `fotografia`) VALUES
(16, 'ruimalemba', '1234', '99999999', 'yuriafricano03@gmail.com', 2, 'Fubú', '../content/images/profilephoto/admin.jpg'),
(23, 'josendonge', '1111', '928383893', 'ruiyurmi1103@gmail.com', 12, 'Talatona-Danjareux', '../content/images/profilephoto/josendonge.jpg'),
(26, 'juliacamana', 'camana', '948928452', 'juliacamana@gmail.com', 1, 'Júlia Camana', '../content/images/profilephoto/juliacamana.jpg'),
(37, 'yurilucas', '9999', '94472176688', 'ruiyurki1103@gmail.com', 1, 'Gamek - Payol', '../content/images/profilephoto/yurilucas.jpg'),
(46, 'kuendamayeye', '9090', '999999999', 'ruiyurjj2@gmail.com', 12, 'Golf 2', '../content/images/profilephoto/fotoAnonimo.jpg'),
(49, 'ruinfjjf', '1234', '999990000', 'xptosoluctionslda@gmail.com', 12, 'gggg', '../content/images/profilephoto/fotoAnonimo.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbadministrador`
--
ALTER TABLE `tbadministrador`
  ADD PRIMARY KEY (`codadmin`);

--
-- Indexes for table `tbcliente`
--
ALTER TABLE `tbcliente`
  ADD PRIMARY KEY (`coduser`),
  ADD KEY `admin2_fk` (`fkadmin`),
  ADD KEY `fk_nacionalidade` (`fknacionalidade`);

--
-- Indexes for table `tbcomuna`
--
ALTER TABLE `tbcomuna`
  ADD PRIMARY KEY (`codcomuna`),
  ADD UNIQUE KEY `uk_comuna` (`nome`),
  ADD KEY `fk_municipio` (`fkmunicipio`);

--
-- Indexes for table `tbgestor`
--
ALTER TABLE `tbgestor`
  ADD PRIMARY KEY (`coduser`),
  ADD KEY `admin_fk` (`fkadmin`);

--
-- Indexes for table `tbmunicipio`
--
ALTER TABLE `tbmunicipio`
  ADD PRIMARY KEY (`codmunicipio`),
  ADD UNIQUE KEY `uk_municipio` (`nome`),
  ADD KEY `fk_provincia` (`fkprovincia`);

--
-- Indexes for table `tbnacionalidade`
--
ALTER TABLE `tbnacionalidade`
  ADD PRIMARY KEY (`codnacionalidade`),
  ADD UNIQUE KEY `nacionalidade` (`nacionalidade`);

--
-- Indexes for table `tboutdoor`
--
ALTER TABLE `tboutdoor`
  ADD PRIMARY KEY (`codoutdoor`),
  ADD UNIQUE KEY `uk_tipo` (`tipo`),
  ADD KEY `fk_gestor` (`fkgestor`),
  ADD KEY `fk_comuna` (`fkcomuna`);

--
-- Indexes for table `tbprovincia`
--
ALTER TABLE `tbprovincia`
  ADD PRIMARY KEY (`codprovincia`),
  ADD UNIQUE KEY `uk_provinvia` (`nome`);

--
-- Indexes for table `tbsolicitacaaluguer`
--
ALTER TABLE `tbsolicitacaaluguer`
  ADD PRIMARY KEY (`fkcliente`,`fkoutdoor`),
  ADD KEY `fk2_gestor` (`fkgestor`),
  ADD KEY `fk_outdoor` (`fkoutdoor`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`coduser`),
  ADD UNIQUE KEY `uk_username` (`username`),
  ADD UNIQUE KEY `uk_telemovel` (`telemovel`),
  ADD UNIQUE KEY `uk_email` (`email`),
  ADD KEY `fk2_comuna` (`fkcomuna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbadministrador`
--
ALTER TABLE `tbadministrador`
  MODIFY `codadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbcomuna`
--
ALTER TABLE `tbcomuna`
  MODIFY `codcomuna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbmunicipio`
--
ALTER TABLE `tbmunicipio`
  MODIFY `codmunicipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `tbnacionalidade`
--
ALTER TABLE `tbnacionalidade`
  MODIFY `codnacionalidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `tboutdoor`
--
ALTER TABLE `tboutdoor`
  MODIFY `codoutdoor` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbprovincia`
--
ALTER TABLE `tbprovincia`
  MODIFY `codprovincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `coduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbadministrador`
--
ALTER TABLE `tbadministrador`
  ADD CONSTRAINT `USER3_FK` FOREIGN KEY (`codadmin`) REFERENCES `tbuser` (`coduser`);

--
-- Constraints for table `tbcliente`
--
ALTER TABLE `tbcliente`
  ADD CONSTRAINT `admin2_fk` FOREIGN KEY (`fkadmin`) REFERENCES `tbadministrador` (`codadmin`),
  ADD CONSTRAINT `fk2_user` FOREIGN KEY (`coduser`) REFERENCES `tbuser` (`coduser`),
  ADD CONSTRAINT `fk_nacionalidade` FOREIGN KEY (`fknacionalidade`) REFERENCES `tbnacionalidade` (`codnacionalidade`);

--
-- Constraints for table `tbcomuna`
--
ALTER TABLE `tbcomuna`
  ADD CONSTRAINT `fk_municipio` FOREIGN KEY (`fkmunicipio`) REFERENCES `tbmunicipio` (`codmunicipio`);

--
-- Constraints for table `tbgestor`
--
ALTER TABLE `tbgestor`
  ADD CONSTRAINT `admin_fk` FOREIGN KEY (`fkadmin`) REFERENCES `tbadministrador` (`codadmin`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`coduser`) REFERENCES `tbuser` (`coduser`);

--
-- Constraints for table `tbmunicipio`
--
ALTER TABLE `tbmunicipio`
  ADD CONSTRAINT `fk_provincia` FOREIGN KEY (`fkprovincia`) REFERENCES `tbprovincia` (`codprovincia`);

--
-- Constraints for table `tboutdoor`
--
ALTER TABLE `tboutdoor`
  ADD CONSTRAINT `fk_comuna` FOREIGN KEY (`fkcomuna`) REFERENCES `tbcomuna` (`codcomuna`),
  ADD CONSTRAINT `fk_gestor` FOREIGN KEY (`fkgestor`) REFERENCES `tbgestor` (`coduser`);

--
-- Constraints for table `tbsolicitacaaluguer`
--
ALTER TABLE `tbsolicitacaaluguer`
  ADD CONSTRAINT `fk2_gestor` FOREIGN KEY (`fkgestor`) REFERENCES `tbgestor` (`coduser`),
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`fkcliente`) REFERENCES `tbcliente` (`coduser`),
  ADD CONSTRAINT `fk_outdoor` FOREIGN KEY (`fkoutdoor`) REFERENCES `tboutdoor` (`codoutdoor`);

--
-- Constraints for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD CONSTRAINT `fk2_comuna` FOREIGN KEY (`fkcomuna`) REFERENCES `tbcomuna` (`codcomuna`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
