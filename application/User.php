<?php

namespace Scern\Lira\Application;

use Scern\Lira\Application\AccessControl\Group;
use Scern\Lira\Core;
use Scern\Lira\Application\Models\Login;
use Scern\Lira\Application\Models\User as UserModel;

class User extends \Scern\Lira\User
{
    public readonly string $name;
    protected bool $is_logged_in = false;

    public function verifyLogin(): bool
    {
        $args = func_get_args();
        $login = array_shift($args);
        $password = array_shift($args);
        $user_mdl = new UserModel();
        $user = $user_mdl->getByLogin($login);
        if (!is_null($user)) {
            if (password_verify($password, $user->password)) {
                setcookie('logged_in', 1, time() + 3600, '/');
                $logins_mdl = new Login();
                $logins_mdl->save((string)$user->_id, 'Admin');
                return true;
            }
        }
        return false;
    }

    public function isLoggedIn(): bool
    {
        return $this->is_logged_in;
    }

    public function checkLoggedIn(): void
    {
        Core::SESSION()->sessionStart();
        if (!empty($_COOKIE['logged_in']) && $_COOKIE['logged_in'] == 1) {
            $logins_mdl = new Login();
            $user_session = $logins_mdl->getUserSession('Admin');
            if (!empty($user_session)) {
                $this->is_logged_in = true;
                $this->is_guest = false;
                $user_mdl = new UserModel();
                $user = $user_mdl->getById($user_session['user_id']);
                $this->name = $user->username;
                if (!empty($user->groups)) foreach ($user->groups as $group => $role_array) {
                    if (!empty($role_array)) foreach ($role_array as $role => $permit) {
                        if ($permit && class_exists($group) && class_exists($role)) {
                            $this->addGroup(new Group($group, new $role));
                        }
                    }
                    return;
                }
            }
        }
        $this->logout();
    }

    public function logout(): void
    {
        setcookie('logged_in', 0, time() - 3600, '/');
        $this->is_logged_in = false;
        Core::SESSION()->sessionRenew();
    }
}