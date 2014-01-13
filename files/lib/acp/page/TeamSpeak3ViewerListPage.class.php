<?php
namespace wcf\acp\page;
use wcf\page\SortablePage;

/**
 * @author	Gregor Ganglberger
 * @copyright	2013 grexaut.net
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package com.grex.wcf.teamspeak3viewer
 * @category 	TeamSpeak3 Viewer
 */
class TeamSpeak3ViewerListPage extends SortablePage {
    public $templateName = 'teamspeak3viewerList';
    public $defaultSortField = 'serverID';
    public $objectListClassName = 'wcf\data\teamspeak3viewer\TeamSpeak3ViewerList';
    public $activeMenuItem = 'wcf.acp.menu.link.community.teamspeak3viewer.list';
}
?>