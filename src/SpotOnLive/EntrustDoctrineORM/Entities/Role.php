<?php

namespace SpotOnLive\EntrustDoctrineORM\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Rhumsaa\Uuid\Uuid;

/**
 * @ORM\Entity
 * @ORM\Table(name="roles")
 */
class Role implements RoleInterface
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Id
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="display_name", type="text", nullable=true)
     */
    protected $displayName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var \SpotOnLive\EntrustDoctrineORM\Entities\PermissionInterface[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="SpotOnLive\EntrustDoctrineORM\Entities\Permission")
     * @ORM\JoinTable(name="role_permission_linker",
     *      joinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="permission_id", referencedColumnName="id")}
     *      )
     **/
    protected $permissions;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->displayName = null;
        $this->description = null;
        $this->permissions = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return ArrayCollection|Permission[]
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param ArrayCollection|PermissionInterface[] $permissions
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * @param PermissionInterface[]|PermissionInterface $permission
     */
    public function addPermissions($permission)
    {
        $this->permissions->add($permission);
    }

    /**
     * @param PermissionInterface[]|PermissionInterface $permission
     */
    public function removePermissions($permission)
    {
        $this->permissions->remove($permission);
    }
}
