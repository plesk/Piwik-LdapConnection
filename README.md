# Matomo LdapConnectionPlesk Plugin

## Description

Configurable Matomo plugin to create an LDAP connection, which can be reused by other plugins.
It uses the ZF2 Ldap component: http://framework.zend.com/manual/2.3/en/index.html#zend-ldap

Currently used by https://github.com/plesk/Piwik-LdapVisitorInfo

## FAQ

__What does this plugin do?__

It creates based on your configuration a connection to LDAP. Not more and not less :-)


__How can i use this LDAP connection in another plugin?__

This is an example to retrieve the connection.
For documentation please see http://framework.zend.com/manual/2.3/en/index.html#zend-ldap

```php
namespace Piwik\Plugins\YourPlugin;

use Piwik\Plugin;
use Piwik\Plugins\LdapConnectionPlesk\API as APILdapConnectionPlesk;
use Zend\Ldap\Ldap;

class YourPlugin extends Plugin
{
    private function doSomething()
    {
    	/* @var $ldap \Zend\Ldap\Ldap */
        $ldap = APILdapConnectionPlesk::getInstance()->getConnection();
        $ldap->connect();
        
        $filter = sprintf('(&(objectclass=user)(samAccountName=%s))', $visitorUsername);
        $collection = $ldap->search($filter, null, Ldap::SEARCH_SCOPE_SUB, ['displayname']);
        
        if ($collection->count() >= 1) {
        	$result = $collection->getFirst();
        	//do something with the result...
        }
    }
}
```
