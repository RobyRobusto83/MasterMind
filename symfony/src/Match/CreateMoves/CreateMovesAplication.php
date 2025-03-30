<?php

namespace App\Match\CreateMoves;

use App\Entity\MatchDocument;
use App\Entity\MovesDocument;
use App\Repository\MatchDocumentRepository;
use App\Repository\MovesDocumentRepository;

class CreateMovesAplication
{
    public function __construct(
        private MatchDocumentRepository $match_repo,
        private MovesDocumentRepository $repository
    )
    {

    }

    public function execute(array $param): void
    {
        // Busco la paritda por uuid
        /* @var \App\Entity\MatchDocument $match */
        $match = $this->match_repo->findByUuid($param["match_id"]);

        // Si no esta error
        if ($match === null) {
            throw new \Exception('Match not found for id ' . $param["match_id"]);
        }

        // Preparo entidad para mandar a repository
        $moves = new MovesDocument();
        $target = $param["target"];
        $target_Answer = $param["target_Answer"];
        $moves->setUuid($param['id']);
        $moves->setMatch($match);
        $moves->setCodigoPropuesto($target);
        $moves->setAttemptedAnswers($target_Answer);

        // Mando accion (add) al repository
        $this->repository->add($moves, true);
    }

}