<?php

namespace App\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @method Mapping\ClassMetadata getClassMetadata($className)
 */
class EntityManagerDecorator implements EntityManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCache()
    {
        return $this->entityManager->getCache();
    }

    public function getConnection()
    {
        // TODO: Implement getConnection() method.

        return $this->entityManager->getConnection();
    }

    public function getExpressionBuilder()
    {
        // TODO: Implement getExpressionBuilder() method.

        return $this->entityManager->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        // TODO: Implement beginTransaction() method.

        $this->entityManager->beginTransaction();
    }

    public function transactional($func)
    {
        // TODO: Implement transactional() method.

        return $this->entityManager->transactional($func);
    }

    public function commit()
    {
        // TODO: Implement commit() method.

        $this->entityManager->commit();
    }

    public function rollback()
    {
        // TODO: Implement rollback() method.

        $this->entityManager->rollback();
    }

    public function createQuery($dql = '')
    {
        // TODO: Implement createQuery() method.

        return $this->entityManager->createQuery($dql = '');
    }

    public function createNamedQuery($name)
    {
        // TODO: Implement createNamedQuery() method.

        return $this->entityManager->createNamedQuery($name);
    }

    public function createNativeQuery($sql, ResultSetMapping $rsm)
    {
        // TODO: Implement createNativeQuery() method.

        return $this->entityManager->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        // TODO: Implement createNamedNativeQuery() method.

        return $this->entityManager->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        // TODO: Implement createQueryBuilder() method.

        return $this->entityManager->createQueryBuilder();
    }

    public function getReference($entityName, $id)
    {
        // TODO: Implement getReference() method.

        return $this->entityManager->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        // TODO: Implement getPartialReference() method.

        return $this->entityManager->getPartialReference($entityName, $identifier);
    }

    public function close()
    {
        // TODO: Implement close() method.

        $this->entityManager->close();
    }

    public function copy($entity, $deep = false)
    {
        // TODO: Implement copy() method.

        return $this->entityManager->copy($entity, $deep = false);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        // TODO: Implement lock() method.

        $this->entityManager->lock($entity, $lockMode, $lockVersion);
    }

    public function getEventManager()
    {
        // TODO: Implement getEventManager() method.

        return $this->entityManager->getEventManager();
    }

    public function getConfiguration()
    {
        // TODO: Implement getConfiguration() method.

        return $this->entityManager->getConfiguration();
    }

    public function isOpen()
    {
        // TODO: Implement isOpen() method.

        return $this->entityManager->isOpen();
    }

    public function getUnitOfWork()
    {
        // TODO: Implement getUnitOfWork() method.

        return $this->entityManager->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        // TODO: Implement getHydrator() method.

        return $this->entityManager->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        // TODO: Implement newHydrator() method.

        return $this->entityManager->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        // TODO: Implement getProxyFactory() method.

        return $this->entityManager->getProxyFactory();
    }

    public function getFilters()
    {
        // TODO: Implement getFilters() method.

        return $this->entityManager->getFilters();
    }

    public function isFiltersStateClean()
    {
        // TODO: Implement isFiltersStateClean() method.

        return $this->entityManager->isFiltersStateClean();
    }

    public function hasFilters()
    {
        // TODO: Implement hasFilters() method.

        return $this->entityManager->hasFilters();
    }

    public function find($className, $id)
    {
        // TODO: Implement find() method.

        return $this->entityManager->find($className, $id);
    }

    public function persist($object)
    {
        // TODO: Implement persist() method.

        $this->entityManager->persist($object);
    }

    public function remove($object)
    {
        // TODO: Implement remove() method.

        $this->entityManager->remove($object);
    }

    public function merge($object)
    {
        // TODO: Implement merge() method.

        return $this->entityManager->merge($object);
    }

    public function clear($objectName = null)
    {
        // TODO: Implement clear() method.

        $this->entityManager->clear($objectName = null);
    }

    public function detach($object)
    {
        // TODO: Implement detach() method.

        $this->entityManager->detach($object);
    }

    public function refresh($object)
    {
        // TODO: Implement refresh() method.

        $this->entityManager->refresh($object);
    }

    public function flush()
    {
        // TODO: Implement flush() method.

        $this->entityManager->flush();
    }

    public function getRepository($className)
    {
        // TODO: Implement getRepository() method.

        return $this->entityManager->getRepository($className);
    }

    public function getMetadataFactory()
    {
        // TODO: Implement getMetadataFactory() method.

        return $this->entityManager->getMetadataFactory();
    }

    public function initializeObject($obj)
    {
        // TODO: Implement initializeObject() method.

        $this->entityManager->initializeObject($obj);
    }

    public function contains($object)
    {
        // TODO: Implement contains() method.

        return $this->entityManager->contains($object);
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method Mapping\ClassMetadata getClassMetadata($className)

        return $this->entityManager->__call($name, $arguments);
    }

    public function getClassMetadata($className)
    {
        return $this->entityManager->getClassMetadata($className);
    }
}
