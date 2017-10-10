<?php

namespace Solidsites;

use Silex\Application;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
//use Illuminate\Database\Capsule\Manager as Capsule;
use Solidsites\Models\Member;
class UserProvider implements UserProviderInterface
{
//    private $app;
//
//    public function __construct(Application $app)
//    {
//        $this->app = $app;
//    }


    public function loadUserByUsername($username)
    {
        if (!$user = Member::where('username', '=', $username)->first()) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }

        return new User($user->username, $user->password, explode(',', $user->roles), true, true, true, true);
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Symfony\Component\Security\Core\User\User';
    }
}