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
     * @ORM\Column(type="datetime", unique=true)
     */
    protected $fecha;

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

    function __construct() {
        $this->alumnos = new ArrayCollection();
        $this->fecha = new \DateTime(date('Y-m-d', strtotime('today')));
    }

    function getId() {
        return $this->id;
    }

    function getFecha() {
        return $this->fecha;
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

    function setFecha($fecha) {
        $this->fecha = $fecha;
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

    function addAlumno($alumno) {
        $this->alumnos[] = $alumno;
        return $this;
    }

    public function getArrayCopy() {
        $array['curso'] = $this->curso->getPersonGroupId();
        $array['fecha'] = $this->fecha->format("Y-m-d");
        $alumnos = array();
        foreach ($this->alumnos as $alumno)
            array_push($alumnos, $alumno->getArrayCopy());
        $array['alumnos'] = $alumnos;
        return $array;
    }

}
