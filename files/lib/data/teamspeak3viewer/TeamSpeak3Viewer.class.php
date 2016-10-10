<?php

namespace wcf\data\teamspeak3viewer;

use wcf\system\WCF;
use wcf\system\exception\SystemException;
use wcf\data\DatabaseObject;

require_once(WCF_DIR . '/lib/data/teamspeak3viewer/TeamSpeak3_Framework/TeamSpeak3.php');

/**
 * @author	Gregor Ganglberger
 * @copyright	2013 grexaut.net
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package com.grex.wcf.teamspeak3viewer
 * @subpackage	data
 * @category 	TeamSpeak3 Viewer
 */
class TeamSpeak3Viewer extends DatabaseObject {

    protected static $databaseTableName = 'teamspeak3viewer_servers';
    protected static $databaseTableIndexName = 'serverID';
    private $connection = false;

    public function connect($serverAddress, $serverPort, $serverQueryPort, $queryAdminName, $queryAdminPassword) {
        if ($this->connection !== false) {
            throw new SystemException('already connected');
        }
        try {
            $this->connection = \TeamSpeak3::factory("serverquery://" . $queryAdminName . ":" . $queryAdminPassword . "@" . $serverAddress . ":" . $serverQueryPort . "/?server_port=" . $serverPort);
            return true;
        } catch(\TeamSpeak3_Adapter_ServerQuery_Exception $e) {
            return false;
        }
    }

    public function disconnect() {
        if ($this->connection != true) {
            throw new SystemException('not connected');
        }
        $this->connection = false;
        return true;
    }

    public function getClients() {
        $clients = $this->connection->clientList();
        $result = array();
        foreach ($clients as $client) {
            if ($client['client_type'] != 1) {
                $result[] = array(
                    'name' => (string) $client['client_nickname'],
                    'talking' => $client['client_flag_talking'],
                    'channel' => $client['cid'],
                    'input_muted' => $client['client_input_muted'],
                    'output_muted' => $client['client_output_muted']
                );
            }
        }
        return $result;
    }

    public function getServerInfo() {
        $serverInfo = $this->connection->getInfo();
        $result = array(
            'name' => (string) $serverInfo['virtualserver_name'],
            'address' => $this->serverAddress,
            'port' => $this->serverPort,
            'hasPassword' => $serverInfo['virtualserver_flag_password'],
            'welcome_message' => (string) $serverInfo['virtualserver_welcomemessage'],
            'platform' => (string) $serverInfo['virtualserver_platform'],
            'version' => (string) $serverInfo['virtualserver_version'],
            'uptime' => $serverInfo['virtualserver_uptime'],
            'clients' => $serverInfo['virtualserver_clientsonline'],
            'maxclients' => $serverInfo['virtualserver_maxclients'],
            'channels' => $serverInfo['virtualserver_channelsonline']
        );
        return $result;
    }

    public function getChannels() {
        $clients = $this->getClients();

        $channels = $this->connection->channelList();
        $result = array();
        foreach ($channels as $channel) {

            if ($channel['channel_flag_permanent']) {
                $type = "permanent";
            } elseif ($channel['channel_flag_semi_permanent']) {
                $type = "semi_permament";
            }

            $channel_clients = array();
            foreach ($clients as $client) {
                if ($channel['cid'] == $client['channel']) {
                    $channel_clients[] = $client;
                }
            }
            if (count($channel_clients) == 0) {
                $channel_clients = false;
            }

            if(preg_match('[lspacer]',$channel['channel_name'])) {
                $pos = strpos($channel['channel_name'],']');
                $name = substr($channel['channel_name'],$pos+1);
                $align = "left";
            } elseif(preg_match('[cspacer]',$channel['channel_name'])) {
                $pos = strpos($channel['channel_name'],']');
                $name = substr($channel['channel_name'],$pos+1);
                $align = "center";
            } elseif(preg_match('[rspacer]',$channel['channel_name'])) {
                $pos = strpos($channel['channel_name'],']');
                $name = substr($channel['channel_name'],$pos+1);
                $align = "right";
            } else {
                $align = false;
                $name = $channel['channel_name'];
            }
            
            $result[] = array(
                'id' => $channel['cid'],
                'pid' => $channel['pid'],
                'name' => (string) $name,
                'hasPassword' => $channel['channel_flag_password'],
                'clients' => $channel['total_clients'],
                'maxclients' => $channel['channel_maxclients'],
                'isDefault' => $channel['channel_flag_default'],
                'type' => $type,
                'clients' => $channel_clients,
                'align' => $align
            );
        }
        return $result;
    }

    public function getVersion() {
        $version = $this->connection->version();
        return $version;
    }

}

