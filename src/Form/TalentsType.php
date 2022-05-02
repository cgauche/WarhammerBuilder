<?php

namespace App\Form;

use App\Entity\Talents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Source;
use Doctrine\ORM\EntityManagerInterface;

class TalentsType extends AbstractType
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
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'row_attr' => ['class' => 'col s12']
            ])
            ->add('Max', TextType::class, [
                'label' => 'Niveau maximal du talent',
                'row_attr' => ['class' => 'col s12']
            ])
            ->add('Test', TextType::class, ['row_attr' => ['class' => 'col s12']])
            ->add('minRoll', IntegerType::class, ['row_attr' => ['class' => 'col s6']])
            ->add('maxRoll', IntegerType::class, ['row_attr' => ['class' => 'col s6']])
            ->add('description', TextareaType::class, ['row_attr' => ['class' => 'col s12']])
            ->add('idSource', ChoiceType::class, [
                'placeholder' => 'Sélectionner une source...',
                'row_attr' => ['class' => 'col s12'],
                'label' => 'Source',
                'choices' => $list
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Talents::class,
        ]);
    }
}
