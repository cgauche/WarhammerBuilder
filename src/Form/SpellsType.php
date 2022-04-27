<?php

namespace App\Form;

use App\Entity\Spells;
use App\Entity\SpellFamily;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Source;
use Doctrine\ORM\EntityManagerInterface;

class SpellsType extends AbstractType
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
        $spellFamily = $this->em->getRepository(SpellFamily::class)->findAll();
        $listSP = [];
        foreach($spellFamily as $sp){
            $listSP[$sp->getName() . ($sp->getRealName() != '' ? ' ' . $sp->getRealName() : '')] = $sp->getId();
        }

        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'row_attr' => ['class' => 'col s12']
            ])
            ->add('type', TextType::class,[
                'row_attr' => ['class' => 'col s12']
            ])
            ->add('ni', IntegerType::class, [
                'label' => 'Niveau d\'incantation',
                'row_attr' => ['class' => 'col s12']
            ])
            ->add('range', TextType::class, [
                'label' => 'Portée',
                'row_attr' => ['class' => 'col s6']
            ])
            ->add('target', TextType::class, [
                'label' => 'Cible',
                'row_attr' => ['class' => 'col s6']
            ])
            ->add('damage', TextType::class, [
                'label' => 'Dégats',
                'row_attr' => ['class' => 'col s6']
            ])
            ->add('length', TextType::class, [
                'label' => 'Taille',
                'row_attr' => ['class' => 'col s6']
            ])
            ->add('description', TextareaType::class,)
            ->add('idSpellFamily', ChoiceType::class, [
                'placeholder' => 'Sélectionner une famille de sort...',
                'label' => 'Famille',
                'choices' => $listSP
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
            'data_class' => Spells::class,
        ]);
    }
}
