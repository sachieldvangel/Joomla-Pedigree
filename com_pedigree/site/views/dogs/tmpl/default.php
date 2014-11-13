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

$document = JFactory::getDocument();
$document->addStyleSheet('media/pedigree/css/pedigree.css', 'text/css');

$user = JFactory::getUser();
$userId = $user->get('id');

$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');

// Permissions:
$canCreate = $user->authorise('core.create', 'com_pedigree');
$canEdit = $user->authorise('core.edit', 'com_pedigree');
$canEditOwn = $user->authorise('core.edit.own', 'com_pedigree');
$canEditState = $user->authorise('core.edit.state', 'com_pedigree');
$canCheckin = $user->authorise('core.manage', 'com_pedigree');
$canDelete = $user->authorise('core.delete', 'com_pedigree');

$PedHelper = new PedigreeFrontendHelper();
$PedHelper->iGallery->getPageHeader();

?>

<?php
// Search tools bar
//$layout = new JLayoutFile('filter.dogs', null, array('debug' => true, 'view' => $this));
//echo $layout->render($this);
?>

<form action="<?php echo JRoute::_('index.php?option=com_pedigree&view=dogs'); ?>" method="post" name="adminForm" id="adminForm" class="ped-dogs form-search">
  <fieldset id="filter-bar">
    <div class="filter-search fltlft">
	  	<button type="button" onclick="resetFilters();" class="btn" title="<?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOGS_CLEAR_FILTERS'); ?>"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?> <i class="icon-cancel"></i> </button>
        <?php foreach ($this->filterForm->getFieldsets() as $fieldset) { ?>
        	<?php if (isset($fieldset)) { ?>
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><?php echo JText::_($fieldset->label); ?> <i class="icon-filter"></i> <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <?php foreach ($this->filterForm->getFieldset($fieldset->name) as $field) { ?>
                    <?php if (isset($field)) {?>
                    <li><a id="tglflt-<?php echo $field->getAttribute('id'); ?>" class="tglflt"><?php echo JText::_($field->getAttribute('label')); ?></a></li>
                    <?php }} ?>
                </ul>
            </div>
        	<?php } ?>
        <?php } ?>
       <button type="submit" class="btn"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?> <i class="icon-search"></i> </button>
      </div>
    <div class="filter-fields">
      <?php echo $this->filterForm->renderFieldset(null); //null, array('hiddenLabel' => true, array('class' => 'hide') ?>
    </div>
  </fieldset>

  <table class="table table-striped" id="dogList">
    <thead>
       <tr>
         <td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>"><?php echo $this->pagination->getResultsCounter(); ?>
	     <?php if ($canCreate): ?>
           <div><a href="<?php echo JRoute::_('index.php?option=com_pedigree&task=dog.edit&id=0', false, 2); ?>" class="btn btn-success btn-small"><i class="icon-plus"></i> <?php echo JText::_('COM_PEDIGREE_ADD_ITEM'); ?></a></div>
         <?php endif; ?>
         </td></tr>
      <tr>
        <?php if (isset($this->items[0]->state) && $canEditState): ?>
        <th width="1%" class="nowrap center"> <?php echo JHtml::_('grid.sort', 'JSTATUS', 'state', $listDirn, $listOrder); ?> </th>
        <?php endif; ?>
        <th width="1%" class="nowrap center"></th>
        <th class='left'> <?php if ($this->activeFilters) : echo JHtml::_('grid.sort',  'COM_PEDIGREE_DOGS_NAME', 'name', $listDirn, $listOrder); else : echo JText::_('COM_PEDIGREE_DOGS_NAME'); endif;?>
        </th>
        <th class='left'> <?php if ($this->activeFilters) : echo JHtml::_('grid.sort',  'COM_PEDIGREE_DOGS_REGISTRATION', 'registration_number', $listDirn, $listOrder); else : echo JText::_('COM_PEDIGREE_DOGS_REGISTRATION'); endif; ?>
        </th>
        <th class='left'> <?php if ($this->activeFilters) : echo JHtml::_('grid.sort',  'COM_PEDIGREE_DOGS_BIRTH_DATE', 'birth_date', $listDirn, $listOrder); else : echo JText::_('COM_PEDIGREE_DOGS_BIRTH_DATE'); endif; ?>
        </th>
        <th class='left'> <?php if ($this->activeFilters) : echo JHtml::_('grid.sort',  'COM_PEDIGREE_DOGS_ID_COLOR', 'color_name', $listDirn, $listOrder); else : echo JText::_('COM_PEDIGREE_DOGS_ID_COLOR'); endif; ?>
        </th>
        <th class='left'> <?php if ($this->activeFilters) : echo JHtml::_('grid.sort',  'COM_PEDIGREE_DOGS_ID_PATTERN', 'pattern_name', $listDirn, $listOrder); else : echo JText::_('COM_PEDIGREE_DOGS_ID_PATTERN'); endif; ?>
        </th>
        <th class='left'> <?php if ($this->activeFilters) : echo JHtml::_('grid.sort',  'COM_PEDIGREE_DOGS_BRS_NUMBER', 'color_name', $listDirn, $listOrder); else : echo JText::_('COM_PEDIGREE_DOGS_BRS_NUMBER'); endif; ?>
        </th>
        <th class='left'> <?php if ($this->activeFilters) : echo JHtml::_('grid.sort',  'COM_PEDIGREE_DOGS_STUD_NUMBER', 'color_name', $listDirn, $listOrder); else : echo JText::_('COM_PEDIGREE_DOGS_STUD_NUMBER'); endif; ?>
        </th>
        <th class='left'> <?php if ($this->activeFilters) : echo JHtml::_('grid.sort',  'COM_PEDIGREE_DOGS_ID_SIRE', 'sire_name', $listDirn, $listOrder); else : echo JText::_('COM_PEDIGREE_DOGS_ID_SIRE'); endif; ?>
        </th>
        <th class='left'> <?php if ($this->activeFilters) : echo JHtml::_('grid.sort',  'COM_PEDIGREE_DOGS_ID_DAM', 'dam_name', $listDirn, $listOrder); else : echo JText::_('COM_PEDIGREE_DOGS_ID_DAM'); endif; ?>
        </th>
        <?php if ($canEdit || $canDelete): ?>
        <th class="center"> <?php echo JText::_('COM_PEDIGREE_DOGS_ACTIONS'); ?> </th>
        <?php endif; ?>
      </tr>
    </thead>
    <tfoot>
      <tr><td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>"><?php echo $this->pagination->getListFooter(); ?></td></tr>
      <tr><td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">Items per page: <?php echo $this->pagination->getLimitBox(); ?></td></tr>
    </tfoot>
    <tbody>
      <?php foreach ($this->items as $i => $item) : ?>
      <?php //$canEdit = $user->authorise('core.edit', 'com_pedigree'); ?>
      <?php $isOwner = (($canEditOwn) && (JFactory::getUser()->id == $item->created_by)); //$user->authorise('core.edit.own', 'com_pedigree')): ?>
      <tr class="row<?php echo $i % 2; ?>">
        <?php if (isset($this->items[0]->state) && $canEditState): ?>
        <?php $class = (($canEdit || $isOwner) && $canEditState) ? 'active' : 'disabled'; ?>
        <td class="center"><a class="btn btn-micro <?php echo $class; ?>" href="<?php echo (($canEdit || $isOwner) && $canEditState) ? JRoute::_('index.php?option=com_pedigree&task=dog.publish&id=' . $item->id . '&state=' . (($item->state + 1) % 2), false, 2) : '#'; ?>">
          <?php if ($item->state == 1): ?>
          <i class="icon-publish"></i>
          <?php else: ?>
          <i class="icon-unpublish"></i>
          <?php endif; ?>
          </a></td>
        <?php endif; ?>
        <td>
        <?php if ($this->params->get('gen-imagethumbsenabled',1)==1 && isset($item->id_gallery_image)) { ?>
          <a class="btn btn-micro" href="<?php echo $PedHelper->iGallery->getImageLink($PedHelper->iGallery->getPicture($item->id_gallery_image), 'img'); ?>"><i class="icon-picture"></i></a>
        <?php } ?>
        </td>
        <td><?php if (isset($item->checked_out) && $item->checked_out && $canEditState) : ?>
          <?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'dogs.', $canCheckin); ?>
          <?php endif; ?>
          <span class="pedigree-sex-<?php echo strtolower($item->sex_name); ?>"><a href="<?php echo JRoute::_('index.php?option=com_pedigree&view=dog&id='.(int) $item->id); ?>"><?php echo $this->escape($item->name); ?></a></span></td>
        <td><?php if (isset($item->registrations)) { ?>
            <?php $i=0; ?>
            <?php foreach($item->registrations as $registration) { ?>
            <?php if ($i>0) : echo '<br />'; endif;?>
            <?php echo $this->escape($registration->registration_number); ?>
            <?php if (count($item->registrations) > 1) : echo ' ('.$registration->iso3.')'; endif; ?>
            <?php $i++; ?>
            <?php } ?>
          <?php } ?></td>
        <td><?php if ($item->birth_date != 'YYYY/MM/DD') : echo $item->birth_date; endif; ?></td>
        <td><?php echo $PedHelper->getColorHtml($item->id_color); ?></td>
        <td><?php echo $PedHelper->getPattern($item->id_pattern); ?></td>
        <td><?php if ($item->brs_number != '0') : echo $this->escape($item->brs_number); endif; ?></td>
        <td><?php if ($item->stud_number != '0') : echo $this->escape($item->stud_number); endif; ?></td>
        <td><?php if ($item->id_sire != '0') { ?>
          <a href="<?php echo JRoute::_('index.php?option=com_pedigree&view=dog&id='.(int) $item->id_sire); ?>"><?php echo $this->escape($item->sire_name);?></a>
          <?php } else { echo $this->escape($item->sire_name);}?></td>
        <td><?php if ($item->id_dam != '0') { ?>
          <a href="<?php echo JRoute::_('index.php?option=com_pedigree&view=dog&id='.(int) $item->id_dam); ?>"><?php echo $this->escape($item->dam_name);?></a>
          <?php } else { echo $this->escape($item->dam_name);}?></td>
        <?php if ($canEdit || $isOwner || $canDelete): ?>
        <td class="center"><div class="btn-group">
            <?php if ($canEdit || $isOwner): ?>
            <a href="<?php echo JRoute::_('index.php?option=com_pedigree&task=dog.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
            <?php endif; ?>
            <?php if ($canDelete): ?>
            <button data-item-id="<?php echo $item->id; ?>" class="btn btn-mini delete-button" type="button"><i class="icon-trash" ></i></button>
            <?php endif; ?>
          </div></td>
        <?php endif; ?>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
  <?php echo JHtml::_('form.token'); ?>
