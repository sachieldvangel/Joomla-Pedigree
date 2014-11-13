<?php

/**
 * @version     1.0.3
 * @package     com_pedigree
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Eddie Kominek <eddie@kominekafghans.com> - http://www.kominekafghans.com/
 */
// No direct access
defined('_JEXEC') or die;

/**
 * Pedigree helper.
 */
class PedigreeHelper {

    /**
     * Configure the Linkbar.
     */
    public static function addSubmenu($vName = '') {
        		JHtmlSidebar::addEntry(
			JText::_('COM_PEDIGREE_TITLE_AUDITS'),
			'index.php?option=com_pedigree&view=audits',
			$vName == 'audits'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PEDIGREE_TITLE_BREEDERS'),
			'index.php?option=com_pedigree&view=breeders',
			$vName == 'breeders'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PEDIGREE_TITLE_COLORS'),
			'index.php?option=com_pedigree&view=colors',
			$vName == 'colors'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PEDIGREE_TITLE_COUNTRIES'),
			'index.php?option=com_pedigree&view=countries',
			$vName == 'countries'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PEDIGREE_TITLE_DOGS'),
			'index.php?option=com_pedigree&view=dogs',
			$vName == 'dogs'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PEDIGREE_TITLE_DELEGATIONS'),
			'index.php?option=com_pedigree&view=delegations',
			$vName == 'delegations'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PEDIGREE_TITLE_JUDGINGS'),
			'index.php?option=com_pedigree&view=judgings',
			$vName == 'judgings'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PEDIGREE_TITLE_OWNERS'),
			'index.php?option=com_pedigree&view=owners',
			$vName == 'owners'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PEDIGREE_TITLE_PATTERNS'),
			'index.php?option=com_pedigree&view=patterns',
			$vName == 'patterns'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PEDIGREE_TITLE_PEOPLES'),
			'index.php?option=com_pedigree&view=peoples',
			$vName == 'peoples'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PEDIGREE_TITLE_PERSONDELEGATIONS'),
			'index.php?option=com_pedigree&view=persondelegations',
			$vName == 'persondelegations'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PEDIGREE_TITLE_REGISTRATIONS'),
			'index.php?option=com_pedigree&view=registrations',
			$vName == 'registrations'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PEDIGREE_TITLE_HOUNDS'),
			'index.php?option=com_pedigree&view=hounds',
			$vName == 'hounds'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PEDIGREE_TITLE_FANCIERS'),
			'index.php?option=com_pedigree&view=fanciers',
			$vName == 'fanciers'
		);

    }

    /**
     * Gets a list of the actions that can be performed.
     *
     * @return	JObject
     * @since	1.6
     */
    public static function getActions() {
        $user = JFactory::getUser();
        $result = new JObject;

        $assetName = 'com_pedigree';

        $actions = array(
            'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
        );

        foreach ($actions as $action) {
            $result->set($action, $user->authorise($action, $assetName));
        }

        return $result;
    }


}
