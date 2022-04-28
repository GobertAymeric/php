<?php
    session_start();

    if (isset($_SESSION['table'])) $table = $_SESSION['table'];
?>

<!DOCTYPE html>
<html lang="fr">

    <?php include_once './includes/head.inc.html'; ?>
    
    <body>

        <?php include_once './includes/header.inc.html'; ?>

        <div class="container">
            <div class="row">
                <!-- Bouton Home -->
                <nav class="col-md-3 mt-3">
            
                    <a role="button" href="index.php" class="btn btn-outline-secondary btn-block w-100">
                    Home</a>

                    <?php if (isset($table)) include_once './includes/ul.inc.php'; ?>

                </nav> 
            
                <section class="col-md-9 mt-3">

                    <?php if(isset($_GET["add"])){
                    include './includes/form.inc.html';

                    } 
                    
                    elseif(isset($_POST['enregistrer'])){
                        $prenom = $_POST['first_name'];
                        $nom = $_POST['last_name'];
                        $age = $_POST['age'];
                        $size = $_POST['size']; 
                        $civility = $_POST['civility'];
                        $table = array ( 
                            "first-name" => $prenom,
                            "last-name" => $nom,
                            "age" => $age,
                            "size" => $size,
                            "civility" => $civility,
                        );

                        $_SESSION ['table'] = $table;
                        echo '<p class="alert-success text-center py-3"> Données sauvegardées</p>' ;
                    
                    } 

                    elseif(isset($_GET["debugging"])) {
                        echo '<h2>Débogage</h2>';
                        print '<pre>';
                        print_r ($table);
                        print '</pre>';

                    } 

                    else {
                        echo '<a role="button" href="index.php?add" class="btn btn-primary">
                        Ajouter des données</a>';
                    } ?>

                </section>
            </div>
        </div>
    
        <footer class="mt-3">
            <?php include 'includes/footer.inc.html'; ?>
        </footer>
    </body>
</html>
