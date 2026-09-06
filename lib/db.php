<?php
    require_once __DIR__ . '/rb.php';

    $caminhoBanco = __DIR__ . '/../db/db.sqlite';

    R::setup("sqlite:" . $caminhoBanco);

    R::freeze(false);
?>