<?php
        $sql = 'SELECT IDPOZYCJA FROM POZYCJA WHERE IDPOZYCJA= (SELECT MAX(IDPOZYCJA) FROM POZYCJA)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))!=false){  
                $MAXID = $row[0];
        }
        else{
                $MAXID=0;
         }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        for($i=0 ; $i<$pozycjaCounter; $i++){
         $MAXID++;

         $POZYCJA = '';
         for ($k = 0; $k < 5; $k++) {
         $POZYCJA .= $characters[rand(0, 60)];
         }
        

        $sql = 'INSERT INTO POZYCJA(IDPOZYCJA,NAZWPOZYCJA) VALUES (:IDPOZYCJA,:POZYCJA)';
        $query= oci_parse($c, $sql);    
        oci_bind_by_name($query, ':IDPOZYCJA',$MAXID);
        oci_bind_by_name($query, ':POZYCJA',$POZYCJA);
        oci_execute($query);
        $tablicInsertow[]= "INSERT INTO POZYCJA(IDPOZYCJA,NAZWPOZYCJA) VALUES(".$MAXID.",".$POZYCJA.");";
         }
        
    
?>