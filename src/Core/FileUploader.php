<?php 

namespace App\Core;

use Exception;

class FileUploader {

    const UPLOAD_MAX_FILESIZE = 2097152;

    /**
     * @var array - Les données du fichier uploadé
     */
    private $data;

    /**
     * @var array - Liste des types MIME autorisés
     */
    protected $allowedMimeTypes = null;

    /**
     * Constructeur
     */
    public function __construct(string $fieldname) {
        
        if (!array_key_exists($fieldname, $_FILES)) {
            throw new Exception('There is no field with name ' . $fieldname);
        }

        $this->data = $_FILES[$fieldname];
    }

    /**
     * Copie le fichier temporaire vers son emplacement définitif
     * @param string $uploadDir - Le répertoire de destination 
     * @param string $filename - Le nom du fichier final
     */
    public function moveTempFile(string $uploadDir = null, string $filename = null) {

        if (!$this->data['tmp_name'] || $this->data['error'] == UPLOAD_ERR_NO_FILE) {
            return '';
        }
        
        // Définition du répertoire de destination et du nom du fichier final le cas échéant
        $uploadDir = $uploadDir ?? DEFAULT_UPLOAD_DIR;
        $filename = $filename ?? $this->generateUniqueFilename();

        // Validation du poids maximal du fichier
        if ($this->getFilesize() > self::UPLOAD_MAX_FILESIZE) {
            throw new Exception('Maximum file size exceded.');
        }

        // Validation du type MIME du fichier
        if ($this->allowedMimeTypes != null && !in_array($this->getFileMimeType(), $this->allowedMimeTypes)) {
            throw new Exception('MIME type not allowed.');
        }

        // Création du dossier de destination le cas échéant
        $this->createPathFolders($uploadDir);

        // Copie du fichier vers le dossier cible
        $success = move_uploaded_file($this->data['tmp_name'], $uploadDir . $filename);

        // En cas de problème lors de la copie du fichier...
        if (!$success) {

            // On lance une exception
            throw new Exception('Upload file error.');
        }

        // On retourne le nom du fichier
        return $filename;
    }

    private function generateUniqueFilename() {
        return md5(uniqid(rand(), true)) . '.' .  $this->getFileExtension();
    }
    
    private function getFileExtension() {
        return pathinfo($this->data['name'])['extension'];
    }

    private function createPathFolders(string $path) {
        if (!is_dir($path)) {
            mkdir($path, 755, true);
        }
    }

    private function getFilesize() {
        return filesize($this->data['tmp_name']);
    }

    private function getFileMimeType() {
        return mime_content_type($this->data['tmp_name']);
    }

}