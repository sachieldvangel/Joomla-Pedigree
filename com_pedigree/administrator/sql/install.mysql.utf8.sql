CREATE TABLE IF NOT EXISTS `#__pedigree_audits` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`user_id` INT(11)  NOT NULL ,
`user_ip` VARCHAR(15)  NOT NULL ,
`operation_type` ENUM('Insert','Update','Deleted','Unknown')  NOT NULL ,
`operation_table` VARCHAR(255)  NOT NULL ,
`operation_field` VARCHAR(255)  NOT NULL ,
`operation_id` INT(11)  NOT NULL ,
`operation_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
`operation_olddata` VARCHAR(1024)  NOT NULL ,
`operation_newdata` VARCHAR(1024)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__pedigree_breeders` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`id_person` INT NOT NULL ,
`id_dog` INT NOT NULL ,
`is_primary` VARCHAR(255)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__pedigree_colors` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`color` VARCHAR(255)  NOT NULL ,
`description` VARCHAR(255)  NOT NULL ,
`image` VARCHAR(255)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__pedigree_countries` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`short_name` VARCHAR(255)  NOT NULL ,
`long_name` VARCHAR(255)  NOT NULL ,
`iso2` CHAR(2)  NOT NULL ,
`iso3` CHAR(3)  NOT NULL ,
`numcode` VARCHAR(255)  NOT NULL ,
`un_member` VARCHAR(255)  NOT NULL ,
`calling_code` VARCHAR(255)  NOT NULL ,
`cctld` VARCHAR(255)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__pedigree_dogs` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`name` VARCHAR(255)  NOT NULL ,
`id_sire` INT NOT NULL ,
`id_dam` INT NOT NULL ,
`sex` VARCHAR(1)  NOT NULL ,
`birth_date` VARCHAR(10)  NOT NULL ,
`call_name` VARCHAR(50)  NOT NULL ,
`id_gallery_image` VARCHAR(255)  NOT NULL ,
`id_gallery_category` VARCHAR(255)  NOT NULL ,
`coi` VARCHAR(255)  NOT NULL ,
`stud_number` VARCHAR(100)  NOT NULL ,
`brs_number` VARCHAR(20)  NOT NULL ,
`atc_number` VARCHAR(50)  NOT NULL ,
`id_color` INT NOT NULL ,
`color_variations` VARCHAR(100)  NOT NULL ,
`id_pattern` INT NOT NULL ,
`is_scented` VARCHAR(255)  NOT NULL ,
`is_smooth` VARCHAR(255)  NOT NULL ,
`is_bearded` VARCHAR(255)  NOT NULL ,
`titles_prefix` VARCHAR(255)  NOT NULL ,
`titles_suffix` VARCHAR(255)  NOT NULL ,
`awards` TEXT NOT NULL ,
`microchip` VARCHAR(255)  NOT NULL ,
`dna_profile` VARCHAR(100)  NOT NULL ,
`chic_number` VARCHAR(10)  NOT NULL ,
`health_test_thyroid` VARCHAR(255)  NOT NULL ,
`health_test_elbow` VARCHAR(255)  NOT NULL ,
`health_test_hips` VARCHAR(255)  NOT NULL ,
`health_test_eyes` VARCHAR(255)  NOT NULL ,
`health_test_heart` VARCHAR(255)  NOT NULL ,
`health_notes` VARCHAR(255)  NOT NULL ,
`death_date` VARCHAR(10)  NOT NULL ,
`death_cause` VARCHAR(255)  NOT NULL ,
`is_stud` VARCHAR(255)  NOT NULL ,
`stud_details` VARCHAR(255)  NOT NULL ,
`is_semen` VARCHAR(255)  NOT NULL ,
`videos` VARCHAR(255)  NOT NULL ,
`articles` VARCHAR(255)  NOT NULL ,
`notes` TEXT NOT NULL ,
`source` VARCHAR(255)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__pedigree_dogs_delegation` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`id_dog` INT NOT NULL ,
`id_user` INT(11)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__pedigree_judging` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`id_person` INT NOT NULL ,
`id_country` INT NOT NULL ,
`date` DATE NOT NULL ,
`notes` TEXT NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__pedigree_owners` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`id_person` INT NOT NULL ,
`id_dog` INT NOT NULL ,
`is_primary` TINYINT(1)  NOT NULL ,
`date_start` DATE NOT NULL ,
`date_end` DATE NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__pedigree_patterns` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`pattern` VARCHAR(20)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__pedigree_people` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`first_name` VARCHAR(100)  NOT NULL ,
`last_name` VARCHAR(100)  NOT NULL ,
`address1` VARCHAR(255)  NOT NULL ,
`address2` VARCHAR(50)  NOT NULL ,
`city` VARCHAR(255)  NOT NULL ,
`province` VARCHAR(255)  NOT NULL ,
`postal_code` VARCHAR(255)  NOT NULL ,
`id_country` INT NOT NULL ,
`home_phone` VARCHAR(255)  NOT NULL ,
`email` VARCHAR(255)  NOT NULL ,
`website` VARCHAR(255)  NOT NULL ,
`fb_profile` VARCHAR(255)  NOT NULL ,
`kennel_name` VARCHAR(255)  NOT NULL ,
`notes` TEXT NOT NULL ,
`is_judge` VARCHAR(255)  NOT NULL ,
`judge_info` TEXT NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__pedigree_people_delegation` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`id_person` INT NOT NULL ,
`id_user` INT(11)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__pedigree_registrations` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`id_dog` INT NOT NULL ,
`id_country` INT NOT NULL ,
`is_primary` VARCHAR(255)  NOT NULL ,
`registration_number` VARCHAR(50)  NOT NULL ,
`registration_name` VARCHAR(255)  NOT NULL ,
`verified` VARCHAR(255)  NOT NULL ,
`notes` VARCHAR(255)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

