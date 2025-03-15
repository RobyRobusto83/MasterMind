<?php

namespace App\Match\ListMatches;

//caso de uso

use App\Entity\MatchDocument;
use App\Repository\MatchDocumentRepository;

class ListAllMatchesAplication
{
    public function __construct(private MatchDocumentRepository $repository)
    {

    }

    public function execute(): array
    {
        $matches = [];
        // Busco las partidas jugandose
        $match = $this->repository->findAllRunning();

        /* @var MatchDocument $doc */
        foreach ($match as $doc) {
            $matches[] = [
                'uuid' => $doc->getUuid(),
                'name' => $doc->getName(),
            ];
        }

        return $matches;

    }

}