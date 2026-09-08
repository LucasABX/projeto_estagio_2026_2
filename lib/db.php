<?php
    require_once __DIR__ . '/rb.php';

    $pastaBanco = __DIR__ . '/../db';
    if (!is_dir($pastaBanco)) {
        mkdir($pastaBanco, 0777, true);
    }

    $caminhoBanco = __DIR__ . '/../db/db.sqlite';

    R::setup("sqlite:" . $caminhoBanco);

    R::freeze(false);

    require_once __DIR__ . '/../src/Services/LoginService.php';

    LoginService::inicializarAdm();
?>