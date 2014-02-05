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
?>
<script type="text/javascript">
    function deleteItem(item_id){
        if(confirm("<?php echo JText::_('COM_PEDIGREE_DELETE_MESSAGE'); ?>")){
            document.getElementById('form-dog-delete-' + item_id).submit();
        }
    }
</script>

<div class="items">
    <ul class="items_list">
<?php $show = false; ?>
        <?php foreach ($this->items as $item) : ?>

            
				<?php
					if($item->state == 1 || ($item->state == 0 && JFactory::getUser()->authorise('core.edit.own',' com_pedigree.dog.'.$item->id))):
						$show = true;
						?>
							<li>
								<a href="<?php echo JRoute::_('index.php?option=com_pedigree&view=dog&id=' . (int)$item->id); ?>"><?php echo $item->name; ?></a>
								<?php
									if(JFactory::getUser()->authorise('core.edit.state','com_pedigree.dog.'.$item->id)):
									?>
										<a href="javascript:document.getElementById('form-dog-state-<?php echo $item->id; ?>').submit()"><?php if($item->state == 1): echo JText::_("COM_PEDIGREE_UNPUBLISH_ITEM"); else: echo JText::_("COM_PEDIGREE_PUBLISH_ITEM"); endif; ?></a>
										<form id="form-dog-state-<?php echo $item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_pedigree&task=dog.save'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
											<input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
											<input type="hidden" name="jform[name]" value="<?php echo $item->name; ?>" />
											<input type="hidden" name="jform[id_sire]" value="<?php echo $item->id_sire; ?>" />
											<input type="hidden" name="jform[id_dam]" value="<?php echo $item->id_dam; ?>" />
											<input type="hidden" name="jform[sex]" value="<?php echo $item->sex; ?>" />
											<input type="hidden" name="jform[birth_date]" value="<?php echo $item->birth_date; ?>" />
											<input type="hidden" name="jform[call_name]" value="<?php echo $item->call_name; ?>" />
											<input type="hidden" name="jform[id_gallery_image]" value="<?php echo $item->id_gallery_image; ?>" />
											<input type="hidden" name="jform[id_gallery_category]" value="<?php echo $item->id_gallery_category; ?>" />
											<input type="hidden" name="jform[coi]" value="<?php echo $item->coi; ?>" />
											<input type="hidden" name="jform[stud_number]" value="<?php echo $item->stud_number; ?>" />
											<input type="hidden" name="jform[brs_number]" value="<?php echo $item->brs_number; ?>" />
											<input type="hidden" name="jform[atc_number]" value="<?php echo $item->atc_number; ?>" />
											<input type="hidden" name="jform[id_color]" value="<?php echo $item->id_color; ?>" />
											<input type="hidden" name="jform[color_variations]" value="<?php echo $item->color_variations; ?>" />
											<input type="hidden" name="jform[id_pattern]" value="<?php echo $item->id_pattern; ?>" />
											<input type="hidden" name="jform[is_scented]" value="<?php echo $item->is_scented; ?>" />
											<input type="hidden" name="jform[is_smooth]" value="<?php echo $item->is_smooth; ?>" />
											<input type="hidden" name="jform[is_bearded]" value="<?php echo $item->is_bearded; ?>" />
											<input type="hidden" name="jform[titles_prefix]" value="<?php echo $item->titles_prefix; ?>" />
											<input type="hidden" name="jform[titles_suffix]" value="<?php echo $item->titles_suffix; ?>" />
											<input type="hidden" name="jform[awards]" value="<?php echo $item->awards; ?>" />
											<input type="hidden" name="jform[microchip]" value="<?php echo $item->microchip; ?>" />
											<input type="hidden" name="jform[dna_profile]" value="<?php echo $item->dna_profile; ?>" />
											<input type="hidden" name="jform[chic_number]" value="<?php echo $item->chic_number; ?>" />
											<input type="hidden" name="jform[health_test_thyroid]" value="<?php echo $item->health_test_thyroid; ?>" />
											<input type="hidden" name="jform[health_test_elbow]" value="<?php echo $item->health_test_elbow; ?>" />
											<input type="hidden" name="jform[health_test_hips]" value="<?php echo $item->health_test_hips; ?>" />
											<input type="hidden" name="jform[health_test_eyes]" value="<?php echo $item->health_test_eyes; ?>" />
											<input type="hidden" name="jform[health_test_heart]" value="<?php echo $item->health_test_heart; ?>" />
											<input type="hidden" name="jform[health_notes]" value="<?php echo $item->health_notes; ?>" />
											<input type="hidden" name="jform[death_date]" value="<?php echo $item->death_date; ?>" />
											<input type="hidden" name="jform[death_cause]" value="<?php echo $item->death_cause; ?>" />
											<input type="hidden" name="jform[is_stud]" value="<?php echo $item->is_stud; ?>" />
											<input type="hidden" name="jform[stud_details]" value="<?php echo $item->stud_details; ?>" />
											<input type="hidden" name="jform[is_semen]" value="<?php echo $item->is_semen; ?>" />
											<input type="hidden" name="jform[videos]" value="<?php echo $item->videos; ?>" />
											<input type="hidden" name="jform[articles]" value="<?php echo $item->articles; ?>" />
											<input type="hidden" name="jform[notes]" value="<?php echo $item->notes; ?>" />
											<input type="hidden" name="jform[source]" value="<?php echo $item->source; ?>" />
											<input type="hidden" name="jform[ordering]" value="<?php echo $item->ordering; ?>" />
											<input type="hidden" name="jform[state]" value="<?php echo (int)!((int)$item->state); ?>" />
											<input type="hidden" name="jform[checked_out]" value="<?php echo $item->checked_out; ?>" />
											<input type="hidden" name="jform[checked_out_time]" value="<?php echo $item->checked_out_time; ?>" />
											<input type="hidden" name="option" value="com_pedigree" />
											<input type="hidden" name="task" value="dog.save" />
											<?php echo JHtml::_('form.token'); ?>
										</form>
									<?php
									endif;
									if(JFactory::getUser()->authorise('core.delete','com_pedigree.dog.'.$item->id)):
									?>
										<a href="javascript:deleteItem(<?php echo $item->id; ?>);"><?php echo JText::_("COM_PEDIGREE_DELETE_ITEM"); ?></a>
										<form id="form-dog-delete-<?php echo $item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_pedigree&task=dog.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
											<input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
											<input type="hidden" name="jform[name]" value="<?php echo $item->name; ?>" />
											<input type="hidden" name="jform[id_sire]" value="<?php echo $item->id_sire; ?>" />
											<input type="hidden" name="jform[id_dam]" value="<?php echo $item->id_dam; ?>" />
											<input type="hidden" name="jform[sex]" value="<?php echo $item->sex; ?>" />
											<input type="hidden" name="jform[birth_date]" value="<?php echo $item->birth_date; ?>" />
											<input type="hidden" name="jform[call_name]" value="<?php echo $item->call_name; ?>" />
											<input type="hidden" name="jform[id_gallery_image]" value="<?php echo $item->id_gallery_image; ?>" />
											<input type="hidden" name="jform[id_gallery_category]" value="<?php echo $item->id_gallery_category; ?>" />
											<input type="hidden" name="jform[coi]" value="<?php echo $item->coi; ?>" />
											<input type="hidden" name="jform[stud_number]" value="<?php echo $item->stud_number; ?>" />
											<input type="hidden" name="jform[brs_number]" value="<?php echo $item->brs_number; ?>" />
											<input type="hidden" name="jform[atc_number]" value="<?php echo $item->atc_number; ?>" />
											<input type="hidden" name="jform[id_color]" value="<?php echo $item->id_color; ?>" />
											<input type="hidden" name="jform[color_variations]" value="<?php echo $item->color_variations; ?>" />
											<input type="hidden" name="jform[id_pattern]" value="<?php echo $item->id_pattern; ?>" />
											<input type="hidden" name="jform[is_scented]" value="<?php echo $item->is_scented; ?>" />
											<input type="hidden" name="jform[is_smooth]" value="<?php echo $item->is_smooth; ?>" />
											<input type="hidden" name="jform[is_bearded]" value="<?php echo $item->is_bearded; ?>" />
											<input type="hidden" name="jform[titles_prefix]" value="<?php echo $item->titles_prefix; ?>" />
											<input type="hidden" name="jform[titles_suffix]" value="<?php echo $item->titles_suffix; ?>" />
											<input type="hidden" name="jform[awards]" value="<?php echo $item->awards; ?>" />
											<input type="hidden" name="jform[microchip]" value="<?php echo $item->microchip; ?>" />
											<input type="hidden" name="jform[dna_profile]" value="<?php echo $item->dna_profile; ?>" />
											<input type="hidden" name="jform[chic_number]" value="<?php echo $item->chic_number; ?>" />
											<input type="hidden" name="jform[health_test_thyroid]" value="<?php echo $item->health_test_thyroid; ?>" />
											<input type="hidden" name="jform[health_test_elbow]" value="<?php echo $item->health_test_elbow; ?>" />
											<input type="hidden" name="jform[health_test_hips]" value="<?php echo $item->health_test_hips; ?>" />
											<input type="hidden" name="jform[health_test_eyes]" value="<?php echo $item->health_test_eyes; ?>" />
											<input type="hidden" name="jform[health_test_heart]" value="<?php echo $item->health_test_heart; ?>" />
											<input type="hidden" name="jform[health_notes]" value="<?php echo $item->health_notes; ?>" />
											<input type="hidden" name="jform[death_date]" value="<?php echo $item->death_date; ?>" />
											<input type="hidden" name="jform[death_cause]" value="<?php echo $item->death_cause; ?>" />
											<input type="hidden" name="jform[is_stud]" value="<?php echo $item->is_stud; ?>" />
											<input type="hidden" name="jform[stud_details]" value="<?php echo $item->stud_details; ?>" />
											<input type="hidden" name="jform[is_semen]" value="<?php echo $item->is_semen; ?>" />
											<input type="hidden" name="jform[videos]" value="<?php echo $item->videos; ?>" />
											<input type="hidden" name="jform[articles]" value="<?php echo $item->articles; ?>" />
											<input type="hidden" name="jform[notes]" value="<?php echo $item->notes; ?>" />
											<input type="hidden" name="jform[source]" value="<?php echo $item->source; ?>" />
											<input type="hidden" name="jform[ordering]" value="<?php echo $item->ordering; ?>" />
											<input type="hidden" name="jform[state]" value="<?php echo $item->state; ?>" />
											<input type="hidden" name="jform[checked_out]" value="<?php echo $item->checked_out; ?>" />
											<input type="hidden" name="jform[checked_out_time]" value="<?php echo $item->checked_out_time; ?>" />
											<input type="hidden" name="jform[created_by]" value="<?php echo $item->created_by; ?>" />
											<input type="hidden" name="option" value="com_pedigree" />
											<input type="hidden" name="task" value="dog.remove" />
											<?php echo JHtml::_('form.token'); ?>
										</form>
									<?php
									endif;
								?>
							</li>
						<?php endif; ?>

<?php endforeach; ?>
        <?php
        if (!$show):
            echo JText::_('COM_PEDIGREE_NO_ITEMS');
        endif;
        ?>
    </ul>
</div>
<?php if ($show): ?>
    <div class="pagination">
        <p class="counter">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </p>
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
<?php endif; ?>


									<?php if(JFactory::getUser()->authorise('core.create','com_pedigree')): ?><a href="<?php echo JRoute::_('index.php?option=com_pedigree&task=dog.edit&id=0'); ?>"><?php echo JText::_("COM_PEDIGREE_ADD_ITEM"); ?></a>
	<?php endif; ?>