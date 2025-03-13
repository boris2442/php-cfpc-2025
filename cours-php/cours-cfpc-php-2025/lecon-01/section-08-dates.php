<?php
date_default_timezone_set('Europe/Paris');//definir le fuseau horaire

//1. Afficher le timestamp actuel

echo "Timestamp actuel : ".time().'<br>';
//2.Affcher la date actuelle

echo "Date actuelle : ".date('d/m/Y').'<br>';
//3.Afficherla date d'hier

echo "Date d'hier : ".date('d/m/Y', strtotime('-1 day')).'<br>';









?>