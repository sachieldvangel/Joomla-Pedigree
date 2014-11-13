<?php

/**
 * @version     1.0.3
 * @package     com_pedigree
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Eddie Kominek <eddie@kominekafghans.com> - http://www.kominekafghans.com/
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Pedigree records.
 */
class PedigreeModelFanciers extends JModelList {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                
            );
        }
        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since	1.6
     */
    protected function populateState($ordering = null, $direction = null) {

        // Initialise variables.
        $app = JFactory::getApplication();

        // List state information
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit', $limit);

        $limitstart = JFactory::getApplication()->input->getInt('limitstart', 0);
        $this->setState('list.start', $limitstart);

        

        // List state information.
        parent::populateState($ordering, $direction);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		return $query;
	}


	public function getItems() {
        $items = parent::getItems();
        foreach($items as $item){
	

			if (isset($item->id_dog) && $item->id_dog != '') {
				if(is_object($item->id_dog)){
					$item->id_dog = JArrayHelper::fromObject($item->id_dog);
				}
				$values = (is_array($item->id_dog)) ? $item->id_dog : explode(',',$item->id_dog);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('name')
							->from('`#__pedigree_dogs`')
							->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->name;
					}
				}

			$item->id_dog = !empty($textValue) ? implode(', ', $textValue) : $item->id_dog;

			}

			if (isset($item->id_country) && $item->id_country != '') {
				if(is_object($item->id_country)){
					$item->id_country = JArrayHelper::fromObject($item->id_country);
				}
				$values = (is_array($item->id_country)) ? $item->id_country : explode(',',$item->id_country);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('short_name')
							->from('`#__pedigree_countries`')
							->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->short_name;
					}
				}

			$item->id_country = !empty($textValue) ? implode(', ', $textValue) : $item->id_country;

			}
}
        return $items;
    }

}
