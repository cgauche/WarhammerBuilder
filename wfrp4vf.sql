-- CREATION DE LA BASE DE DONNEES
DROP DATABASE IF EXISTS `wfrp4vf`;
CREATE DATABASE IF NOT EXISTS `wfrp4vf`
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin; 
USE `wfrp4vf`;

-- CREATION DES TABLES
CREATE TABLE `Animals_vehicles` (
  `ID`  INT NOT NULL,
  `Name` VARCHAR(20),
  `Price` VARCHAR(10),
  `Clutter` INT NOT NULL DEFAULT 0 COMMENT 'Encombrement',
  `Contents` INT,
  `Availability` VARCHAR(10),
  `ID_Source` INT
);
CREATE TABLE `Armoury` (
  `ID`  INT NOT NULL,
  `Type` VARCHAR(10) COMMENT 'Arme, Armure',
  `Group` VARCHAR(20) COMMENT 'à distance, cuir...',
  `Name` VARCHAR(20),
  `Price` VARCHAR(10),
  `Clutter` INT NOT NULL DEFAULT 0 COMMENT 'Encombrement',
  `Availability` VARCHAR(10),
  `Range` VARCHAR(10),
  `Damage` VARCHAR(10),
  `Advantage_flaw` VARCHAR(10),
  `Penalty` VARCHAR(10),
  `Location` VARCHAR(10),
  `PA` VARCHAR(10),
  `Description` VARCHAR(10),
  `ID_Source` INT NOT NULL
);
CREATE TABLE `Bags_Containers` (
  `ID`  INT NOT NULL,
  `Name` VARCHAR(20),
  `Price` VARCHAR(10),
  `Clutter` INT NOT NULL DEFAULT 0 COMMENT 'Encombrement',
  `Contents` INT,
  `Availability` VARCHAR(10),
  `ID_Source` INT
);
CREATE TABLE `Caracteristics` (
  `ID`  INT NOT NULL,
  `Name` VARCHAR(10),
  `Abridged` VARCHAR(4),
  `Description` VARCHAR(1000),
  `Value` INT
);
CREATE TABLE `Careers` (
  `ID`  INT NOT NULL,
  `Name` VARCHAR(20) NOT NULL,
  `Description` VARCHAR(1000),
  `ID_Class` INT,
  `ID_Source` INT
);
CREATE TABLE `Characters` (
  `ID`  INT NOT NULL,
  `Name` VARCHAR(50),
  `Description` VARCHAR(2500),
  `Fate` INT,
  `Luck` INT,
  `Resilience` INT,
  `Determination` INT,
  `ID_Species` INT NOT NULL,
  `ID_Career` INT
);
CREATE TABLE `Char_Caracteristics` (
  `ID`  INT NOT NULL,
  `Init_val` INT NOT NULL,
  `Inc_val` INT NOT NULL DEFAULT 0,
  `Talent` INT NOT NULL DEFAULT 0,
  `ID_Char` INT NOT NULL,
  `ID_Caracteristics` INT NOT NULL
);
CREATE TABLE `Char_Spells` (
  `ID`  INT NOT NULL,
  `ID_Char` INT NOT NULL,
  `ID_Spell` INT NOT NULL
);
CREATE TABLE `Char_Trapping` (
  `ID`  INT NOT NULL,
  `ID_Char` INT NOT NULL,
  `Description` VARCHAR(1000) DEFAULT NULL,
  `ID_Armoury` INT NULL,
  `ID_Bags_containers` INT NULL,
  `ID_Animals_vehicles` INT NULL,
  `ID_Trapping` INT NULL,
  `Quantity` INT NULL
);
CREATE TABLE `Classes` (
  `ID`  INT NOT NULL,
  `Name` VARCHAR(20) NOT NULL,
  `Description` VARCHAR(1000)
);
CREATE TABLE `Events` (
  `ID` INT NOT NULL,
  `Name` VARCHAR(20) NOT NULL,
  `Description` VARCHAR(1000) NOT NULL,
  `ID_Char` INT NOT NULL
);
CREATE TABLE `Ranks` (
  `ID`  INT NOT NULL,
  `Name` VARCHAR(20) NOT NULL,
  `Description` VARCHAR(1000),
  `ID_Career` INT
);
CREATE TABLE `Skills` (
  `ID`  INT NOT NULL,
  `Name` VARCHAR(20),
  `Type` VARCHAR(20) COMMENT 'Base ou Avancée',
  `Description` VARCHAR(1000),
  `Specs` BOOLEAN NOT NULL DEFAULT 0,
  `ID_Caracteristics` INT,
  `ID_Source` INT
);
CREATE TABLE `SkillSpecs` (
  `ID`  INT NOT NULL,
  `Name` VARCHAR(20),
  `Description` VARCHAR(1000),
  `ID_Skill` INT
);
CREATE TABLE `Source` (
  `ID`  INT NOT NULL,
  `Name` VARCHAR(20),
  `Year` INT,
  `ISBN` BIGINT
);
CREATE TABLE `Species` (
  `ID`  INT NOT NULL,
  `Name` VARCHAR(20),
  `Rollmin` INT NOT NULL DEFAULT 101,
  `Rollmax` INT NOT NULL DEFAULT 101,
  `Description` VARCHAR(2500),
  `Randomtalents` INT,
  `Age` INT,
  `Rollage` INT,
  `Height` INT,
  `Rollheight` INT,
  `Fate` INT,
  `Resilience` INT,
  `FR_spend` INT DEFAULT 0,
  `ID_Source` INT
);
CREATE TABLE `Spec_Careers` (
  `ID`  INT NOT NULL,
  `ID_Species` INT NOT NULL,
  `ID_Career` INT NOT NULL
);
CREATE TABLE `Spells` (
  `ID` INT,
  `Name` VARCHAR(20) NOT NULL,
  `Type` VARCHAR(20) COMMENT 'Bénédiction, Miracle, Sortilège',
  `NI` INT DEFAULT 0,
  `Range` VARCHAR(10),
  `Target` VARCHAR(10),
  `Length` VARCHAR(10),
  `Damage` VARCHAR(10),
  `Description` VARCHAR(10),
  `ID_Spell_type` INT,
  `ID_Source` INT
);
CREATE TABLE `Spell_type` (
  `ID`  INT NOT NULL,
  `Type` VARCHAR(20),
  `Name` VARCHAR(20),
  `Real_name` VARCHAR(20),
  `Color` VARCHAR(20),
  `Description` VARCHAR(1000)
);
CREATE TABLE `Talents` (
  `ID`  INT NOT NULL,
  `Name` VARCHAR(20),
  `Description` VARCHAR(1000),
  `ID_Skill` INT,
  `ID_Caracteristics` INT,
  `ID_Source` INT
);
CREATE TABLE `Trapping` (
  `ID`  INT NOT NULL,
  `Type` VARCHAR(20) COMMENT 'Catégorie',
  `Name` VARCHAR(20),
  `Price` VARCHAR(10),
  `Clutter` INT NOT NULL DEFAULT 0 COMMENT 'Encombrement',
  `Availability` VARCHAR(10),
  `ID_Source` INT
);
CREATE TABLE `XP` (
  `ID`  INT NOT NULL,
  `Actual` INT NOT NULL DEFAULT 0,
  `Spent` INT NOT NULL DEFAULT 0,
  `Total` INT NOT NULL DEFAULT 0,
  `ID_char` INT NOT NULL
);

