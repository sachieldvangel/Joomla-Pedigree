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

            			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_ID'); ?>:
			<?php echo $this->item->id; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_FIRST_NAME'); ?>:
			<?php echo $this->item->first_name; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_LAST_NAME'); ?>:
			<?php echo $this->item->last_name; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_ADDRESS1'); ?>:
			<?php echo $this->item->address1; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_ADDRESS2'); ?>:
			<?php echo $this->item->address2; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_CITY'); ?>:
			<?php echo $this->item->city; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_PROVINCE'); ?>:
			<?php echo $this->item->province; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_POSTAL_CODE'); ?>:
			<?php echo $this->item->postal_code; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_ID_COUNTRY'); ?>:
			<?php echo $this->item->id_country; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_HOME_PHONE'); ?>:
			<?php echo $this->item->home_phone; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_EMAIL'); ?>:
			<?php echo $this->item->email; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_WEBSITE'); ?>:
			<?php echo $this->item->website; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_FB_PROFILE'); ?>:
			<?php echo $this->item->fb_profile; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_KENNEL_NAME'); ?>:
			<?php echo $this->item->kennel_name; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_NOTES'); ?>:
			<?php echo $this->item->notes; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_IS_JUDGE'); ?>:
			<?php echo $this->item->is_judge; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_JUDGE_INFO'); ?>:
			<?php echo $this->item->judge_info; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_ORDERING'); ?>:
			<?php echo $this->item->ordering; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_STATE'); ?>:
			<?php echo $this->item->state; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_CHECKED_OUT'); ?>:
			<?php echo $this->item->checked_out; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_CHECKED_OUT_TIME'); ?>:
			<?php echo $this->item->checked_out_time; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_PEOPLE_CREATED_BY'); ?>:
			<?php echo $this->item->created_by; ?></li>


        </ul>

    </div>
    <?php if($canEdit && $this->item->checked_out == 0): ?>
		<a href="<?php echo JRoute::_('index.php?option=com_pedigree&task=people.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_PEDIGREE_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_pedigree.people.'.$this->item->id)):
								?>
									<a href="javascript:document.getElementById('form-people-delete-<?php echo $this->item->id ?>').submit()"><?php echo JText::_("COM_PEDIGREE_DELETE_ITEM"); ?></a>
									<form id="form-people-delete-<?php echo $this->item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_pedigree&task=people.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
										<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
										<input type="hidden" name="jform[first_name]" value="<?php echo $this->item->first_name; ?>" />
										<input type="hidden" name="jform[last_name]" value="<?php echo $this->item->last_name; ?>" />
										<input type="hidden" name="jform[address1]" value="<?php echo $this->item->address1; ?>" />
										<input type="hidden" name="jform[address2]" value="<?php echo $this->item->address2; ?>" />
										<input type="hidden" name="jform[city]" value="<?php echo $this->item->city; ?>" />
										<input type="hidden" name="jform[province]" value="<?php echo $this->item->province; ?>" />
										<input type="hidden" name="jform[postal_code]" value="<?php echo $this->item->postal_code; ?>" />
										<input type="hidden" name="jform[id_country]" value="<?php echo $this->item->id_country; ?>" />
										<input type="hidden" name="jform[home_phone]" value="<?php echo $this->item->home_phone; ?>" />
										<input type="hidden" name="jform[email]" value="<?php echo $this->item->email; ?>" />
										<input type="hidden" name="jform[website]" value="<?php echo $this->item->website; ?>" />
										<input type="hidden" name="jform[fb_profile]" value="<?php echo $this->item->fb_profile; ?>" />
										<input type="hidden" name="jform[kennel_name]" value="<?php echo $this->item->kennel_name; ?>" />
										<input type="hidden" name="jform[notes]" value="<?php echo $this->item->notes; ?>" />
										<input type="hidden" name="jform[is_judge]" value="<?php echo $this->item->is_judge; ?>" />
										<input type="hidden" name="jform[judge_info]" value="<?php echo $this->item->judge_info; ?>" />
										<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
										<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
										<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
										<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />
										<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />
										<input type="hidden" name="option" value="com_pedigree" />
										<input type="hidden" name="task" value="people.remove" />
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
