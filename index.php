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
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Panel</title>
                    <link rel="stylesheet" href="css/page.css">
                    <script src="https://kit.fontawesome.com/c7ea7d9c0d.js" crossorigin="anonymous"></script>
                    <link rel="shortcut icon" href="img/Logo.png" type="image/x-icon">
                </head>

                <body>
                    <div class="box">
                        <div class="nav_admin left">
                            <div class="info_perso">
                                <img class="avatar" src="<?php echo $data[0]['img']; ?>" alt="pp">
                                <br>
                                <h2 class="info_name">
                                    <?php echo $data[0]['nom']; ?> <?php echo $data[0]['prenom']; ?>
                                </h2>
                                <br>
                                <nav>
                                    <ul>
                                        <li class="dec">
                                            <a href="page/">Paramètre</a>
                                        </li>
                                        <br>
                                        <li class="dec">
                                            <a href="page/dec.php">Se deconnecter</a>
                                        </li>
                                    </ul>
                                </nav>
                                <br>
                                <div class="ligne_gray"></div>
                                <br>
                                <nav class="nav_2">
                                    <ul>
                                        <li class="dec">
                                            <a href="page/">Paramètre</a>
                                        </li>
                                        <br>
                                        <li class="dec">
                                            <a href="page/dec.php">Se deconnecter</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="page">

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