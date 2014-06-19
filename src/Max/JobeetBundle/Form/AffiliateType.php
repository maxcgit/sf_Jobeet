<?php

namespace Max\JobeetBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Max\JobeetBundle\Entity\Affiliate;
use Max\JobeetBundle\Entity\Category;
 
class AffiliateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url')
            ->add('email')
            ->add('categories', null, array('expanded'=>true))
        ;
    }
 
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Max\JobeetBundle\Entity\Affiliate',
        ));
    }
 
    public function getName()
    {
        return 'aff';
    }
}