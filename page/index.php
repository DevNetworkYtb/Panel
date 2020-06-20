<?php
session_start();
include '../data/database.php';
if (isset($_SESSION['token'])) 
{
    $token = $_SESSION['token'];
    $query = $db->query("SELECT * FROM tt_user WHERE token = '$token'");
    if ($query->rowCount() > 0) 
    {
        $data = $query->fetchALL();
        $id = htmlspecialchars($data[0]['id']);
        if (isset($_POST['snom'])) 
        {
            if (!empty($_POST['nom'])) 
            {
                $nom = htmlspecialchars($_POST['nom']);
                $sql = $db->prepare('UPDATE tt_user SET nom = ? WHERE id = ?');
                $sql->execute(array($nom, $id));
                header('Location: ../page/');
            }
        }
        elseif (isset($_POST['sprenom'])) 
        {
            if (!empty($_POST['prenom'])) 
            {
                $prenom = htmlspecialchars($_POST['prenom']);
                $sql = $db->prepare('UPDATE tt_user SET nom = ? WHERE id = ?');
                $sql->execute(array($prenom, $id));
                header('Location: ../page/');
            }
        }
        elseif (isset($_POST['smdp'])) 
        {
            if (!empty($_POST['mdp'])) 
            {
                $mdp = htmlspecialchars($_POST['mdp']);
                $sql = $db->prepare('UPDATE tt_user SET nom = ? WHERE id = ?');
                $sql->execute(array($mdp, $id));
                header('Location: ../page/');
            }
        }
        elseif (isset($_POST['smail'])) 
        {
            if (!empty($_POST['mail'])) 
            {
                $mail = htmlspecialchars($_POST['mail']);
                $sql = $db->prepare('UPDATE tt_user SET nom = ? WHERE id = ?');
                $sql->execute(array($mail, $id));
                header('Location: ../page/');
            }
        }
        elseif (isset($_POST['simg'])) 
        {
            $nb_min = 10000000;
            $nb_max = 120000000;
            $uniqname = mt_rand($nb_min,$nb_max);
            
            $fileexe = "." . strtolower(substr(strrchr($_FILES['img']['name'], '.'), 1));

            $fillename = $_FILES['img']['name'];
            $temname = $_FILES['img']['tmp_name'];
            $fillenewname = "../img/user_img/" . $uniqname . $fileexe;
            $resutat = move_uploaded_file($temname, $fillenewname);

            $img = "http://localhost/Panel/img/user_img/" . $uniqname . $fileexe;

            $sql = $db->prepare('UPDATE tt_user SET img = ? WHERE id = ?');
            $sql->execute(array($img, $id));

            $sql = $db->prepare('INSERT INTO `tt_img`(`lien_img`, `user_id`) VALUES (?,?)');
            $sql->execute(array($img, $id));
            header('Location: ../page/');
        }
        ?>
            <!DOCTYPE html>
            <html lang="fr">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php echo $data[0]['nom']; ?> <?php echo $data[0]['prenom']; ?></title>
                <link rel="stylesheet" href="../css/page_profil.css">
                <link rel="shortcut icon" href="../img/Logo.png" type="image/x-icon">
            </head>

            <body>
                <a href="../">← Retour</a>
                <div class="box">
                    <div class="content">
                        <div class="image_profil left">
                            <h2>Votre avatar :</h2>
                            <div class="ligne_gray"></div>
                            <br>
                            <img src="<?php echo $data[0]['img']; ?>" alt="">
                        </div>
                        <div class="information_profil right">
                            <h2>Vos information :</h2>
                            <div class="ligne_gray"></div>
                            <div class="info">
                                <h3>Votre Id : <strong><?php echo $data[0]['id']; ?></strong></h3>
                                <h3>Votre Token : <span class="token"><strong><?php echo $data[0]['token']; ?></strong></span></h3>
                                <h3>Votre Nom : <strong><?php echo $data[0]['nom']; ?></strong></h3>
                                <h3>Votre Prenom : <strong><?php echo $data[0]['prenom']; ?></strong></h3>
                                <h3>Votre Mot de passe : <strong><?php echo $data[0]['password']; ?></strong></h3>
                                <h3>Votre Adresse mail : <strong><?php echo $data[0]['mail']; ?></strong></h3>
                            </div>
                        </div>
                        <div class="left">
                            <h2>Dernière entrer :</h2>
                            <div class="ligne_gray"></div>
                            <h3>Aucune entrer a était envoyer</h3>
                        </div>
                        <div class="information_profil right">
                            <h2>Modification de votre profil :</h2>
                            <div class="ligne_gray"></div>
                            <br>
                            <div class="info">
                                <form method="post">
                                    <label for="">Nouveau Nom :</label>
                                    <br>
                                    <input class="input" name="nom" type="text">
                                    <input class="send" type="submit" name="snom" value="send">
                                </form>
                                <form method="post">
                                    <label for="">Nouveau Prenom :</label>
                                    <br>
                                    <input class="input" name="prenom" type="text">
                                    <input class="send" type="submit" name="sprenom" value="send">
                                </form>
                                <form method="post">
                                    <label for="">Nouveau Mot de passe :</label>
                                    <br>
                                    <input class="input" name="mdp" type="text">
                                    <input class="send" type="submit" name="smdp" value="send">
                                </form>
                                <form method="post">
                                    <label for="">Nouvelle Adresse Mail :</label>
                                    <br>
                                    <input class="input" name="mail" type="text">
                                    <input class="send" type="submit" name="smail" value="send">
                                </form>
                                <form method="post" enctype="multipart/form-data">
                                    <label for="">Nouveau avatar :</label>
                                    <br>
                                    <input class="input" name="img" type="file">
                                    <input class="send" name="simg" type="submit" value="send">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </body>

            </html>
        <?php
    }
    else
    {
        header('Location: ../index.php');
    }
}