<?php session_start(); 
require_once("licznik.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel='stylesheet' type='text/css' media='screen' href='news.css'> --> 
       <!--  <link rel="stylesheet" type='text/css' media='screen' href="w3css.css">  -->
      <link rel="stylesheet" type='text/css' media='screen' href="moj.css">  
    <title>Naglowek</title>
</head>
                                                        
    <div class="glowna"> 

<div class="naglowek">  
      
<div>

<ol> 

    <?php 

    require_once("dane_do_bazy.php");
        

    if (isset ($_GET['zaloguj_aktywny'])){
    $zaloguj_aktywny = $_GET['zaloguj_aktywny'];
    }





    if (isset($_SESSION['akcja'])){
        $_GET['akcja'] = $_SESSION['akcja'];
        unset($_SESSION['akcja']); 
    }



     if (isset($_GET['akcja'])) {
        $akcja = $_GET['akcja'];
     }
       else
        {
                $akcja = "filmy";
        }
      





        
        if (isset($_SESSION['id_filmu'])){
            $_GET['id_filmu'] = $_SESSION['id_filmu'];
            unset($_SESSION['id_filmu']);        
        }


        
        if (isset($_GET['id_filmu'])) {
            $id_filmu = $_GET['id_filmu'];


    } 






    if (isset($_SESSION['id_osoby'])){
        $_GET['id_osoby'] = $_SESSION['id_osoby'];
        unset($_SESSION['id_osoby']); 
        
    }
    
    if (isset($_GET['id_osoby'])) {
        $id_osoby = $_GET['id_osoby'];
        
    } 
    
    ?>
    


    <li><a href="index.php?akcja=filmy"<?php if($akcja=="filmy"){echo "class=active";} ?>>Filmy</a> </li>

    <li><a href="index.php?akcja=osoby"<?php if($akcja=="osoby"){echo "class=active";} ?>>Osoby</a> </li> 

    <li><a href="#?akcja=index"<?php if($akcja=="index"){echo "class=active";} ?>>Kontakt</a>





                <ul>
                    <li style="background-color:white;"><a href="index.php?akcja=mapa"<?php if($akcja=="mapa"){echo "class=active";} ?>>Kontakt</a> </li>
                    <li style="background-color:white;"><a href="news.php?akcja=opinie"<?php if($akcja=="opinie"){echo "class=active";} ?>>Opinie</a> </li>
                    
                </ul>
             



            


                </li> 
     
     






     <?php

        if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] == true )
        {  ?>
            
            <li style="float:right; width:120px"><a href="wyloguj.php">Wyloguj <?php echo $_SESSION['login'] ?></a> </li>



            <?php


             if (isset($_SESSION['login'])){
            $login = $_SESSION['login'];
                }

            $stmt = $conn->query("SELECT rejestracja FROM uzytkownicy WHERE login = '$login'");

            $rows = $stmt->fetch();


            if (!empty($rows['rejestracja'])){

                $dzien = $rows['rejestracja'];
                $teraz = time();
   
   
                   // wyliczanie roznicy
                       $sekund = abs($teraz-$dzien);
                       $minut = (int)($sekund/60);
                       $godzin = (int)($minut/60);
                       $dni = (int)($godzin/24);
                       $lat = (int)($dni/365);
   
                   // wyliczanie calego okresu
                       $sekund = (int)($sekund-$minut*60);
                       $minut = (int)($minut-$godzin*60);
                       $godzin = (int)($godzin-$dni*24);
                       $dni = (int)($dni-$lat*365);


            

            ?>
            
            <li class="napis" style="border-radius:5px;  border: 1px solid #d7d7d7; float:right; width:505px; margin-top:60px; background-color:#f5f5dc; color:#337ab7; margin-right:60px; ">Witaj <?php echo $_SESSION['login'] ?> jesteś z nami już

            <?php

            echo " $lat lat;  $dni dni; $godzin godzin; $minut minut;  $sekund sekund; ";
            
            ?>         

            </li>
        
            
            <?php 
            }
            } 
        else
       { ?>
           
        <li style="float:right; width:100px"><a href="formularz_logowania.php?zaloguj_aktywny=logowanie&id_osoby=<?php if(isset($id_osoby)) {echo $id_osoby;}?>&id_filmu=<?php if(isset($id_filmu)) {echo  $id_filmu;}?>&akcja=<?php echo $akcja;?>"<?php if(isset($zaloguj_aktywny) and $zaloguj_aktywny =="logowanie"){echo "class=active";} ?>>Zaloguj się</a> </li>

        <li style="float:right; width:120px"><a href="formularz_rejestrowania.php?zaloguj_aktywny=rejestrowanie&id_osoby=<?php if(isset($id_osoby)) {echo $id_osoby;}?>&id_filmu=<?php if(isset($id_filmu)) {echo  $id_filmu;}?>&akcja=<?php echo $akcja;?>"<?php if(isset($zaloguj_aktywny) and $zaloguj_aktywny=="rejestrowanie"){echo "class=active";} ?>>Zarejestruj się</a> </li>
        
       


     
        <li class="napis" style=" border: 1px solid #d7d7d7; border-radius: 5px; float:right; width:550px;  margin-top:60px; background-color:#f5f5dc; color:#337ab7; ">
        
                

                Odwiedzin wszystkich: <?php echo licznik_all(); ?>  <br>
                Odwiedzin dziś: <?php echo licznik_dzis(); ?> <br>
                <!-- Ostatnia data: <?php echo licznik_last(); ?> -->
                

        </li>
       

        <?php   }
        ?>






