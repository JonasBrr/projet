<?php 
    require '../../helper/connection.php';
    $L = $pdo->prepare('SELECT * FROM etablissement');
    $successl = $L->execute();
    $lycee = $L->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($lycee);
    header('Content-Type: application/json');
?>