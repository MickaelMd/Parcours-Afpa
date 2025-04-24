<?php require_once __DIR__.'/assets/php/connect.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Phase 2</title>
</head>

<body>
    <?php 
echo '<h4>Rechercher le prénom des employés et le numéro de la région de leur
département. </h4>';


echo '<p class="sql">SELECT employe.nodep, employe.nom AS nom_employe, dept.nom AS nom_dept FROM `employe` JOIN dept ON employe.nodep = dept.nodept;</p>';

$sqlQueryy = "SELECT employe.nodep, employe.nom AS nom_employe, dept.nom AS nom_dept FROM `employe` JOIN dept ON employe.nodep = dept.nodept";
$employeStatement = $mysqlClient->prepare($sqlQueryy);
$employeStatement->execute();
$employeList = $employeStatement->fetchAll();

foreach ($employeList as $ex) {

    echo $ex['nom_employe'] . ' - ' . $ex['nodep']  . '</br>';

}

echo '<hr> <h4>Rechercher le numéro du département, le nom du département, le
nom des employés classés par numéro de département (renommer les
tables utilisées).  </h4>';

echo '<p class="sql">SELECT employe.nom AS nom_employe, employe.nodep AS numdep, dept.nom AS nom_dept FROM employe JOIN dept ON employe.nodep = dept.nodept ORDER BY nodep;</p>';


$sqlQuery = "SELECT employe.nom AS nom_employe, employe.nodep AS numdep, dept.nom AS nom_dept FROM employe JOIN dept ON employe.nodep = dept.nodept ORDER BY nodep";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_2 = $Statement->fetchAll();

foreach ($ex_2 as $ex) {

    echo $ex['numdep'] . ' - ' . $ex['nom_dept'] . ' - ' . $ex['nom_employe'] . '</br>';

}

echo '<hr><h4>Rechercher le nom des employés du département Distribution.  </h4>';


echo '<p class="sql">SELECT employe.nom AS nom_employe FROM employe JOIN dept ON employe.nodep = dept.nodept WHERE dept.nom = \'distribution\' ORDER BY nom_employe;</p>';


$sqlQuery = "SELECT employe.nom AS nom_employe FROM employe JOIN dept ON employe.nodep = dept.nodept WHERE dept.nom = 'distribution' ORDER BY nom_employe";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_3 = $Statement->fetchAll();

foreach ($ex_3 as $ex) {

    echo $ex['nom_employe'] . '</br>';

}

echo '<hr><h4> Rechercher le nom et le salaire des employés qui gagnent plus que
leur patron, et le nom et le salaire de leur patron. </h4>';


echo '<p class="sql">SELECT employe.nom AS employe_nom, patron.nom AS patron_nom, employe.salaire AS employe_salaire, patron.salaire AS patron_salaire 
                FROM employe 
                LEFT JOIN employe patron 
                ON employe.nosup = patron.noemp 
                WHERE employe.salaire > patron.salaire;</p>';


$sqlQuery = "SELECT employe.nom AS employe_nom, patron.nom AS patron_nom, employe.salaire AS employe_salaire, patron.salaire AS patron_salaire 
                FROM employe 
                LEFT JOIN employe patron 
                ON employe.nosup = patron.noemp 
                WHERE employe.salaire > patron.salaire;";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_4 = $Statement->fetchAll();

foreach ($ex_4 as $ex) {

    echo $ex['employe_nom'] . ' ' . $ex['employe_salaire'] . '</br>';

}

echo '<hr><h4>Rechercher le nom et le titre des employés qui ont le même titre que
Amartakaldire.  </h4>';


echo '<p class="sql">SELECT nom, titre FROM employe WHERE titre = (SELECT titre FROM employe WHERE nom = \'Amartakaldire\');</p>';


$sqlQuery = "SELECT nom, titre FROM employe WHERE titre = (SELECT titre FROM employe WHERE nom = 'Amartakaldire')"; 
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_5 = $Statement->fetchAll();

foreach ($ex_5 as $ex) {

    echo $ex['nom'] . ' - ' . $ex['titre'] . '</br>';

}

echo '<hr><h4> Rechercher le nom, le salaire et le numéro de département des
employés qui gagnent plus qu\'un seul employé du département 31,
classés par numéro de département et salaire. </h4>';

echo '<p class="sql">SELECT nom, salaire, nodep FROM employe WHERE salaire > ANY (SELECT salaire FROM employe WHERE nodep = 31) ORDER BY nodep, salaire;</p>';


$sqlQuery = "SELECT nom, salaire, nodep FROM employe WHERE salaire > ANY (SELECT salaire FROM employe WHERE nodep = 31) ORDER BY nodep, salaire;";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_6 = $Statement->fetchAll();

foreach ($ex_6 as $ex) {

    echo $ex['nom'] . ' - ' . $ex['salaire'] . ' - ' . $ex['nodep'] . '</br>';

}

echo '<hr><h4>Rechercher le nom, le salaire et le numéro de département des
employés qui gagnent plus que tous les employés du département 31,
classés par numéro de département et salaire. </h4>';


