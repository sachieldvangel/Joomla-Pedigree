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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
//JHtml::_('formbehavior.ajaxchosen', $chosenAjaxSettings);

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_pedigree', JPATH_ADMINISTRATOR);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . 'components/com_pedigree/assets/js/form.js');

// autocomplete functionality
JHtml::_('jquery.ui', array('core', 'widget', 'position'));
$doc->addScript(JUri::base() . 'media/pedigree/js/jui/jquery.ui.menu.js');
$doc->addScript(JUri::base() . 'media/pedigree/js/jui/jquery.ui.autocomplete.js');
//$doc->addScript(JUri::base() . 'media/jui/ajax-chosen.js');

$document = JFactory::getDocument();
$document->addStyleSheet('media/pedigree/css/pedigree.css', 'text/css');
$document->addStyleSheet('media/pedigree/css/jquery.ui.menu.css', 'text/css');
$document->addStyleSheet('media/pedigree/css/jquery.ui.autocomplete.css', 'text/css');
$document->addStyleSheet('media/pedigree/css/jquery.ui.autocomplete.bootstrap.css', 'text/css');

$PedHelper = new PedigreeFrontendHelper();
$PedHelper->iGallery->getPageHeader();


if($this->item->state == 1){
	$state_string = 'Publish';
	$state_value = 1;
} else {
	$state_string = 'Unpublish';
	$state_value = 0;
}
if($this->item->id) {
	$canState = JFactory::getUser()->authorise('core.edit.state','com_pedigree.dog');
} else {
	$canState = JFactory::getUser()->authorise('core.edit.state','com_pedigree.dog.'.$this->item->id);
}
?>

<div class="ped-dogedit front-end-edit">
  <form id="form-dog" action="<?php echo JRoute::_('index.php?option=com_pedigree&task=dog.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
    <div class="row-fluid">
      <div class="ped-dogname span12"> 
      <div class="btn-group right">
          <button type="submit" class="validate btn btn-success"><?php echo JText::_('JSUBMIT'); ?></button>
          <a class="btn" href="<?php echo JRoute::_('index.php?option=com_pedigree&task=ownerform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
      </div>
      <span class="ped-regname">
        <?php if (!empty($this->item->id)): ?>
        <?php echo sprintf(JText::_('COM_PEDIGREE_DOGS_EDIT'), $this->item->name); ?>
        <?php else: ?>
        <?php echo sprintf(JText::_('COM_PEDIGREE_DOGS_ADD'), $this->state->params->get('breed', 'dog')); ?>
        <?php endif; ?>
        </span> </div>
    </div>
    <div class="row-fluid">
      <div id="sidebar" class="ped-image-container span5">
        <div class="ped-image"> <?php echo $PedHelper->iGallery->displayDetail($PedHelper->iGallery->getPicture($this->item->id_gallery_image)); ?> </div>
        <div id="ped-imagebar" class="control-group">
          <div class="btn-group controls"> <a id="id_gallery_image_add" class="btn dropdown-toggle" data-toggle="dropdown"><?php echo (($this->item->id_gallery_image == 0) ? JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_GALLERY_IMAGE_ADD') : JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_GALLERY_IMAGE_CHANGE')); ?> <i class="<?php echo (($this->item->id_gallery_image == 0) ? 'icon-new' : 'icon-edit'); ?>"></i> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="">Select from Gallery</a></li>
              <li><a href="">Upload</a></li>
            </ul>
          </div>
          <?php if ($this->item->id_gallery_image != 0) { ?>
          <a id="id_gallery_image_delete" class="btn" ><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_GALLERY_IMAGE_DELETE'); ?> <i class="icon-delete"></i></a>
          <?php } ?>
          <input name="id_gallery_image" type="hidden" value="<?php echo $this->item->id_gallery_image; ?>"/>
        </div>
      </div>
      <nav class="navigation span7" role="navigation">
        <ul class="nav menu nav-tabs" role="tablist">
          <?php $i=1; ?>
          <?php foreach ($this->form->getFieldsets() as $fieldset) { ?>
            <?php if (isset($fieldset) && !isset($fieldset->hidden)) {?>
              <li <?php echo (($i==1)?' class="active"':''); ?>><a href="#<?php echo JText::_($fieldset->name); ?>" role="tab" data-toggle="tab"><?php echo JText::_($fieldset->label); ?></a></li>
              <?php $i+=1; ?>
            <?php } ?>
          <?php } ?>
        </ul>
        <div class="tab-content">
          <?php $i=1; ?>
          <?php foreach ($this->form->getFieldsets() as $fieldset) { ?>
            <?php if (isset($fieldset)) { ?>
			  <?php switch ($fieldset->name) { 
			  		  case "registrations": ?>
                  <div id="<?php echo JText::_($fieldset->name); ?>" class="tab-pane<?php if ($i==1) : echo ' active'; endif;?>">
                    <div class="item_fields"> <?php echo $this->form->renderFieldset($fieldset->name); ?> </div>
                  </div>
                  <?php break; ?>
              	<?php case "breeders": ?>
                  <div id="<?php echo JText::_($fieldset->name); ?>" class="tab-pane<?php if ($i==1) : echo ' active'; endif;?>">
                    <div class="item_fields"> <?php echo $this->form->renderFieldset($fieldset->name); ?> </div>
                  </div>
                  <?php break; ?>
              	<?php case "owners": ?>
                  <div id="<?php echo JText::_($fieldset->name); ?>" class="tab-pane<?php if ($i==1) : echo ' active'; endif;?>">
                    <div class="item_fields"> <?php echo $this->form->renderFieldset($fieldset->name); ?> </div>
                  </div>
                  <?php break; ?>
                <?php default: ?>
                  <div id="<?php echo JText::_($fieldset->name); ?>" class="tab-pane<?php if ($i==1) : echo ' active'; endif;?>">
                    <div class="item_fields"> <?php echo $this->form->renderFieldset($fieldset->name); ?> </div>
                  </div>
                  <?php break; ?>
              <?php } ?>
              <?php $i+=1; ?>
            <?php } ?>
          <?php } ?>
        </div>
      </nav>
    </div>
    <input type="hidden" name="option" value="com_pedigree" />
    <input type="hidden" name="task" value="dogform.save" />
    <?php echo JHtml::_('form.token'); ?>
  </form>
</div>
<script type="text/javascript">
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function() {
        jQuery(document).ready(function() {
            jQuery('#form-dog').submit(function(event) {
                
            });

            
			/*jQuery('input:hidden.id_sire').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('id_sirehidden')){
					jQuery('#jform_id_sire option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
					jQuery("#jform_id_sire").trigger("liszt:updated");
			jQuery('input:hidden.id_dam').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('id_damhidden')){
					jQuery('#jform_id_dam option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
					jQuery("#jform_id_dam").trigger("liszt:updated");
			jQuery('input:hidden.id_color').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('id_colorhidden')){
					jQuery('#jform_id_color option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
					jQuery("#jform_id_color").trigger("liszt:updated");
			jQuery('input:hidden.id_pattern').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('id_patternhidden')){
					jQuery('#jform_id_pattern option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
					jQuery("#jform_id_pattern").trigger("liszt:updated");*/
        });
    });

</script>