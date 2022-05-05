<?php 
    session_start(); 
    if(isset($_SESSION['table'])) $table = $_SESSION['table'];
?>

<!DOCTYPE html>
<html lang="fr">
    
    <?php include_once './includes/head.inc.html'; ?>   

    <body>

        <?php include("./includes/header.inc.html"); ?> 

        <div class="container">
            <div class="row">
                
                <nav class="col-md-3 mt-3">
                    <!-- bouton Home -->
                    <a role="button" href="index.php" class="btn btn-outline-secondary w-100" >
                        Home</a>

                    <?php if (isset($table)) include_once './includes/ul.inc.php'; ?>

                </nav>

                <div class="col-md-9 mt-3">
                    <section>

                            <?php 
                                $buttonSubmit = '<div class="d-flex flex-row-reverse bd-highlight mt-4">
                                    <button name="enregistrer" type="submit" class="btn btn-primary">Enregistrer des données</button> </div>';
                                
                                if(isset($_GET['add'])) {
                                    echo '<p class="h1 text-center">Ajouter des données</p>';
                                    include './includes/form.inc.html';
                                    echo $buttonSubmit . '</form>';
                                } 

                                elseif(isset($_GET['addmore'])) {
                                    include './includes/form2.inc.php';
                                } 

                                elseif(isset($_POST['enregistrer'])) {
                                    $prenom = $_POST['first_name'];
                                    $nom = $_POST['last_name'];
                                    $age = $_POST['age'];
                                    $taille = $_POST['size'];
                                    $sex = $_POST['genre'];
                                    $html = $_POST['html'];
                                    $css = $_POST['css'];
                                    $javascript = $_POST['js'];
                                    $php = $_POST['php'];
                                    $mysql = $_POST['mysql'];
                                    $bootstrap = $_POST['bootstrap'];
                                    $symfony = $_POST['symfony'];
                                    $react = $_POST['react'];
                                    $color = $_POST['color'];
                                    $date = $_POST['date'];
                                    $img = $_FILES['img'];
                                    $file_name = $_FILES['img']['name'];
                                    $file_type = $_FILES['img']['type'];
                                    $file_tmp = $_FILES['img']['tmp_name'];
                                    $file_error = $_FILES['img']['error'];
                                    $file_size = $_FILES['img']['size'];
                                    $file_ext=strtolower(end(explode('.',$_FILES['img']['name'])));
                                    $extensions= array("jpg","png");
                                    $table_all = array(          
                                        "first_name" => $prenom,
                                        "last_name"  =>  $nom,
                                        "age" => $age,
                                        "size" => $taille,
                                        "civility" => $sex,
                                        "html" => $html,
                                        "css" => $css,
                                        "javascript" => $javascript,
                                        "php" => $php,
                                        "mysql" => $mysql,
                                        "bootstrap" => $bootstrap,
                                        "symfony" => $symfony,
                                        "react" => $react,
                                        "color" => $color,
                                        "date" => $date,
                                        "img" => array(
                                            "name" => $file_name,
                                            "type" => $file_type,
                                            "tmp_name" => $file_tmp,
                                            "error" => $file_error,
                                            "size" => $file_size,
                                        )
                                        
                                    );

                                    $errors= array();
                        
                                    if(isset($img)){
                                        if($file_size > 2000000) {
                                            echo "<p class='alert-danger text-center'>La taille de l'image doit être inférieur à 2Mo</p>";
                                    }

                                        if(in_array($file_ext,$extensions)=== false){
                                            echo "<p class='alert-danger text-center py-3'>Extension \"pdf\" non prise en charge</p>";
                                        }

                                        if(empty($file_tmp)) {
                                            echo "<p class='alert-danger text-center py-3'>Aucun fichier n'a été téléchargé</p>";
                                        }

                                        if(empty($errors)){
                                        move_uploaded_file($file_tmp,"./uploaded/".$file_name);
                                        $table = array_filter($table_all);
                                        $_SESSION['table'] = $table;
                                        echo "<p class='alert-success text-center py-3'> Données sauvegardées</p>";
                                        }

                                        else{
                                            print_r($errors);

                                        } 

                                    } else {
                                        $table = array_filter($table_all);
                                        $_SESSION['table'] = $table;
                                        echo '<p class="alert-success text-center py-3"> Données sauvegardées</p>';
                                    }
                                }     
                                 else {
                                    if (isset($table)) {

                                        if(isset($_GET["debugging"])) {
                                            echo '<h2 class="text-center">Débogage</h2>';
                                            echo "<h3 class='fs-5'>===> Lecture du tableau à l'aide de la fonction print_r() </h3>";
                                            print "<pre>";
                                            print_r($table);
                                            print "</pre>";
            
                                        } elseif (isset($_GET['concatenation'])) {  
                                            echo '<h2 class="text-center">Concaténation</h2><br>';
            
                                            echo "<h3 class='fs-5'>===> Construction d'une phrase avec le contenu du tableau :</h3>";
                                            
                                            echo "<p>" ;
                                            echo ($table["civility"] == "Femme") ? "Mme " : "Mr " ;
                                            echo $table['first_name'] ." ". $table['last_name']; 
                                            echo " <br>J'ai " . $table["age"] . " ans et je mesure " . $table["size"] . "m.</p><br><br>";
                                            
                                            echo "<h3 class='fs-5' > ===> Construction d'une phrase après MAJ du tableau : </h3><br><br>";
                                            
                                            $table['first_name'] = ucfirst ($table['first_name']);
                                            $table['last_name'] = strtoupper($table['last_name']);
                                            echo "<p>" ;
                                            echo ($table["civility"] == "Femme") ? "Mme " : "Mr " ;                               
                                            echo $table["first_name"] ." ". $table["last_name"];
                                            echo " <br>J'ai " . $table["age"] . " ans et je mesure " . $table['size'] . "m.</p><br><br>";
                                            
            
                                            echo "<h3 class='fs-5' > ===> Affichage d'une virgule à la place du point pour la taille : </h3>";
                                            
                                            $table['size'] = str_replace('.' , ',', $table['size']);
                                            $table['first_name'] = ucfirst ($table['first_name']);
                                            $table['last_name'] = strtoupper($table['last_name']);
                                            echo "<p>" ;
                                            echo ($table["civility"] == "Femme") ? "Mme " : "Mr " ;                               
                                            echo $table["first_name"] ." ". $table["last_name"];
                                            echo " <br>J'ai " . $table["age"] . " ans et je mesure " . $table['size'] . "m.</p><br><br>";
            
                                        } elseif (isset($_GET['loop'])) {
            
                                            echo "<h2 class='text-center'>Boucle</h2><br>";
                                            echo "<h3 class='fs-5'>===> Lecture du tableau à l'aide d'une boucle foreach</h3><br>";
                                            $table = $_SESSION['table'];
                                            $i = 0;

                                            foreach ($table as $x => $value) {
                                                if ($x == 'img') {
                                                    unset($value);
                                                    echo '<div>à la ligne n°' . $i . ' correspond la clé "' . $x . '" et contient</div>';
                                                    echo "<img class='w-100' src='./uploaded/".$table['img']['name']."'>"; 

                                                } else {
                                                    echo '<div>à la ligne n°' . $i . ' correspond la clé "' . $x . '" et contient "' . $value . '"</div>';
                                                    $i++;
                                                }    
                                            }
                                            
                                        } elseif (isset($_GET['function'])){     
                
                                            echo "<h2 class='text-center'>Fonction</h2><br>";
                                            echo "<h3 class='fs-5'>===> J'utilise ma fonction readTable()</h3><br>";
                                            function readTable(){
                                                $table = $_SESSION['table'];
                                                $i = 0;

                                                foreach ($table as $x => $value) {
                                                    if ($x == 'img') {
                                                    unset($value);
                                                    echo '<div>à la ligne n°' . $i . ' correspond la clé "' . $x . '" et contient</div>';
                                                    echo "<img class='w-100' src='./uploaded/".$table['img']['name']."'>"; 

                                                } else {
                                                    echo '<div>à la ligne n°' . $i . ' correspond la clé "' . $x . '" et contient "' . $value . '"</div>';
                                                    $i++;
                                                }    
                                            }
                                            }  
                                            readTable();
                                        
                                        } elseif (isset($_GET['del'])) {
                                            unset ($_SESSION['table']);
                                            if (empty($_SESSION['table'])) {
                                                echo '<p class="alert-success text-center py-3"> Données suprimées</p>';
                                            }
                                        
                                        }else { 
                                            echo '<a role="button" class=" btn btn-primary" href="index.php?add">Ajouter des données</a>'; 
                                            echo '<a role="button" class=" btn btn-secondary ms-2" href="index.php?addmore">Ajouter plus de données</a>'; 
                                        }  
                                    }else { 
                                        echo '<a role="button" class=" btn btn-primary" href="index.php?add">Ajouter des données</a> ';
                                        echo '<a role="button" class=" btn btn-secondary ms-2" href="index.php?addmore">Ajouter plus de données</a>'; 
                                    } 
                            }   
                            ?>

                        </section>
                    </div>
            </div>   
        </div>
        <br>
        <?php include("./includes/footer.inc.html"); ?> 
    </body>
</html>