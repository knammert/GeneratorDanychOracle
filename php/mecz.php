<?php

        $addDate =1;
        //MAXID dla KOLEJKA
        $sql = 'SELECT IDKOLEJKA FROM KOLEJKA WHERE IDKOLEJKA= (SELECT MAX(IDKOLEJKA) FROM KOLEJKA)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))==false){  
            include('./kolejka.php');  
        }

        //MAXID dla DRUZYNA 
        $sql = 'SELECT IDDRUZYNA FROM DRUZYNA WHERE IDDRUZYNA = (SELECT MAX(IDDRUZYNA) FROM DRUZYNA)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))==false){  
            include('./druzyna.php');
        }

        //MAXID dla SEZON
        $sql = 'SELECT IDSEZON FROM SEZON WHERE IDSEZON= (SELECT MAX(IDSEZON) FROM SEZON)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))==false){  
            include('./sezon.php');
        }

        //MAXID dla DRUZYNA z istniejącymi wierszami
        $sql = 'SELECT IDDRUZYNA FROM DRUZYNA WHERE IDDRUZYNA = (SELECT MAX(IDDRUZYNA) FROM DRUZYNA)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        $row= oci_fetch_row($query);
        $druzynaMAXID=$row[0];     

        //MAXID dla KOLEJKA z istniejacymi wierszami
        $sql = 'SELECT IDKOLEJKA FROM KOLEJKA WHERE IDKOLEJKA= (SELECT MAX(IDKOLEJKA) FROM KOLEJKA)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        $row= oci_fetch_row($query);
        $kolejkaMAXID=$row[0];  
        //MAXID dla SEZON
        $sql = 'SELECT IDSEZON FROM SEZON WHERE IDSEZON= (SELECT MAX(IDSEZON) FROM SEZON)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        $row= oci_fetch_row($query);
        $sezonMAXID=$row[0]; 


        //MAXID dla IDMECZ
        $sql = "SELECT IDMECZ FROM MECZ WHERE IDMECZ= (SELECT MAX(IDMECZ) FROM MECZ)";
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))!=false){  
            $MAXID=$row[0]; 
        }
        else{
                $MAXID=0;     
        }   

        for($i=0 ; $i<$meczCounter; $i++){
         $MAXID++;
         //losowanie wyniku
         $DRUZYNA1_WYNIK =(rand(0, 4));
         $DRUZYNA2_WYNIK =(rand(0, 4));
         //losowanie kolejki
         $KOLEJKA_IDKOLEJKA =(rand(1, $kolejkaMAXID));
         //losowanei druzyn
         $DRUZYNA_IDDRUZYNA1 =(rand(1, $druzynaMAXID));
         $DRUZYNA_IDDRUZYNA2 =(rand(1, $druzynaMAXID));
         while($DRUZYNA_IDDRUZYNA1==$DRUZYNA_IDDRUZYNA2){
        $DRUZYNA_IDDRUZYNA2 =(rand(1, $druzynaMAXID));
         }
         //losowanei sezonu
         $SEZON_IDSEZON=(rand(1, $sezonMAXID));

        $sql = "INSERT INTO MECZ(IDMECZ,DRUZYNA1_WYNIK,DRUZYNA2_WYNIK,KOLEJKA_IDKOLEJKA,DRUZYNA_IDDRUZYNA1,DRUZYNA_IDDRUZYNA2,SEZON_IDSEZON) VALUES 
        (:IDMECZ,:DRUZYNA1_WYNIK,:DRUZYNA2_WYNIK,:KOLEJKA_IDKOLEJKA,:DRUZYNA_IDDRUZYNA1,:DRUZYNA_IDDRUZYNA2,:SEZON_IDSEZON)";
        $query= oci_parse($c, $sql);    
        oci_bind_by_name($query, ':IDMECZ',$MAXID);
        oci_bind_by_name($query, ':DRUZYNA1_WYNIK',$DRUZYNA1_WYNIK);
        oci_bind_by_name($query, ':DRUZYNA2_WYNIK',$DRUZYNA2_WYNIK);
        oci_bind_by_name($query, ':KOLEJKA_IDKOLEJKA',$KOLEJKA_IDKOLEJKA);
        oci_bind_by_name($query, ':DRUZYNA_IDDRUZYNA1',$DRUZYNA_IDDRUZYNA1);
        oci_bind_by_name($query, ':DRUZYNA_IDDRUZYNA2',$DRUZYNA_IDDRUZYNA2);
        oci_bind_by_name($query, ':SEZON_IDSEZON',$SEZON_IDSEZON);   
        oci_execute($query);
         $tablicInsertow[]= "INSERT INTO MECZ(IDMECZ,DRUZYNA1_WYNIK,DRUZYNA2_WYNIK,KOLEJKA_IDKOLEJKA,DRUZYNA_IDDRUZYNA1,DRUZYNA_IDDRUZYNA2,SEZON_IDSEZON) VALUES(".$MAXID.",'".$DRUZYNA1_WYNIK."','".$DRUZYNA2_WYNIK."','".$KOLEJKA_IDKOLEJKA."','".$DRUZYNA_IDDRUZYNA1."','".$DRUZYNA_IDDRUZYNA2."',".$SEZON_IDSEZON.");";
        }
    
?>