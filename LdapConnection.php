<?php
/**
 * @author https://github.com/ThaDafinser
 */
namespace Piwik\Plugins\LdapConnectionPlesk;

use Piwik\Plugin;

class LdapConnectionPlesk extends Plugin
{

    /**
     *
     * @see Piwik\Plugin::getListHooksRegistered
     */
    public function getListHooksRegistered()
    {
        return array(
            'Controller.UsersManager.userSettings' => 'userSettingsNotification'
        );
    }

    /**
     * Notify plugin's behaviour only to Super admins
     */
    public function userSettingsNotification()
    {
        $conn = API::getInstance()->getConnection();
        $conn->connect();
        
        $result = $conn->search('(sAMAccountName=kecmar)');
    }
}
