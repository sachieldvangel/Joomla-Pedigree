
/* Updates to fix various Select/Option groups */
		
UPDATE `mu9ez_pedigree_dogs` 
SET sex = sex - 1,
is_scented = IF(is_scented=0, 1, 0),
is_smooth = IF(is_smooth=0, 1, 0),
is_bearded = IF(is_bearded=0, 1, 0),
is_stud = IF(is_stud=0, 1, 0),
is_semen = IF(is_semen=0, 1, 0);
