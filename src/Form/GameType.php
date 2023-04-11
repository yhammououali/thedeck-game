<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Name of the game'
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Description of the game'
            ])
            ->add('playerOneName', TextType::class, [
                'required' => true,
                'label' => 'Player name one'
            ])
            ->add('playerTwoName', TextType::class, [
                'required' => true,
                'label' => 'Player name two'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Create'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
