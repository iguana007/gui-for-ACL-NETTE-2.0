<?php
/**
 * Roles model
 *
 * @author  Tomas Marcanik
 * @package GUI for Acl
 */
class RolesModel extends \Nette\Object
{
    /**
     * Has parent of node children?
     *
     * @param   integer Parent id
     * @return  integer Number of children
     */
    public function hasChildNodes($parent_id) {
        $sql = \dibi::query('SELECT * FROM ['. TABLE_ROLES .'] WHERE %and;', array('parent_id' => $parent_id));
        return count($sql);
    }

    /**
     * Return all children of specific parent of node
     *
     * @param   integer Parent id
     * @return  object
     */
    public function getChildNodes($parent_id) {
        $sql = \dibi::query('SELECT r.id, r.name, r.comment, count(ur.user_id) AS members
                                FROM ['.TABLE_ROLES.'] AS r
                                LEFT JOIN ['.TABLE_USERS_ROLES.'] AS ur ON r.id=ur.role_id
                                WHERE %and
                                GROUP BY r.id, r.name, r.comment
                                ORDER BY r.name;', array('r.parent_id' => $parent_id));
        return $sql->fetchAll();
    }

    /**
     * Return all roles in the tree structure
     *
     * @return  array
     */
    public function getTreeValues() {
        $roles = array();
        $this->getParents(NULL, $roles, 0);
        return $roles;
    }
    /**
     * All children of specific parent of role placed in a array
     *
     * @param   integer Parent id
     * @param   array Array of curent resources
     * @param   integer Depth of tree structure
     */
    public function getParents($parent_id, &$array, $depth) {
        $sql = \dibi::query('SELECT id, name FROM ['.TABLE_ROLES.'] WHERE %and ORDER BY name;', array('parent_id' => $parent_id));
        $rows = $sql->fetchAll();
        foreach ($rows as $row) {
            $array[$row->id] = ($depth ? str_repeat("- - ", $depth) : '').$row->name;
            $this->getParents($row->id, $array, ($depth+1));
        }
    }
}
?>