<?php 
        if($akcja=="film")
        {
            ?>
            <li><a href="#"<?php if($akcja=="film"){echo "class=active";} ?>>Film</a> </li> 
            <?php
        }
     ?>

<?php 
        if($akcja=="osoba")
        {
            ?>
            <li><a href="#"<?php if($akcja=="osoba"){echo "class=active";} ?>>Osoba</a> </li> 
            <?php
        }
     ?>

<?php 
        if($akcja=="dodaj_film")
        {
            ?>
            <li><a href="#"<?php if($akcja=="dodaj_film"){echo "class=active";} ?>>Dodaj film</a> </li> 
            <?php
        }
     ?>

<?php 
        if($akcja=="dodaj_osobe")
        {
            ?>
            <li style='width:100px;'><a href="#"<?php if($akcja=="dodaj_osobe"){echo "class=active";} ?>>Dodaj osobę</a> </li> 
            <?php
        }
     ?>


<?php 
        if($akcja=="wstaw_aktora")
        {
            ?>
            <li style='width:200px;'><a href="#"<?php if($akcja=="wstaw_aktora"){echo "class=active";} ?>>Dodawanie aktora do filmu </a> </li> 
            <?php
        }
     ?>


<?php 
        if($akcja=="wstaw_filmy")
        {
            ?>
            <li style='width:200px;'><a href="#"<?php if($akcja=="wstaw_filmy"){echo "class=active";} ?>>Dodawanie filmów do aktora </a> </li> 
            <?php
        }
     ?>

<?php 
        if($akcja=="usun_osobe")
        {
            ?>
            <li style='width:170px;'><a href="#"<?php if($akcja=="usun_osobe"){echo "class=active";} ?>>Usuwanie osoby z filmu</a> </li> 
            <?php
        }
     ?>


<?php 
        if($akcja=="usun_film")
        {
            ?>
            <li style='width:120px;'><a href="#"<?php if($akcja=="usun_film"){echo "class=active";} ?>>Usuwanie filmu</a> </li> 
            <?php
        }
     ?>

<?php 
        if($akcja=="usun_film_osobie")
        {
            ?>
            <li style='width:120px;'><a href="#"<?php if($akcja=="usun_film_osobie"){echo "class=active";} ?>>Usuwanie filmu</a> </li> 
            <?php
        }
     ?>

<?php 
        if($akcja=="usun_osobke")
        {
            ?>
            <li style='width:120px;'><a href="#"<?php if($akcja=="usun_osobke"){echo "class=active";} ?>>Usuwanie osoby</a> </li> 
            <?php
        }
     ?>

 </ol>

 

</div>

</div>











                                                               




