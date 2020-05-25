<?php
       

        $sql = 'SELECT IDKOLEJKA FROM KOLEJKA WHERE IDKOLEJKA= (SELECT MAX(IDKOLEJKA) FROM KOLEJKA)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))!=false){  
                $MAXID = $row[0];
        }
        else{
                $MAXID=0;
        }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        for($i=0 ; $i<$kolejkaCounter; $i++){
         $MAXID++;

         $RUNDA = '';
         for ($k = 0; $k < 5; $k++) {
         $RUNDA .= $characters[rand(1, 60)];
         }
        

        $sql = 'INSERT INTO KOLEJKA(IDKOLEJKA,RUNDA) VALUES (:IDKOLEJKA,:RUNDA)';
        $query= oci_parse($c, $sql);    
        oci_bind_by_name($query, ':IDKOLEJKA',$MAXID);
        oci_bind_by_name($query, ':RUNDA',$RUNDA);
        oci_execute($query);

        $tablicInsertow[]= "INSERT INTO KOLEJKA(IDKOLEJKA,RUNDA) VALUES(".$MAXID.",".$RUNDA.");";

        }
    
?>