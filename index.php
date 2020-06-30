<?php
session_start();
include 'data/database.php';
    if (isset($_SESSION['token'])) 
    {
        $token = $_SESSION['token'];
        $query = $db->query("SELECT * FROM tt_user WHERE token = '$token'");
        if ($query->rowCount() > 0) {
            $data = $query->fetchALL();
            ?>
                <!DOCTYPE html>
                <html lang="fr">

                <head>
                    <link rel="stylesheet" href="css/page.css">
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Panel</title>
                    
                    <script src="https://kit.fontawesome.com/c7ea7d9c0d.js" crossorigin="anonymous"></script>
                    <link rel="shortcut icon" href="img/Logo.png" type="image/x-icon">
                </head>

                <body>
                    <div class="box">
                        <div class="nav_admin">
                            <div class="head">
                                <img src="<?php echo $data[0]['img']; ?>" alt="" class="img_avatar">
                                <br>
                                <h2 class="name"><?php echo $data[0]['nom'] . " " . $data[0]['prenom'] ?></h2>
                                <nav class="nav">
                                    <ul class="ul">
                                        <li class="li">
                                            <a href="" class="button_head">
                                                Mon Profil
                                            </a>
                                        </li>
                                        <li class="li">
                                            <a href="" class="button_head">
                                                Me Deconnecter 
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="page">
                            <div class="add">
                                <form method="post">
                                    <input class="add_input" type="text" ><button name="add"></button> 
                                </form>
                            </div>
                        </div>
                    </div>
                </body>

                </html>
           <?php
        }
        else
        {
            ?>
                <h1>non</h1>
            <?php
        }
    }
    else {
        if (isset($_POST['send'])) 
        {
            if (!empty($_POST['identifient']) && !empty($_POST['password'])) 
            {
                $identifient = htmlspecialchars($_POST['identifient']);
                $password = htmlspecialchars($_POST['password']);
                $query = $db->query("SELECT * FROM tt_user WHERE identifient = '$identifient' AND password = '$password'");
                if ($query->rowCount() > 0) 
                {
                    $data = $query->fetchALL();
                    $_SESSION['token'] = $data[0]['token'];
                    header('Location: index.php');
                }
                else
                {
                    
                }
            }
        }
        ?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Login | Panel</title>
                <link rel="stylesheet" href="css/login.page.css">
                <link rel="shortcut icon" href="img/Logo.png" type="image/x-icon">
            </head>
            <body>
                <div class="box">
                    <div class="login">
                        <br>
                        <h1 class="login_h1">
                            Login
                        </h1>
                        <br>
                        <img src="img/Logo.png" class="img" alt="Logo">
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <form method="post">
                            <input type=text name="identifient" placeholder="Votre Identifient">
                            <br>
                            <br>
                            <input type="password" name="password" placeholder="Votre Mot de passe">
                            <br>
                            <br>
                            <button name="send">Se connecter</button>
                        </form>
                    </div>
                </div>
            </body>
            </html>
        <?php
    }
?>