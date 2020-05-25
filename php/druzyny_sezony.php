<?php

        //Sprawdzanei kluczow obcych tabeli DRUZYNA
        $sql = 'SELECT IDDRUZYNA FROM DRUZYNA WHERE IDDRUZYNA = (SELECT MAX(IDDRUZYNA) FROM DRUZYNA)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))==false){  
            include('./druzyna.php');
        }

        //Sprawdzanieu klcuzow obych tabeli SEZON
        $sql = 'SELECT IDSEZON FROM SEZON WHERE IDSEZON= (SELECT MAX(IDSEZON) FROM SEZON)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))==false){ 
            include('./sezon.php');              
        }
        //Ponowne sprawdzenei w celu znalezneinai klucza glownego tabveli DRUZYNA
        $sql = 'SELECT IDDRUZYNA FROM DRUZYNA WHERE IDDRUZYNA = (SELECT MAX(IDDRUZYNA) FROM DRUZYNA)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        $row= oci_fetch_row($query);
        $druzynaMAXID=$row[0];
        //Ponowne sprawdzenei w celu znalezneinai klucza glownego tabeli SEZON
        $sql = 'SELECT IDSEZON FROM SEZON WHERE IDSEZON= (SELECT MAX(IDSEZON) FROM SEZON)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        $row= oci_fetch_row($query);
        $sezonMAXID= $row[0];
   


        for($i=0 ; $i<$druzyny_sezonyCounter; $i++){     
              
            $DRUZYNA_IDDRUZYNA =(rand(1, $druzynaMAXID));
            $SEZON_IDSEZON =(rand(1, $sezonMAXID));
         
            $sql = 'INSERT INTO DRUZYNY_SEZONY(DRUZYNA_IDDRUZYNA,SEZON_IDSEZON) VALUES (:DRUZYNA_IDDRUZYNA,:SEZON_IDSEZON)';
            $query= oci_parse($c, $sql);    
            oci_bind_by_name($query, ':DRUZYNA_IDDRUZYNA',$DRUZYNA_IDDRUZYNA);
            oci_bind_by_name($query, ':SEZON_IDSEZON',$SEZON_IDSEZON);
            oci_execute($query);
            $tablicInsertow[]= "INSERT INTO DRUZYNY_SEZONY(DRUZYNA_IDDRUZYNA,SEZON_IDSEZON) VALUES(".$DRUZYNA_IDDRUZYNA.",".$SEZON_IDSEZON.");";
            }
        

?>