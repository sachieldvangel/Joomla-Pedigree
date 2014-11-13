<?php
/**
 * @version     1.0.3
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
<?php if ($this->item && $this->item->state == 1) : ?>

    <div class="item_fields">
        <table class="table">
            <tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_ID'); ?></th>
			<td><?php echo $this->item->id; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_ID_DOG'); ?></th>
			<td><?php echo $this->item->id_dog; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_ID_COUNTRY'); ?></th>
			<td><?php echo $this->item->id_country; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_IS_PRIMARY'); ?></th>
			<td><?php echo $this->item->is_primary; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_REGISTRATION_NUMBER'); ?></th>
			<td><?php echo $this->item->registration_number; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_REGISTRATION_NAME'); ?></th>
			<td><?php echo $this->item->registration_name; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_VERIFIED'); ?></th>
			<td><?php echo $this->item->verified; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_NOTES'); ?></th>
			<td><?php echo $this->item->notes; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_STATE'); ?></th>
			<td>
			<i class="icon-<?php echo ($this->item->state == 1) ? 'publish' : 'unpublish'; ?>"></i></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_CREATED_BY'); ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
</tr>

        </table>
    </div>
    <?php if($canEdit && $this->item->checked_out == 0): ?>
		<a class="btn" href="<?php echo JRoute::_('index.php?option=com_pedigree&task=registration.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_PEDIGREE_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_pedigree.registration.'.$this->item->id)):?>
									<a class="btn" href="<?php echo JRoute::_('index.php?option=com_pedigree&task=registration.remove&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("COM_PEDIGREE_DELETE_ITEM"); ?></a>
								<?php endif; ?>
    <?php
else:
    echo JText::_('COM_PEDIGREE_ITEM_NOT_LOADED');
endif;
?>
