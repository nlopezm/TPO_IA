<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="cursos")
 */
class Curso {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",unique=true)
     */
    protected $personGroupId;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $nombre;

    /**
     * @ORM\ManyToMany(targetEntity="Alumno")
     * @ORM\JoinTable(name="curso_alumne",
     *      joinColumns={@ORM\JoinColumn(name="curso_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="alumno_id", referencedColumnName="id")}
     *  )
     */
    protected $alumnos;

    /**
     * @ORM\OneToMany(targetEntity="Clase", mappedBy="curso", cascade={"persist","remove"})
     */
    protected $clases;

    function __construct($personGroupId, $nombre) {
        $this->personGroupId = $personGroupId;
        $this->nombre = $nombre;
        $this->alumnos = new ArrayCollection();
        $this->clases = new ArrayCollection();
    }

    function getId() {
        return $this->id;
    }

    function getPersonGroupId() {
        return $this->personGroupId;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getAlumnos() {
        return $this->alumnos;
    }

    function getClases() {
        return $this->clases;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setPersonGroupId($personGroupId) {
        $this->personGroupId = $personGroupId;
        return $this;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    function setAlumnos($alumnos) {
        $this->alumnos = $alumnos;
        return $this;
    }

    function setClases($clases) {
        $this->clases = $clases;
        return $this;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function addAlumno($alumno) {
        $this->alumnos[] = $alumno;
        return $this;
    }

}
