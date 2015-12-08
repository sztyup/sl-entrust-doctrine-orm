# Doctrine2 ORM - zizaco/entrust

[![Latest Stable Version](https://poser.pugx.org/spotonlive/sl-entrust-doctrine-orm/v/stable)](https://packagist.org/packages/spotonlive/sl-entrust-doctrine-orm) [![Total Downloads](https://poser.pugx.org/spotonlive/sl-entrust-doctrine-orm/downloads)](https://packagist.org/packages/spotonlive/sl-entrust-doctrine-orm) [![Latest Unstable Version](https://poser.pugx.org/spotonlive/sl-entrust-doctrine-orm/v/unstable)](https://packagist.org/packages/spotonlive/sl-entrust-doctrine-orm) [![License](https://poser.pugx.org/spotonlive/sl-entrust-doctrine-orm/license)](https://packagist.org/packages/spotonlive/sl-entrust-doctrine-orm)

**THIS PACKAGE IS UNDER DEVELOPMENT**

## Configuration

### Installation
Run `$ composer require spotonlive/sl-entrust-doctrine-orm`

**config/app.php**
*Note: It is important that the providers are appended in this order*
```
    'providers' => [
	    (...)
		SpotOnLive\EntrustDoctrineORM\EntrustDoctrineORMServiceProvider::class,
        'Zizaco\Entrust\EntrustServiceProvider',
	    (...)
	]

    'aliases' => [
	    (...)
        'Entrust' => 'Zizaco\Entrust\EntrustFacade'
	    (...)
	]
```

**User.php**
*Your user entity*
```php
use Doctrine\Common\Collections\ArrayCollection;

class User implements \SpotOnLive\EntrustDoctrineORM\Entities\UserRoleInterface
{
    /**
     * @var \SpotOnLive\EntrustDoctrineORM\Entities\RoleInterface[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="SpotOnLive\EntrustDoctrineORM\Entities\Role")
     * @ORM\JoinTable(name="user_role_linker",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *      )
     **/
    protected $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|\SpotOnLive\EntrustDoctrineORM\Entities\RoleInterface[]
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param ArrayCollection|\SpotOnLive\EntrustDoctrineORM\Entities\RoleInterface[] $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * @param \SpotOnLive\EntrustDoctrineORM\Entities\RoleInterface[] $roles
     */
    public function addRoles($roles)
    {
        $this->roles->add($roles);
    }

    /**
     * @param \SpotOnLive\EntrustDoctrineORM\Entities\RoleInterface[] $roles
     */
    public function removeRoles($roles)
    {
        $this->roles->remove($roles);
    }

    (...)
}
```

### Traits
Add `\SpotOnLive\EntrustDoctrineORM\Traits\EntrustDoctrineORMUserTrait` to your User entity to get the original model functionality from entrust .

### Migrations

`$ vendor/bin/doctrine-laravel migrations:diff` and then
`$ vendor/bin/doctrine-laravel migrations:migrate`

## Dependencies
* [**zizaco/entrust**](https://github.com/Zizaco/entrust)

## Doctrine for laravel
* [**laravel-doctrine/orm**](https://packagist.org/packages/laravel-doctrine/orm)

## Organization & authors
* [**spotonlive**](https://github.com/spotonlive)
* [**nikolajpetersen**](https://github.com/Nikolajpetersen)