<?php

namespace App\Form;

use App\Entity\Skills;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Source;
use App\Entity\Characteristics;
use Doctrine\ORM\EntityManagerInterface;

class SkillsType extends AbstractType
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
            ->add('name', TextType::class , ['label' => 'Nom'])
            ->add('type', ChoiceType::class, ['choices' => ['Base' => 1, 'Avancée' => 2 ]])
            ->add('specs', TextType::class, ['label' => 'Spécialités (séparée par ,)'])
            ->add('description', TextareaType::class)
            ->add('idCaracteristics', ChoiceType::class, [
                'placeholder' => 'Sélectionner une caractéristique...',
                'label' => 'Caractéristique utilisée',
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
            'data_class' => Skills::class,
        ]);
    }
}
