<?php
if(isset($_POST['counter'])!=true){
  echo "Wprowadź liczbę wierszy";
  die();
}
  $tablicInsertow=[];
      require("./config.php");
    $counter= ($_POST['counter']);
    $tabela= ($_POST['tabela']);
    
    switch ($tabela) {
        case 'danymeczasysty':
          $danymeczasystyCounter=$counter;
          $meczCounter=5;
          $druzynaCounter=5;
          $sezonCounter=5;
          $kolejkaCounter=5; 
          $zawodnikCounter=5;
          $pozycjaCounter=5;
          include('./danymeczasysty.php');
        break;

        case 'danymeczczerwonakartka':
          $danymeczczerwonakartkaCounter=$counter;
          $meczCounter=5;
          $druzynaCounter=5;
          $sezonCounter=5;
          $kolejkaCounter=5; 
          $zawodnikCounter=5;
          $pozycjaCounter=5;
          include('./danymeczczerwonakartka.php');
        break;
                
        case 'danymeczgole':
          $danymeczgoleCounter=$counter;
          $meczCounter=5;
          $druzynaCounter=5;
          $sezonCounter=5;
          $kolejkaCounter=5; 
          $zawodnikCounter=5;
          $pozycjaCounter=5;
            include('./danymeczgole.php');
          break;
                  
        case 'druzyna':
          $druzynaCounter=$counter;
            include('./druzyna.php');
          break;
                  
        case 'druzyny_sezony':
          $druzyny_sezonyCounter=$counter;
          $druzynaCounter=5;
          $sezonCounter=5;
            include('./druzyny_sezony.php');
          break;
                  
        case 'kolejka':
          $kolejkaCounter=$counter;
            include('./kolejka.php');
          break;
                  
        case 'mecz':
          $meczCounter=$counter;
          $druzynaCounter=5;
          $sezonCounter=5;
          $kolejkaCounter=5;   
          $zawodnikCounter=5; 
          $pozycjaCounter=5;  
          $sezonCounter=5;   
            include('./mecz.php');
          break;
                  
        case 'pozycja':
          $pozycjaCounter=$counter;
            include('./pozycja.php');
          break;
                  
        case 'sezon':
          $sezonCounter=$counter;
            include('./sezon.php');
          break;
        case 'transfer':
          $transferCounter=$counter;
          $druzynaCounter=5;
          $zawodnikCounter=5;
          $pozycjaCounter=5;
            include('./transfer.php');
          break;
        case 'zawodnicy_sezony':
          $zawodnicy_sezonyCounter=$counter;
          $zawodnikCounter=5;
          $sezonCounter=5;
          $pozycjaCounter=5;
          $druzynaCounter=5;
            include('./zawodnicy_sezony.php');
          break;
        case 'zawodnik':
          $zawodnikCounter=$counter;  
          $druzynaCounter=5;
          $pozycjaCounter=5;
          include('./zawodnik.php');
          break;

          
      }
      $time="../inserts/Zbior Insertow Godz. ".date('h-i-s').".txt";
  
      file_put_contents($time, implode(PHP_EOL, $tablicInsertow));

      echo "Pomyślnie dodano";

?>