<?php
namespace wcf\acp\form;
use wcf\data\teamspeak3viewer\TeamSpeak3ViewerAction;
use wcf\form\AbstractForm;
use wcf\system\WCF;

/**
 * @author	Gregor Ganglberger
 * @copyright	2013 grexaut.net
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package com.grex.wcf.teamspeak3viewer
 * @subpackage wcf.acp
 * @category 	TeamSpeak3Viewer
 */
class TeamSpeak3ViewerAddForm extends AbstractForm {
	/**
	 * @see	\wcf\page\AbstractPage::$activeMenuItem
	 */
	public $activeMenuItem = 'wcf.acp.menu.link.community.teamspeak3viewer.add';
	public $templateName = 'teamspeak3viewerAdd';
	
	// parameters
	public $serverID = '';
        public $serverAddress = '';
        public $serverPort = '9987';
        public $serverPassword = '';
        public $queryPort = '10011';
        public $queryAdminName = '';
        public $queryAdminPassword = '';
		public $joinName;
        public $descr = '';
	
	
	/**
	 * @see Form::readFormParameters()
	 */
	public function readFormParameters() {
		parent::readFormParameters();
		
		if (isset($_POST['serverID'])) $this->serverID = $_POST['serverID'];
		if (isset($_POST['serverAddress'])) $this->serverAddress = $_POST['serverAddress'];
		if (isset($_POST['serverPort'])) $this->serverPort = $_POST['serverPort'];
		if (isset($_POST['serverPassword'])) $this->serverPassword = $_POST['serverPassword'];
		if (isset($_POST['queryPort'])) $this->queryPort = $_POST['queryPort'];
		if (isset($_POST['queryAdminName'])) $this->queryAdminName = $_POST['queryAdminName'];
		if (isset($_POST['queryAdminPassword'])) $this->queryAdminPassword = $_POST['queryAdminPassword'];
		if (isset($_POST['joinName'])) $this->joinName = $_POST['joinName'];
		if (isset($_POST['descr'])) $this->descr = $_POST['descr'];
	}
	
	/**
	 * @see	\wcf\form\IForm::validate()
	 */
	public function validate() {
		parent::validate();
        }
        
        
	
	/**
	 * @see Form::save()
	 */
	public function save() {
		parent::save();
		
		$this->objectAction = new TeamSpeak3ViewerAction(array(), 'create', array('data' => array_merge($this->additionalFields, array(
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
                
                // reset values
                $this->serverID = '';
                $this->serverAddress = '';
                $this->serverPort = '9987';
                $this->serverPassword = '';
                $this->queryPort = '10011';
                $this->queryAdminName = '';
                $this->queryAdminPassword = '';
                $this->joinName = '';
                $this->descr = '';
                
		// show success
		WCF::getTPL()->assign(array(
			'success' => true
		));
	}
        
	/**
	 * @see Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
                
		WCF::getTPL()->assign(array(
			'serverID' => $this->serverID,
                        'serverAddress' => $this->serverAddress,
                        'serverPort' => $this->serverPort,
                        'serverPassword' => $this->serverPassword,
                        'queryPort' => $this->queryPort,
                        'queryAdminName' => $this->queryAdminName,
                        'queryAdminPassword' => $this->queryAdminPassword,
                        'joinName' => $this->joinName,
                        'descr' => $this->descr,
                        'action' => 'add'
		));
	}
}
?>