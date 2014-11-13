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
class PedigreeModelJudgings extends JModelList {

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
                                'id', 'a.id',
                'id_person', 'a.id_person',
                'id_country', 'a.id_country',
                'date', 'a.date',
                'notes', 'a.notes',
                'ordering', 'a.ordering',
                'state', 'a.state',
                'created_by', 'a.created_by',

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

        
		if(empty($ordering)) {
			$ordering = 'a.ordering';
		}

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
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
                $this->getState(
                        'list.select', 'DISTINCT a.*'
                )
        );

        $query->from('`#__pedigree_judging` AS a');

        
    // Join over the users for the checked out user.
    $query->select('uc.name AS editor');
    $query->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');
    
		// Join over the foreign key 'id_person'
		$query->select('#__pedigree_people_1067774.last_name AS peoples_last_name_1067774');
		$query->join('LEFT', '#__pedigree_people AS #__pedigree_people_1067774 ON #__pedigree_people_1067774.id = a.id_person');
		// Join over the foreign key 'id_country'
		$query->select('#__pedigree_countries_1067775.short_name AS countries_short_name_1067775');
		$query->join('LEFT', '#__pedigree_countries AS #__pedigree_countries_1067775 ON #__pedigree_countries_1067775.id = a.id_country');
		// Join over the created by field 'created_by'
		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');
        

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%');
                
            }
        }

        

		//Filtering id_country
		$filter_id_country = $this->state->get("filter.id_country");
		if ($filter_id_country) {
			$query->where("a.id_country = '".$filter_id_country."'");
		}

        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        if ($orderCol && $orderDirn) {
            $query->order($db->escape($orderCol . ' ' . $orderDirn));
        }

        return $query;
    }

    public function getItems() {
        $items = parent::getItems();
        foreach($items as $item){
	

			if (isset($item->id_person) && $item->id_person != '') {
				if(is_object($item->id_person)){
					$item->id_person = JArrayHelper::fromObject($item->id_person);
				}
				$values = (is_array($item->id_person)) ? $item->id_person : explode(',',$item->id_person);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('last_name')
							->from('`#__pedigree_people`')
							->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->last_name;
					}
				}

			$item->id_person = !empty($textValue) ? implode(', ', $textValue) : $item->id_person;

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
