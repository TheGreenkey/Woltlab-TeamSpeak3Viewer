<?php
namespace wcf\page;
use wcf\data\teamspeak3viewer\TeamSpeak3Viewer;
use wcf\system\WCF;


/**
 * @author	Gregor Ganglberger
 * @copyright	2013 grexaut.net
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package com.grex.wcf.teamspeak3viewer
 * @category 	TeamSpeak3 Viewer
 */
 
 
class TeamSpeak3ViewerPage extends AbstractPage {
	/**
	 * @see	\wcf\page\AbstractPage::$activeMenuItem
	 */
	public $activeMenuItem = 'wcf.page.teamspeak3viewer';
        
        public $neededPermissions = array('user.board.teamspeak3viewer.canView');
	
	/**
	 * @see	\wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();

	}

	/**
	 * @see	\wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
                $servers = $this->getActiveServers();
                foreach($servers as $key => $server) {
                    $server = (object) $server;
                    $ts3 = new TeamSpeak3Viewer($server->serverID);
                    
                    $ts3->connect($ts3->serverAddress,$ts3->serverPort, $ts3->queryPort, $ts3->queryAdminName, $ts3->queryAdminPassword);
                    $servers[$key]['serverInfo'] = $ts3->getServerInfo();
                    $servers[$key]['channels'] = $ts3->getChannels();
                    $servers[$key]['clients'] = $ts3->getClients();
                    $ts3->disconnect();
                }
                WCF::getTPL()->assign(array(
                    'servers' => $servers
                ));
	}
        
        public function getActiveServers() {
            $result = array();
            $sql = "SELECT	*
                    FROM	wcf".WCF_N."_teamspeak3viewer_servers
                    WHERE	active = 1";
            $statement = WCF::getDB()->prepareStatement($sql);
            $statement->execute();
            while($row = $statement->fetchArray()) {
                $result[$row['serverID']] = $row;
            }
            return $result;
        }
}
