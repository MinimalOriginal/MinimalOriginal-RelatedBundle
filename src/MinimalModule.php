<?php

namespace MinimalOriginal\RelatedBundle;

use MinimalOriginal\CoreBundle\Modules\AbstractManageableModule;

use MinimalOriginal\RelatedBundle\Form\RelatedType;
use MinimalOriginal\RelatedBundle\Entity\Related;

class MinimalModule extends AbstractManageableModule{

  /**
   * {@inheritdoc}
   */
  public function init(){
    $this->informations->set('name', 'related');
    $this->informations->set('title', 'Relations');
    $this->informations->set('description', "Liez des éléments entre eux.");
    $this->informations->set('icon', "ion-link");
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getEntityClass(){
    return Related::class;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormTypeClass(){
    return RelatedType::class;
  }

  /**
   * {@inheritdoc}
   */
  public function getParent(){
    return array('news','page');
  }

}
