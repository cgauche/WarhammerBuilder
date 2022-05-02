<?php

namespace App\Form;

use App\Entity\SpellFamily;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Source;
use Doctrine\ORM\EntityManagerInterface;

class SpellFamilyType extends AbstractType
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
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('realName', TextType::class, ['label' => 'Nom secondaire'])
            ->add('type', TextType::class)
            ->add('color', TextType::class, ['label' => 'Couleur'])
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
            'data_class' => SpellFamily::class,
        ]);
    }
}
