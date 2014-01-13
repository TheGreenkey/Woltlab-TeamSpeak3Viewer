<?php
namespace wcf\data\teamspeak3viewer;
use wcf\data\DatabaseObjectEditor;
use wcf\system\WCF;

/**
 * @author	Gregor Ganglberger
 * @copyright	2013 grexaut.net
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package com.grex.wcf.arma
 * @subpackage data.arma
 * @category 	ARMA Server Monitor
 */
class TeamSpeak3ViewerEditor extends DatabaseObjectEditor {
	/**
	 * @see	\wcf\data\DatabaseObjectEditor::$baseClass
	 */
	protected static $baseClass = 'wcf\data\teamspeak3viewer\TeamSpeak3Viewer';
	
}
