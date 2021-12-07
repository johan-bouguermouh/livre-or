<?php
session_start();
if(isset($_SESSION['id']))
    {
    if($_SESSION['id']==1)
    {
        $id='admin';
    }
    else
    {
        $id='user';
    }
    }
else
{
    $id='none';
    $img_accueil='images/moodule_background_index_none.png';
}
require('custom_body.php');
if(isset($_POST['com']))
{
    $login_data = $_SESSION['login'];
    $conn = mysqli_connect('localhost','root','','livre_or');
    $log = mysqli_query($conn,"SELECT * FROM utilisateurs WHERE `login`= '$login_data'");
    $user = mysqli_fetch_all($log,MYSQLI_ASSOC);
    $id_user = $user[0]['id'];
    $new_com = addslashes($_POST['com']);
    $push_comm=mysqli_query($conn,"INSERT INTO `commentaires` (`commentaire`, `id_utilisateur`, `date`) VALUES ('$new_com','$id_user',NOW())");
}
    $conn = mysqli_connect('localhost','root','','livre_or');
    $requiere_all_coms = mysqli_query($conn,"SELECT * FROM `utilisateurs` INNER JOIN `commentaires` WHERE utilisateurs.id = commentaires.id_utilisateur ORDER BY `date` DESC");
    $all_coms = mysqli_fetch_all($requiere_all_coms,MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<?php
require('meta.php');
?>

    <title>Acceuil</title>
</head>

<body class="<?=$id?>_body">
<header>
<?php
require('header.php');
?>
</header>
<main>
<section id="livre_or_session_main">
        <section id="all_article_main">
    <?php    $i = 0;
        while(isset($all_coms[$i]))
        {
            $icon=$all_coms[$i]['prenom'][0].$all_coms[$i]['nom'][0];
        ?>
        <article class="commentaire">
            <section class="header_commentaire">
            <div style="
            background-color: <?=$all_coms[$i]['color_head']?>;
                width: 8vw;
                height: 8vw;
                max-width: 50px;
                max-height: 50px;
                color: rgb(54, 54, 54);
                border-style: solid 2px rgb(184, 184, 184);
                border-radius: 4vw;
                box-shadow: 0.3px 0.3px 5px 1px rgba(0, 0, 0, 0.199);
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                text-transform: uppercase;
                font-size: 1.3rem;
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                margin-right: .625rem;">
                    <p><?=$icon?></p>
            </div>

            <h3><?=$all_coms[$i]['prenom']?> <?=$all_coms[$i]['nom']?></h3>
            </section>
            <section class="content_commentaire">
            <p><?=$all_coms[$i]['commentaire']?></p>
            </section>
            <section class="footer_commentaire">
                <p><?=$all_coms[$i]['date']?></p>
            </section>
        </article>
        <?php
        $i++;
        }
    if(isset($_SESSION['id']))
    {
    ?>
    </section>
    <article id="form_session_fixe">
        <?php
            if(empty($_POST['com']))
            {
        ?>  
                <section class="form_commentaires">
                    <h2>Laissez votre impression ici </h2>
                    <form action="livre_or.php" method="post">
                        <textarea placeholder=" &#10000 Exprimez-vous" name="com" rows="5"></textarea>
                        <input class="input_connect" type="submit" value="Envoyer">
                    </form>
                </section>
                
    <?php
            }
            else
            {
    ?> 
            <div class="info_update">
                            <img src="images\moodule_gif_validation.gif?date=<?php echo date('Y-m-d-H-i-s');?>" alt="validation"/>
                            <p><b>Votre Message à bien était envoyer<b></p>
            </div>
                        <?php
                        unset($_POST['com']);
                        }
    }
                        ?>
                    
    </article>
    </section>
</main>
<footer>
<?php

require('footer.php');
?>
</footer>
</body>
</html>