<?php
/**
 * GUI for Acl
 *
 * @copyright  Copyright (c) 2010 Tomas Marcanik
 * @package    GUI for Acl
 */

namespace AclModule;

/**
 * Blank Presenter, which redirects to UsersPresenter
 * 
 */
class DefaultPresenter extends \BasePresenter
{
    public function startup() {
        $this->redirect('Users:Default');
    }
}
