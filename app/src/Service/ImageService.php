<?php

namespace App\Service;

use Aws\S3\S3Client;

class ImageService {

    protected $s3;

    function __construct() {
        $this->s3 = new S3Client([
            'version' => '2006-03-01',
            'region' => 'us-east-1',
            'credentials' => array(
                'key' => S3_KEY,
                'secret' => S3_SECRET,
            )
        ]);
    }

    public function guardarImagen($base64Array, $subFolder = null) {
        $imagenes = array();
        foreach ($base64Array as $base64) {
            $imagen = $this->getDecodificada($base64);
            $f = finfo_open();

            $mime_type = finfo_buffer($f, $imagen, FILEINFO_MIME_TYPE);
            try {
                $result = $this->s3->putObject([
                    'Bucket' => 'ia.imagenes',
                    'Key' => 'images/' . ( $subFolder ? $subFolder . '/' : '') . uniqid() . '.' . explode('/', $mime_type)[1],
                    'Body' => $imagen,
                    'ContentType' => $mime_type,
                    'ACL' => 'public-read',
                ]);
                array_push($imagenes, $result['ObjectURL']);
            } catch (Aws\S3\Exception\S3Exception $e) {
                throw new \Exception($e);
            }
        }
        return $imagenes;
    }

    private function getDecodificada($base64) {
        $base64 = str_replace("data:image/jpeg;base64,", "", $base64);
        $base64 = str_replace("data:image/png;base64,", "", $base64);
        $base64 = str_replace(" ", "+", $base64);
        $imagen = base64_decode($base64);

        return $imagen;
    }

}
