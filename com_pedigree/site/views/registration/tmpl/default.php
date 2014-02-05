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

            			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_ID'); ?>:
			<?php echo $this->item->id; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_ID_DOG'); ?>:
			<?php echo $this->item->id_dog; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_ID_COUNTRY'); ?>:
			<?php echo $this->item->id_country; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_IS_PRIMARY'); ?>:
			<?php echo $this->item->is_primary; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_REGISTRATION_NUMBER'); ?>:
			<?php echo $this->item->registration_number; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_REGISTRATION_NAME'); ?>:
			<?php echo $this->item->registration_name; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_VERIFIED'); ?>:
			<?php echo $this->item->verified; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_NOTES'); ?>:
			<?php echo $this->item->notes; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_ORDERING'); ?>:
			<?php echo $this->item->ordering; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_STATE'); ?>:
			<?php echo $this->item->state; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_CHECKED_OUT'); ?>:
			<?php echo $this->item->checked_out; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_CHECKED_OUT_TIME'); ?>:
			<?php echo $this->item->checked_out_time; ?></li>
			<li><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_CREATED_BY'); ?>:
			<?php echo $this->item->created_by; ?></li>


        </ul>

    </div>
    <?php if($canEdit && $this->item->checked_out == 0): ?>
		<a href="<?php echo JRoute::_('index.php?option=com_pedigree&task=registration.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_PEDIGREE_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_pedigree.registration.'.$this->item->id)):
								?>
									<a href="javascript:document.getElementById('form-registration-delete-<?php echo $this->item->id ?>').submit()"><?php echo JText::_("COM_PEDIGREE_DELETE_ITEM"); ?></a>
									<form id="form-registration-delete-<?php echo $this->item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_pedigree&task=registration.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
										<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
										<input type="hidden" name="jform[id_dog]" value="<?php echo $this->item->id_dog; ?>" />
										<input type="hidden" name="jform[id_country]" value="<?php echo $this->item->id_country; ?>" />
										<input type="hidden" name="jform[is_primary]" value="<?php echo $this->item->is_primary; ?>" />
										<input type="hidden" name="jform[registration_number]" value="<?php echo $this->item->registration_number; ?>" />
										<input type="hidden" name="jform[registration_name]" value="<?php echo $this->item->registration_name; ?>" />
										<input type="hidden" name="jform[verified]" value="<?php echo $this->item->verified; ?>" />
										<input type="hidden" name="jform[notes]" value="<?php echo $this->item->notes; ?>" />
										<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
										<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
										<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
										<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />
										<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />
										<input type="hidden" name="option" value="com_pedigree" />
										<input type="hidden" name="task" value="registration.remove" />
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
