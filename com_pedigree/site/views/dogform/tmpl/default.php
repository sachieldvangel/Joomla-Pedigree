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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_pedigree', JPATH_ADMINISTRATOR);
?>

<!-- Styling for making front end forms look OK -->
<!-- This should probably be moved to the template CSS file -->
<style>
    .front-end-edit ul {
        padding: 0 !important;
    }
    .front-end-edit li {
        list-style: none;
        margin-bottom: 6px !important;
    }
    .front-end-edit label {
        margin-right: 10px;
        display: block;
        float: left;
        text-align: center;
        width: 200px !important;
    }
    .front-end-edit .radio label {
        float: none;
    }
    .front-end-edit .readonly {
        border: none !important;
        color: #666;
    }    
    .front-end-edit #editor-xtd-buttons {
        height: 50px;
        width: 600px;
        float: left;
    }
    .front-end-edit .toggle-editor {
        height: 50px;
        width: 120px;
        float: right;
    }

    #jform_rules-lbl{
        display:none;
    }

    #access-rules a:hover{
        background:#f5f5f5 url('../images/slider_minus.png') right  top no-repeat;
        color: #444;
    }

    fieldset.radio label{
        width: 50px !important;
    }
</style>
<script type="text/javascript">
    function getScript(url,success) {
        var script = document.createElement('script');
        script.src = url;
        var head = document.getElementsByTagName('head')[0],
        done = false;
        // Attach handlers for all browsers
        script.onload = script.onreadystatechange = function() {
            if (!done && (!this.readyState
                || this.readyState == 'loaded'
                || this.readyState == 'complete')) {
                done = true;
                success();
                script.onload = script.onreadystatechange = null;
                head.removeChild(script);
            }
        };
        head.appendChild(script);
    }
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',function() {
        js = jQuery.noConflict();
        js(document).ready(function(){
            js('#form-dog').submit(function(event){
                 
            }); 
        
            
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
    });
    
</script>

<div class="dog-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Edit <?php echo $this->item->id; ?></h1>
    <?php else: ?>
        <h1>Add</h1>
    <?php endif; ?>

    <form id="form-dog" action="<?php echo JRoute::_('index.php?option=com_pedigree&task=dog.save'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
        <ul>
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
				<?php $canState = false; ?>
				<?php if($this->item->id): ?>
					<?php $canState = $canState = JFactory::getUser()->authorise('core.edit.state','com_pedigree.dog'); ?>
				<?php else: ?>
					<?php $canState = JFactory::getUser()->authorise('core.edit.state','com_pedigree.dog.'.$this->item->id); ?>
				<?php endif; ?>				<?php if(!$canState): ?>
				<div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
					<?php
						$state_string = 'Unpublish';
						$state_value = 0;
						if($this->item->state == 1):
							$state_string = 'Publish';
							$state_value = 1;
						endif;
					?>
					<div class="controls"><?php echo $state_string; ?></div>
					<input type="hidden" name="jform[state]" value="<?php echo $state_value; ?>" />
				<?php else: ?>
					<div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('state'); ?></div>					<?php endif; ?>
				</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('created_by'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('created_by'); ?></div>
			</div>
				<div class="fltlft" <?php if (!JFactory::getUser()->authorise('core.admin','pedigree')): ?> style="display:none;" <?php endif; ?> >
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
                       document.getElementById("form-dog").appendChild(input);
                       jQuery(this).attr('disabled',true);
                    });
                </script>
             <?php endif; ?>
        </ul>

        <div>
            <button type="submit" class="validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>
            <?php echo JText::_('or'); ?>
            <a href="<?php echo JRoute::_('index.php?option=com_pedigree&task=dog.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>

            <input type="hidden" name="option" value="com_pedigree" />
            <input type="hidden" name="task" value="dogform.save" />
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </form>
</div>
