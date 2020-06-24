<?php

namespace App\Core;

class ImageFileUploader extends FileUploader {

    public function __construct(string $fieldname) {
        parent::__construct($fieldname);
        $this->allowedMimeTypes = [
            'image/gif',
            'image/jpeg',
            'image/png',
            'image/svg+xml'
        ];
    }
}