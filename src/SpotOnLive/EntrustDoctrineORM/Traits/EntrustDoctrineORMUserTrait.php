<?php

namespace SpotOnLive\EntrustDoctrineORM\Traits;

use InvalidArgumentException;

trait EntrustDoctrineORMUserTrait
{
    /**
     * Many-to-Many relations with Role.
     *
     * @return \Doctrine\Common\Collections\ArrayCollection|\SpotOnLive\EntrustDoctrineORM\Entities\RoleInterface[]
     */
    public function roles()
    {
        return $this->getRoles();
    }

    /**
     * Checks if the user has a role by its name.
     *
     * @param string|array $name       Role name or array of role names.
     * @param bool         $requireAll All roles in the array are required.
     *
     * @return bool
     */
    public function hasRole($name, $requireAll = false)
    {
        if (is_array($name)) {
            // Check array of roles
            foreach ($name as $roleName) {
                if (!$this->hasRole($roleName)) {
                    return false;
                }
            }

            return true;
        }

        foreach ($this->roles() as $role) {
            if ($role->getName() == $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if user has a permission by its name.
     *
     * @param string|array $name       Permission string or array of permissions.
     * @param bool         $requireAll All permissions in the array are required.
     *
     * @return bool
     */
    public function can($name, $requireAll = false)
    {
        if (is_array($name)) {
            // Array of permissions

            foreach ($name as $permissionName) {
                if (!$this->can($permissionName)) {
                    return false;
                }
            }

            return true;
        }

        foreach ($this->roles() as $role) {
            foreach ($role->getPermissions() as $permission) {
                if ($name == $permission->getName()) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Checks role(s) and permission(s).
     *
     * @param string|array $roles       Array of roles or comma separated string
     * @param string|array $permissions Array of permissions or comma separated string.
     * @param array        $options     validate_all (true|false) or return_type (boolean|array|both)
     *
     * @throws \InvalidArgumentException
     *
     * @return array|bool
     */
    public function ability($roles, $permissions, $options = [])
    {
        if (!is_array($roles)) {
            // Convert comma separated roles to an array
            $roles = explode(',', $roles);
        }

        if (!is_array($permissions)) {
            // Convert comma separated permissions to an array
            $permissions = explode(',', $permissions);
        }

        $optionsValidateAll = false;

        if (isset($options['validate_all'])) {
            if (!is_bool($options['validate_all'])) {
                // Validate_all must be of type boolean
                throw new InvalidArgumentException();
            }

            $optionsValidateAll = $options['validate_all'];
        }

        if (isset($options['return_type'])) {
            switch ($options['return_type']) {
                case 'boolean':
                case 'array':
                case 'both':
                    // Success
                    $returnType = $options['return_type'];
                    break;

                default:
                    // Incorrect return type
                    throw new InvalidArgumentException('Invalid return type');
                    break;
            }
        } else {
            $returnType = 'boolean';
        }

        $checkedRoles = [];
        $checkedPermissions = [];

        // Check roles
        foreach ($roles as $role) {
            $checkedRoles[$role] = $this->hasRole($role);
        }

        // Check Permissions
        foreach ($permissions as $permission) {
            $checkedPermissions[$permission] = $this->can($permission);
        }

        $validateAll = false;

        if ($optionsValidateAll) {
            if (!in_array(false, $checkedRoles) && !in_array(false, $checkedPermissions)) {
                $validateAll = true;
            }
        }

        if (!$optionsValidateAll) {
            if (in_array(true, $checkedRoles) && in_array(true, $checkedPermissions)) {
                $validateAll = true;
            }
        }

        switch ($returnType) {
            case 'boolean':
                return $validateAll;
                break;

            case 'array':
                return [
                    'roles' => $checkedRoles,
                    'permissions' => $checkedPermissions
                ];
                break;

            default:
                return [
                    $validateAll,
                    [
                        'roles' => $checkedRoles,
                        'permissions' => $checkedPermissions
                    ]
                ];
                break;
        }

    }

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param \SpotOnLive\EntrustDoctrineORM\Entities\RoleInterface $role
     */
    public function attachRole($role)
    {
        $this->addRoles($role);
    }

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param \SpotOnLive\EntrustDoctrineORM\Entities\RoleInterface $role
     */
    public function detachRole($role)
    {
        $this->removeRoles($role);
    }

    /**
     * Attach multiple roles to a user
     *
     * @param \SpotOnLive\EntrustDoctrineORM\Entities\RoleInterface[] $roles
     */
    public function attachRoles($roles)
    {
        $this->addRoles($roles);
    }

    /**
     * Detach multiple roles from a user
     *
     * @param \SpotOnLive\EntrustDoctrineORM\Entities\RoleInterface[] $roles
     */
    public function detachRoles($roles)
    {
        $this->removeRoles($roles);
    }

}
