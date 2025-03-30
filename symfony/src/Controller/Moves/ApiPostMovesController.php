<?php

namespace App\Controller\Moves;

use App\Match\CreateMatch\CreateMatchAplication;
use App\Match\CreateMoves\CreateMovesAplication;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\MatchDocument;
use App\Entity\MovesDocument;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

class ApiPostMovesController extends AbstractController
{
    #[Route('/api/moves', name: 'create_move', methods: ['POST'])]
    public function defaultAction(ManagerRegistry $doctrine, Request $request): Response
    {
        try {
            // Recupero datos desde request
            $param = json_decode($request->getContent(), true);

            $useCase = new CreateMovesAplication(
                $doctrine->getRepository(MatchDocument::class),
                $doctrine->getRepository(MovesDocument::class)
            );
            $useCase->execute($param);

            // Informo Ok al cliente
            return new Response(
                "OK",
                Response::HTTP_OK,
                ['Content-type' => 'application/' . $request->getContentType()]
            );

        } catch (Throwable $e) {
            return new JsonResponse(
                [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'message' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

}