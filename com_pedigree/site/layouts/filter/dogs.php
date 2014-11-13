<?php

?>

<fieldset id="filter-bar">
  <div class="filter-search fltlft">
    <input type="text" name="filter_name" id="filter_name" class="" value="<?php echo (!empty($filterName) ? $this->escape($filterName) : $filterNameDefault); ?>" title="<?php echo $filterNameDefault; ?>" onblur="if (this.value=='') this.value='<?php echo $filterNameDefault; ?>';" onfocus="if (this.value=='<?php echo $filterNameDefault; ?>') this.value='';" />
    <div class="btn-group">
      <button type="submit" class="btn btn-default"> <i class="icon-search"></i> </button>
      <button class="btn btn-default dropdown-toggle" data-toggle="dropdown"><strong>+/-</strong> <i class="icon-filter"></i> <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="#" class="tglflt-registration"><?php echo JText::_('COM_PEDIGREE_FORM_LBL_REGISTRATION_REGISTRATION_NUMBER'); ?></a></li>
        <li><a href="#" class="tglflt-brs-number"><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_BRS_NUMBER'); ?></a></li>
        <li><a href="#" class="tglflt-stud-number"><?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOG_STUD_NUMBER'); ?></a></li>
      </ul>
      <button type="button" onclick="resetFilters();" class="btn btn-default" title="<?php echo JText::_('COM_PEDIGREE_FORM_LBL_DOGS_CLEAR_FILTERS'); ?>"> <i class="icon-cancel"></i> </button>
    </div>
    <input type="text" id="filter_registration" name="filter_registration" value="<?php echo (!empty($filterRegistration) ? $this->escape($filterRegistration) : $filterRegistrationDefault); ?>" title="<?php echo $filterRegistrationDefault; ?>" onblur="if (this.value=='') this.value='<?php echo $filterRegistrationDefault; ?>';" onfocus="if (this.value=='<?php echo $filterRegistrationDefault; ?>') this.value='';" class="<?php echo ((!empty($filterRegistration) && $filterRegistration != $filterRegistrationDefault) ? '' : 'hide'); ?>"/>
    <input type="text" id="filter_brs_number" name="filter_brs_number" value="<?php echo (!empty($filterBRSNumber) ? $this->escape($filterBRSNumber) : $filterBRSNumberDefault); ?>" title="<?php echo $filterBRSNumberDefault; ?>" onblur="if (this.value=='') this.value='<?php echo $filterBRSNumberDefault; ?>';" onfocus="if (this.value=='<?php echo $filterBRSNumberDefault; ?>') this.value='';" class="<?php echo ((!empty($filterBRSNumber) && $filterBRSNumber != $filterBRSNumberDefault) ? '' : 'hide'); ?>"/>
    <input type="text" id="filter_stud_number" name="filter_stud_number" value="<?php echo (!empty($filterStudNumber) ? $this->escape($filterStudNumber) : $filterStudNumberDefault); ?>" title="<?php echo $filterStudNumberDefault; ?>" onblur="if (this.value=='') this.value='<?php echo $filterStudNumberDefault; ?>';" onfocus="if (this.value=='<?php echo $filterStudNumberDefault; ?>') this.value='';" class="<?php echo ((!empty($filterStudNumber) && $filterStudNumber != $filterStudNumberDefault) ? '' : 'hide'); ?>"/>
  </div>
</fieldset>
