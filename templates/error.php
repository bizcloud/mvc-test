<?php
/** @var \Exception $exception */
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Error occured!</title>
</head>
<body>
<h1>Error occured! <?= $exception->getCode() ?></h1>

<h2> <?= $exception->getMessage() ?></h2>
</body>
</html>