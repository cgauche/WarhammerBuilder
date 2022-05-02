<?php

namespace App\Form;

use App\Entity\Species;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Source;
use Doctrine\ORM\EntityManagerInterface;

class SpeciesType extends AbstractType
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
            ->add('name', TextType::Class, [
                'row_attr' => ['class' => 'col s12']
            ])
            ->add('rollmin', IntegerType::Class, [
                'row_attr' => ['class' => 'col s6'],
                'label' => 'Nombre minimun pour le jet de dé'
            ])
            ->add('rollmax', IntegerType::Class, [
                'row_attr' => ['class' => 'col s6'],
                'label' => 'Nombre maximum pour le jet de dé'
            ])
            ->add('description', TextareaType::Class, [
                'row_attr' => ['class' => 'col s12']
            ])
            ->add('randomtalents', IntegerType::Class, [
                'row_attr' => ['class' => 'col s12'],
                'label' => 'Nombre de talents aléatoires'
            ])
            ->add('age', IntegerType::Class, [
                'row_attr' => ['class' => 'col s6'],
            ])
            ->add('rollage', IntegerType::Class, [
                'row_attr' => ['class' => 'col s6'],
                'label' => 'Nombre de dés supplémentaires'
            ])
            ->add('height', IntegerType::Class, [
                'row_attr' => ['class' => 'col s6'],
                'label' => 'Taille (cm)'
            ])
            ->add('rollheight', IntegerType::Class, [
                'row_attr' => ['class' => 'col s6'],
                'label' => 'Nombre de dés supplémentaires'
            ])
            ->add('fate', IntegerType::Class, [
                'row_attr' => ['class' => 'col s4'],
                'label' => 'Point de destin'
            ])
            ->add('resilience', IntegerType::Class, [
                'row_attr' => ['class' => 'col s4'],
                'label' => 'Point de résilience'
            ])
            ->add('frSpend', IntegerType::Class, [
                'row_attr' => ['class' => 'col s4'],
                'label' => 'Point supplémentaires'
            ])
            ->add('idSource', ChoiceType::class, [
                'placeholder' => 'Sélectionner une source...',
                'label' => 'Source',
                'choices' => $list,
                'row_attr' => ['class' => 'col s12']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Species::class,
        ]);
    }
}
