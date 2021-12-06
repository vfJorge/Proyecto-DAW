<?php
include("../variablesbd.php");
include("../funciones.php");
session_start();

$message = '';

    if (isset($_FILES['fotoSubida']) && $_FILES['fotoSubida']['error'] === UPLOAD_ERR_OK)
    {
        // get details of the uploaded file
        $fileTmpPath = $_FILES['fotoSubida']['tmp_name'];
        $fileName = $_FILES['fotoSubida']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // sanitize file-name
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        // directory in which the uploaded file will be moved
        $uploadFileDir = '../uploaded_files/';
        $dest_path = $uploadFileDir . $newFileName;


        if(move_uploaded_file($fileTmpPath, $dest_path))
        {
            $message ='File is successfully uploaded.';

            $sql = "UPDATE `usuarios` SET `foto_perfil` = '".$newFileName."' WHERE `usuarios`.`correo` = '".$_SESSION["email"]."';";

            if(array_key_exists('user_image', $_SESSION)) {
                if($_SESSION["user_image"] !== NULL) {
                    unlink("../uploaded_files/".$_SESSION["user_image"]);
                }
            }

            $_SESSION["user_image"] = $newFileName;

            EjecutarSQL($servidor, $usuario, $contrasena, $basedatos, $sql);

        }
        else
        {
            $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
        }

    }
    else
    {
        $message = 'There is some error in the file upload. Please check the following error.<br>';
        $message .= 'Error:' . $_FILES['fotoSubida']['error'];
    }

$_SESSION['message'] = $message;