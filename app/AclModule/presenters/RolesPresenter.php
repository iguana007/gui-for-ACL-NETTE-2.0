<?php

/**
 * GUI Acl bootstrap file.
 *
 * @copyright  Copyright (c) 2010 Tomas Marcanik
 * @package    GUI Acl
 */

namespace AclModule;

use Nette\Application\UI\Form;

/**
 * Roles
 *
 */
class RolesPresenter extends \BasePresenter
{
    /**
     * Init method
     */
    public function startup() {
        parent::startup();
        $this->checkAccess();
    }

    /******************
     * Default
     ******************/
    public function renderDefault() {
        $nodes = new \RolesModel();
        $this->template->nodes = $nodes;
        $this->template->parents = $nodes->getChildNodes(NULL);
    }

    /******************
     * Add and Edit
     ******************/
    public function actionAdd($id = 0) { // id = parent id
        $form = $this->getComponent('addEdit');
        $form->setDefaults(array('parent_id' => $id));
    }
    
    public function actionEdit($id) {
        $sql = \dibi::query('SELECT key_name, parent_id, name, comment FROM ['.TABLE_ROLES.'] WHERE id=%i;', $id);
        $form = $this->getComponent('addEdit');
        if (count($sql)) {
            $row = $sql->fetch();
            if (empty($row->parent_id))
                $row->parent_id = 0;
            $form->setDefaults($row);
        }
        else
            $form->addError('This role does not exist.');
    }
    
    protected function createComponentAddEdit($name) {
        $roles[0] = ' ';
        $mroles = new \RolesModel();
        $rows = $mroles->getTreeValues();
        foreach ($rows as $key => $row) { // function array_merge does't work correctly with integer indexes
            // manual array merge
            $roles[$key] = $row;
        }

        $form = new Form;
        $renderer = $form->getRenderer();
        $renderer->wrappers['label']['suffix'] = ':';
        //$form->addGroup('Add');
        $form->addText('name', 'Name', 30)
            ->addRule(Form::FILLED, 'You have to fill name.')
            ->getControlPrototype()->onChange("create_key()");
        $form->addText('key_name', 'Key', 30)
            ->addRule(Form::FILLED, 'You have to fill key.');
        $form->addSelect('parent_id', 'Parent', $roles, 15);
        $form->addTextArea('comment', 'Comment', 40, 4)
            ->addRule(Form::MAX_LENGTH, 'Comment must be at least %d characters.', 250);
        if ($this->getAction()=='add')
            $form->addSubmit('add', 'Add');
        else
            $form->addSubmit('edit', 'Edit');
        $form->onSuccess[] = callback($this, 'addEditOnFormSubmitted');
        return $form;
    }
    
    public function addEditOnFormSubmitted($form) {
        // add action
        if ($this->getAction()=='add') {
            try {
                $values = $form->getValues();
                if ($values['parent_id']==0)
                    $values['parent_id'] = NULL;
                \dibi::query('INSERT INTO ['.TABLE_ROLES.'] %v;', get_object_vars($values));
                $this->flashMessage('The role has been added.', 'ok');
                if (ACL_CACHING) {
                    unset($this->cache['gui_acl']); // invalidate cache
                }
                $this->redirect('Roles:');
            } catch (Exception $e) {
                $form->addError('The role has not been added.');
                throw $e;
            }
        }
        else { // edit action
            try {
                $id = $this->getParam('id');
                $values = $form->getValues();
                if ($values['parent_id']==0)
                    $values['parent_id'] = NULL;
                \dibi::query('UPDATE ['.TABLE_ROLES.'] SET %a WHERE id=%i;', get_object_vars($values), $id);
                $this->flashMessage('The role has been edited.', 'ok');
                if (ACL_CACHING) {
                    unset($this->cache['gui_acl']); // invalidate cache
                }
                $this->redirect('Roles:');
            } catch (Exception $e) {
                $form->addError('The role has not been edited.');
                throw $e;
            }
        }
    }

    /******************
     * Delete
     ******************/
    public function actionDelete($id) {
        $sql = \dibi::query('SELECT name FROM ['.TABLE_ROLES.'] WHERE id=%i;', $id);
        if (count($sql)) {
            $this->template->role = $sql->fetchSingle();
        }
        else {
            $this->flashMessage('This role does not exist.');
            $this->redirect('Roles:');
        }
    }
    
    protected function createComponentDelete($name) {
        $form = new Form;
        $form->addSubmit('delete', 'Delete');
        $form->addSubmit('cancel', 'Cancel');
        $form->onSuccess[] = callback($this, 'deleteOnFormSubmitted');
        return $form;
    }
    
    public function deleteOnFormSubmitted($form) {
        if ($form['delete']->isSubmittedBy()) {
            try {
                $id = $this->getParam('id');
                \dibi::query('DELETE FROM ['.TABLE_ROLES.'] WHERE id=%i;', $id);
                $this->flashMessage('The role has been deleted.', 'ok');
                if (ACL_CACHING) {
                    unset($this->cache['gui_acl']); // invalidate cache
                }
                $this->redirect('Roles:');
            } catch (Exception $e) {
                $form->addError('The role has not been deleted.');
                throw $e;
            }
        }
        else
            $this->redirect('Roles:');
    }

    /******************
     * Users
     ******************/
    public function actionUsers($id) {
        $nodes = new \RolesModel();
        $this->template->nodes = $nodes;
        $this->template->parents = $nodes->getChildNodes(NULL);

        $this->template->role = \dibi::fetchSingle('SELECT name FROM ['.TABLE_ROLES.'] WHERE id=%i;', $id);

        $sql = \dibi::query('SELECT u.id, u.name FROM ['.TABLE_USERS.'] AS u
                                LEFT JOIN ['.TABLE_USERS_ROLES.'] AS r ON u.id=r.user_id
                                WHERE r.role_id=%i
                                ORDER BY u.name;', $id);
        $users = $sql->fetchAll();
        $this->template->users = $users;
    }

    /******************
     * Access
     ******************/
    public function actionAccess($id) {
        $nodes = new \RolesModel();
        $this->template->nodes = $nodes;
        $this->template->parents = $nodes->getChildNodes(NULL);

        $role = \dibi::fetch('SELECT key_name, name FROM ['.TABLE_ROLES.'] WHERE id=%i;', $id);
        $this->template->role = $role->name;

        $access = new \AccessModel(array($role));
        $this->template->access = $access->getAccess();
    }
}
