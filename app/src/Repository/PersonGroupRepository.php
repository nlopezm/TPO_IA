<?php

namespace App\Repository;

use App\AbstractRepository;
use App\Entity\Curso;

class PersonGroupRepository extends AbstractRepository {

    public function get($personGroupId) {
        $curso = $this->entityManager->getRepository('App\Entity\Curso')->findOneByPersonGroupId($personGroupId);
        return $curso->getArrayCopy();
    }

    public function createCurso($personGroupId, $nombre) {
        $entity = new Curso($personGroupId, $nombre);
        $this->entityManager->persist($entity);
        $this->entityManager->flush($entity);
        return $entity->getArrayCopy();
    }

}
