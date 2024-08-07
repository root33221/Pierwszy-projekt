<?php
  //session_start();
  error_reporting(E_ALL ^ E_NOTICE);
require_once("header.php");


?>
<div style="clear:both"></div>
<body>


<?php
    require_once("dane_do_bazy.php");




if($akcja=="filmy") { 
    
    

    if (isset($_GET['p1']) || isset($_GET['p2']) || isset($_GET['p3']) || isset($_GET['p4']))
    {

    if (isset($_GET['p1'])){

    if ($_GET['p1']=='m')
    {
     $order = ' ORDER BY id_filmu DESC ';
    }


    if ($_GET['p1']=='r') 
    {
    $order = ' ORDER BY id_filmu ASC ';
    }   
        }

    
    if (isset($_GET['p2'])){

    if ($_GET['p2']=='m') 
    {
    $order = ' ORDER BY tytul DESC ';
    }


    if ($_GET['p2']=='r') 
    {
    $order = ' ORDER BY tytul ASC ';
    }
        }


    if (isset($_GET['p3'])){

    if ($_GET['p3']=='m')
    {
    $order = ' ORDER BY czas_trwania DESC ';
    }


    if ($_GET['p3']=='r')
    {
    $order = ' ORDER BY czas_trwania ASC ';
    }
        }


    if (isset($_GET['p4'])){

    if ($_GET['p4']=='m')
    {
    $order = ' ORDER BY data_premiery DESC ';
    }


    if ($_GET['p4']=='r')
    {
    $order = ' ORDER BY data_premiery ASC ';
    }
        }



    }   else {
        $order = ' ORDER BY id_filmu ASC ';
    }


    
require_once("logika_paginacji_filmow.php");



$stmt = $conn->query("SELECT id_filmu, tytul, czas_trwania, data_premiery FROM filmy $order LIMIT $record_index, $limit");
//$stmt = $conn->query("SELECT id_filmu, tytul, czas_trwania, data_premiery FROM filmy $order");


$rows = $stmt -> fetchAll();

?>


    <h1>Lista filmów </h1>


<?php
    if (isset ($_SESSION['zalogowany']) and ($_SESSION['zalogowany'] == true) )
    {     ?>

<ol>
    <li class='przycisk'><a href="formularz_film.php?akcja=dodaj_film">Dodaj film</a></li>
</ol>

  <?php  }
                ?>




<?php
require_once("paginacja_filmow.php");
?>
  




<table>

<tr>
    <th>Id <a href="?akcja=filmy&p1=r">&#8593</a>/<a href="?akcja=filmy&p1=m">&#8595</a></th>
    <th>Tytuł <a href="?akcja=filmy&p2=r">&#8593</a>/<a href="?akcja=filmy&p2=m">&#8595</a></th>
    <th>Długość <a href="?akcja=filmy&p3=r">&#8593</a>/<a href="?akcja=filmy&p3=m">&#8595</a></th>
    <th>Data premiery <a href="?akcja=filmy&p4=r">&#8593</a>/<a href="?akcja=filmy&p4=m">&#8595</a></th>
    
    
    <?php
    if (isset ($_SESSION['zalogowany']) and ($_SESSION['zalogowany'] == true) )
    {     ?>
    
    <th>Usuń film</th>

    <?php
    }
        ?>






</tr>

<?php
foreach ($rows as $row)
{ 
    ?>

<tr>
    <td><?php echo $row['id_filmu']; ?></td>
    <td><a href="index.php?akcja=film&id_filmu=<?php echo $row['id_filmu']?> "><?php echo $row['tytul']; ?></a></td>
    <td><?php echo $row['czas_trwania']; ?></td>
    <td><?php echo $row['data_premiery']; ?></td>


    <?php
    if (isset ($_SESSION['zalogowany']) and ($_SESSION['zalogowany'] == true) )
    {     ?>


    <td>

    <?php
        $id_filmu = $row['id_filmu'];


        $stmt = $conn->query("SELECT COUNT(*) FROM osoby_w_filmach a, filmy b, osoby d WHERE  a.id_filmu = b.id_filmu AND a.id_osoby = d.id_osoby and b.id_filmu=$id_filmu");

        $rows = $stmt -> fetch();
        $zmienna_a = $rows[0];
        
        if($zmienna_a == 0)
        {

        ?>
    
        <a href="usun_film.php?id_filmu=<?php echo $row['id_filmu']?>&tytul=<?php echo $row['tytul']?>&akcja=usun_film">Usuń</a>
        

        <?php
        }
        ?>

    </td>
     
    <?php
    }
        ?>

    

</tr>
<?php
}
?>

</table>

<?php
}
?>

 



