<?php
namespace wcf\data\teamspeak3viewer;
use wcf\data\DatabaseObjectList;

/**
 * @author	Gregor Ganglberger
 * @copyright	2013 grexaut.net
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package com.grex.wcf.arma
 * @subpackage data.arma
 * @category 	ARMA Server Monitor
 */
class TeamSpeak3ViewerList extends DatabaseObjectList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'wcf\data\teamspeak3viewer\TeamSpeak3Viewer';
}
