<?php

namespace App\Match\CreateMatch;


use App\Entity\MatchDocument;

final class CreateMatchAplication
{
    private const STATUS_RUN="runing";

    public function __construct(private $repository)
    {

    }

    public function execute(array $param): void
    {
        $match = $this->repository->findByUuid($param['id']);
        if ($match) {
            throw new \Exception('Match found for id ' . $param['id']);
        }

        $match = new MatchDocument();
        $match->setUuid($param['id']);

        if (!empty($param['name'])) {
            $match->setName($param['name']);
        } else {
            $match->setName(""); // nombre opcional, no se necesita valor
        }

        $target = $param["target"];
        $match->setTargetColors($target);
        $match->setstatus(self::STATUS_RUN);

        $this->repository->add($match, true);
    }
}