<?php if($akcja == "osoby") { 
    

    if (isset($_GET['p1']) || isset($_GET['p2']) || isset($_GET['p3']) || isset($_GET['p4']))
    {

    if (isset($_GET['p1'])){

    if ($_GET['p1']=='m')
    {
     $order = ' ORDER BY id_osoby DESC ';
    }


    if ($_GET['p1']=='r') 
    {
    $order = ' ORDER BY id_osoby ASC ';
    }   
        }

    
    if (isset($_GET['p2'])){

    if ($_GET['p2']=='m') 
    {
    $order = ' ORDER BY imie DESC ';
    }


    if ($_GET['p2']=='r') 
    {
    $order = ' ORDER BY imie ASC ';
    }
        }


    if (isset($_GET['p3'])){

    if ($_GET['p3']=='m')
    {
    $order = ' ORDER BY nazwisko DESC ';
    }


    if ($_GET['p3']=='r')
    {
    $order = ' ORDER BY nazwisko ASC ';
    }
        }


    if (isset($_GET['p4'])){

    if ($_GET['p4']=='m')
    {
    $order = ' ORDER BY data_urodzenia DESC ';
    }


    if ($_GET['p4']=='r')
    {
    $order = ' ORDER BY data_urodzenia ASC ';
    }
        }



    }   else {
        $order = ' ORDER BY id_osoby ASC ';
    }





require_once("logika_paginacji_osob.php");


$stmt = $conn->query("SELECT id_osoby, imie, nazwisko, data_urodzenia FROM osoby $order LIMIT $record_index, $limit");


$rows = $stmt -> fetchAll();

?>

<h1>Lista osób </h1>





<?php
    if (isset ($_SESSION['zalogowany']) and ($_SESSION['zalogowany'] == true) )
    {     ?>

<ol>
    <li class='przycisk dodatek'><a href="formularz_osoba.php?akcja=dodaj_osobe">Dodaj osobę</a></li>
</ol>

        <?php
    }
        ?>




<?php
require_once("paginacja_osob.php");
?>





<table>

<tr>
    <th>Id <a href="?akcja=osoby&p1=r">&#8593</a>/<a href="?akcja=osoby&p1=m">&#8595</a></th>
    <th>Imię <a href="?akcja=osoby&p2=r">&#8593</a>/<a href="?akcja=osoby&p2=m">&#8595</a></th>
    <th>Nazwisko <a href="?akcja=osoby&p3=r">&#8593</a>/<a href="?akcja=osoby&p3=m">&#8595</a></th>
    <th>Data urodzenia <a href="?akcja=osoby&p4=r">&#8593</a>/<a href="?akcja=osoby&p4=m">&#8595</a></th>




    <?php
    if (isset ($_SESSION['zalogowany']) and ($_SESSION['zalogowany'] == true) )
    {     ?>

    <th>Usuń osobę</th>

    <?php
    }
        ?>





</tr>

<?php
foreach ($rows as $row)
{ 
    ?>

<tr>
    <td><?php echo $row['id_osoby'];?></td>
    <td><a href="index.php?akcja=osoba&id_osoby=<?php echo $row['id_osoby']?> "><?php echo $row['imie'];?></a></td>
    <td><a href="index.php?akcja=osoba&id_osoby=<?php echo $row['id_osoby']?>"><?php echo $row['nazwisko'];?></a></td>
    <td><?php echo $row['data_urodzenia'];?></td>




    <?php
    if (isset ($_SESSION['zalogowany']) and ($_SESSION['zalogowany'] == true) )
    {     ?>
    <td>

    <?php
        $id_osoby = $row['id_osoby'];


        $stmt = $conn->query("SELECT COUNT(*) FROM osoby_w_filmach a, filmy b, osoby d WHERE a.id_filmu = b.id_filmu AND a.id_osoby = d.id_osoby and d.id_osoby=$id_osoby");

        $rows = $stmt -> fetch();
        $zmienna_a = $rows[0];
        
        if($zmienna_a == 0)
        {

        ?>
    
        <a href="usun_osobe.php?id_osoby=<?php echo $row['id_osoby']?>&imie=<?php echo $row['imie']?>&nazwisko=<?php echo $row['nazwisko']?>&akcja=usun_osobke">Usuń</a>
        

        <?php
        }
        ?>

    </td>

    <?php
    }
        ?>





</tr>

<?php
}
?>


</table>

<?php
}
?>


