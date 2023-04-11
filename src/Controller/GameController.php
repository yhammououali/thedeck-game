<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Generator\CardsGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    #[Route('/game/create', name: 'app_game_create')]
    public function create(Request $request): Response
    {
        $game = new Game();

        $form = $this->createForm(GameType::class, $game);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($game);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_game_start', ['id' => $game->getId()]);
        }

        return $this->render('game/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/game/{id}/start', name: 'app_game_start', requirements: ['id' => '\d+'])]
    public function start(Game $game): Response
    {
        return $this->render('game/start.html.twig', [ 'game' => $game ]);
    }

    #[Route('/game/{id}/cards', name: 'app_get_cards', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getCards(CardsGenerator $cardsGenerator): JsonResponse
    {
        $unsortedCards = $cardsGenerator->generate();

        return new JsonResponse([
            'unsortedCards' => $unsortedCards,
            'sortedCards' => $cardsGenerator->sortCardsByColorsAndValues($unsortedCards)
        ]);
    }
}