-- CREATION DES PRIMARY KEY, 22 TABLES
ALTER TABLE `Animals_vehicles` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Armoury` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Bags_Containers` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Caracteristics` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Careers` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Characters` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Char_Caracteristics` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Char_Spells` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Char_Trapping` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Classes` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Events` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Ranks` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Skills` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `SkillSpecs` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Source` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Species` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Spec_Careers` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Spells` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Spell_type` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Talents` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `Trapping` ADD PRIMARY KEY( `ID`); 
ALTER TABLE `XP` ADD PRIMARY KEY( `ID`); 

-- CREATION DES CLEFS ETRANGERES // 8 ID_Source
ALTER TABLE `Animals_vehicles` ADD CONSTRAINT `FK_AV_SOURCE` FOREIGN KEY (`ID_Source`) REFERENCES Source (`ID`);
ALTER TABLE `Bags_Containers` ADD CONSTRAINT `FK_BC_SOURCE` FOREIGN KEY (`ID_Source`) REFERENCES Source (`ID`); 
ALTER TABLE `Careers` ADD CONSTRAINT `FK_CAREER_SOURCE` FOREIGN KEY (`ID_Source`) REFERENCES Source (`ID`); 
ALTER TABLE `Characters` ADD CONSTRAINT `FK_CHAR_CAREER` FOREIGN KEY (`ID_Career`) REFERENCES Careers (`ID`);
ALTER TABLE `Characters` ADD CONSTRAINT `FK_CHAR_SPECIE` FOREIGN KEY (`ID_Species`) REFERENCES Species (`ID`);
ALTER TABLE `Char_Caracteristics` ADD CONSTRAINT `FK_CARAC_CHAR` FOREIGN KEY (`ID_Char`) REFERENCES Characters (`ID`);
ALTER TABLE `Char_Caracteristics` ADD CONSTRAINT `FK_CARAC_CARAC` FOREIGN KEY (`ID_Caracteristics`) REFERENCES Caracteristics (`ID`);
ALTER TABLE `Char_Spells` ADD CONSTRAINT `FK_CHAR_SPELL` FOREIGN KEY (`ID_Spell`) REFERENCES Spells (`ID`);
ALTER TABLE `Char_Spells` ADD CONSTRAINT `FK_CHAR_CHAR` FOREIGN KEY (`ID_Char`) REFERENCES Characters (`ID`);
ALTER TABLE `Char_Trapping` ADD CONSTRAINT `FK_TRAP_CHAR` FOREIGN KEY (`ID_Char`) REFERENCES Characters (`ID`);
ALTER TABLE `Char_Trapping` ADD CONSTRAINT `FK_TRAP_ARM` FOREIGN KEY (`ID_Armoury`) REFERENCES Armoury (`ID`);
ALTER TABLE `Char_Trapping` ADD CONSTRAINT `FK_TRAP_BAGS` FOREIGN KEY (`ID_Bags_containers`) REFERENCES Bags_Containers (`ID`);
ALTER TABLE `Char_Trapping` ADD CONSTRAINT `FK_TRAP_AV` FOREIGN KEY (`ID_Animals_vehicles`) REFERENCES Animals_vehicles (`ID`);
ALTER TABLE `Char_Trapping` ADD CONSTRAINT `FK_TRAP_TRAP` FOREIGN KEY (`ID_Trapping`) REFERENCES Trapping (`ID`);
ALTER TABLE `Events` ADD CONSTRAINT `FK_EVE_CHAR` FOREIGN KEY (`ID_Char`) REFERENCES Characters (`ID`);
ALTER TABLE `Ranks` ADD CONSTRAINT `FK_RANK_CAREER` FOREIGN KEY (`ID_Career`) REFERENCES Caracteristics (`ID`);
ALTER TABLE `Skills` ADD CONSTRAINT `FK_SKILL_CARAC` FOREIGN KEY (`ID_Caracteristics`) REFERENCES Caracteristics (`ID`);
ALTER TABLE `Skills` ADD CONSTRAINT `FK_SKILL_SOURCE` FOREIGN KEY (`ID_Source`) REFERENCES Source (`ID`);
ALTER TABLE `SkillSpecs` ADD CONSTRAINT `FK_SSpec_SKILL` FOREIGN KEY (`ID_Skill`) REFERENCES Skills (`ID`);
ALTER TABLE `Species` ADD CONSTRAINT `FK_Specie_SOURCE` FOREIGN KEY (`ID_Source`) REFERENCES Source (`ID`);
ALTER TABLE `Spec_Careers` ADD CONSTRAINT `FK_SCAREER_SPECIE` FOREIGN KEY (`ID_Species`) REFERENCES Species (`ID`);
ALTER TABLE `Spec_Careers` ADD CONSTRAINT `FK_SCAREER_CAREER` FOREIGN KEY (`ID_Career`) REFERENCES Careers (`ID`);
ALTER TABLE `Spells` ADD CONSTRAINT `FK_SPELL_TYPE` FOREIGN KEY (`ID_Spell_type`) REFERENCES Spell_type (`ID`);
ALTER TABLE `Spells` ADD CONSTRAINT `FK_SPELL_SOURCE` FOREIGN KEY (`ID_Source`) REFERENCES Source (`ID`);
ALTER TABLE `Talents` ADD CONSTRAINT `FK_TALENT_SOURCE` FOREIGN KEY (`ID_Source`) REFERENCES Source (`ID`);
ALTER TABLE `Talents` ADD CONSTRAINT `FK_TALENT_SKILL` FOREIGN KEY (`ID_Skill`) REFERENCES Skills (`ID`);
ALTER TABLE `Talents` ADD CONSTRAINT `FK_TALENT_CARAC` FOREIGN KEY (`ID_Caracteristics`) REFERENCES Caracteristics (`ID`);
ALTER TABLE `Trapping` ADD CONSTRAINT `FK_TRAP_SOURCE` FOREIGN KEY (`ID_Source`) REFERENCES Source (`ID`);
ALTER TABLE `XP` ADD CONSTRAINT `FK_XP_CHAR` FOREIGN KEY (`ID_Char`) REFERENCES Characters (`ID`);