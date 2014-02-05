<?php
/**
 * @version     1.0.2
 * @package     com_pedigree
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Eddie Kominek <eddie@kominekafghans.com> - http://www.kominekafghans.com/
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of Pedigree.
 */
class PedigreeViewDogs extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new Exception(implode("\n", $errors));
		}
        
		PedigreeHelper::addSubmenu('dogs');
        
		$this->addToolbar();
        
        $this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/pedigree.php';

		$state	= $this->get('State');
		$canDo	= PedigreeHelper::getActions($state->get('filter.category_id'));

		JToolBarHelper::title(JText::_('COM_PEDIGREE_TITLE_DOGS'), 'dogs.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR.'/views/dog';
        if (file_exists($formPath)) {

            if ($canDo->get('core.create')) {
			    JToolBarHelper::addNew('dog.add','JTOOLBAR_NEW');
		    }

		    if ($canDo->get('core.edit') && isset($this->items[0])) {
			    JToolBarHelper::editList('dog.edit','JTOOLBAR_EDIT');
		    }

        }

		if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0]->state)) {
			    JToolBarHelper::divider();
			    JToolBarHelper::custom('dogs.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
			    JToolBarHelper::custom('dogs.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            } else if (isset($this->items[0])) {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'dogs.delete','JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state)) {
			    JToolBarHelper::divider();
			    JToolBarHelper::archiveList('dogs.archive','JTOOLBAR_ARCHIVE');
            }
            if (isset($this->items[0]->checked_out)) {
            	JToolBarHelper::custom('dogs.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
		}
        
        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
		    if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
			    JToolBarHelper::deleteList('', 'dogs.delete','JTOOLBAR_EMPTY_TRASH');
			    JToolBarHelper::divider();
		    } else if ($canDo->get('core.edit.state')) {
			    JToolBarHelper::trash('dogs.trash','JTOOLBAR_TRASH');
			    JToolBarHelper::divider();
		    }
        }

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_pedigree');
		}
        
        //Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_pedigree&view=dogs');
        
        $this->extra_sidebar = '';
        
		//Filter for the field sex
		$select_label = JText::sprintf('COM_PEDIGREE_FILTER_SELECT_LABEL', 'Sex');
		$options = array();
		$options[0] = new stdClass();
		$options[0]->value = "0";
		$options[0]->text = "Male";
		$options[1] = new stdClass();
		$options[1]->value = "1";
		$options[1]->text = "Female";
		JHtmlSidebar::addFilter(
			$select_label,
			'filter_sex',
			JHtml::_('select.options', $options , "value", "text", $this->state->get('filter.sex'), true)
		);
        //Filter for the field ".id_color;
        jimport('joomla.form.form');
        $options = array();
        JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
        $form = JForm::getInstance('com_pedigree.dog', 'dog');

        $field = $form->getField('id_color');

        $query = $form->getFieldAttribute('filter_id_color','query');
        $translate = $form->getFieldAttribute('filter_id_color','translate');
        $key = $form->getFieldAttribute('filter_id_color','key_field');
        $value = $form->getFieldAttribute('filter_id_color','value_field');

        // Get the database object.
        $db = JFactory::getDBO();

        // Set the query and get the result list.
        $db->setQuery($query);
        $items = $db->loadObjectlist();

        // Build the field options.
        if (!empty($items))
        {
            foreach ($items as $item)
            {
                if ($translate == true)
                {
                    $options[] = JHtml::_('select.option', $item->$key, JText::_($item->$value));
                }
                else
                {
                    $options[] = JHtml::_('select.option', $item->$key, $item->$value);
                }
            }
        }

        JHtmlSidebar::addFilter(
            'Color',
            'filter_id_color',
            JHtml::_('select.options', $options, "value", "text", $this->state->get('filter.id_color')),
            true
        );        //Filter for the field ".id_pattern;
        jimport('joomla.form.form');
        $options = array();
        JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
        $form = JForm::getInstance('com_pedigree.dog', 'dog');

        $field = $form->getField('id_pattern');

        $query = $form->getFieldAttribute('filter_id_pattern','query');
        $translate = $form->getFieldAttribute('filter_id_pattern','translate');
        $key = $form->getFieldAttribute('filter_id_pattern','key_field');
        $value = $form->getFieldAttribute('filter_id_pattern','value_field');

        // Get the database object.
        $db = JFactory::getDBO();

        // Set the query and get the result list.
        $db->setQuery($query);
        $items = $db->loadObjectlist();

        // Build the field options.
        if (!empty($items))
        {
            foreach ($items as $item)
            {
                if ($translate == true)
                {
                    $options[] = JHtml::_('select.option', $item->$key, JText::_($item->$value));
                }
                else
                {
                    $options[] = JHtml::_('select.option', $item->$key, $item->$value);
                }
            }
        }

        JHtmlSidebar::addFilter(
            'Pattern',
            'filter_id_pattern',
            JHtml::_('select.options', $options, "value", "text", $this->state->get('filter.id_pattern')),
            true
        );
		JHtmlSidebar::addFilter(

			JText::_('JOPTION_SELECT_PUBLISHED'),

			'filter_published',

			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), "value", "text", $this->state->get('filter.state'), true)

		);

        
	}
    
	protected function getSortFields()
	{
		return array(
		'a.id' => JText::_('JGRID_HEADING_ID'),
		'a.name' => JText::_('COM_PEDIGREE_DOGS_NAME'),
		'a.id_sire' => JText::_('COM_PEDIGREE_DOGS_ID_SIRE'),
		'a.id_dam' => JText::_('COM_PEDIGREE_DOGS_ID_DAM'),
		'a.sex' => JText::_('COM_PEDIGREE_DOGS_SEX'),
		'a.birth_date' => JText::_('COM_PEDIGREE_DOGS_BIRTH_DATE'),
		'a.id_gallery_image' => JText::_('COM_PEDIGREE_DOGS_ID_GALLERY_IMAGE'),
		'a.id_gallery_category' => JText::_('COM_PEDIGREE_DOGS_ID_GALLERY_CATEGORY'),
		'a.id_color' => JText::_('COM_PEDIGREE_DOGS_ID_COLOR'),
		'a.id_pattern' => JText::_('COM_PEDIGREE_DOGS_ID_PATTERN'),
		'a.titles_prefix' => JText::_('COM_PEDIGREE_DOGS_TITLES_PREFIX'),
		'a.titles_suffix' => JText::_('COM_PEDIGREE_DOGS_TITLES_SUFFIX'),
		'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
		'a.state' => JText::_('JSTATUS'),
		'a.checked_out' => JText::_('COM_PEDIGREE_DOGS_CHECKED_OUT'),
		'a.checked_out_time' => JText::_('COM_PEDIGREE_DOGS_CHECKED_OUT_TIME'),
		'a.created_by' => JText::_('COM_PEDIGREE_DOGS_CREATED_BY'),
		);
	}

    
}
