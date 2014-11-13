<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.form.formfield');
//jimport('joomla.form.helper'); 
//JFormHelper::loadFieldClass('list');
 
// The class name must always be the same as the filename (in camel case)
class JFormFieldJuiautocomplete extends JFormField {
 
	//The field class must know its own type through the variable $type.
	protected $type = 'Juiautocomplete';
	protected $url = '';
	protected $dataType = 'json';
	protected $minLength = 3;
	protected $hiddenId = '';
	protected $mustExist = true;
	
	public function __construct($form = null) {
		parent::__construct($form);
	}
	
	/**
	 * Method to get certain otherwise inaccessible properties from the form field object.
	 *
	 * @param   string  $name  The property name for which to the the value.
	 *
	 * @return  mixed  The property value or null.
	 *
	 * @since   3.2
	 */
	
	public function __get($name)
	{
		switch ($name)
		{
			case 'url':
			case 'dataType':
			case 'minLength':
			case 'hiddenId':
			case 'mustExist':
				return $this->$name;
		}

		return parent::__get($name);
	}

	/**
	 * Method to set certain otherwise inaccessible properties of the form field object.
	 *
	 * @param   string  $name   The property name for which to the the value.
	 * @param   mixed   $value  The value of the property.
	 *
	 * @return  void
	 *
	 * @since   3.2
	 */
	public function __set($name, $value)
	{
		switch ($name)
		{
			case 'mustExist':
				$this->$name = (bool) $value;
				break;
			case 'minLength':
				$this->$name = (int) $value;
				break;
			case 'url':
			case 'dataType':
			case 'hiddenId':
				$this->$name = (string) $value;
				break;
			default:
				parent::__set($name, $value);
		}
	}

	/**
	 * Method to attach a JForm object to the field.
	 *
	 * @param   SimpleXMLElement  $element  The SimpleXMLElement object representing the <field /> tag for the form field object.
	 * @param   mixed             $value    The form field value to validate.
	 * @param   string            $group    The field name group control value. This acts as as an array container for the field.
	 *                                      For example if the field has name="foo" and the group value is set to "bar" then the
	 *                                      full field name would end up being "bar[foo]".
	 *
	 * @return  boolean  True on success.
	 *
	 * @see     JFormField::setup()
	 * @since   3.2
	 */
	public function setup(SimpleXMLElement $element, $value, $group = null)
	{
		$return = parent::setup($element, $value, $group);

		if ($return)
		{
			$this->url  = isset($this->element['url']) ? html_entity_decode((string) $this->element['url']) : '';
			$this->dataType = isset($this->element['dataype']) ? (string) $this->element['datatype'] : 'json';
			$this->minLength   = isset($this->element['minlength']) ? (int) $this->element['minlength'] : 3;
			if (isset($this->element['hiddenid'])) {
				if (isset($this->formControl)) {
					$this->hiddenId = $this->formControl.'_'.((string) $this->element['hiddenid']);
				} else {
					$this->hiddenId = (string) $this->element['hiddenid'];
				}
			} else {
				$this->hiddenId = rtrim($this->id, '_label');
			}
			$this->mustExist   = isset($this->element['mustexist']) ? (bool) $this->element['mustexist'] : false;
		}

		return $return;
	}

	public function getInput() {	
		//$options = array();
		//$doc = JFactory::getDocument();
		//$doc->addScript(JUri::base() . 'administrator/components/com_pedigree/models/fields/sire.js');
		
		// jQuery.ui Autocomplete: 
		$script = array();	
		$script[] = 'jQuery(function() { ';
		$script[] = '   jQuery( "#'.$this->id.'" ).autocomplete({ ';
		$script[] = '    source: function( request, response ) { ';
		$script[] = '      jQuery.ajax({ ';
		$script[] = '        url: "'.$this->url.'",';
		$script[] = '        dataType: "'.$this->dataType.'",';
		$script[] = '        data: {';
		$script[] = '          q: request.term';
		$script[] = '        },';
		$script[] = '        success: function( data ) {';
		$script[] = '          response( data );';
		$script[] = '        }';
		$script[] = '      });';
		$script[] = '    },';
		$script[] = '    minLength: '.$this->minLength.',';
		$script[] = '    select: function( event, ui ) {';
		$script[] = '        event.preventDefault();';
		$script[] = '        jQuery( "#'.$this->hiddenId.'" ).val(ui.item.value);';
		$script[] = '        jQuery( "#'.$this->id.'" ).val(ui.item.label);';
		if ($this->mustExist) {
		$script[] = '  	     jQuery( "#'.$this->id.'" ).prop( "readonly", true );';
		$script[] = '  		 jQuery( "#'.$this->id.'_clear" ).removeClass("hide");';}
		
		$script[] = '    },';
		$script[] = '    open: function() {';
		$script[] = '      jQuery( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );';
		$script[] = '    },';
		$script[] = '    close: function() {';
		$script[] = '      jQuery( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );';
		$script[] = '    }';
		$script[] = '  });';
		$script[] = '   jQuery( "#'.$this->id.'" ).blur(function() { ';
		$script[] = '     if (jQuery( "#'.$this->hiddenId.'" ).val() == "0") {';
		$script[] = '       jQuery( "#'.$this->id.'" ).val("")';
		$script[] = '     }';
		$script[] = '  });';
		$script[] = '});';
		if ($this->mustExist) {
		$script[] = 'function clear_'.$this->id.'() { ';
		$script[] = '  jQuery( "#'.$this->hiddenId.'" ).val("0");';
		$script[] = '  jQuery( "#'.$this->id.'" ).val("");';
		$script[] = '  jQuery( "#'.$this->id.'" ).prop( "readonly", false );';
		$script[] = '  jQuery( "#'.$this->id.'_clear" ).addClass("hide");';
		$script[] = '}';
		}

		JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));
		
		$class     = $this->class;
		$required  = $this->required ? ' required aria-required="true"' : '';
		$disabled  = $this->disabled ? ' disabled' : '';

		$class        = ' class="' . trim($class) . '"';
		//$control      = $this->control ? ' data-control="' . $this->control . '"' : '';
		$control = '';
		$readonly = ($this->readonly || (!empty($this->value) && $this->mustExist)) ? ' readonly' : '';
		
		// Translate placeholder text
		$hint = $this->translateHint ? JText::_($this->hint) : $this->hint;
		$hint         = $hint ? ' placeholder="' . $hint . '"' : '';
		$autocomplete = ' autocomplete="off"';
		$autofocus = $this->autofocus ? ' autofocus' : '';
		$position = '';
		$onchange  = !empty($this->onchange) ? ' onchange="' . $this->onchange . '"' : '';
		
		// code that returns HTML that will be shown as the form field
		$html = array();
			
		//$html[] = '<div class="ui-widget">';
		$html[] = '<input type="text" id="'.$this->id.'" name="'.$this->name.'" '.'value="'.$this->value.'"' . $hint . $class . $position . $control
				. $readonly . $disabled . $required . $onchange . $autocomplete . $autofocus . ' />';
		if ($this->mustExist) {
		$html[] = '<button id="'.$this->id.'_clear" type="button" class="btn btn-micro btn-danger'.((empty($readonly))?' hide':'').'" onclick="clear_'.$this->id.'()"><i class="icon-delete"></i></button>';}
		//$html[] = '<input type="hidden" id="'.$this->id.'" name="'.$this->name.'" value="'.$this->value.'"/>';
		//$html[] = '</div>';
		
		return implode("\n", $html);
		//return $html;

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