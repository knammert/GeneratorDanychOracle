<?php

        //Sprawdzanei kluczow obcych tabeli SEZON
        $sql = 'SELECT IDSEZON FROM SEZON WHERE IDSEZON= (SELECT MAX(IDSEZON) FROM SEZON)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))==false){
            include('./sezon.php');  
        }

        //Sprawdzanieu klcuzow obych tabeli ZAWODNIK
        $sql = 'SELECT IDZAWODNIK FROM ZAWODNIK WHERE IDZAWODNIK = (SELECT MAX(IDZAWODNIK) FROM ZAWODNIK)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))==false){ 
            include('./zawodnik.php');              
        }
        //Ponowne sprawdzenei w celu znalezneinai klucza glownego tabveli SEZON
        $sql = 'SELECT IDSEZON FROM SEZON WHERE IDSEZON= (SELECT MAX(IDSEZON) FROM SEZON)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        $row= oci_fetch_row($query);
        $sezonMAXID=$row[0];
        //Ponowne sprawdzenei w celu znalezneinai klucza glownego tabeli ZAWODNIK
        $sql = 'SELECT IDZAWODNIK FROM ZAWODNIK WHERE IDZAWODNIK = (SELECT MAX(IDZAWODNIK) FROM ZAWODNIK)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        $row= oci_fetch_row($query);
        $zawodnikMAXID= $row[0];

    

        for($i=0 ; $i<$zawodnicy_sezonyCounter; $i++){     

            $SEZON_IDSEZON =(rand(1, $sezonMAXID));
            $ZAWODNIK_IDZAWODNIK =(rand(1, $zawodnikMAXID));
                  
         
            $sql = 'INSERT INTO ZAWODNICY_SEZONY(ZAWODNIK_IDZAWODNIK,SEZON_IDSEZON) VALUES (:ZAWODNIK_IDZAWODNIK,:SEZON_IDSEZON)';
            $query= oci_parse($c, $sql);    
            oci_bind_by_name($query, ':SEZON_IDSEZON',$SEZON_IDSEZON);
            oci_bind_by_name($query, ':ZAWODNIK_IDZAWODNIK',$ZAWODNIK_IDZAWODNIK);
            oci_execute($query);

            $tablicInsertow[]= "INSERT INTO ZAWODNICY_SEZONY(ZAWODNIK_IDZAWODNIK,SEZON_IDSEZON) VALUES(".$SEZON_IDSEZON.",".$ZAWODNIK_IDZAWODNIK.");";
            }
        

?>