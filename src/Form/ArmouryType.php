<?php

namespace App\Form;

use App\Entity\Armoury;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Source;
use Doctrine\ORM\EntityManagerInterface;

class ArmouryType extends AbstractType
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
            ->add('name', TextType::class,[
                'row_attr' => ['class' => 'col s12']
            ])
            ->add('type', TextType::class,[
                'row_attr' => ['class' => 'col s6']
            ])
            ->add('group', TextType::class,[
                'row_attr' => ['class' => 'col s6']
            ])
            ->add('price', TextType::class,[
                'row_attr' => ['class' => 'col s6']
            ])
            ->add('clutter', IntegerType::class,[
                'row_attr' => ['class' => 'col s6']
            ])
            ->add('availability', TextType::class,[
                'row_attr' => ['class' => 'col s6']
            ])
            ->add('range', TextType::class,[
                'row_attr' => ['class' => 'col s6']
            ])
            ->add('damage', TextType::class,[
                'row_attr' => ['class' => 'col s6']
            ])
            ->add('penalty', TextType::class,[
                'row_attr' => ['class' => 'col s6']
            ])
            ->add('location', TextType::class,[
                'row_attr' => ['class' => 'col s6']
            ])
            ->add('pa', TextType::class,[
                'row_attr' => ['class' => 'col s6']
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
            'data_class' => Armoury::class,
        ]);
    }
}
