<?php

namespace wcf\data\teamspeak3viewer;

use wcf\data\AbstractDatabaseObjectAction;
use wcf\data\IToggleAction;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\WCF;

/**
 * @author	Gregor Ganglberger
 * @copyright	2013 grexaut.net
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package com.grex.wcf.teamspeak3viewer
 * @subpackage data.teamspeak3viewer
 * @category 	TeamSpeak3 Viewer
 */
class TeamSpeak3ViewerAction extends AbstractDatabaseObjectAction implements IToggleAction {

    /**
     * @see	\wcf\data\AbstractDatabaseObjectAction::$className
     */
    protected $className = 'wcf\data\teamspeak3viewer\TeamSpeak3ViewerEditor';

    /**
     * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
     */
    protected $permissionsDelete = array('admin.community.teamspeak3viewer.canDelete');

    /**
     * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
     */
    protected $permissionsUpdate = array('admin.community.teamspeak3viewer.canEdit');

    /**
     * @see	\wcf\data\AbstractDatabaseObjectAction::$requireACP
     */
    protected $requireACP = array('delete', 'toggle', 'update');


    /**
     * @see	\wcf\data\IToggleAction::validateToggle()
     */
    public function validateToggle() {
        parent::validateUpdate();
    }

    /**
     * @see	\wcf\data\IToggleAction::toggle()
     */
    public function toggle() {
        foreach ($this->objects as $ts3) {
            $ts3->update(array(
                'active' => $ts3->active ? 0 : 1
            ));
        }
    }

}
