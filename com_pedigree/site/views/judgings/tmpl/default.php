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
            document.getElementById('form-judging-delete-' + item_id).submit();
        }
    }
</script>

<div class="items">
    <ul class="items_list">
<?php $show = false; ?>
        <?php foreach ($this->items as $item) : ?>

            
				<?php
					if($item->state == 1 || ($item->state == 0 && JFactory::getUser()->authorise('core.edit.own',' com_pedigree.judging.'.$item->id))):
						$show = true;
						?>
							<li>
								<a href="<?php echo JRoute::_('index.php?option=com_pedigree&view=judging&id=' . (int)$item->id); ?>"><?php echo $item->notes; ?></a>
								<?php
									if(JFactory::getUser()->authorise('core.edit.state','com_pedigree.judging.'.$item->id)):
									?>
										<a href="javascript:document.getElementById('form-judging-state-<?php echo $item->id; ?>').submit()"><?php if($item->state == 1): echo JText::_("COM_PEDIGREE_UNPUBLISH_ITEM"); else: echo JText::_("COM_PEDIGREE_PUBLISH_ITEM"); endif; ?></a>
										<form id="form-judging-state-<?php echo $item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_pedigree&task=judging.save'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
											<input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
											<input type="hidden" name="jform[id_person]" value="<?php echo $item->id_person; ?>" />
											<input type="hidden" name="jform[id_country]" value="<?php echo $item->id_country; ?>" />
											<input type="hidden" name="jform[date]" value="<?php echo $item->date; ?>" />
											<input type="hidden" name="jform[notes]" value="<?php echo $item->notes; ?>" />
											<input type="hidden" name="jform[ordering]" value="<?php echo $item->ordering; ?>" />
											<input type="hidden" name="jform[state]" value="<?php echo (int)!((int)$item->state); ?>" />
											<input type="hidden" name="jform[checked_out]" value="<?php echo $item->checked_out; ?>" />
											<input type="hidden" name="jform[checked_out_time]" value="<?php echo $item->checked_out_time; ?>" />
											<input type="hidden" name="option" value="com_pedigree" />
											<input type="hidden" name="task" value="judging.save" />
											<?php echo JHtml::_('form.token'); ?>
										</form>
									<?php
									endif;
									if(JFactory::getUser()->authorise('core.delete','com_pedigree.judging.'.$item->id)):
									?>
										<a href="javascript:deleteItem(<?php echo $item->id; ?>);"><?php echo JText::_("COM_PEDIGREE_DELETE_ITEM"); ?></a>
										<form id="form-judging-delete-<?php echo $item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_pedigree&task=judging.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
											<input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
											<input type="hidden" name="jform[id_person]" value="<?php echo $item->id_person; ?>" />
											<input type="hidden" name="jform[id_country]" value="<?php echo $item->id_country; ?>" />
											<input type="hidden" name="jform[date]" value="<?php echo $item->date; ?>" />
											<input type="hidden" name="jform[notes]" value="<?php echo $item->notes; ?>" />
											<input type="hidden" name="jform[ordering]" value="<?php echo $item->ordering; ?>" />
											<input type="hidden" name="jform[state]" value="<?php echo $item->state; ?>" />
											<input type="hidden" name="jform[checked_out]" value="<?php echo $item->checked_out; ?>" />
											<input type="hidden" name="jform[checked_out_time]" value="<?php echo $item->checked_out_time; ?>" />
											<input type="hidden" name="jform[created_by]" value="<?php echo $item->created_by; ?>" />
											<input type="hidden" name="option" value="com_pedigree" />
											<input type="hidden" name="task" value="judging.remove" />
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


									<?php if(JFactory::getUser()->authorise('core.create','com_pedigree')): ?><a href="<?php echo JRoute::_('index.php?option=com_pedigree&task=judging.edit&id=0'); ?>"><?php echo JText::_("COM_PEDIGREE_ADD_ITEM"); ?></a>
	<?php endif; ?>