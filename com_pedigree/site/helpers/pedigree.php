<?php

/**
 * @version     1.0.3
 * @package     com_pedigree
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Eddie Kominek <eddie@kominekafghans.com> - http://www.kominekafghans.com/
 */
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
jimport('joomgallery.interface');

class PedigreeFrontendHelper {
	
	protected $_colors;
	protected $_patterns;
	protected $_countries;
	public $iGallery;
		
	public function PedigreeFrontendHelper() {

		$this->iGallery = new JoomInterface();
		$this->iGallery->addConfig('showhidden', '1');

		$this->loadColors();
		$this->loadPatterns();
		$this->loadCountries();
	}
	
	protected function loadColors() {
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
				->select('a.`id`, a.`color`, a.`description`, a.`image`')
				->from('#__pedigree_colors a')
				->where('a.`state`=1')
				->order('a.`color`');
		$db->setQuery($query);
		$results = $db->loadObjectList();
		if ($results) {				
			foreach ($results as $row){
				$this->_colors[] = $row;
			}				
		}
	}
	
	protected function loadPatterns() {
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
				->select('a.`id`, a.`pattern`')
				->from('#__pedigree_patterns a')
				->where('a.`state`=1')
				->order('a.`pattern`');
		$db->setQuery($query);
		$results = $db->loadObjectList();
		if ($results) {				
			foreach ($results as $row){
				$this->_patterns[] = $row;
			}				
		}
	}
	
	protected function loadCountries() {
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
				->select('a.`id`, a.`short_name`, a.`long_name`, a.`iso2`, a.`iso3`')
				->from('#__pedigree_countries a')
				->where('a.`state`=1')
				->order('a.`short_name`');
		$db->setQuery($query);
		$results = $db->loadObjectList();
		if ($results) {				
			foreach ($results as $row){
				$this->_countries[] = $row;
			}				
		}
	}
	
	public function getColorHtml($id, $option = 'text') {
		$retval='';
		if ($id != '0') {
			foreach ($this->_colors as $color){
				if ($id==$color->id) { 
					switch ($option) {
						case 'texticon': 
							$retval = $color->color.' <img class="ped-img-color" src="'.JURI::base().'media/pedigree/images/colors/'.$color->image.'" title="'.$color->color.'">';
							break;
						case 'icontext': 
							$retval = '<img class="ped-img-color" src="'.JURI::base().'media/pedigree/images/colors/'.$color->image.'" title="'.$color->color.'"> '.$color->color;
							break;
						case 'icon':
							$retval = '<img class="ped-img-color" src="'.JURI::base().'media/pedigree/images/colors/'.$color->image.'" title="'.$color->color.'">';
							break;
						case 'text' : 
						default :
							$retval = $color->color;
							break;
					}
				}
			}
		}
		return $retval;	
	}
	
	public function getColorName($id) {
		$retval='';
		if ($id != '0') {
			foreach ($this->_colors as $color){
				if ($id==$color->id) { 
					$retval = $color->color;
				}
			}
		}
		return $retval;	
	}
	
	public function getPattern($id) {
		$retval='';
		if ($id != '0') {
			foreach ($this->_patterns as $pattern){
				if ($id==$pattern->id) { 
					$retval = $pattern->pattern;
				}
			}
		}
		return $retval;	
	}
	
	public function getCountryFlagHtml($id) {
		$retval='';
		if ($id != '0') {
			foreach ($this->_countries as $country){
				if ($id==$country->id) { 
					$retval = '<img class="ped-img-flag" src="'.JURI::base().'media/pedigree/images/flags/'.$country->iso2.'.png" title="'.$country->short_name.'">';
				}
			}
		}
		return $retval;	
	}    
}
