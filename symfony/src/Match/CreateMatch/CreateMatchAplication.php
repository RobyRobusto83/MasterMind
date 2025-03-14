<?php

namespace App\Match\CreateMatch;


use App\Entity\MatchDocument;

final class CreateMatchAplication
{
    public function __construct(private $repository)
    {

    }

    public function execute(array $param): void
    {
        // Busco la tarea por uuid
        $match = $this->repository->findByUuid($param['id']);

        // Si no esta error
        if ($match) {
            throw new \Exception('Task found for id ' . $param['id']);
        }

        // Preparo entidad para mandar a repository
        $match = new MatchDocument();
        $match->setUuid($param['id']);
        $match->setName($param['name']); // ToDo puede ser opcional
        $match->setColor($this->generarCodigoColoresConRepeticion());

        // Mando accion (add) al repository
        $this->repository->add($match, true);
    }

    private function generarCodigoColoresConRepeticion(): string
    {
        $colores = ["Turquesa", "Mostaza", "Coral", "Lavanda", "Esmeralda", "Granate"];
        $codigo = [];

        // Generar un código de 4 colores con posibles repeticiones
        for ($i = 0; $i < 4; $i++) {
            $codigo[] = $colores[array_rand($colores)];
        }

        return json_encode($codigo);
    }

}