</form>
<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('.delete-button').click(deleteItem);
		
		// Add click event to all filter menu items.
		jQuery('.tglflt').click(function () { jQuery(jQuery(this).attr("id").toString().replace('tglflt-', '#')).val('').parents(".control-group").toggleClass("hide"); });
		jQuery('.control-label label').append('<a onclick="hideAndSubmit(this)"><i class="icon-delete"></i></a>');
		
		jQuery("[id^='filter_'][value='']").parents(".control-group").addClass("hide");
		jQuery("select[id^='filter_'] option[value='']:selected").parents(".control-group").addClass("hide");
		//jQuery("select[id^='filter_'] option:selected").filter("[value='']").parents(".control-group").addClass("hide");
		//alert(jQuery("[id^='filter_id_color']").val());
    });

	function resetFilters() {
		jQuery("[id^='filter_']").val('');
		jQuery('#adminForm').submit();
	}
	
	function hideAndSubmit(control) {
		jQuery(control).parents('.control-group').addClass('hide').find("[id^='filter_']").val('');
		jQuery('#adminForm').submit();
	}

    function deleteItem() {
        var item_id = jQuery(this).attr('data-item-id');
        if (confirm("<?php echo JText::_('COM_PEDIGREE_DELETE_MESSAGE'); ?>")) {
            window.location.href = '<?php echo JRoute::_('index.php?option=com_pedigree&task=dog.remove&id=', false, 2) ?>' + item_id;
        }
    }
</script> 
