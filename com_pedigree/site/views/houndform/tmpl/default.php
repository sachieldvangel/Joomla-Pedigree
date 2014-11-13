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

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_pedigree', JPATH_ADMINISTRATOR);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/components/com_pedigree/assets/js/form.js');


if($this->item->state == 1){
	$state_string = 'Publish';
	$state_value = 1;
} else {
	$state_string = 'Unpublish';
	$state_value = 0;
}
if($this->item->id) {
	$canState = JFactory::getUser()->authorise('core.edit.state','com_pedigree.registration');
} else {
	$canState = JFactory::getUser()->authorise('core.edit.state','com_pedigree.registration.'.$this->item->id);
}
?>
</style>
<script type="text/javascript">
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function() {
        jQuery(document).ready(function() {
            jQuery('#form-hound').submit(function(event) {
                
            });

            
			jQuery('input:hidden.id_dog').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('id_doghidden')){
					jQuery('#jform_id_dog option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
					jQuery("#jform_id_dog").trigger("liszt:updated");
			jQuery('input:hidden.id_country').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('id_countryhidden')){
					jQuery('#jform_id_country option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
					jQuery("#jform_id_country").trigger("liszt:updated");
        });
    });

</script>

<div class="hound-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Edit <?php echo $this->item->id; ?></h1>
    <?php else: ?>
        <h1>Add</h1>
    <?php endif; ?>

    <form id="form-hound" action="<?php echo JRoute::_('index.php?option=com_pedigree&task=hound.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
        
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="validate btn btn-primary"><?php echo JText::_('JSUBMIT'); ?></button>
                <a class="btn" href="<?php echo JRoute::_('index.php?option=com_pedigree&task=houndform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            </div>
        </div>
        
        <input type="hidden" name="option" value="com_pedigree" />
        <input type="hidden" name="task" value="houndform.save" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>
