<?php


$stmt = $conn->query("SELECT COUNT(*) FROM filmy");

     
       $rows = $stmt -> fetch(PDO::FETCH_NUM);
      
       
           $total_records = $rows[0];
       
           /* $total_pages = ceil($total_records / $limit);  */
           $limit = 7;

           
        

if (isset($_GET["page"]) ) 
{
$page  = $_GET["page"]; 
} 
else 
{
$page = 0; 
$_GET["page"]=$page;
}

$record_index = $page;



/* $record_index= ($page-1) * $limit; */ 

?>