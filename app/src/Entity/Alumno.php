<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="alumnes")
 */
class Alumno {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",unique=true)
     */
    protected $personId;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    protected $legajo;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $apellido;

    /**
     * @ORM\Column(type="string")
     */
    protected $foto;

    function __construct($personId, $legajo, $nombre, $apellido) {
        $this->personId = $personId;
        $this->legajo = $legajo;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    function getId() {
        return $this->id;
    }

    function getPersonId() {
        return $this->personId;
    }

    function getLegajo() {
        return $this->legajo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getFoto() {
        return $this->foto;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setPersonId($personId) {
        $this->personId = $personId;
        return $this;
    }

    function setLegajo($legajo) {
        $this->legajo = $legajo;
        return $this;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
        return $this;
    }

    function setFoto($foto) {
        $this->foto = $foto;
        return $this;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
