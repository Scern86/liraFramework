<?php

namespace Scern\Lira;
use Scern\Lira\Application\AccessControl\Group;

class User
{
    protected bool $is_guest = true;
    protected static array $delegated = [];

    public function __construct(protected array $groups = [])
    {
    }
    public function isGuest(): bool
    {
        return $this->is_guest;
    }

    public function delegate(string $name, $entity)
    {
        if (!array_key_exists($name, self::$delegated)) self::$delegated[$name] = $entity;
    }

    public function getDelegated(string $name)
    {
        if (array_key_exists($name, self::$delegated)) {
            return self::$delegated[$name];
        }
        return null;
    }

    public function addGroup(Group $group): void
    {
        if (!array_key_exists($group->name, $this->groups)) $this->groups[$group->name] = $group;
    }

    public function isMethodAllowed(string $method): bool
    {
        if (!empty($this->groups)) foreach ($this->groups as $group) {
            $result = $group->isMethodAllowed($method);
            if ($result) return true;
        }
        return false;
    }
}