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
    js(document).ready(function() {
        
	js('input:hidden.id_dog').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('id_doghidden')){
			js('#jform_id_dog option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_id_dog").trigger("liszt:updated");
	js('input:hidden.id_country').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('id_countryhidden')){
			js('#jform_id_country option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_id_country").trigger("liszt:updated");
    });

    Joomla.submitbutton = function(task)
    {
        if (task == 'registration.cancel') {
            Joomla.submitform(task, document.getElementById('registration-form'));
        }
        else {
            
            if (task != 'registration.cancel' && document.formvalidator.isValid(document.id('registration-form'))) {
                
                Joomla.submitform(task, document.getElementById('registration-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_pedigree&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="registration-form" class="form-validate">

    <div class="form-horizontal">
        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_PEDIGREE_TITLE_REGISTRATION', true)); ?>
        <div class="row-fluid">
            <div class="span10 form-horizontal">
                <fieldset class="adminform">

                    			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
			</div>
			<div class="control-group">
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
				<div class="control-label"><?php echo $this->form->getLabel('id_country'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('id_country'); ?></div>
			</div>

			<?php
				foreach((array)$this->item->id_country as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="id_country" name="jform[id_countryhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('is_primary'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('is_primary'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('registration_number'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('registration_number'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('registration_name'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('registration_name'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('verified'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('verified'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('notes'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('notes'); ?></div>
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
        </div>
        <?php echo JHtml::_('bootstrap.endTab'); ?>
        
        <?php if (JFactory::getUser()->authorise('core.admin','pedigree')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'permissions', JText::_('COM_PEDIGREE_FIELDSET_RULES', true)); ?>
		<?php echo $this->form->getInput('rules'); ?>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
<?php endif; ?>

        <?php echo JHtml::_('bootstrap.endTabSet'); ?>

        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>

    </div>
</form>