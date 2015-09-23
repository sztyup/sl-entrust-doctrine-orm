<?php

namespace SpotOnLive\EntrustDoctrineORMTest\Entities;

use PHPUnit_Framework_TestCase;

class PermissionTest extends PHPUnit_Framework_TestCase
{
    /** @var \SpotOnLive\EntrustDoctrineORM\Entities\Permission */
    protected $entity;

    public function setUp()
    {
        $entity = new \SpotOnLive\EntrustDoctrineORM\Entities\Permission;
        $this->entity = $entity;
    }

    public function testGettersSetters()
    {
        $entity = $this->entity;
        $string = 'test-string';
        $datetime = new \DateTime;

        $entity->setId($string);
        $this->assertSame($string, $entity->getId());

        $entity->setName($string);
        $this->assertSame($string, $entity->getName());

        $entity->setDisplayName($string);
        $this->assertSame($string, $entity->getDisplayName());

        $entity->setDescription($string);
        $this->assertSame($string, $entity->getDescription());

        $entity->setUpdated($datetime);
        $this->assertSame($datetime, $entity->getUpdated());

        $entity->setCreated($datetime);
        $this->assertSame($datetime, $entity->getCreated());
    }
}