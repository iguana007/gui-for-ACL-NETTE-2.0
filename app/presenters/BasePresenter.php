<?php

/**
 * GUI for Acl
 *
 * @copyright  Copyright (c) 2010 Tomas Marcanik
 * @package    GUI for Acl
 */

/**
 * Base class for all application presenters.
 *
 */
abstract class BasePresenter extends \Nette\Application\UI\Presenter{

    public $cache;
    public $oldLayoutMode = FALSE;
    public $oldModuleMode = FALSE;

    public function startup(){
        parent::startup();
        $db_config = \Nette\Environment::getConfig('database');

        \Nette\Diagnostics\Debugger::barDump($db_config,"db_config");
        
        \dibi::connect(array(
            'driver' => 'mysql',
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            "database" => "acl"
        ));

        $tables = \Nette\Environment::getConfig('tables');
        define('TABLE_ACL',$tables -> acl);
        define('TABLE_PRIVILEGES',$tables -> acl_privileges);
        define('TABLE_RESOURCES',$tables -> acl_resources);
        define('TABLE_ROLES',$tables -> acl_roles);
        define('TABLE_USERS',$tables -> users);
        define('TABLE_USERS_ROLES',$tables -> users_roles);

        $acl_config = \Nette\Environment::getConfig('acl');
        define('ACL_RESOURCE',$acl_config -> resource);
        define('ACL_PRIVILEGE',$acl_config -> privilege);
        define('ACL_CACHING',$acl_config -> cache);
        define('ACL_PROG_MODE',$acl_config -> programmer_mode);

        $this -> template -> prog_mode = (ACL_PROG_MODE ? true : false);

        $this -> template -> user = $this -> user;
        if($this -> user -> isLoggedIn()){
            $this -> template -> identity = $this -> user -> getIdentity();
        }

        // cache
        if(ACL_CACHING){
            $this -> cache = \Nette\Environment::getCache();
            if( ! isset($this -> cache['gui_acl'])){
                $this -> cache -> save('gui_acl',new Acl(),array(
                    'files' => array(APP_DIR.'/config.ini'),
                ));
            }
            $this -> user -> setAuthorizator($this -> cache['gui_acl']);
        }
        else
            $this -> user -> setAuthorizator(new Acl());

        $this -> template -> current = $this -> getPresenter() -> getName();
    }

    /**
     * Check if the user has permissions to enter this section.
     * If not, then it is redirected.
     *
     */
    public function checkAccess(){
        // if the user is not allowed access to the ACL, then redirect him
        if( ! $this -> user -> isAllowed(ACL_RESOURCE,ACL_PRIVILEGE)){
            // @todo change redirect to login page
            $this -> redirect('Denied:');
        }
    }

}
