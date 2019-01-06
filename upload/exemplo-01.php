<form method="POST" enctype="multipart/form-data">
  <input type="file" name="fileUpload">
  <button type="submit">Submit</button>
</form>

<?php

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    $file = $_FILES['fileUpload'];

    if ($file['error']) {
        throw new Exception('Error: '.$file['error']);
    }

    $dirUploads = 'uploads';

    if (!is_dir($dirUploads)) {
        mkdir($dirUploads);
    }

    if (!move_uploaded_file($file['tmp_name'], $dirUploads.DIRECTORY_SEPARATOR.$file['name'])) {
        throw new Exception('Erro ao realizar o upload');
    }

    echo 'Success';
}
