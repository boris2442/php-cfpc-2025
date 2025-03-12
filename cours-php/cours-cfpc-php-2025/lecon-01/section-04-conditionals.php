<?php
$age = 25;
echo $age < 22 ? 'Young' : 'Old'; // Affiche "Old" car 25 n'est pas inférieur à 22

$person=[
    'name',
    'age'=>25,
    'occupation'=>'Developer'
];
$person['name']??='Anonymous';

echo "person name:".$person['name'].'<br/>';


$per=['a','b','c','d'];
echo "<pre>";
var_dump(value:$per);
echo "</pre>";


//le switch case
echo "<pre>";
$userRole = 'editor';
switch ($userRole) {
 case 'admin':
 echo 'You have full access.<br>';
 break;
 case 'editor':
 echo 'You can edit content.<br>';
 break;
 case 'user':
 echo 'You can view posts and comment.<br>';
 break;
 default:
 echo 'Unknown role.<br>';
 break;
}
echo "</pre>";