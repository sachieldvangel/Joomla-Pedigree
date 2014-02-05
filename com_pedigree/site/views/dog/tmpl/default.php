<?php
/**
 * @version     1.0.2
 * @package     com_pedigree
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Eddie Kominek <eddie@kominekafghans.com> - http://www.kominekafghans.com/
 */
// no direct access
defined('_JEXEC') or die;

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_pedigree', JPATH_ADMINISTRATOR);
$canEdit = JFactory::getUser()->authorise('core.edit', 'com_pedigree.' . $this->item->id);
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_pedigree' . $this->item->id)) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>
<?php if ($this->item) : ?>

    <div class="item_fields">

        <ul class="fields_list">

            			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID'); ?>:
			<?php echo $this->item->id; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_NAME'); ?>:
			<?php echo $this->item->name; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_SIRE'); ?>:
			<?php echo $this->item->id_sire; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_DAM'); ?>:
			<?php echo $this->item->id_dam; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_SEX'); ?>:
			<?php echo $this->item->sex; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_BIRTH_DATE'); ?>:
			<?php echo $this->item->birth_date; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_CALL_NAME'); ?>:
			<?php echo $this->item->call_name; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_GALLERY_IMAGE'); ?>:
			<?php echo $this->item->id_gallery_image; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_GALLERY_CATEGORY'); ?>:
			<?php echo $this->item->id_gallery_category; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_COI'); ?>:
			<?php echo $this->item->coi; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_STUD_NUMBER'); ?>:
			<?php echo $this->item->stud_number; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_BRS_NUMBER'); ?>:
			<?php echo $this->item->brs_number; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ATC_NUMBER'); ?>:
			<?php echo $this->item->atc_number; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_COLOR'); ?>:
			<?php echo $this->item->id_color; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_COLOR_VARIATIONS'); ?>:
			<?php echo $this->item->color_variations; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_PATTERN'); ?>:
			<?php echo $this->item->id_pattern; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_IS_SCENTED'); ?>:
			<?php echo $this->item->is_scented; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_IS_SMOOTH'); ?>:
			<?php echo $this->item->is_smooth; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_IS_BEARDED'); ?>:
			<?php echo $this->item->is_bearded; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_TITLES_PREFIX'); ?>:
			<?php echo $this->item->titles_prefix; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_TITLES_SUFFIX'); ?>:
			<?php echo $this->item->titles_suffix; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_AWARDS'); ?>:
			<?php echo $this->item->awards; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_MICROCHIP'); ?>:
			<?php echo $this->item->microchip; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_DNA_PROFILE'); ?>:
			<?php echo $this->item->dna_profile; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_CHIC_NUMBER'); ?>:
			<?php echo $this->item->chic_number; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_HEALTH_TEST_THYROID'); ?>:
			<?php echo $this->item->health_test_thyroid; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_HEALTH_TEST_ELBOW'); ?>:
			<?php echo $this->item->health_test_elbow; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_HEALTH_TEST_HIPS'); ?>:
			<?php echo $this->item->health_test_hips; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_HEALTH_TEST_EYES'); ?>:
			<?php echo $this->item->health_test_eyes; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_HEALTH_TEST_HEART'); ?>:
			<?php echo $this->item->health_test_heart; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_HEALTH_NOTES'); ?>:
			<?php echo $this->item->health_notes; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_DEATH_DATE'); ?>:
			<?php echo $this->item->death_date; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_DEATH_CAUSE'); ?>:
			<?php echo $this->item->death_cause; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_IS_STUD'); ?>:
			<?php echo $this->item->is_stud; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_STUD_DETAILS'); ?>:
			<?php echo $this->item->stud_details; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_IS_SEMEN'); ?>:
			<?php echo $this->item->is_semen; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_VIDEOS'); ?>:
			<?php echo $this->item->videos; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ARTICLES'); ?>:
			<?php echo $this->item->articles; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_NOTES'); ?>:
			<?php echo $this->item->notes; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_SOURCE'); ?>:
			<?php echo $this->item->source; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ORDERING'); ?>:
			<?php echo $this->item->ordering; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_STATE'); ?>:
			<?php echo $this->item->state; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_CHECKED_OUT'); ?>:
			<?php echo $this->item->checked_out; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_CHECKED_OUT_TIME'); ?>:
			<?php echo $this->item->checked_out_time; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_CREATED_BY'); ?>:
			<?php echo $this->item->created_by; ?></li>


        </ul>

    </div>
    <?php if($canEdit && $this->item->checked_out == 0): ?>
		<a href="<?php echo JRoute::_('index.php?option=com_pedigree&task=dog.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_PEDIGREE_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_pedigree.dog.'.$this->item->id)):
								?>
									<a href="javascript:document.getElementById('form-dog-delete-<?php echo $this->item->id ?>').submit()"><?php echo JText::_("COM_PEDIGREE_DELETE_ITEM"); ?></a>
									<form id="form-dog-delete-<?php echo $this->item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_pedigree&task=dog.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
										<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
										<input type="hidden" name="jform[name]" value="<?php echo $this->item->name; ?>" />
										<input type="hidden" name="jform[id_sire]" value="<?php echo $this->item->id_sire; ?>" />
										<input type="hidden" name="jform[id_dam]" value="<?php echo $this->item->id_dam; ?>" />
										<input type="hidden" name="jform[sex]" value="<?php echo $this->item->sex; ?>" />
										<input type="hidden" name="jform[birth_date]" value="<?php echo $this->item->birth_date; ?>" />
										<input type="hidden" name="jform[call_name]" value="<?php echo $this->item->call_name; ?>" />
										<input type="hidden" name="jform[id_gallery_image]" value="<?php echo $this->item->id_gallery_image; ?>" />
										<input type="hidden" name="jform[id_gallery_category]" value="<?php echo $this->item->id_gallery_category; ?>" />
										<input type="hidden" name="jform[coi]" value="<?php echo $this->item->coi; ?>" />
										<input type="hidden" name="jform[stud_number]" value="<?php echo $this->item->stud_number; ?>" />
										<input type="hidden" name="jform[brs_number]" value="<?php echo $this->item->brs_number; ?>" />
										<input type="hidden" name="jform[atc_number]" value="<?php echo $this->item->atc_number; ?>" />
										<input type="hidden" name="jform[id_color]" value="<?php echo $this->item->id_color; ?>" />
										<input type="hidden" name="jform[color_variations]" value="<?php echo $this->item->color_variations; ?>" />
										<input type="hidden" name="jform[id_pattern]" value="<?php echo $this->item->id_pattern; ?>" />
										<input type="hidden" name="jform[is_scented]" value="<?php echo $this->item->is_scented; ?>" />
										<input type="hidden" name="jform[is_smooth]" value="<?php echo $this->item->is_smooth; ?>" />
										<input type="hidden" name="jform[is_bearded]" value="<?php echo $this->item->is_bearded; ?>" />
										<input type="hidden" name="jform[titles_prefix]" value="<?php echo $this->item->titles_prefix; ?>" />
										<input type="hidden" name="jform[titles_suffix]" value="<?php echo $this->item->titles_suffix; ?>" />
										<input type="hidden" name="jform[awards]" value="<?php echo $this->item->awards; ?>" />
										<input type="hidden" name="jform[microchip]" value="<?php echo $this->item->microchip; ?>" />
										<input type="hidden" name="jform[dna_profile]" value="<?php echo $this->item->dna_profile; ?>" />
										<input type="hidden" name="jform[chic_number]" value="<?php echo $this->item->chic_number; ?>" />
										<input type="hidden" name="jform[health_test_thyroid]" value="<?php echo $this->item->health_test_thyroid; ?>" />
										<input type="hidden" name="jform[health_test_elbow]" value="<?php echo $this->item->health_test_elbow; ?>" />
										<input type="hidden" name="jform[health_test_hips]" value="<?php echo $this->item->health_test_hips; ?>" />
										<input type="hidden" name="jform[health_test_eyes]" value="<?php echo $this->item->health_test_eyes; ?>" />
										<input type="hidden" name="jform[health_test_heart]" value="<?php echo $this->item->health_test_heart; ?>" />
										<input type="hidden" name="jform[health_notes]" value="<?php echo $this->item->health_notes; ?>" />
										<input type="hidden" name="jform[death_date]" value="<?php echo $this->item->death_date; ?>" />
										<input type="hidden" name="jform[death_cause]" value="<?php echo $this->item->death_cause; ?>" />
										<input type="hidden" name="jform[is_stud]" value="<?php echo $this->item->is_stud; ?>" />
										<input type="hidden" name="jform[stud_details]" value="<?php echo $this->item->stud_details; ?>" />
										<input type="hidden" name="jform[is_semen]" value="<?php echo $this->item->is_semen; ?>" />
										<input type="hidden" name="jform[videos]" value="<?php echo $this->item->videos; ?>" />
										<input type="hidden" name="jform[articles]" value="<?php echo $this->item->articles; ?>" />
										<input type="hidden" name="jform[notes]" value="<?php echo $this->item->notes; ?>" />
										<input type="hidden" name="jform[source]" value="<?php echo $this->item->source; ?>" />
										<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
										<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
										<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
										<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />
										<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />
										<input type="hidden" name="option" value="com_pedigree" />
										<input type="hidden" name="task" value="dog.remove" />
										<?php echo JHtml::_('form.token'); ?>
									</form>
								<?php
								endif;
							?>
<?php
else:
    echo JText::_('COM_PEDIGREE_ITEM_NOT_LOADED');
endif;
?>
