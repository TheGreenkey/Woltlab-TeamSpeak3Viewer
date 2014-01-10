<?php
namespace wcf\acp\form;
use wcf\data\teamspeak3viewer\TeamSpeak3Viewer;
use wcf\data\teamspeak3viewer\TeamSpeak3ViewerAction;
use wcf\form\AbstractForm;
use wcf\system\exception\IllegalLinkException;
use wcf\system\WCF;
/**
 * @author	Gregor Ganglberger
 * @copyright	2013 grexaut.net
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package com.grex.wcf.teamspeak3viewer
 * @subpackage wcf.acp
 * @category 	TeamSpeak3Viewer
 */
class TeamSpeak3ViewerEditForm extends TeamSpeak3ViewerAddForm {
    
	public $activeMenuItem = 'wcf.acp.menu.link.teamspeak3viewer';
	public $serverID = 0;
	public $ts3 = null;

        
        
	/**
	 * @see	\wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		AbstractForm::readParameters();
		
		if (isset($_REQUEST['id'])) $this->serverID = intval($_REQUEST['id']);
		$this->ts3 = new TeamSpeak3Viewer($this->serverID);
		if (!$this->ts3->serverID) {
			throw new IllegalLinkException();
		}
	}
	

	
	/**
	 * @see Form::validate()
	 */
	public function save() {
		AbstractForm::save();
		
		// update
                $this->objectAction = new TeamSpeak3ViewerAction(array($this->serverID), 'update', array('data' => array_merge($this->additionalFields, array(
			'serverAddress' => $this->serverAddress,
			'serverPort' => $this->serverPort,
			'serverPassword' => $this->serverPassword,
			'queryPort' => $this->queryPort,
			'queryAdminName' => $this->queryAdminName,
			'queryAdminPassword' => $this->queryAdminPassword,
			'joinName' => $this->joinName,
			'descr' => $this->descr
                ))));
                $this->objectAction->executeAction();
                
		$this->saved();

                // show success message
		WCF::getTPL()->assign(array(
			'success' => true
		));
                
	}
	
	/**
	 * @see Page::readData()
	 */
	public function readData() {
		parent::readData();
		
		if (empty($_POST)) {
			// default value
			$this->serverID = $this->ts3->serverID;
			$this->serverAddress = $this->ts3->serverAddress;
			$this->serverPort = $this->ts3->serverPort;
			$this->serverPassword = $this->ts3->serverPassword;
			$this->queryPort = $this->ts3->queryPort;
			$this->queryAdminName = $this->ts3->queryAdminName;
			$this->queryAdminPassword = $this->ts3->queryAdminPassword;
			$this->joinName = $this->ts3->joinName;
			$this->descr = $this->ts3->descr;
		}
	}
        
	
	/**
	 * @see Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		WCF::getTPL()->assign(array(
                    'ts3' => $this->ts3,
                    'action'    => 'edit'
		));
	}
}
?>