<?php if($akcja=="film") {
    

if (isset($_GET['id_filmu'])) {
                $id_filmu = $_GET['id_filmu'];
        } 


$stmt = $conn->query("SELECT * FROM filmy WHERE id_filmu=$id_filmu");


$rows = $stmt -> fetch();


?>

<h1>Film: <?php echo $rows['tytul']?></h1>
<h2>Dane</h2>

<table>
<tr>
    
    <th class="nazwa">Tytuł</th>
    <td><?php echo $rows['tytul']?></td>
       
</tr>
<tr>
    <th class="nazwa">Rok produkcji</th>
    <td><?php echo $rows['rok_produkcji']?></td>
    
</tr>

<tr>
    <th class="nazwa">Premiera</th>
    <td><?php echo $rows['data_premiery']?></td>
    
</tr>

<tr>
    <th class="nazwa">Długość</th>
    <td><?php echo $rows['czas_trwania']?></td>
    
</tr>

</table>


<h2>Streszczenie</h2>
<p> <?php echo $rows['opis']?></p>


<?php
    if (isset ($_SESSION['zalogowany']) and ($_SESSION['zalogowany'] == true) )
    {     ?>

<ol>
    <li class='przycisk wstaw_aktora'><a href="index.php?akcja=wstaw_aktora&id_filmu=<?php echo $id_filmu?>">Wstaw aktorów filmu</a></li>
</ol>

<?php
    }       
    ?>


<?php




if (isset($_GET['p1']) || isset($_GET['p2']) || isset($_GET['p3']))
    {

    if (isset($_GET['p1'])){

    if ($_GET['p1']=='m')
    {
     $order = ' ORDER BY imie DESC ';
    }


    if ($_GET['p1']=='r') 
    {
    $order = ' ORDER BY imie ASC ';
    }   
        }

    
    if (isset($_GET['p2'])){

    if ($_GET['p2']=='m') 
    {
    $order = ' ORDER BY nazwisko DESC ';
    }


    if ($_GET['p2']=='r') 
    {
    $order = ' ORDER BY nazwisko ASC ';
    }
        }


    if (isset($_GET['p3'])){

    if ($_GET['p3']=='m')
    {
    $order = ' ORDER BY nazwa_funkcji DESC ';
    }


    if ($_GET['p3']=='r')
    {
    $order = ' ORDER BY nazwa_funkcji ASC ';
    }
        }



    }   else {
        $order = ' ORDER BY nazwisko ASC ';
    }





?>
<?php
$stmt = $conn->query("SELECT * FROM osoby_w_filmach a, filmy b, osoby d WHERE a.id_filmu = b.id_filmu AND a.id_osoby = d.id_osoby and b.id_filmu=$id_filmu $order");

$rows = $stmt -> fetchAll();

?>
    
<h2 class="tytul">Osoby</h2>
<table>
<tr>
    
    <th style="color:black;">Imię <a href='?p1=r&akcja=film&id_filmu=<?php echo $id_filmu?>'>&#8593</a>/<a href='?p1=m&akcja=film&id_filmu=<?php echo $id_filmu?>'>&#8595</a></th>
    <th style="color:black;">Nazwisko <a href="?p2=r&akcja=film&id_filmu=<?php echo $id_filmu?>">&#8593</a>/<a href="?p2=m&akcja=film&id_filmu=<?php echo $id_filmu?>">&#8595</a></th>
    <th style="color:black;">Rola <a href="?p3=r&akcja=film&id_filmu=<?php echo $id_filmu?>">&#8593</a>/<a href="?p3=m&akcja=film&id_filmu=<?php echo $id_filmu?>">&#8595</a></th>
    
    
    <?php
    if (isset ($_SESSION['zalogowany']) and ($_SESSION['zalogowany'] == true) )
    {     ?>
    
    <th style="color:black;">Usuń osobę z filmu</th>

        <?php
    }
        ?>



</tr>


<?php
foreach ($rows as $row)
{ 
    ?>

<tr>
    
    <td><a href="index.php?akcja=osoba&id_osoby=<?php echo $row['id_osoby']?> "><?php echo $row['imie']?></a></td>
    <td><a href="index.php?akcja=osoba&id_osoby=<?php echo $row['id_osoby']?>"><?php echo $row['nazwisko']?></a></td>
    <td><?php echo $row['nazwa_funkcji']?></td>




    <?php
    if (isset ($_SESSION['zalogowany']) and ($_SESSION['zalogowany'] == true) )
    {     ?>

    <td><a href="Usun_osobe_z_filmu.php?id_osoby=<?php echo $row['id_osoby']?>&id_filmu=<?php echo $_GET['id_filmu']?>
&imie=<?php echo $row['imie']?>&nazwisko=<?php echo $row['nazwisko']?>&tytul=<?php echo $row['tytul']?>&nazwa_funkcji=<?php echo $row['nazwa_funkcji']?>&akcja=usun_osobe">Usuń</a></td>

    <?php
    }
    ?>




</tr>

<?php 
}
?>

</table>


<?php
}
?>





