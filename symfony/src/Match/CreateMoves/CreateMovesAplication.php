<?php

namespace App\Match\CreateMoves;

use App\Entity\MovesDocument;
use App\Repository\MovesDocumentRepository;

class CreateMovesAplication
{
    public function __construct(private MovesDocumentRepository $repository)
    {

    }

    public function execute(array $param): void
    {
        // Busco la tarea por uuid
        /* @var \App\Entity\MatchDocument $match */
        $match = $this->repository->findByUuid($param["match_id"]);

        // Si no esta error
        if ($match === null) {
            throw new \Exception('Match not found for id ' . $param["match_id"]);
        }

        // Preparo entidad para mandar a repository
        $moves = new MovesDocument();
        $moves->setMatch($match);
        $moves->setCodigoPropuesto($param["codigo_propuesto"]);

        // Mando accion (add) al repository
        $this->repository->add($moves, true);
    }

}