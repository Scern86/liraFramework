<?php

namespace Scern\Lira;
use Scern\Lira\Application\AccessControl\Group;

class User
{
    protected bool $is_guest = true;

    public function __construct(protected array $groups = [])
    {
    }
    public function isGuest(): bool
    {
        return $this->is_guest;
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