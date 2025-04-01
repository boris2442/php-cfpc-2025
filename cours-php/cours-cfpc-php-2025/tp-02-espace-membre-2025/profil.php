<?php
session_start();
require_once "database.php";
if (isset($_GET['id'])) {

    $getid = intval($_GET['id']);
    $requser = $db->prepare('SELECT*FROM membres WHERE id=?');
    $requser->execute([$getid]);
    $userInfos = $requser->fetch();
}


?>






<?php
$title = "profil of user";
require_once "header-and-footer/header.php";
?>
<div class="max-w-[400px] bg-white mx-auto min-h-[450px] rounded-[7px] px-[7px] flex flex-col justify-center items-center  ">
    <h1 class="text-center text-4xl p-[7px] font-bold text-green-900">welcome to profil!...</h1>

    <h2 class="text-2xl font-bold">Profil de: <span class="text-2xl"> <?= $userInfos['pseudo']; ?></span></h2>






    <h3 class="font-bold text-2xl">mail:<?= $userInfos['mail']; ?></h3>
    <?php if (!empty($userInfos['avatar'])) { ?>
        <img src="membres/avatars/<?= $userInfos['avatar']; ?>" width="" alt="image de boris" class="w-[200px] h-[200px] object-cover bg-red-500"  />
    <?php  } ?>

    <?php
    if (isset($_SESSION['id']) && $userInfos['id'] == $_SESSION['id']) {
    ?>
        <div class="flex justify-beetween gap-[20px] pt-[20px] mx-auto">
            <div>
                <a href="editprofil.php" class="bg-green-500 p-[5px] text-white rounded-[5px] hover:bg-900">Editer mon profil</a>
            </div>
            <div>
                <a href="deconnexion.php" class="bg-green-500 text-white p-[5px] rounded-[5px] hover:bg-900">Se déconnecter</a>
            </div>
        </div>
</div>
<?php
    } else {
        echo '<br /> Vous ne pouvez pas accéder à ce profil';
    }
?>

<?php
require_once "header-and-footer/footer.php";
?>