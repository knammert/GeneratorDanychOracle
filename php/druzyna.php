<?php
 

        $sql = 'SELECT IDDRUZYNA FROM DRUZYNA WHERE IDDRUZYNA = (SELECT MAX(IDDRUZYNA) FROM DRUZYNA)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))!=false){  
                $MAXID=$row[0];
        }
        else{
                $MAXID=0;
        }


        for($i=0 ; $i<$druzynaCounter; $i++){
                $MAXID++;

        $plik = file("./DRUZYNAlista.txt");
        $linia = $plik[rand(0,count($plik)- 1)];
        $NAZWDRUZYNA = $linia;
        $NAZWDRUZYNA=trim($NAZWDRUZYNA);

        $sql = 'INSERT INTO DRUZYNA(IDDRUZYNA,NAZWDRUZYNA) VALUES (:IDDRUZYNA,:NAZWDRUZYNA)';
        $query= oci_parse($c, $sql);    
        oci_bind_by_name($query, ':IDDRUZYNA',$MAXID);
        oci_bind_by_name($query, ':NAZWDRUZYNA',$NAZWDRUZYNA);
        oci_execute($query);

        $tablicInsertow[]= "INSERT INTO DRUZYNA(IDDRUZYNA,NAZWDRUZYNA) VALUES (".$MAXID.",".$NAZWDRUZYNA.");";
         }
        

?>