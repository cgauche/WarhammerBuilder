<?php

namespace App\Form;

use App\Entity\Ranks;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Source;
use App\Entity\Characteristics;

class RanksType extends AbstractType
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

        $charac = $this->em->getRepository(Characteristics::class)->findAll();
        $listC = [];
        foreach($charac as $c){
            $listC[$c->getName()] = $c->getId();
        }

        $builder
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('status', TextType::class)
            ->add('idCharac', ChoiceType::class, [
                'placeholder' => 'Sélectionner une caractéristique...',
                'label' => 'Caractéristique principale',
                'choices' => $listC
            ])
            ->add('idCharac2', ChoiceType::class, [
                'placeholder' => 'Sélectionner une caractéristique...',
                'label' => 'Caractéristique secondaire',
                'choices' => $listC
            ])
            ->add('idCharac3', ChoiceType::class, [
                'placeholder' => 'Sélectionner une caractéristique...',
                'label' => 'Caractéristique tertiaire',
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
            'data_class' => Ranks::class,
        ]);
    }
}