echo '<p class="sql">SELECT nom, salaire, nodep FROM employe WHERE salaire > ALL (SELECT salaire FROM employe WHERE nodep = 31) ORDER BY nodep, salaire;</p>';


$sqlQuery = "SELECT nom, salaire, nodep FROM employe WHERE salaire > ALL (SELECT salaire FROM employe WHERE nodep = 31) ORDER BY nodep, salaire;";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_7 = $Statement->fetchAll();

foreach ($ex_7 as $ex) {

    echo $ex['nom'] . ' - ' . $ex['salaire'] . ' - ' . $ex['nodep'] . '</br>';

}

echo '<hr><h4> 
Rechercher le nom et le titre des employés du service 31 qui ont un
titre que l\'on trouve dans le département 32. </h4>';


echo '<p class="sql">SELECT nom, titre, nodep FROM employe WHERE nodep = 31 AND titre IN (SELECT titre FROM employe WHERE nodep = 32);</p>';

$sqlQuery = "SELECT nom, titre, nodep FROM employe WHERE nodep = 31 AND titre IN (SELECT titre FROM employe WHERE nodep = 32);";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_8 = $Statement->fetchAll();

foreach ($ex_8 as $ex) {

    echo $ex['nom'] . ' - ' . $ex['titre'] . '</br>';

}

echo '<hr><h4>Rechercher le nom et le titre des employés du service 31 qui ont un
titre l\'on ne trouve pas dans le département 32.  </h4>';


echo '<p class="sql">SELECT nom, titre, nodep FROM employe WHERE nodep = 31 AND titre NOT IN (SELECT titre FROM employe WHERE nodep = 32);</p>';


$sqlQuery = "SELECT nom, titre, nodep FROM employe WHERE nodep = 31 AND titre NOT IN (SELECT titre FROM employe WHERE nodep = 32);";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_9 = $Statement->fetchAll();

foreach ($ex_9 as $ex) {

    echo $ex['nom'] . ' - ' . $ex['titre'] . '</br>';

}

echo '<hr><h4>Rechercher le nom, le titre et le salaire des employés qui ont le même
titre et le même salaire que Fairant.  </h4>';


echo '<p class="sql">SELECT nom, titre, salaire FROM employe WHERE titre = (SELECT titre FROM employe WHERE nom = \'fairent\') AND salaire = (SELECT salaire FROM employe WHERE nom = \'fairent\');</p>';

$sqlQuery = "SELECT nom, titre, salaire FROM employe WHERE titre = (SELECT titre FROM employe WHERE nom = 'fairent') AND salaire = (SELECT salaire FROM employe WHERE nom = 'fairent');";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_10 = $Statement->fetchAll();

foreach ($ex_10 as $ex) {

    echo $ex['nom'] . ' - ' . $ex['titre'] . ' - ' . $ex['salaire'] . '</br>';

}

echo '<hr><h4> 
Rechercher le numéro de département, le nom du département, le
nom des employés, en affichant aussi les départements dans lesquels
il n\'y a personne, classés par numéro de département.</h4>';


echo '<p class="sql">SELECT employe.nodep AS emp_nodep, employe.nom AS emp_nom, dept.nom AS dept_nom FROM employe RIGHT JOIN dept ON employe.nodep = dept.nodept ORDER BY employe.nodep;</p>';


$sqlQuery = "SELECT employe.nodep AS emp_nodep, employe.nom AS emp_nom, dept.nom AS dept_nom FROM employe RIGHT JOIN dept ON employe.nodep = dept.nodept ORDER BY employe.nodep;";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_11 = $Statement->fetchAll();

foreach ($ex_11 as $ex) {

    echo $ex['emp_nodep'] . ' - ' . $ex['dept_nom'] . ' - ' . $ex['emp_nom'] . '</br>';

}



// ----------
echo '<hr><h4> 1. Calculer le nombre d\'employés de chaque titre.</h4>';

echo '<p class="sql">SELECT titre, count(titre) FROM employe GROUP BY titre;</p>';

$sqlQuery = "SELECT titre, count(titre) FROM employe GROUP BY titre;";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_12 = $Statement->fetchAll();

foreach ($ex_12 as $ex) {

    echo $ex['titre'] . ' - ' . $ex['count(titre)'] . '</br>';

}

echo '<hr><h4> 2. Calculer la moyenne des salaires et leur somme, par région.</h4>';


echo '<p class="sql">SELECT nodep, AVG(salaire), SUM(salaire) FROM employe GROUP BY nodep;</p>';


$sqlQuery = "SELECT nodep, AVG(salaire), SUM(salaire) FROM employe GROUP BY nodep;";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_13 = $Statement->fetchAll();

foreach ($ex_13 as $ex) {

    echo $ex['nodep'] . ' - ' . $ex['AVG(salaire)'] . ' - ' . $ex['SUM(salaire)'] . '</br>';

}

echo '<hr><h4> 3. Afficher les numéros des départements ayant au moins 3 employés.</h4>';


echo '<p class="sql">SELECT nodep FROM employe GROUP BY nodep HAVING COUNT(*) >= 3;</p>';


