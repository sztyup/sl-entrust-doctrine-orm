<?php

namespace SpotOnLive\EntrustDoctrineORM\Entities;

use Doctrine\Common\Collections\ArrayCollection;

interface RoleInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @param string $id
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getDisplayName();

    /**
     * @param string $displayName
     */
    public function setDisplayName($displayName);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     */
    public function setDescription($description);

    /**
     * @return ArrayCollection|Permission[]
     */
    public function getPermissions();

    /**
     * @param ArrayCollection|PermissionInterface[] $permissions
     */
    public function setPermissions($permissions);

    /**
     * @param PermissionInterface[]|PermissionInterface $permission
     */
    public function addPermissions($permission);

    /**
     * @param PermissionInterface[]|PermissionInterface $permission
     */
    public function removePermissions($permission);
}
