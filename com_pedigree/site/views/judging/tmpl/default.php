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
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_JUDGING_ID'); ?></th>
			<td><?php echo $this->item->id; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_JUDGING_ID_PERSON'); ?></th>
			<td><?php echo $this->item->id_person; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_JUDGING_ID_COUNTRY'); ?></th>
			<td><?php echo $this->item->id_country; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_JUDGING_DATE'); ?></th>
			<td><?php echo $this->item->date; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_JUDGING_NOTES'); ?></th>
			<td><?php echo $this->item->notes; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_JUDGING_STATE'); ?></th>
			<td>
			<i class="icon-<?php echo ($this->item->state == 1) ? 'publish' : 'unpublish'; ?>"></i></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_JUDGING_CREATED_BY'); ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
</tr>

        </table>
    </div>
    <?php if($canEdit && $this->item->checked_out == 0): ?>
		<a class="btn" href="<?php echo JRoute::_('index.php?option=com_pedigree&task=judging.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_PEDIGREE_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_pedigree.judging.'.$this->item->id)):?>
									<a class="btn" href="<?php echo JRoute::_('index.php?option=com_pedigree&task=judging.remove&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("COM_PEDIGREE_DELETE_ITEM"); ?></a>
								<?php endif; ?>
    <?php
else:
    echo JText::_('COM_PEDIGREE_ITEM_NOT_LOADED');
endif;
?>
