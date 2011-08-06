<?php
/**
 * Users authenticator
 * 
 * @copyright  Copyright (c) 2010 Tomas Marcanik
 * @package    GUI for Acl
 */
class Login extends Nette\Object implements Nette\Security\IAuthenticator
{
    /**
     * Performs an authentication
     *
     * @param  array
     * @return void
     * @throws AuthenticationException
     */
    public function authenticate(array $credentials)
    {
        $username = $credentials[self::USERNAME];
        $password = $credentials[self::PASSWORD];

        $sql = \dibi::query('SELECT * FROM [' . TABLE_USERS . '] WHERE name=%s;', $username);
        $sql->setType('permission',\dibi::BOOL);
        $row = $sql->fetch();

        /*if (count($sql)==0) {
            throw new AuthenticationException('Unknown user', self::IDENTITY_NOT_FOUND);
        }*/

        /*if ($row->password !== md5($password)) {
            throw new AuthenticationException('Password not match', self::INVALID_CREDENTIAL);
        }*/

        if (count($sql)==0 OR $row->password!==md5($password)) {
            throw new \Nette\Security\AuthenticationException('Incorrect password or name', self::INVALID_CREDENTIAL);
        }

        // get roles
        $sql = \dibi::query('SELECT r.key_name
                                FROM [' . TABLE_ROLES . '] AS r
                                RIGHT JOIN [' . TABLE_USERS_ROLES . '] AS us ON r.id=us.role_id
                                WHERE us.user_id=%i;', $row->id);
        $roles = $sql->fetchPairs();

        unset($row->password);
        return new \Nette\Security\Identity($username, $roles, $row);
    }
}
?>