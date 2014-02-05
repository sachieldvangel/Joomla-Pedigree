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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_pedigree/assets/css/pedigree.css');
?>
<script type="text/javascript">
    js = jQuery.noConflict();
    js(document).ready(function(){
        
	js('input:hidden.id_person').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('id_personhidden')){
			js('#jform_id_person option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_id_person").trigger("liszt:updated");
	js('input:hidden.id_dog').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('id_doghidden')){
			js('#jform_id_dog option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_id_dog").trigger("liszt:updated");
    });
    
    Joomla.submitbutton = function(task)
    {
        if(task == 'owner.cancel'){
            Joomla.submitform(task, document.getElementById('owner-form'));
        }
        else{
            
            if (task != 'owner.cancel' && document.formvalidator.isValid(document.id('owner-form'))) {
                
                Joomla.submitform(task, document.getElementById('owner-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_pedigree&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="owner-form" class="form-validate">
    <div class="row-fluid">
        <div class="span10 form-horizontal">
            <fieldset class="adminform">

                			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('id_person'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('id_person'); ?></div>
			</div>

			<?php
				foreach((array)$this->item->id_person as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="id_person" name="jform[id_personhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('id_dog'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('id_dog'); ?></div>
			</div>

			<?php
				foreach((array)$this->item->id_dog as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="id_dog" name="jform[id_doghidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('is_primary'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('is_primary'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('date_start'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('date_start'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('date_end'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('date_end'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('state'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('created_by'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('created_by'); ?></div>
			</div>


            </fieldset>
        </div>

        <div class="clr"></div>

<?php if (JFactory::getUser()->authorise('core.admin','pedigree')): ?>
	<div class="fltlft" style="width:86%;">
		<fieldset class="panelform">
			<?php echo JHtml::_('sliders.start', 'permissions-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
			<?php echo JHtml::_('sliders.panel', JText::_('ACL Configuration'), 'access-rules'); ?>
			<?php echo $this->form->getInput('rules'); ?>
			<?php echo JHtml::_('sliders.end'); ?>
		</fieldset>
	</div>
<?php endif; ?>

        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>

    </div>
</form>