<?php

namespace App\Form;

use App\Entity\WeaponAttr;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Source;


class WeaponAttrType extends AbstractType
{
    public function __construct(EntityManagerInterface $entityManager)

    {
        $this->em = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $sources = $this->em->getRepository(Source::class)->findAll();
        $list = [];
        foreach($sources as $s){
            $list[$s->getName()] = $s->getId();
        }

        $builder
        ->add('name', TextType::class)
        ->add('withRank', ChoiceType::class, [
            'label' => 'Avec niveau ?',
            'choices' => [
                'Non' => false,
                'Oui' => true
            ]
        ])
        ->add('description', TextareaType::class)
        ->add('idSource', ChoiceType::class, [
            'placeholder' => 'Sélectionner une source...',
            'label' => 'Source',
            'choices' => $list
        ])
        
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WeaponAttr::class,
        ]);
    }
}
