<?php

namespace App\Controller\Match;

//use App\Entity\Document;
//use App\Pfc\application\GetPFC\ApiGetPFCContent;
//use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiGetMatchesController extends AbstractController
{
    #[Route('/api/matchs', name: 'matchs_list', methods: ['GET'])]
    public function defaultAction(Request $request): Response
    {
        try {
            throw(new \Exception("Rompido"));
//            $id = $request->attributes->get("uuid");
//            $useCase = new ApiGetPFCContent($doctrine->getRepository(Document::class));
//            return new JsonResponse(
//                ['document' => $useCase->execute($id)],
//                Response::HTTP_OK
//            );
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