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
	$canState = JFactory::getUser()->authorise('core.edit.state','com_pedigree.people');
} else {
	$canState = JFactory::getUser()->authorise('core.edit.state','com_pedigree.people.'.$this->item->id);
}
?>
</style>
<script type="text/javascript">
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function() {
        jQuery(document).ready(function() {
            jQuery('#form-people').submit(function(event) {
                
            });

            
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

<div class="people-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Edit <?php echo $this->item->id; ?></h1>
    <?php else: ?>
        <h1>Add</h1>
    <?php endif; ?>

    <form id="form-people" action="<?php echo JRoute::_('index.php?option=com_pedigree&task=people.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
        
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('first_name'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('first_name'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('last_name'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('last_name'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('address1'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('address1'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('address2'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('address2'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('city'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('city'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('province'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('province'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('postal_code'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('postal_code'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('id_country'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('id_country'); ?></div>
	</div>
	<?php foreach((array)$this->item->id_country as $value): ?>
		<?php if(!is_array($value)): ?>
			<input type="hidden" class="id_country" name="jform[id_countryhidden][<?php echo $value; ?>]" value="<?php echo $value; ?>" />';
		<?php endif; ?>
	<?php endforeach; ?>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('home_phone'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('home_phone'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('email'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('email'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('website'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('website'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('fb_profile'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('fb_profile'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('kennel_name'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('kennel_name'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('notes'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('notes'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('is_judge'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('is_judge'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('judge_info'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('judge_info'); ?></div>
	</div>
	<div class="control-group">
		<?php if(!$canState): ?>
			<div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
			<div class="controls"><?php echo $state_string; ?></div>
			<input type="hidden" name="jform[state]" value="<?php echo $state_value; ?>" />
		<?php else: ?>
			<div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('state'); ?></div>
		<?php endif; ?>
	</div>

	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('created_by'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('created_by'); ?></div>
	</div>				<div class="fltlft" <?php if (!JFactory::getUser()->authorise('core.admin','pedigree')): ?> style="display:none;" <?php endif; ?> >
                <?php echo JHtml::_('sliders.start', 'permissions-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
                <?php echo JHtml::_('sliders.panel', JText::_('ACL Configuration'), 'access-rules'); ?>
                <fieldset class="panelform">
                    <?php echo $this->form->getLabel('rules'); ?>
                    <?php echo $this->form->getInput('rules'); ?>
                </fieldset>
                <?php echo JHtml::_('sliders.end'); ?>
            </div>
				<?php if (!JFactory::getUser()->authorise('core.admin','pedigree')): ?>
                <script type="text/javascript">
                    jQuery.noConflict();
                    jQuery('.tab-pane select').each(function(){
                       var option_selected = jQuery(this).find(':selected');
                       var input = document.createElement("input");
                       input.setAttribute("type", "hidden");
                       input.setAttribute("name", jQuery(this).attr('name'));
                       input.setAttribute("value", option_selected.val());
                       document.getElementById("form-people").appendChild(input);
                    });
                </script>
             <?php endif; ?>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="validate btn btn-primary"><?php echo JText::_('JSUBMIT'); ?></button>
                <a class="btn" href="<?php echo JRoute::_('index.php?option=com_pedigree&task=peopleform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            </div>
        </div>
        
        <input type="hidden" name="option" value="com_pedigree" />
        <input type="hidden" name="task" value="peopleform.save" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>