$sqlQuery = "SELECT nodep FROM employe GROUP BY nodep HAVING COUNT(*) >= 3";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_14 = $Statement->fetchAll();

foreach ($ex_14 as $ex) {

    echo $ex['nodep'] . '</br>';

}

echo '<hr><h4> 4. Afficher les lettres qui sont l\'initiale d\'au moins trois employés.</h4>';


echo '<p class="sql">SELECT SUBSTRING(nom, 1, 1) AS fl, SUBSTRING(prenom, 1, 1) AS sl, CONCAT(nom, \' \', prenom) AS test FROM employe ORDER BY RAND() LIMIT 3;</p>';

echo '<p class="sql">SELECT SUBSTRING(nom, 1, 1) AS fl, SUBSTRING(prenom, 1, 1) AS sl, COUNT(*) AS num
FROM employe
GROUP BY fl, sl
HAVING COUNT(*) >= 3;
;</p>';


$sqlQuery = "SELECT SUBSTRING(nom, 1, 1) AS fl, SUBSTRING(prenom, 1, 1) AS sl, CONCAT(nom, ' ', prenom) AS test FROM employe ORDER BY RAND() LIMIT 3;";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_15 = $Statement->fetchAll();

foreach ($ex_15 as $ex) {

    echo $ex['fl'] . ' , ' . $ex['sl'] . ' - ' . $ex['test'] . '</br>';

}

echo '<hr><h4> 5. Rechercher le salaire maximum et le salaire minimum parmi tous les
salariés et l\'écart entre les deux.</h4>';


echo '<p class="sql">SELECT MIN(salaire) AS min, MAX(salaire) AS max, MAX(salaire) - MIN(salaire) AS diff FROM employe;</p>';


$sqlQuery = "SELECT MIN(salaire) AS min, MAX(salaire) AS max, MAX(salaire) - MIN(salaire) AS diff FROM employe";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_16 = $Statement->fetchAll();

foreach ($ex_16 as $ex) {

    echo $ex['min'] . ' - ' . $ex['max'] . ' - ' . $ex['diff'] . '</br>';

}

echo '<hr><h4>6. Rechercher le nombre de titres différents. </h4>';


echo '<p class="sql">SELECT COUNT(DISTINCT titre) AS num FROM employe;</p>';


$sqlQuery = "SELECT COUNT(DISTINCT titre) AS num FROM employe";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_17 = $Statement->fetchAll();

foreach ($ex_17 as $ex) {

    echo $ex['num'] . '</br>';

}

echo '<hr><h4> 7. Pour chaque titre, compter le nombre d\'employés possédant ce titre.</h4>';


echo '<p class="sql">SELECT titre, COUNT(*) AS num FROM employe GROUP BY titre;</p>';


$sqlQuery = "SELECT titre, COUNT(*) AS num FROM employe GROUP BY titre;";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_18 = $Statement->fetchAll();

foreach ($ex_18 as $ex) {

    echo $ex['titre'] . ' - ' . $ex['num'] . '</br>';

}

echo '<hr><h4> 8. Pour chaque nom de département, afficher le nom du département et
le nombre d\'employés. </h4>';



echo '<p class="sql">SELECT dept.nom, COUNT(*) AS num FROM employe JOIN dept ON employe.nodep = dept.nodept GROUP BY dept.nom;</p>';




$sqlQuery = "SELECT dept.nom, COUNT(employe.noemp) AS num FROM dept LEFT JOIN employe ON employe.nodep = dept.nodept GROUP BY dept.nom;";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_19 = $Statement->fetchAll();

foreach ($ex_19 as $ex) {

    echo $ex['nom'] . ' - ' . $ex['num'] . '</br>';

}

echo '<hr><h4>9. Rechercher les titres et la moyenne des salaires par titre dont la
moyenne est supérieure à la moyenne des salaires des Représentants. </h4>';


echo '<p class="sql">SELECT titre, AVG(salaire) AS moy FROM employe GROUP BY titre HAVING AVG(salaire) > (SELECT AVG(salaire) FROM employe WHERE titre = \'représentant\');</p>';


$sqlQuery = "SELECT titre, AVG(salaire) AS moy FROM employe GROUP BY titre HAVING AVG(salaire) > ( SELECT AVG(salaire) FROM employe WHERE titre = 'représentant');
;";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_20 = $Statement->fetchAll();

foreach ($ex_20 as $ex) {

    echo $ex['titre'] . ' - ' . $ex['moy'] . '</br>';

}

echo '<hr><h4>10.Rechercher le nombre de salaires renseignés et le nombre de taux de
commission renseignés.  </h4>';


echo '<p class="sql">SELECT COUNT(salaire) AS sa, COUNT(tauxcom) AS tc FROM employe;</p>';


$sqlQuery = "SELECT COUNT(salaire) AS sa, COUNT(tauxcom) AS tc FROM employe;";
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$ex_21 = $Statement->fetchAll();

foreach ($ex_21 as $ex) {

    echo $ex['sa'] . ' - ' . $ex['tc'] . '</br>';

}

echo '<hr>';
?>
</body>

</html>