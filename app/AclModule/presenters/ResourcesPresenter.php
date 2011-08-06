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
 * Resources
 *
 */
class ResourcesPresenter extends \BasePresenter
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
        $nodes = new \ResourcesModel();
        $this->template->nodes = $nodes;
        $this->template->parents = $nodes->getChildNodes(NULL);
    }

    /******************
     * Add and Edit
     ******************/
    public function actionAdd() {
    }
    public function actionEdit($id) {
        $sql = \dibi::query('SELECT key_name, parent_id, name, comment FROM ['.TABLE_RESOURCES.'] WHERE id=%i;', $id);
        $form = $this->getComponent('addEdit');
        if (count($sql)) {
            $row = $sql->fetch();
            if (empty($row->parent_id))
                $row->parent_id = 0;
            $form->setDefaults($row);
        }
        else
            $form->addError('This resource does not exist.');
    }
    protected function createComponentAddEdit() {
        $resources[0] = ' ';
        $mresources = new \ResourcesModel();
        $rows = $mresources->getTreeValues();
        foreach ($rows as $key => $row) { // function array_merge does't work correctly with integer indexes
            // manual array merge
            $resources[$key] = $row;
        }

        $form = new Form;
        $renderer = $form->getRenderer();
        $renderer->wrappers['label']['suffix'] = ':';
        //$form->addGroup('Edit');

        if (ACL_PROG_MODE) {
            $form->addText('name', 'Name', 30)
                ->addRule(Form::FILLED, 'You have to fill name.')
                ->getControlPrototype()->onChange("create_key()");
        }
        else {
            $form->addText('name', 'Name', 30)
                ->addRule(Form::FILLED, 'You have to fill name.');
        }
        $form->addText('key_name', 'Key', 30)
            ->setDisabled((ACL_PROG_MODE ? false : true));
        $form->addSelect('parent_id', 'Parent', $resources, 15);
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
        // add
        if ($this->getAction()=='add') {
            try {
                $values = $form->getValues();
                if ($values['parent_id']==0)
                    $values['parent_id'] = NULL;
                \dibi::query('INSERT INTO ['.TABLE_RESOURCES.'] %v;', \get_object_vars($values));
                $this->flashMessage('The resource has been added.', 'ok');
                if (ACL_CACHING) {
                    unset($this->cache['gui_acl']); // invalidate cache
                }
                $this->redirect('Resources:');
            } catch (Exception $e) {
                $form->addError('The resource has not been added.');
                throw $e;
            }
        }
        else { // edit
            try {
                $id = $this->getParam('id');
                $values = $form->getValues();
                if ($values['parent_id']==0)
                    $values['parent_id'] = NULL;
                \dibi::query('UPDATE ['.TABLE_RESOURCES.'] SET %a WHERE id=%i;', \get_object_vars($values), $id);
                $this->flashMessage('The resource has been edited.', 'ok');
                if (ACL_CACHING) {
                    unset($this->cache['gui_acl']); // invalidate cache
                }
                $this->redirect('Resources:');
            } catch (Exception $e) {
                $form->addError('The resource has not been edited.');
                throw $e;
            }
        }
    }

    /******************
     * Delete
     ******************/
    public function actionDelete($id) {
        $sql = \dibi::query('SELECT name FROM ['.TABLE_RESOURCES.'] WHERE id=%i;', $id);
        if (count($sql)) {
            $this->template->resource = $sql->fetchSingle();
        }
        else {
            $this->flashMessage('This resource does not exist.');
            $this->redirect('Resources:');
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
                \dibi::query('DELETE FROM ['.TABLE_RESOURCES.'] WHERE id=%i;', $id);
                $this->flashMessage('The resource has been deleted.', 'ok');
                if (ACL_CACHING) {
                    unset($this->cache['gui_acl']); // invalidate cache
                }
                $this->redirect('Resources:');
            } catch (Exception $e) {
                $form->addError('The resource has not been deleted.');
                throw $e;
            }
        }
        else
            $this->redirect('Resources:');
    }
}
