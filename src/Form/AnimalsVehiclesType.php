<?php

namespace App\Form;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\AnimalsVehicles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Source;

class AnimalsVehiclesType extends AbstractType
{
    private $em;

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
            ->add('price', TextType::class)
            ->add('clutter', IntegerType::class)
            ->add('contents',IntegerType::class)
            ->add('availability', TextType::class)
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
            'data_class' => AnimalsVehicles::class,
        ]);
    }
}
