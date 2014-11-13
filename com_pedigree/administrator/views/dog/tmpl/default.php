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
/*jimport('joomgallery.interface');
$iGallery = new JoomInterface();
$iGallery->addConfig('showhidden', '1');
$iGallery->getPageHeader();*/

$PedHelper = new PedigreeFrontendHelper();
$PedHelper->iGallery->getPageHeader();

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_pedigree', JPATH_ADMINISTRATOR);

// Load Pedigree CSS
$document = JFactory::getDocument();
$document->addStyleSheet('media/pedigree/css/pedigree.css', 'text/css');
//JHtml::_('jquery.ui');

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_pedigree.' . $this->item->id);
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_pedigree' . $this->item->id)) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>

<?php if ($this->item && $this->item->state == 1) : ?>

<div class="ped-dog">
  <div class="ped-doginfo row-fluid">
    <div class="ped-dogname span12">
       <div class="btn-group right">
        <?php if($canEdit && ($this->item->checked_out == 0 || $this->item->checked_out == JFactory::getUser()->id)): ?>
        <a class="btn btn-warning" href="<?php echo JRoute::_('index.php?option=com_pedigree&task=dog.edit&id='.$this->item->id); ?>" title="<?php echo JText::_("COM_PEDIGREE_EDIT_ITEM"); ?>"><i class="icon-edit" ></i></a>
        <?php endif; ?>
        <?php if(JFactory::getUser()->authorise('core.delete','com_pedigree.dog.'.$this->item->id)):?>
        <a class="btn btn-danger delete-button" title="<?php echo JText::_("COM_PEDIGREE_DELETE_ITEM"); ?>"><i class="icon-trash" ></i></a>
        <?php endif; ?>
      </div>
      <span class="ped-title"><?php echo $this->item->titles_prefix; ?></span> <span class="ped-regname"><?php echo $this->item->name; ?></span> <span class="ped-title"><?php echo $this->item->titles_suffix; ?></span> <br />
      <span class="ped-callname pedigree-sex-<?php echo strtolower($this->item->sex_name); ?>"><?php echo (($this->item->call_name != '') ? '"' : '').$this->item->call_name.(($this->item->call_name != '') ? '"' : ''); ?></span>


    </div>
  </div>
  <div class="row-fluid">
    <div id="sidebar" class="ped-image-container span5"> 
	  <div class="ped-image">
	  	<?php echo (($this->item->id_gallery_image)?$PedHelper->iGallery->displayDetail($PedHelper->iGallery->getPicture($this->item->id_gallery_image)):$PedHelper->iGallery->displayDetail($PedHelper->iGallery->getPicture(76997))); ?> 
      </div>
    </div>
    <nav class="navigation span7" role="navigation">
      <ul class="nav menu nav-tabs" role="tablist">
        <li class="active"><a href="#general" role="tab" data-toggle="tab"><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_TAB_GENERAL'); ?></a></li>
        <li><a href="#health" role="tab" data-toggle="tab"><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_TAB_HEALTH'); ?></a></li>
        <li><a href="#additional" role="tab" data-toggle="tab"><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_TAB_ADDITIONAL'); ?></a></li>
        <li><a href="#siblings" role="tab" data-toggle="tab"><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_TAB_SIBLINGS').' ('.(((isset($this->item->siblings->full)) ? count($this->item->siblings->full) : 0)+((isset($this->item->siblings->half)) ? count($this->item->siblings->half) : 0)).')'; ?></a></li>
        <li><a href="#offspring" role="tab" data-toggle="tab"><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_TAB_OFFSPRING').' ('.count($this->item->offspring).')'; ?></a></li>
        <li><a href="#gallery" role="tab" data-toggle="tab"><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_TAB_GALLERY'); ?></a></li>
        <li><a href="#actions" role="tab" data-toggle="tab"><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_TAB_ACTIONS'); ?></a></li>
      </ul>
      <div class="tab-content">
        <div id="general" class="tab-pane active">
          <div class="item_fields">
            <table class="table">
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_SIRE'); ?></th>
                <?php if (isset($this->item->sire_name)) { ?>
                <td><span class="pedigree-sex-male"><a href="<?php echo JRoute::_('index.php?option=com_pedigree&view=dog&id='.$this->item->id_sire); ?>"><?php echo $this->item->sire_name; ?></a></span></td>
                <?php } else { ?>
                <td><?php echo JText::_('COM_PEDIGREE_DOG_UNKNOWN'); ?></td>
                <?php } ?>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_DAM'); ?></th>
                <?php if (isset($this->item->dam_name)) { ?>
                <td><span class="pedigree-sex-female"><a href="<?php echo JRoute::_('index.php?option=com_pedigree&view=dog&id='.$this->item->id_dam); ?>"><?php echo $this->item->dam_name; ?></a></span></td>
                <?php } else { ?>
                <td><?php echo JText::_('COM_PEDIGREE_DOG_UNKNOWN'); ?></td>
                <?php } ?>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_BIRTH_DATE'); ?></th>
                <td><?php echo $this->item->birth_date; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_REGISTRATIONS'); ?></th>
                <td><?php if (isset($this->item->registrations)) { ?>
                    <?php $i=0; ?>
                    <?php foreach($this->item->registrations as $registration) { ?>
                    <?php if ($i>0) : echo '<br />'; endif;?>
                    <?php echo $registration->registration_number.' '.$PedHelper->getCountryFlagHtml($registration->id_country); ?>
                    <?php $i++; ?>
                    <?php } ?>
                  <?php } ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_BREEDERS'); ?></th>
                <td><?php if (isset($this->item->breeders)) { ?>
                    <?php $i=0; ?>
                    <?php foreach($this->item->breeders as $breeder) { ?>
                    <?php if ($i>0) : echo '<br />'; endif;?>
                    <?php //echo stristr($breeder->last_name, ' (', true).', '.$breeder->first_name.' ('.(($breeder->kennel_name != '') ? $breeder->kennel_name.' - ' : '').$PedHelper->getCountryFlagHtml($breeder->id_country).')'; ?>
					<?php echo trim($breeder->first_name.' '.stristr($breeder->last_name, ' (', true).' ('.(($breeder->kennel_name != '') ? $breeder->kennel_name.' - ' : '').$breeder->iso3.')'); ?>
                    <?php $i++; ?>
                    <?php } ?>
                  <?php } ?></td>
              </tr>
              
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_OWNERS'); ?></th>
                <td><?php if (isset($this->item->owners)) { ?>
                    <?php $i=0; ?>
                    <?php foreach($this->item->owners as $owner) { ?>
                    <?php if ($i>0) : echo '<br />'; endif;?>
                    <?php //echo stristr($owner->last_name, ' (', true).', '.$owner->first_name.' ('.(($owner->kennel_name != '') ? $owner->kennel_name.' - ' : '').$PedHelper->getCountryFlagHtml($owner->id_country).')'; ?>
                    <?php echo trim($owner->first_name.' '.stristr($owner->last_name, ' (', true).' ('.(($owner->kennel_name != '') ? $owner->kennel_name.' - ' : '').$owner->iso3.')'); ?>
                    <?php $i++; ?>
                    <?php } ?>
                  <?php } ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_COLOR'); ?> &amp; <?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_PATTERN'); ?></th>
                <td><?php echo trim($PedHelper->getColorHtml($this->item->id_color, 'icontext').' - '.$PedHelper->getPattern($this->item->id_pattern), ' - '); ?></td>
                  </td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_COLOR_VARIATIONS'); ?></th>
                <td><?php echo $this->item->color_variations; ?></td>
              </tr>
            </table>
          </div>
        </div>
        <div id="health" class="tab-pane">
          <div class="item_fields">
            <table class="table">
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_COI'); ?></th>
                <td><?php echo $this->item->coi; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_MICROCHIP'); ?></th>
                <td><?php echo $this->item->microchip; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_DNA_PROFILE'); ?></th>
                <td><?php echo $this->item->dna_profile; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_CHIC_NUMBER'); ?></th>
                <td><?php echo $this->item->chic_number; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_HEALTH_TEST_THYROID'); ?></th>
                <td><?php echo $this->item->health_test_thyroid; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_HEALTH_TEST_ELBOW'); ?></th>
                <td><?php echo $this->item->health_test_elbow; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_HEALTH_TEST_HIPS'); ?></th>
                <td><?php echo $this->item->health_test_hips; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_HEALTH_TEST_EYES'); ?></th>
                <td><?php echo $this->item->health_test_eyes; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_HEALTH_TEST_HEART'); ?></th>
                <td><?php echo $this->item->health_test_heart; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_HEALTH_NOTES'); ?></th>
                <td><?php echo $this->item->health_notes; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_DEATH_DATE'); ?></th>
                <td><?php echo $this->item->death_date; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_DEATH_CAUSE'); ?></th>
                <td><?php echo $this->item->death_cause; ?></td>
              </tr>
              <?php if ($this->item->sex==1) { ?>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_IS_STUD'); ?></th>
                <td><i class="icon-checkbox-<?php echo ($this->item->is_stud == 1) ? 'checked' : 'unchecked'; ?>"></i></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_STUD_DETAILS'); ?></th>
                <td><?php echo $this->item->stud_details; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_IS_SEMEN'); ?></th>
                <td><i class="icon-checkbox-<?php echo ($this->item->is_semen == 1) ? 'checked' : 'unchecked'; ?>"></i></td>
              </tr>
              <?php } ?>
            </table>
          </div>
        </div>
        <div id="additional" class="tab-pane">
          <div class="item_fields">
            <table class="table">
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_AWARDS'); ?></th>
                <td><?php echo $this->item->awards; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_IS_SCENTED'); ?></th>
                <td><i class="icon-checkbox-<?php echo ($this->item->is_scented == 1) ? 'checked' : 'unchecked'; ?>"></i></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_IS_SMOOTH'); ?></th>
                <td><i class="icon-checkbox-<?php echo ($this->item->is_smooth == 1) ? 'checked' : 'unchecked'; ?>"></i></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_IS_BEARDED'); ?></th>
                <td><i class="icon-checkbox-<?php echo ($this->item->is_bearded == 1) ? 'checked' : 'unchecked'; ?>"></i></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_STUD_NUMBER'); ?></th>
                <td><?php echo $this->item->stud_number; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_BRS_NUMBER'); ?></th>
                <td><?php echo $this->item->brs_number; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ATC_NUMBER'); ?></th>
                <td><?php echo $this->item->atc_number; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_VIDEOS'); ?></th>
                <td><?php echo $this->item->videos; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ARTICLES'); ?></th>
                <td><?php echo $this->item->articles; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_NOTES'); ?></th>
                <td><?php echo $this->item->notes; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_SOURCE'); ?></th>
                <td><?php echo $this->item->source; ?></td>
              </tr>
              <tr>
                <th><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_CREATED_BY'); ?></th>
                <td><?php echo $this->item->created_by_name; ?></td>
              </tr>
            </table>
          </div>
        </div>
        <div id="siblings" class="tab-pane">
          <h4><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_FULL_SIBLINGS'); ?></h4>
          <div class="item_fields">
            <table class="table table-striped" id="dogList">
              <thead>
                <tr>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_NAME'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_REGISTRATION'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_BIRTH_DATE'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_COLOR'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_PATTERN'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_BRS_NUMBER'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_STUD_NUMBER'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($this->item->siblings->full)) { ?>
                  <?php foreach ($this->item->siblings->full as $i => $sibling) { ?>
                  <tr class="row<?php echo $i % 2; ?>">
                    <td><span class="pedigree-sex-<?php echo $sibling->sex; ?>"><a href="<?php echo JRoute::_('index.php?option=com_pedigree&view=dog&id='.(int) $sibling->id); ?>"><?php echo $this->escape($sibling->name); ?></a></span></td>
                    <td><?php echo $sibling->registration_number; ?></td>
                    <td><?php echo $sibling->birth_date; ?></td>
                    <td><?php echo $PedHelper->getColorHtml($sibling->id_color, 'icontext'); ?></td>
                    <td><?php echo $PedHelper->getPattern($sibling->id_pattern); ?></td>
                    <td><?php if ($sibling->brs_number != '0') : echo $sibling->brs_number; endif; ?></td>
                    <td><?php if ($sibling->stud_number != '0') : echo $sibling->stud_number; endif; ?></td>
                  </tr>
                  <?php }} ?>
              </tbody>
            </table>
          </div>
          <h4><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_HALF_SIBLINGS'); ?></h4>
          <div class="item_fields">
            <table class="table table-striped" id="dogList">
              <thead>
                <tr>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_NAME'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_REGISTRATION'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_BIRTH_DATE'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_COLOR'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_PATTERN'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_BRS_NUMBER'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_STUD_NUMBER'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($this->item->siblings->half)) { ?>
                  <?php foreach ($this->item->siblings->half as $i => $sibling) { ?>
                  <tr class="row<?php echo $i % 2; ?>">
                    <td><span class="pedigree-sex-<?php echo $sibling->sex; ?>"><a href="<?php echo JRoute::_('index.php?option=com_pedigree&view=dog&id='.(int) $sibling->id); ?>"><?php echo $this->escape($sibling->name); ?></a></span></td>
                    <td><?php echo $sibling->registration_number; ?></td>
                    <td><?php echo $sibling->birth_date; ?></td>
                    <td><?php echo $PedHelper->getColorHtml($sibling->id_color, 'icontext'); ?></td>
                    <td><?php echo $PedHelper->getPattern($sibling->id_pattern); ?></td>
                    <td><?php if ($sibling->brs_number != '0') : echo $sibling->brs_number; endif; ?></td>
                    <td><?php if ($sibling->stud_number != '0') : echo $sibling->stud_number; endif; ?></td>
                  </tr>
                  <?php }} ?>
              </tbody>
            </table>
          </div>
        </div>
        <div id="offspring" class="tab-pane">
          <div class="item_fields">
            <table class="table table-striped" id="dogList">
              <thead>
                <tr>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_NAME'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_REGISTRATION'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_BIRTH_DATE'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_COLOR'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_ID_PATTERN'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_BRS_NUMBER'); ?></th>
                  <th class='left'><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_STUD_NUMBER'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($this->item->offspring as $i => $offspring) : ?>
                <tr class="row<?php echo $i % 2; ?>">
                  <td><span class="pedigree-sex-<?php echo $offspring->sex; ?>"><a href="<?php echo JRoute::_('index.php?option=com_pedigree&view=dog&id='.(int) $offspring->id); ?>"><?php echo $this->escape($offspring->name); ?></a></span></td>
                  <td><?php echo $offspring->registration_number; ?></td>
                  <td><?php echo $offspring->birth_date; ?></td>
                  <td><?php echo $PedHelper->getColorHtml($offspring->id_color, 'icontext'); ?></td>
                  <td><?php echo $PedHelper->getPattern($offspring->id_pattern); ?></td>
                  <td><?php if ($offspring->brs_number != '0') : echo $offspring->brs_number; endif; ?></td>
                  <td><?php if ($offspring->stud_number != '0') : echo $offspring->stud_number; endif; ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div id="gallery" class="tab-pane">
          <div class="ped-image-category"><?php echo $PedHelper->iGallery->displayThumbs($PedHelper->iGallery->getPicsByCategory($this->item->id_gallery_category)); ?></div>
        </div>
        <div id="actions" class="tab-pane">
          <div class="item_fields">
            <table class="table">
              <tr>
                <th><a href="#">Test Mating</a></th>
              </tr>
              <?php if($canEdit && $this->item->checked_out == 0): ?>
              <tr>
                <th><a href="<?php echo JRoute::_('index.php?option=com_pedigree&task=dog.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_PEDIGREE_EDIT_ITEM"); ?></a></th>
              </tr>
              <?php endif; ?>
              <?php if(JFactory::getUser()->authorise('core.delete','com_pedigree.dog.'.$this->item->id)):?>
              <tr>
                <th><a href="<?php echo JRoute::_('index.php?option=com_pedigree&task=dog.remove&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("COM_PEDIGREE_DELETE_ITEM"); ?> </a></th>
              </tr>
              <?php endif; ?>
            </table>
          </div>
        </div>
      </div>
    </nav>
  </div>
  <div class="clearfix"></div>
  <div class="ped-pedigree-container row-fluid">
    <h2 class="center">Pedigree</h2>
    <form id="pedigree-limit" class="center form-inline">
      <input type="hidden" name="option" value="com_pedigree">
      <input type="hidden" name="view" value="pedigree">
      <input type="hidden" name="format" value="phtml">
      <input type="hidden" name="id" value="<?php echo $this->item->id; ?>">
      <label for="pedigree-limit-limit">Generations: </label>
      <span><?php echo $this->state->params->get('gen-min', 1); ?></span>
      <input type="range" id="pedigree-limit-limit" name="limit" min="<?php echo $this->state->params->get('gen-min', 1); ?>" max="<?php echo $this->state->params->get('gen-max', 10); ?>" value="<?php echo $this->state->params->get('gen-default', 4); ?>" title="Generations" onchange="updatePedigreeLimit()">
      <span><?php echo $this->state->params->get('gen-max', 10); ?></span>
      
      <div class="btn-group">
      	<?php if ($this->state->params->get('gen-imagethumbsenabled', 1)) { ?>
        <button type="button" id="pedigree-thumbs-check" class="btn btn-default<?php echo (($this->state->params->get('gen-imagethumbs', 1)) ? ' active' : ''); ?>">Thumbnails</button>
        <?php } ?>
        <button type="button" id="pedigree-colors-check" class="btn btn-default<?php echo (($this->state->params->get('gen-occurancecolors', 1)) ? ' active' : ''); ?>">Colors</button>
        <button type="button" id="pedigree-regnumbers-check" class="btn btn-default<?php echo (($this->state->params->get('gen-regnumber', 0)) ? ' active' : ''); ?>">Registrations</button>
        <button type="button" id="pedigree-titles-check" class="btn btn-default<?php echo (($this->state->params->get('gen-titles', 0)) ? ' active' : ''); ?>">Titles</button>
      </div>
    </form>
    <div id="ped-pedigree-content"></div>
  </div>
  
  <script type="text/javascript">
	
    jQuery(document).ready(function() {
		jQuery('.delete-button').click(deleteItem);
		updatePedigreeLimit();
    });
	
	function updatePedigreeLimit() {
		jQuery.post('index.php', jQuery("form#pedigree-limit").serializeArray() ,function(result){                     
                      //edit the result here
				jQuery("#ped-pedigree-content").addClass("hidden");
				//alert( "hidden" );
				jQuery("#ped-pedigree-content").html(result);
				//alert( "html inserted" );
				if (typeof Slimbox == 'object'){
					Slimbox.scanPage();
				}
				//alert( "scanPage done" );
				toggleAll();
				//alert( "all toggled" );
				jQuery("#ped-pedigree-content").removeClass("hidden");
				//alert( "unhidden" );
			   })
		  .done(function() {
			//alert( "second success" );
		  })
		  .fail(function() {
			//alert( "error" );
		  })
		  .always(function() {
			//alert( "finished" );
			//document.body.style.cursor  = 'default';
		});
	   //document.getElementById("ped-pedigree-container").innerHTML = jQuery("form#pedigree-limit").serialize();
	}
	
	function toggleState(buttonItem, searchItem, classToggle) {
		if (jQuery( buttonItem ).hasClass("active")) {
			jQuery( searchItem ).removeClass( classToggle );
		} else {
			jQuery( searchItem ).addClass( classToggle );	
		}
	}
	
	function toggleAll() {
		toggleState("#pedigree-thumbs-check", ".ped-pedigree-thumbnail", "hidden");
		toggleState("#pedigree-colors-check", '[class*="ped-pedigree-occur"]', "no-color");
		toggleState("#pedigree-regnumbers-check", ".ped-pedigree-regnumber", "hidden");
		toggleState("#pedigree-titles-check", '.ped-pedigree-title', "hidden");
	}
	
	jQuery('body').on('click','#pedigree-thumbs-check', function() {
		jQuery(this).toggleClass('active');
		toggleState("#pedigree-thumbs-check", ".ped-pedigree-thumbnail", "hidden");
	} );

	jQuery('body').on('click','#pedigree-colors-check', function() {
		jQuery(this).toggleClass('active');
		toggleState("#pedigree-colors-check", '[class*="ped-pedigree-occur"]', "no-color");
	} );
	
	jQuery('body').on('click','#pedigree-regnumbers-check', function() {
		jQuery(this).toggleClass('active');
		toggleState("#pedigree-regnumbers-check", ".ped-pedigree-regnumber", "hidden");
	} );
	
	jQuery('body').on('click','#pedigree-titles-check', function() {
		jQuery(this).toggleClass('active');
		toggleState("#pedigree-titles-check", '.ped-pedigree-title', "hidden");
	} );

    function deleteItem() {
        var item_id = jQuery(this).attr('data-item-id');
        if (confirm("<?php echo JText::_('COM_PEDIGREE_DELETE_MESSAGE'); ?>")) {
            window.location.href = '<?php echo JRoute::_('index.php?option=com_pedigree&task=dog.remove&id=', false, 2) ?>' + item_id;
        }
    }
	
	</script> 
</div>
<?php
else:
    echo JText::_('COM_PEDIGREE_ITEM_NOT_LOADED');
endif;
?>
