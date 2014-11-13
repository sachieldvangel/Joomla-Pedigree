<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.form.formfield');
//jimport('joomla.form.helper'); 
//JFormHelper::loadFieldClass('list');
 
// The class name must always be the same as the filename (in camel case)
class JFormFieldSire extends JFormField {
 
	//The field class must know its own type through the variable $type.
	protected $type = 'Sire';
	
	public function __construct($form = null) {
		parent::__construct($form);
	}

	public function getInput() {
		// code that returns HTML that will be shown as the form field
		$html = array();
		//$options = array();
		//$doc = JFactory::getDocument();
		//$doc->addScript(JUri::base() . 'administrator/components/com_pedigree/models/fields/sire.js');
		
		// jQuery.ui Autocomplete: 
		$script = array();	
		$script[] = 'jQuery(function() { ';
		$script[] = '   jQuery( ".sire-autocomplete" ).autocomplete({ ';
		$script[] = '    source: function( request, response ) { ';
		$script[] = '      jQuery.ajax({ ';
		$script[] = '        url: "index.php?option=com_pedigree&view=acdogs&format=json&sex=1",';
		$script[] = '        dataType: "json",';
		$script[] = '        data: {';
		$script[] = '          q: request.term';
		$script[] = '        },';
		$script[] = '        success: function( data ) {';
		$script[] = '          response( data );';
		$script[] = '        }';
		$script[] = '      });';
		$script[] = '    },';
		$script[] = '    minLength: 3,';
		$script[] = '    select: function( event, ui ) {';
		$script[] = '      alert( ui.item ?';
		$script[] = '        "Selected: " + ui.item.label :';
		$script[] = '        "Nothing selected, input was " + this.value);';
		$script[] = '    },';
		$script[] = '    open: function() {';
		$script[] = '      jQuery( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );';
		$script[] = '    },';
		$script[] = '    close: function() {';
		$script[] = '      jQuery( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );';
		$script[] = '    }';
		$script[] = '  });';
		$script[] = '});';

		JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));
		$input_options = 'class="sire-autocomplete ui-autocomplete-input ui-corner-all ' . $this->getAttribute('class') . '"';		
		$html = '<input type="text" id="'.$this->id.'" name="'.$this->name.'" '.$input_options.'></input>';
		return $html;

		/*$script = array();		
		$script[] = '<script type="text/javascript">';
		$script[] = '   jQuery(document).ready(function () {';
		$script[] = '      jQuery(".ajax-autocomplete-sire").ajaxChosen({';
		$script[] = '         type: "GET",';
		$script[] = '         url: "index.php?option=com_pedigree&view=acdogs&format=json&sex=1",';
		$script[] = '         dataType: "json"';
		$script[] = '      }, ';
		$script[] = '      function (data) ';
		$script[] = '      {';
		$script[] = '         var terms = {};';
		$script[] = '         $.each(data, function (i, val) {';
		$script[] = '            terms[i] = val;';
		$script[] = '         });';
		$script[] = '         return terms;';
		$script[] = '      }).change(function () { ';

		$script[] = '         console.log($(".ajax-autocomplete-sire").val());';
		$script[] = '      });';
		$script[] = '   });';
		$script[] = '</script>';*/
		
		//JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));
		/*$input_options = 'class="ajax-autocomplete-sire ' . $this->getAttribute('class') . '"';
		$html[] = '<select id="'.$this->id.'" name="'.$this->name.'" title="'.JText::_('COM_PEDIGREE_FORM_HINT_DOG_SIRE').'" '.$input_options.'>';
		$html[] = '  <option value="0" selected>'.JText::_('COM_PEDIGREE_FORM_HINT_DOG_SIRE').'</option>';
		$html[] = '</select>';*/
		
		//$options[] = array("value" => 0, "text" => JText::_('COM_PEDIGREE_FORM_HINT_DOG_SIRE'));
		
		//return implode("\n", $html);
		//return $options;
	}
}