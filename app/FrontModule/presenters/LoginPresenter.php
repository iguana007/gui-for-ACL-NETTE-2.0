<?php
/**
 * GUI for Acl
 *
 * @copyright  Copyright (c) 2010 Tomas Marcanik
 * @package    GUI for Acl
 */

namespace FrontModule;

use Nette\Application\UI\Form;


/**
 * Login
 *
 */
class LoginPresenter extends \BasePresenter
{
    /******************
     * Default
     ******************/
    public function renderDefault() {
    }
    
    protected function createComponentLogin($name) {
        $form = new Form;
        $renderer = $form->getRenderer();
        $renderer->wrappers['label']['suffix'] = ':';
        //$form->addGroup('Login');
        $form->addText('name', 'Name', 30)
            ->addRule(Form::FILLED, 'You have to fill name.');
        $form->addPassword('password', 'Password', 30)
            ->addRule(Form::FILLED, 'You have to fill password.');
        //$form->addProtection('Security token did not match. Possible CSRF attack.');
        $form->addSubmit('signon', 'Sign on');
        $form->onSuccess[] = callback($this, 'SignOnFormSubmitted');
        return $form;
    }
    
    public function SignOnFormSubmitted($form) { // Login form submitted
        try {
            $values =  $form->getValues();
            $this->user->  login($values->name, $values->password);
            $this->user->setExpiration(30*60, TRUE, TRUE); // set expiration 30 minuts
            if (ACL_CACHING) {
               unset($this->cache['gui_acl']); // invalidate cache
            }
            $this->redirect('Default:');
        } catch (AuthenticationException $e) {
            $form->addError($e->getMessage());
            $form->setValues(array('name' => ''));
        }
    }

    /******************
     * Logout
     ******************/
    public function actionLogout() {
        $this->flashMessage('Sing off');
        $this->user->  logout(TRUE); // TRUE - delete identity
        $this->redirect('Default:');
    }
}
