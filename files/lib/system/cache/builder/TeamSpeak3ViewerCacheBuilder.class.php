<?php

namespace wcf\system\cache\builder;

use wcf\data\teamspeak3viewer\TeamSpeak3Viewer;
use wcf\system\cache\builder\AbstractCacheBuilder;
use wcf\system\WCF;

/**
 * @author	Gregor Ganglberger
 * @copyright	2013 grexaut.net
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package     com.grex.wcf.teamspeak3viewer
 * @subpackage  data.teamspeak3viewer
 * @category 	TeamSpeak3 Viewer
 */
class TeamSpeak3ViewerCacheBuilder extends AbstractCacheBuilder {

    /**
     * @see	\wcf\system\cache\builder\AbstractCacheBuilder::$maxLifetime
     */
    protected $maxLifetime = TS3_REFRESHRATE;

    /**
     * @see	\wcf\system\cache\builder\AbstractCacheBuilder::rebuild()
     */
    protected function rebuild(array $parameters) {
        $servers = $this->getActiveServers();
        foreach ($servers as $key => $server) {
            $server = (object) $server;
            $ts3 = new TeamSpeak3Viewer($server->serverID);
            if ($ts3->connect($ts3->serverAddress, $ts3->serverPort, $ts3->queryPort, $ts3->queryAdminName, $ts3->queryAdminPassword)) {
                $servers[$key]['status'] = "online";
                $servers[$key]['serverInfo'] = $ts3->getServerInfo();
                $servers[$key]['channels'] = $ts3->getChannels();
                $servers[$key]['clients'] = $ts3->getClients();
                $ts3->disconnect();
            } else {
                $servers[$key]['status'] = "offline";
            }
        }
        return $servers;
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
