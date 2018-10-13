<?php

namespace App\Repository;

use App\AbstractRepository;
use App\Entity\Curso;

/**
 * Class Resource
 * @package App
 */
class PersonGroupRepository extends AbstractRepository {

    /**
     * @param string|null $slug
     *
     * @return array
     */
    public function get($personGroupId) {
        $curso = $this->entityManager->getRepository('App\Entity\Curso')->findOneByPersonGroupId($personGroupId);
        return $curso->getArrayCopy();
    }

    public function createCurso($personGroupId, $nombre) {
        $entity = new Curso(uniqid(), $nombre);
        $this->entityManager->persist($entity);
        $this->entityManager->flush($entity);
        return $entity->getArrayCopy();
    }

}
