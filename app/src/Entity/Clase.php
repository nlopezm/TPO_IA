<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="clases")
 */
class Clase {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Curso", inversedBy="clases")
     */
    protected $curso;

    /**
     * @ORM\ManyToMany(targetEntity="Alumno")
     * @ORM\JoinTable(name="clase_alumne",
     *      joinColumns={@ORM\JoinColumn(name="clase_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="alumno_id", referencedColumnName="id")}
     *  )
     */
    protected $alumnos;

    function __construct($curso) {
        $this->curso = $curso;
        $this->alumnos = new ArrayCollection();
    }

    function getId() {
        return $this->id;
    }

    function getCurso() {
        return $this->curso;
    }

    function getAlumnos() {
        return $this->alumnos;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setCurso($curso) {
        $this->curso = $curso;
        return $this;
    }

    function setAlumnos($alumnos) {
        $this->alumnos = $alumnos;
        return $this;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

    function addAlumno($alumno) {
        $this->alumnos[] = $alumno;
        return $this;
    }

}
