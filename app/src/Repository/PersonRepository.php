<?php

namespace App\Repository;

use App\AbstractRepository;
use App\Entity\Alumno;

class PersonRepository extends AbstractRepository {

    public function createPerson($personGroupId, $personId, $legajo, $nombre, $apellido, $foto) {
        $curso = $this->entityManager->getRepository('App\Entity\Curso')->findOneByPersonGroupId($personGroupId);
        $entity = new Alumno($personId, $legajo, $nombre, $apellido, $foto);
        $curso->addAlumno($entity);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity->getArrayCopy();
    }

    public function getPerson($legajo) {
        return $this->entityManager->getRepository('App\Entity\Alumno')->findOneByLegajo($legajo);
    }

}