<?php if($akcja=="osoba") {
    

    if (isset($_GET['id_osoby'])) {
                    $id_osoby = $_GET['id_osoby'];
            } 
    
    
    $stmt = $conn->query("SELECT * FROM osoby WHERE id_osoby=$id_osoby");
    
    
    $rowk = $stmt -> fetch();
    
    
?>


<h1>Osoba: <?php echo $rowk['imie']; echo " "; echo $rowk['nazwisko']  ?></h1>
<h2>Dane</h2>

<table>
<tr>
    
    <th class="nazwa">Imię</th>
    <td><?php echo $rowk['imie']?></td>
       
</tr>
<tr>
    <th class="nazwa">Nazwisko</th>
    <td><?php echo $rowk['nazwisko']?></td>
    
</tr>

<tr>
    <th class="nazwa">Płeć</th>
    <td>
        <?php 
        if ($rowk['czy_mezczyzna']==1)
        {
        echo 'mężczyzna';
        }
        else
        {
        echo 'kobieta';
        }

        ?>
        </td>
    
</tr>

<tr>
    <th class="nazwa">Data urodzenia</th>
    <td><?php echo $rowk['data_urodzenia']?></td>
    
</tr>

</table>


<h2>Charakterystyka</h2>
<p><?php echo $rowk['charakterystyka']?></p>





<?php
    if (isset ($_SESSION['zalogowany']) and ($_SESSION['zalogowany'] == true) )
    {     ?>


<ol>
    <li class='przycisk wstaw_aktora'><a href="index.php?akcja=wstaw_filmy&id_osoby=<?php echo $id_osoby?>">Wstaw filmy aktora</a></li>
</ol>

<?php
    }
    ?>




<?php
    



if (isset($_GET['p1']) || isset($_GET['p2']))
{

if (isset($_GET['p1'])){

if ($_GET['p1']=='m')
{
 $order = ' ORDER BY tytul DESC ';
}


if ($_GET['p1']=='r') 
{
$order = ' ORDER BY tytul ASC ';
}   
    }


if (isset($_GET['p2'])){

if ($_GET['p2']=='m') 
{
$order = ' ORDER BY nazwa_funkcji DESC ';
}


if ($_GET['p2']=='r') 
{
$order = ' ORDER BY nazwa_funkcji ASC ';
}
    }




}   else {
    $order = ' ORDER BY tytul ASC ';
}



?>


<?php
$stmt = $conn->query("SELECT * FROM osoby_w_filmach a, filmy b, osoby d WHERE a.id_filmu = b.id_filmu AND a.id_osoby = d.id_osoby and d.id_osoby=$id_osoby $order");

$rows = $stmt -> fetchAll();

?>


<h2 class="tytul">Filmy</h2>
<table>
<tr>
    <th style="color:black">Tytuł <a href='?p1=r&akcja=osoba&id_osoby=<?php echo $id_osoby?>'>&#8593</a>/<a href='?p1=m&akcja=osoba&id_osoby=<?php echo $id_osoby?>'>&#8595</a></th>
    <th style="color:black">Rola <a href='?p2=r&akcja=osoba&id_osoby=<?php echo $id_osoby?>'>&#8593</a>/<a href='?p2=m&akcja=osoba&id_osoby=<?php echo $id_osoby?>'>&#8595</a></th>
    
    
    <?php
    if (isset ($_SESSION['zalogowany']) and ($_SESSION['zalogowany'] == true) )
    {     ?>

    <th style="color:black;">Usuń film tej osobie</th>

        <?php
    }
        ?>


</tr>


<?php
foreach($rows as $row)
{ 
?>

<tr>
    <td><a href="index.php?akcja=film&id_filmu=<?php echo $row['id_filmu']?>"><?php echo $row['tytul']?></a></td>
    <td><?php echo $row['nazwa_funkcji']?></td>


    <?php
    if (isset ($_SESSION['zalogowany']) and ($_SESSION['zalogowany'] == true) )
    {     ?>

    <td><a href="usun_film_tej_osoby.php?id_osoby=<?php echo $_GET['id_osoby']?>&id_filmu=<?php echo $row['id_filmu']?>
&imie=<?php echo $rowk['imie']?>&nazwisko=<?php echo $rowk['nazwisko']?>&tytul=<?php echo $row['tytul']?>&nazwa_funkcji=<?php echo $row['nazwa_funkcji']?>&akcja=usun_film_osobie">Usuń</a></td>

        <?php
    }

    ?>




</tr>


<?php
}
?>

</table>



<?php
}
?>



