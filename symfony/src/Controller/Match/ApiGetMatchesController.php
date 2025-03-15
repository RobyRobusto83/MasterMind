<?php

namespace App\Controller\Match;

use App\Entity\MatchDocument;
use App\Match\ListMatches\ListAllMatchesAplication;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class ApiGetMatchesController extends AbstractController
{
    #[Route('/api/matchs', name: 'matchs_list', methods: ['GET'])]
    public function defaultAction(ManagerRegistry $doctrine, Request $request): Response
    {
        try {
            $useCase = new ListAllMatchesAplication($doctrine->getRepository(MatchDocument::class));
            return new JsonResponse(
                ['matches' => $useCase->execute()],
                Response::HTTP_OK
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