<?php

namespace MinimalOriginal\RelatedBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\RequestStack;

use MinimalOriginal\CoreBundle\Util\TextParser;
use MinimalOriginal\CoreBundle\Service\Related as BaseRelated;
use MinimalOriginal\RelatedBundle\Entity\Related as RelatedEntity;

class Related extends BaseRelated
{
  protected $em;
  protected $requestStack;
  protected $related;
  protected $route;

    /**
    * @param EntityManagerInterface $em
    * @param RequestStack $requestStack
    */
    public function __construct(EntityManagerInterface $em, RequestStack $requestStack)
    {
      parent::__construct();
      $this->em = $em;
      $this->requestStack = $requestStack;

      $request = $this->requestStack->getCurrentRequest();

      if( null !== ($this->route = $request->get('_route')) ){
        $repository = $this->em->getRepository(RelatedEntity::class);
        $this->related = $repository->createQueryBuilder('s')
        ->join('s.routing', 'r')
        ->where('r.route IN (:routename)')
        ->setParameter('routename', $this->route)
        ->getQuery()
        ->getOneOrNullResult();

      }
    }

    /**
    *
    * @param string $default
    *
    * @return string
    */
    public function getTitle($default = null)
    {

        if( null !== $this->related ){
          return $this->related->getTitle();
        }
        return $default;
    }

    /**
    *
    * @param string $default
    *
    * @return string
    */
    public function getDescription($default = null)
    {

        if( null !== $this->related ){
          return $this->related->getDescription();
        }
        return $default;
    }

}