<?php 
if($akcja=="wstaw_aktora") {

    $idd= $_GET['id_filmu'];
    $stmt = $conn->query("SELECT tytul FROM filmy WHERE id_filmu= $idd ");
    $rot = $stmt -> fetch();



    $stmt = $conn->query("SELECT id_osoby, imie, nazwisko, data_urodzenia FROM osoby");
    $rows = $stmt -> fetchAll();

?>

<h1>Wybierz aktorów z filmu <?php echo $rot['tytul'];?> </h1>




<table>

<tr>
    <th>Id</th>
    <th>Imię</th>
    <th>Nazwisko</th>
    <th>Data urodzenia</th>
    <th>Dodaj aktora</th>
</tr>

<?php
foreach ($rows as $row)
{ 
    ?>

<tr>
    <td><?php echo $row['id_osoby'];?></td>
    <td><a href="index.php?akcja=osoba&id_osoby=<?php echo $row['id_osoby']?> "><?php echo $row['imie'];?></a></td>
    <td><a href="index.php?akcja=osoba&id_osoby=<?php echo $row['id_osoby']?>"><?php echo $row['nazwisko'];?></a></td>
    <td><?php echo $row['data_urodzenia'];?></td>
    <td><a href="formularz_dodaj_aktora.php?id_filmu=<?php echo $_GET['id_filmu']?>&id_osoby=<?php echo $row['id_osoby']?>
&tytul=<?php echo $rot['tytul']?>&imie=<?php echo $row['imie'];?>&nazwisko=<?php echo $row['nazwisko'];?>&akcja=wstaw_aktora">Dodaj</a></td>




</tr>

<?php
}
?>


</table>

<?php
}
?>








<?php
if($akcja=="wstaw_filmy") {


    $ido= $_GET['id_osoby'];
    $stmt = $conn->query("SELECT imie, nazwisko FROM osoby WHERE id_osoby= $ido ");
    $rot = $stmt -> fetch();



    $stmt = $conn->query("SELECT id_filmu, tytul, czas_trwania, data_premiery FROM filmy");
    $rows = $stmt -> fetchAll();

?>


    <h1>Lista filmów dla <?php echo $rot['imie']; echo " "; echo $rot['nazwisko'];?></h1>





<table>

<tr>
    <th>Id</th>
    <th>Tytuł</th>
    <th>Długość</th>
    <th>Data premiery</th>
    <th>Dodaj film</th>
</tr>

<?php
foreach ($rows as $row)
{ 
    ?>

<tr>
    <td><?php echo $row['id_filmu']; ?></td>
    <td><a href="index.php?akcja=film&id_filmu=<?php echo $row['id_filmu']?> "><?php echo $row['tytul']; ?></a></td>
    <td><?php echo $row['czas_trwania']; ?></td>
    <td><?php echo $row['data_premiery']; ?></td>
    <td><a href="formularz_dodaj_film.php?id_osoby=<?php echo $_GET['id_osoby']?>&id_filmu=<?php echo $row['id_filmu']?>
&imie=<?php echo $rot['imie']?>&nazwisko=<?php echo $rot['nazwisko']?>&tytul=<?php echo $row['tytul'];?>&akcja=wstaw_filmy">Dodaj</a></td>

</tr>
<?php
}
?>

</table>

<?php
}
?>


