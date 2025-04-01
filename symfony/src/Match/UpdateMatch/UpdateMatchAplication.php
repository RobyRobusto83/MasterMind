<?php

namespace App\Match\UpdateMatch;

use App\Entity\MatchDocument;

class UpdateMatchAplication
{
    private const STATUS_END="ended";

    public function __construct(private $repository)
    {

    }

    public function execute(array $param): void
    {
        /* @var MatchDocument $match */
        $match = $this->repository->findByUuid($param['id']);
        if (null === $match) {
            throw new \Exception('Match not found for id ' . $param['id']);
        }
        $match->setstatus(self::STATUS_END);
        $match->setSuccessful(false);
        if ($param['succsesfull'] === 'OK'){
            $match->setSuccessful(true);
        }

        $this->repository->add($match, true);
    }
}