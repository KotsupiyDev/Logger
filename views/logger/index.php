<?php

use yii\helpers\Html;

/**
 * @var $loggersResponse array
 */

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .list {
            margin-top: 25px;
        }

        .list li {
            border-bottom: 1px solid black;
            padding: 10px 0;
            font-size: 20px;
            list-style-type: none;
        }
    </style>
</head>
<body>

</body>
</html>
<div>
    <ul class="list">
        <?php foreach ($loggersResponse  as $key => $response) :?>
            <li class="item"><?php echo $key+1 . ') '; echo $response; ?></li>
        <?php endforeach; ?>
    </ul>
</div>