<?php
if($akcja=="mapa") {
?>
    <html>

                                            
    <div style="clear:both"></div>
    <body>
    <p class="adres"> Mapa dojazdu do twórcy strony KINO. <br>
        Adres: 96-100 Skierniewice <br>
        Ul. Sucharskiego 7 <br><br>
        Tel. 503 337 258 <br><br>
        Email: marek_j7@wp.pl
    </p>

    <div style="clear:both"></div>


<form action="mapa.php" method="post">

<h2 style='margin: 0px 0 0px 0; font-size:22px;  width:250px;'>  Napisz do mnie:  </h2>

<p class="pola_wymagane">* pola wymagane</p>
<div style="clear:both"></div>
<table class="tabelka_kontakt">
<tr>

<th style ="width:50px;"class="nazwa">Imię</th>
<td ><input style="width:150px;" type="text" id="logon" name="logon" placeholder="Wpisz imie" value="
<?php
if (isset($_SESSION['logon'])){
echo $_SESSION['logon'];
unset($_SESSION['logon']);

}?>">


<span> *</span>     
<span>     

<?php 
if (isset($_SESSION['logonErr'])){
echo $_SESSION['logonErr'];
unset($_SESSION['logonErr']);
}
?>

</span>
</td>


</tr>


<tr>
<th class="nazwa">Email</th>


<td ><input style="width:150px;" type="text" id="email2" name="email2" placeholder="Wpisz email" value="
<?php
if (isset($_SESSION['email2'])){
echo $_SESSION['email2'];
unset($_SESSION['email2']);

}?>">

<span>  *  </span> 
<span>     

<?php 
if (isset($_SESSION['email2Err'])){
echo $_SESSION['email2Err'];
unset($_SESSION['email2Err']);
}
?>

</span>

</td>


</tr>



<tr>
    <th class="nazwa">Wpisz wiadomość</th>
    <td> <textarea style="width:150px;" id="Opis" name="opis_filmu" rows="5" cols="30" placeholder="Tutaj wpisz wiadomosc"><?php
     if (isset($_SESSION['opis_filmu'])){
        echo $_SESSION['opis_filmu'];
        unset($_SESSION['opis_filmu']);
        
    }?></textarea>
    


    <span> *</span>     
    <span>     
        
    <?php 
    if (isset($_SESSION['opis_filmuErr'])){
        echo $_SESSION['opis_filmuErr'];
        unset($_SESSION['opis_filmuErr']);
    }
    ?>

    </span>



</td>
   
</tr>






<input type="hidden" name="akcja" value="<?php echo $akcja; ?>" >



<input type="hidden" name="id_filmu" value="<?php if (isset($id_filmu)) {echo $id_filmu;} ?>" >


<input type="hidden" name="id_osoby" value="<?php if (isset($id_osoby)) {echo $id_osoby;} ?>" >



</table>


<!-- <input type="hidden" id="akcja" name="akcja"  value="dodaj_uzytkownika"> -->

<br>


<?php
    if (isset($_SESSION['wiadomosc'])){   ?>
        <div class='wiadomosc'><?php echo $_SESSION['wiadomosc']; ?>  </div>
        
        <?php unset($_SESSION['wiadomosc']);
        
    }
?>



<input type="submit" class="przycisk_wstaw_film wyslij_email" name="opcja" value="Wyślij email">

<br>
<br>
<br>
<br>


  </form>

  <div style="clear:both"></div>



    
    <div class="mapa";>
     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2457.7987240731227!2d20.13639749668165!3d51.974094199999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4719605d12fbbabf%3A0xd5e0e6829b37ab1c!2smajora%20Henryka%20Sucharskiego%207%2C%2096-100%20Skierniewice!5e0!3m2!1spl!2spl!4v1711028387401!5m2!1spl!2spl" width="590"; height="582"; style="border:1px dotted #337ab7"; allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
     </div>
    
            
    
    
    <div style="clear:both"></div>
   


<?php
}
?>


<?php
require_once("footer.php");
?>
</div>
</div>
                                                        
</body>

</html>

