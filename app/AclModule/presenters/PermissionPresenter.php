<?php
/**
 * GUI Acl
 *
 * @copyright  Copyright (c) 2010 Tomas Marcanik
 * @package    GUI Acl
 */

namespace AclModule;

use Nette\Application\UI\Form;

/**
 * Permission
 *
 */
class PermissionPresenter extends \BasePresenter
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
        // paginator
        $vp = new \VisualPaginator($this, 'vp');
        $paginator = $vp->getPaginator();
        $paginator->itemsPerPage = 20;

        $sql = \dibi::query('SELECT a.id, a.access, ro.name AS role, re.name AS resource, p.name AS privilege
                                FROM ['.TABLE_ACL.'] AS a
                                LEFT JOIN ['.TABLE_ROLES.'] AS ro ON a.role_id=ro.id
                                LEFT JOIN ['.TABLE_RESOURCES.'] AS re ON a.resource_id=re.id
                                LEFT JOIN ['.TABLE_PRIVILEGES.'] AS p ON a.privilege_id=p.id
                                ORDER BY ro.name;');
        $sql->setType('access', \dibi::BOOL);
        $paginator->itemCount = count($sql);
        $acl = $sql->fetchAll($paginator->offset, $paginator->itemsPerPage);
        $this->template->acl = $acl;
    }

    /******************
     * Add and Edit
     ******************/
    public function actionAdd($id) {
        $form = $this->getComponent('addEdit');
        $this->template->form = $form;
    }
    public function actionEdit($id) {
        $sql = \dibi::query('SELECT * FROM ['.TABLE_ACL.'] WHERE id=%i;', $id);
        if (count($sql)) {
            $form = $this->getComponent('addEdit');
            $sql->setType('access', \dibi::BOOL);
            $row = $sql->fetch();
            $row->access = (int)$row->access;
            $form->setDefaults($row);
            $this->template->form = $form;
        }
        else {
            $this->flashMessage('This acces does not exist.');
            $this->redirect('Permission:');
        }
    }
    protected function createComponentAddEdit($name) {
        $form = new Form;
        $access = array(1 => 'Allow', 0 => 'Deny');
        // roles
        $mroles = new \RolesModel();
        $roles = $mroles->getTreeValues();
        // resources
        $resources[0] = '- All resources -';
        $mresources = new \ResourcesModel();
        $rows = $mresources->getTreeValues();
        foreach ($rows as $key => $row) { // function array_merge does't work correctly with integer indexes
            // manual array merge
            $resources[$key] = $row;
        }
        // privileges
        $privileges[0] = '- All privileges -';
        $rows = \dibi::fetchAll('SELECT id, name FROM [gui_acl_privileges] ORDER BY name;');
        foreach ($rows as $row) { // function array_merge does't work correctly with integer indexes
            // manual array merge
            $privileges[$row->id] = $row->name;
        }

        //$renderer = $form->getRenderer();
        //$renderer->wrappers['label']['suffix'] = ':';
        //$form->addGroup('Add');
        $form->addMultiSelect('role_id', 'Role', $roles, 15)
                ->addRule(Form::FILLED, 'You have to fill roles.');
        $form->addMultiSelect('resource_id', 'Resources', $resources, 15)
                ->addRule(Form::FILLED, 'You have to fill resources.');
        $form->addMultiSelect('privilege_id', 'Privileges', $privileges, 15)
                ->addRule(Form::FILLED, 'You have to fill privileges.');
        //$form->addSelect('access', 'Access', $access)
        $form->addRadioList('access', 'Access', $access)
                ->addRule(Form::FILLED, 'You have to fill access.');
        $form->addSubmit('assign', 'Assign');
        $form->onSuccess[] = callback($this, 'addEditOnFormSubmitted');
        return $form;
    }
    public function addEditOnFormSubmitted($form) { // Permission form submitted
        $id = $this->getParam('id');
        $values = $form->getValues();
        // add
        if (!$id) {
            $error = FALSE;
            \dibi::begin();
            try {
                foreach ($values['privilege_id'] as $privi) {
                    foreach ($values['resource_id'] as $resou) {
                        foreach ($values['role_id'] as $role) {
                            if ($resou=='0')
                                $resou = NULL;
                            if ($privi=='0')
                                $privi = NULL;
                            \dibi::query('INSERT INTO ['.TABLE_ACL.'] (role_id, privilege_id, resource_id, access) VALUES (%i, %i, %i, %s);', $role, $privi, $resou, New \dibiVariable($values['access'], \dibi::BOOL));
                        }
                    }
                }
                \dibi::commit();
                $this->flashMessage('Permission was successfully assigned.', 'ok');
                if (ACL_CACHING) {
                    unset($this->cache['gui_acl']); // invalidate cache
                }
                $this->redirect('Permission:');
            } catch (Exception $e) {
                $error = FALSE;
                $form->addError('Permission was not successfully assigned.');
                throw $e;
            }
            if ($error)
                \dibi::rollback();
        }
        else { // edit
            try {
                $value = array();
                $value['access'] = New \dibiVariable($values['access'], \dibi::BOOL);
                $value["role_id"] = $values["role_id"];
                $value["resource_id"] = $values["resource_id"];
                $value["privilege_id"] = $values["privilege_id"];
                \dibi::query('UPDATE ['.TABLE_ACL.'] SET %a WHERE id=%i', $value, $id);
                $this->flashMessage('Permission was successfully edited.', 'ok');
                if (ACL_CACHING) {
                    unset($this->cache['gui_acl']); // invalidate cache
                }
                $this->redirect('Permission:');
            } catch (Exception $e) {
                $form->addError('Permission was not successfully edited.');
                throw $e;
            }
        }
    }

    /******************
     * Delete
     ******************/
    public function actionDelete($id) {
        $sql = \dibi::query('SELECT a.id, a.access, ro.name AS role, re.name AS resource, p.name AS privilege
                                FROM ['.TABLE_ACL.'] AS a
                                LEFT JOIN ['.TABLE_ROLES.'] AS ro ON a.role_id=ro.id
                                LEFT JOIN ['.TABLE_RESOURCES.'] AS re ON a.resource_id=re.id
                                LEFT JOIN ['.TABLE_PRIVILEGES.'] AS p ON a.privilege_id=p.id
                                WHERE a.id=%i;', $id);
        if (count($sql)) {
            $sql->setType('access', \dibi::BOOL);
            $acl = $sql->fetch();
            $this->template->acl = $acl;
        }
        else {
            $this->flashMessage('This acces does not exist.');
            $this->redirect('Permission:');
        }
    }
    
    protected function createComponentDelete($name) {
        $form = new Form;
        $form->addSubmit('delete', 'Delete');
        $form->addSubmit('cancel', 'Cancel');
        $form->onSucces[] = callback($this, 'deleteOnFormSubmitted');
    }
    
    public function deleteOnFormSubmitted(AppForm $form) {
        if ($form['delete']->isSubmittedBy()) {
            try {
                $id = $this->getParam('id');
                \dibi::query('DELETE FROM ['.TABLE_ACL.'] WHERE id=%i;', $id);
                $this->flashMessage('The access has been deleted.', 'ok');
                if (ACL_CACHING) {
                    unset($this->cache['gui_acl']); // invalidate cache
                }
                $this->redirect('Permission:');
            } catch (Exception $e) {
                $form->addError('The access has not been deleted.');
                throw $e;
            }
        }
        else
            $this->redirect('Permission:');
    }
}
