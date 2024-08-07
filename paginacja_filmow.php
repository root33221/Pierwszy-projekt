


<div class="page_lewy">    
                
            
                <?php
                    //$_GET["page"] = 15;


                    

                    if  (($_GET["page"]) > 6)
                   
                   {
                        ?> 

                        
                    <a href='index.php?akcja=filmy&page=<?php echo ($page - 7); ?>' >  
         
                                
                          
                              <div class='ikona'>    <img src='strzalka_w_lewo.jpg'>    </div> 
                             
                              <div class='akapit'>Poprzednie</div>

                               
                    
                            </a>
                              <?php
                            } 
                            ?> 
         </div> 

              
            



<div class="page_srodek">



<!-- 
<?php

            $strona = $total_records/$limit;
            $strona = ceil($strona);
            $page2 = 0;

            ?>
            
            

            <?php
            for ($b=1; $b<=$strona; $b++)
            {
            ?>


                    
                                
            <a href='index.php?akcja=filmy&page=<?php if($page2 < $total_records)
                                                     {

                                                    echo $page2;
                                                    $page2 = $page2 + 7;
                                                    
                                                    }
                                                     
                                                     ?>'>
                                         
                                         
                                                   <?php echo "[".$b."]"; ?> 
                                              
                                      

                                          </a>
                                      
   
            <?php 
                  //echo var_dump($page);
            }
              ?> -->

          
            




<?php

$razem = $total_records ;
$na_stronie = $limit ;              // ilość elementów tablicy na jednej podstronie



if( !isset($_GET['page']) ){ 
  $start = 0;  
}                                                           // jeśli nie istnieje $_GET['start']
else{
  $start = $_GET['page'] ;

}


$ta_strona = $start / $na_stronie + 1 ; // określenie numeru tej podstrony

                                          // do wyświetlenia ilości stron w pętli
$start_podstrony  = 0;
$podstrona           = 1;

 

while ( $start_podstrony <  $razem ) {
  if( $podstrona == $ta_strona ) {
    ?>
        <a href="index.php?akcja=filmy&page=<?php echo $start_podstrony ?> "><b style="background:orangered; border:2px solid orangered;"> <?php echo "[ ". $podstrona ." ]" ?></b>  </a>
  <?php
  } else {     ?>
       <a href="index.php?akcja=filmy&page=<?php echo $start_podstrony ?> "> <?php echo "[ ". $podstrona ." ]" ?>    </a> 
       <?php
  }

  $start_podstrony  = $start_podstrony + $na_stronie ;
  ++$podstrona;
}

?>

</div>







       

         <div class="page_prawy">        

          <?php
                  
                 
                   //$total_records = 23; 
                    if(($_GET["page"]) + 1 < $total_records)
                   
                   {
                        ?>
                   <a href='index.php?akcja=filmy&page=<?php echo ($page + 7); ?>' >
                               
                                <div class='ikona_dwa'>   <img src='strzalka_w_prawo.png'>    </div>

                                <div class='akapit_dwa'>Następne</div> 
                                
                                    
                               </a>  
                            
                            <?php 
                            } 
                            ?>
                            
         </div>

        

         <div style="clear:both";></div> 






