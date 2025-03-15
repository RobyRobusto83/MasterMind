<?php

namespace App\Match\ListScores;

//caso de uso

use App\Entity\MovesDocument;
use App\Repository\MovesDocumentRepository;

class ListAllScoresAplication
{
    public function __construct(private MovesDocumentRepository $repository)
    {

    }

    public function execute(): array
    {
        $moves = [];
        // Busco los resultados
        $match = $this->repository->findAllScores();

        /* @var MovesDocument $doc */
        foreach ($moves as $doc) {
            $moves[] = [
                'id' => $doc->getId(),
                'score' => $doc->getScore(),
            ];
        }

        return $moves;

    }

}