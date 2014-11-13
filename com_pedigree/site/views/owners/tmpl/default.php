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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user = JFactory::getUser();
$userId = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canCreate = $user->authorise('core.create', 'com_pedigree');
$canEdit = $user->authorise('core.edit', 'com_pedigree');
$canCheckin = $user->authorise('core.manage', 'com_pedigree');
$canChange = $user->authorise('core.edit.state', 'com_pedigree');
$canDelete = $user->authorise('core.delete', 'com_pedigree');
?>

<form action="<?php echo JRoute::_('index.php?option=com_pedigree&view=owners'); ?>" method="post" name="adminForm" id="adminForm">

    <table class="table table-striped" id="ownerList">
        <thead>
            <tr>
                <?php if (isset($this->items[0]->state)): ?>
                    <th width="1%" class="nowrap center">
                        <?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
                    </th>
                <?php endif; ?>

                				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_PEDIGREE_OWNERS_ID_PERSON', 'a.id_person', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_PEDIGREE_OWNERS_ID_DOG', 'a.id_dog', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_PEDIGREE_OWNERS_IS_PRIMARY', 'a.is_primary', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_PEDIGREE_OWNERS_DATE_START', 'a.date_start', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_PEDIGREE_OWNERS_DATE_END', 'a.date_end', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_PEDIGREE_OWNERS_CREATED_BY', 'a.created_by', $listDirn, $listOrder); ?>
				</th>
                    

                <?php if (isset($this->items[0]->id)): ?>
                    <th width="1%" class="nowrap center hidden-phone">
                        <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                    </th>
                <?php endif; ?>

                				<?php if ($canEdit || $canDelete): ?>
					<th class="center">
				<?php echo JText::_('COM_PEDIGREE_OWNERS_ACTIONS'); ?>
				</th>
				<?php endif; ?>

            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
                    <?php echo $this->pagination->getListFooter(); ?>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($this->items as $i => $item) : ?>
                <?php $canEdit = $user->authorise('core.edit', 'com_pedigree'); ?>

                				<?php if (!$canEdit && $user->authorise('core.edit.own', 'com_pedigree')): ?>
					<?php $canEdit = JFactory::getUser()->id == $item->created_by; ?>
				<?php endif; ?>

                <tr class="row<?php echo $i % 2; ?>">

                    <?php if (isset($this->items[0]->state)): ?>
                        <?php $class = ($canEdit || $canChange) ? 'active' : 'disabled'; ?>
                        <td class="center">
                            <a class="btn btn-micro <?php echo $class; ?>" href="<?php echo ($canEdit || $canChange) ? JRoute::_('index.php?option=com_pedigree&task=owner.publish&id=' . $item->id . '&state=' . (($item->state + 1) % 2), false, 2) : '#'; ?>">
                                <?php if ($item->state == 1): ?>
                                    <i class="icon-publish"></i>
                                <?php else: ?>
                                    <i class="icon-unpublish"></i>
                                <?php endif; ?>
                            </a>
                        </td>
                    <?php endif; ?>

                    				<td>

					<?php echo $item->id_person; ?>
				</td>
				<td>

					<?php echo $item->id_dog; ?>
				</td>
				<td>

					<?php echo $item->is_primary; ?>
				</td>
				<td>

					<?php echo $item->date_start; ?>
				</td>
				<td>

					<?php echo $item->date_end; ?>
				</td>
				<td>

							<?php echo JFactory::getUser($item->created_by)->name; ?>				</td>


                    <?php if (isset($this->items[0]->id)): ?>
                        <td class="center hidden-phone">
                            <?php echo (int) $item->id; ?>
                        </td>
                    <?php endif; ?>

                    				<?php if ($canEdit || $canDelete): ?>
					<td class="center">
						<?php if ($canEdit): ?>
							<a href="<?php echo JRoute::_('index.php?option=com_pedigree&task=owner.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
						<?php endif; ?>
						<?php if ($canDelete): ?>
							<button data-item-id="<?php echo $item->id; ?>" class="btn btn-mini delete-button" type="button"><i class="icon-trash" ></i></button>
						<?php endif; ?>
					</td>
				<?php endif; ?>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($canCreate): ?>
        <a href="<?php echo JRoute::_('index.php?option=com_pedigree&task=owner.edit&id=0', false, 2); ?>" class="btn btn-success btn-small"><i class="icon-plus"></i> <?php echo JText::_('COM_PEDIGREE_ADD_ITEM'); ?></a>
    <?php endif; ?>

    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
    <?php echo JHtml::_('form.token'); ?>
</form>

<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('.delete-button').click(deleteItem);
    });

    function deleteItem() {
        var item_id = jQuery(this).attr('data-item-id');
        if (confirm("<?php echo JText::_('COM_PEDIGREE_DELETE_MESSAGE'); ?>")) {
            window.location.href = '<?php echo JRoute::_('index.php?option=com_pedigree&task=owner.remove&id=', false, 2) ?>' + item_id;
        }
    }
</script>


