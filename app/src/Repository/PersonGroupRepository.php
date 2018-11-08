<?php

namespace App\Repository;

use App\AbstractRepository;
use App\Entity\Curso;
use App\Entity\Clase;

class PersonGroupRepository extends AbstractRepository {
    
    public function getAll() {
        $cursos = $this->entityManager->getRepository('App\Entity\Curso')->findAll();
        return $cursos;
    }

    public function get($personGroupId) {
        $curso = $this->entityManager->getRepository('App\Entity\Curso')->findOneByPersonGroupId($personGroupId);
        return $curso;
    }

    public function createCurso($personGroupId, $nombre) {
        $entity = new Curso($personGroupId, $nombre);
        $this->entityManager->persist($entity);
        $this->entityManager->flush($entity);
        return $entity->getArrayCopy();
    }

    public function tomarAsistencia($personGroupId, $alumnos) {
        $presentes = array();
        $clase = $this->getClase($personGroupId);
        foreach ($alumnos as $alumno)
            if (sizeof($alumno['candidates']) && $alumno['candidates'][0]['confidence'] >= CONFIDENCE) {
                $this->alumnoPresente($clase, $alumno['candidates'][0]['personId']);
            }
        return array_unique($clase->getArrayCopy());
    }

    private function getClase($personGroupId) {
        $curso = $this->get($personGroupId);
        $hoy = (new \DateTime())->format("Y-m-d");
        $clase = $this->entityManager->getRepository("App\Entity\Clase")->findOneBy(array("fecha" => array($hoy), "curso" => $curso->getId()));
        if ($clase)
            return $clase;
        $clase = new Clase ();
        $clase->setCurso($curso);
        $this->entityManager->persist($clase);
        $this->entityManager->flush($clase);
        return $clase;
    }

    public function alumnoPresente(&$clase, $personId) {
        try {
            $alumno = $this->entityManager->getRepository("App\Entity\Alumno")->findOneByPersonId($personId);
            $clase->addAlumno($alumno);
            $this->entityManager->flush($clase);
        } catch (\Exception $e) {}
    }
    
    public function tomarAsistenciaManual($personGroupId, $alumnos) {
        $clase = $this->getClase($personGroupId);
        $alumnos = $this->entityManager->getRepository("App\Entity\Alumno")->findById($alumnos);
        $clase->setAlumnos($alumnos);
        $this->entityManager->flush($clase);
        return array_unique($clase->getArrayCopy());
    }

}
