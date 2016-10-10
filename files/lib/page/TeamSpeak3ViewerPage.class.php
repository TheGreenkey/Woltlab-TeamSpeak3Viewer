<?php

namespace wcf\page;

use wcf\data\teamspeak3viewer\TeamSpeak3Viewer;
use wcf\system\cache\builder\TeamSpeak3ViewerCacheBuilder;
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

        $servers = TeamSpeak3ViewerCacheBuilder::getInstance()->getData();
        $servers = $this->fixObject($servers);
        WCF::getTPL()->assign(array(
            'servers' => $servers
        ));
    }

    public function fixObject(&$object) {
        if (!is_object($object) && gettype($object) == 'object') {
            return ($object = unserialize(serialize($object)));
        }
        return $object;
    }

}
