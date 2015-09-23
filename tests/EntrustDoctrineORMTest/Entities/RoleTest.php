<?php

namespace SpotOnLive\EntrustDoctrineORMTest\Entities;

use PHPUnit_Framework_TestCase;

class RoleTest extends PHPUnit_Framework_TestCase
{
    /** @var \SpotOnLive\EntrustDoctrineORM\Entities\Role */
    protected $entity;

    public function setUp()
    {
        $entity = new \SpotOnLive\EntrustDoctrineORM\Entities\Role;
        $this->entity = $entity;
    }

    public function testGettersSetters()
    {
        $entity = $this->entity;
        $string = 'test-string';

        $arrayCollection = $this->getMock('Doctrine\Common\Collections\ArrayCollection');

        $entity->setId($string);
        $this->assertSame($string, $entity->getId());

        $entity->setName($string);
        $this->assertSame($string, $entity->getName());

        $entity->setDisplayName($string);
        $this->assertSame($string, $entity->getDisplayName());

        $entity->setDescription($string);
        $this->assertSame($string, $entity->getDescription());

        $entity->setPermissions($arrayCollection);
        $this->assertSame($arrayCollection, $entity->getPermissions());

        $permission = $this->getMock('SpotOnLive\EntrustDoctrineORM\Entities\Permission');

        $arrayCollection->expects($this->at(0))
            ->method('add')
            ->with($permission);

        $arrayCollection->expects($this->at(1))
            ->method('remove')
            ->with($permission);

        $entity->addPermissions($permission);
        $entity->removePermissions($permission);
    }
}