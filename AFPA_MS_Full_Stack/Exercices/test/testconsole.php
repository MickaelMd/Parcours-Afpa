<?php 

$startTime = microtime(true);
echo $startTime;

$result = 0;

for ($i = 0; $i < 10000000; $i++) { 
    $calcul = rand(1, 54645) * rand(45, 786) / rand(1, 78) * rand(7, 89846) * rand(748, 844869846) / rand(7, 846) - rand(784846, 4484848646864888) / rand(4878, 911486) * time();
    $result =  $result + $calcul / 999999999999999999 ;
}

$endTime = microtime(true);
echo "\n" . $endTime;
$executionTime = $endTime - $startTime;

echo "\n \n" . "Temps d'exécution : " . $executionTime . " secondes\n" . "Résultat : " . intval($result) .  "\n";