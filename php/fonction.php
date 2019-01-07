<?php

$prenom = array('joel', 'corinne', 'emanuelle');
$coordonnee = array(
'prenom' => 'joel',
'nom' => 'parrat')
//echo $prenom[0];
//echo ' ';
//echo $coordonnee['nom'];
for ($i=0; $i<3; $i++)
    echo $prenom[$i].<br>;

foreach ($prenom as $element)
    echo $element.<br>;
 ?>

