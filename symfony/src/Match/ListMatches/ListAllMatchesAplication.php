<?php

namespace App\Match\ListMatches;

//caso de uso

use App\Entity\MatchDocument;
use App\Entity\MovesDocument;
use App\Repository\MatchDocumentRepository;
use App\Repository\MovesDocumentRepository;

class ListAllMatchesAplication
{
    public function __construct(
        private MatchDocumentRepository $repository,
        private MovesDocumentRepository $movesRepo
    )
    {

    }

    public function execute(): array
    {
        $matches = [];
        // Busco las partidas jugandose
        $match = $this->repository->findAllRunning();

        /* @var MatchDocument $doc */
        foreach ($match as $doc) {
            $moves = [];
            $movesData = $this->movesRepo->findMovesFromMatch($doc->getUuid());
            /* @var MovesDocument $datum */
            foreach ($movesData as $datum){
                $moves[] = [
                    'attempt' => $datum->getAttemptedAnswers(),
                    'try' => $datum->getCodigoPropuesto()
                ];
            }
            $matches[] = [
                'uuid' => $doc->getUuid(),
                'name' => $doc->getName(),
                'target'=> $doc->getTargetColors(),
                'moves'=> $moves
            ];
        }

        return $matches;

    }

}