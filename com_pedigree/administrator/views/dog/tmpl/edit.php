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
        
	js('input:hidden.id_sire').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('id_sirehidden')){
			js('#jform_id_sire option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_id_sire").trigger("liszt:updated");
	js('input:hidden.id_dam').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('id_damhidden')){
			js('#jform_id_dam option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_id_dam").trigger("liszt:updated");
	js('input:hidden.id_color').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('id_colorhidden')){
			js('#jform_id_color option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_id_color").trigger("liszt:updated");
	js('input:hidden.id_pattern').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('id_patternhidden')){
			js('#jform_id_pattern option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_id_pattern").trigger("liszt:updated");
    });

    Joomla.submitbutton = function(task)
    {
        if (task == 'dog.cancel') {
            Joomla.submitform(task, document.getElementById('dog-form'));
        }
        else {
            
            if (task != 'dog.cancel' && document.formvalidator.isValid(document.id('dog-form'))) {
                
                Joomla.submitform(task, document.getElementById('dog-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_pedigree&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="dog-form" class="form-validate">

    <div class="form-horizontal">
        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_PEDIGREE_TITLE_DOG', true)); ?>
        <div class="row-fluid">
            <div class="span10 form-horizontal">
                <fieldset class="adminform">

                    			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('name'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('name'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('id_sire'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('id_sire'); ?></div>
			</div>

			<?php
				foreach((array)$this->item->id_sire as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="id_sire" name="jform[id_sirehidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('id_dam'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('id_dam'); ?></div>
			</div>

			<?php
				foreach((array)$this->item->id_dam as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="id_dam" name="jform[id_damhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('sex'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('sex'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('birth_date'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('birth_date'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('call_name'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('call_name'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('id_gallery_image'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('id_gallery_image'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('id_gallery_category'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('id_gallery_category'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('coi'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('coi'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('stud_number'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('stud_number'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('brs_number'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('brs_number'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('atc_number'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('atc_number'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('id_color'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('id_color'); ?></div>
			</div>

			<?php
				foreach((array)$this->item->id_color as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="id_color" name="jform[id_colorhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('color_variations'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('color_variations'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('id_pattern'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('id_pattern'); ?></div>
			</div>

			<?php
				foreach((array)$this->item->id_pattern as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="id_pattern" name="jform[id_patternhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('is_scented'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('is_scented'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('is_smooth'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('is_smooth'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('is_bearded'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('is_bearded'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('titles_prefix'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('titles_prefix'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('titles_suffix'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('titles_suffix'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('awards'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('awards'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('microchip'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('microchip'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('dna_profile'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('dna_profile'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('chic_number'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('chic_number'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('health_test_thyroid'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('health_test_thyroid'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('health_test_elbow'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('health_test_elbow'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('health_test_hips'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('health_test_hips'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('health_test_eyes'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('health_test_eyes'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('health_test_heart'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('health_test_heart'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('health_notes'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('health_notes'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('death_date'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('death_date'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('death_cause'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('death_cause'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('is_stud'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('is_stud'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('stud_details'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('stud_details'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('is_semen'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('is_semen'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('videos'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('videos'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('articles'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('articles'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('notes'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('notes'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('source'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('source'); ?></div>
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