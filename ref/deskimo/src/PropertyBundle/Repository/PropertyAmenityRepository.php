<?php

namespace PropertyBundle\Repository;

use Doctrine\ORM\EntityRepository;
use PropertyBundle\Entity\Property;

class PropertyAmenityRepository extends EntityRepository
{
  public function getAmenitiesByProperty(Property $property)
  {
    $queryBuilder = $this->createQueryBuilder('amenity_property');
    $queryBuilder->select('amenity.id, amenity.name, amenity_property.isFree');
    $queryBuilder->innerJoin('amenity_property.amenity', 'amenity');
    $queryBuilder->where('amenity_property.property = :property');
    $queryBuilder->setParameter('property', $property);

    return $queryBuilder->getQuery()->execute();
  }
}
