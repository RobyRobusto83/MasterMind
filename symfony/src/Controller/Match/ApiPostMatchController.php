<?php

namespace App\Controller\Match;

use App\Entity\MatchDocument;
use App\Match\UpdateMatch\UpdateMatchAplication;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

class ApiPostMatchController extends AbstractController
{
    #[Route('/api/match', name: 'update_match', methods: ['POST'])]
    public function defaultAction(ManagerRegistry $doctrine, Request $request): Response
    {
        try {
            // Recupero datos desde request
            $param = json_decode($request->getContent(), true);

            $useCase = new UpdateMatchAplication($doctrine->getRepository(MatchDocument::class));
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