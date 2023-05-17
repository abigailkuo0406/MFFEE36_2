<?php

$p = '345678';
$hash = '$2y$10$WEgEvErgyDcbxgic3P.1G.ed3dbzVedGx4JtqdegCz99aQvgUkDaa';


var_dump(password_verify($p, $hash));