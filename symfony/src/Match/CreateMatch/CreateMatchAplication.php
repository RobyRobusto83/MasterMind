<?php

namespace App\Match\CreateMatch;


use App\Entity\MatchDocument;

final class CreateMatchAplication
{
    private const STATUS_RUN="runing";
    private const STATUS_END="ended";

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
            $match->setName(null); // nombre opcional, no se necesita valor
        }

        $match->setColor($this->generarCodigoColoresConRepeticion());
        $match->setstatus(self::STATUS_RUN);
        $match->setstatus(self::STATUS_END);

        $this->repository->add($match, true);
    }

    private function generarCodigoColoresConRepeticion(): string
    {
        $colores = ["Rojo", "Azul", "Amarillo", "Verde", "Marron", "Morado"];
        $codigo = [];

        // Generar un código de 4 colores con posibles repeticiones
        for ($i = 0; $i < 4; $i++) {
            $codigo[] = $colores[array_rand($colores)];
        }

        return json_encode($codigo);
    }

}
