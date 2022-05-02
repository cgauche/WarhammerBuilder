<?php

namespace App\Form;

use App\Entity\Careers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Source;
use App\Entity\Classes;
use Doctrine\ORM\EntityManagerInterface;

class CareersType extends AbstractType
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

        $classes = $this->em->getRepository(Classes::class)->findAll();
        $listC = [];
        foreach($classes as $c){
            $listC[$c->getName()] = $c->getId();
        }

        $builder
            ->add('name',TextType::class)
            ->add('resume', TextType::class)
            ->add('description', TextareaType::class)
            ->add('idClass', ChoiceType::class, [
                'placeholder' => 'Sélectionner une classe...',
                'label' => 'Classe',
                'choices' => $listC
            ])
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
            'data_class' => Careers::class,
        ]);
    }
}
