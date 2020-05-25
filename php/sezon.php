<?php        
        $j=1;

        $sql = 'SELECT IDSEZON,NAZWSEZON FROM SEZON WHERE IDSEZON= (SELECT MAX(IDSEZON) FROM SEZON)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))!=false){  

        }
        else{
            $MAXID = 1;
            $NAZWSEZON = "Sezon 2019/2020";
            $sezonCounter--;
            $MAXID=1;

            $sql = 'INSERT INTO SEZON(IDSEZON,NAZWSEZON) VALUES (:IDSEZON,:NAZWSEZON)';
            $query= oci_parse($c, $sql);    
            oci_bind_by_name($query, ':IDSEZON',$MAXID);
            oci_bind_by_name($query, ':NAZWSEZON',$NAZWSEZON);
            oci_execute($query);              
        }


        $sql = 'SELECT IDSEZON,NAZWSEZON FROM SEZON WHERE IDSEZON= (SELECT MAX(IDSEZON) FROM SEZON)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        $row= oci_fetch_row($query);
        $MAXID = $row[0];
        $maxNazwSezon = $row[1];
        $maxNazwSezon = (int)substr($maxNazwSezon, -4);
        
        $k=0;

        for($i=0 ; $i<$sezonCounter; $i++){
            $MAXID++;
 
            $maxNazwSezon=$maxNazwSezon+1; 
            $maxNazwSezon2=$maxNazwSezon;
            $maxNazwSezon2=$maxNazwSezon2+1;


             $NAZWSEZON = "Sezon $maxNazwSezon/$maxNazwSezon2";  
      
            $sql = 'INSERT INTO SEZON(IDSEZON,NAZWSEZON) VALUES (:IDSEZON,:NAZWSEZON)';
            $query= oci_parse($c, $sql);    
            oci_bind_by_name($query, ':IDSEZON',$MAXID);
            oci_bind_by_name($query, ':NAZWSEZON',$NAZWSEZON);
            oci_execute($query);
            $tablicInsertow[]= "INSERT INTO SEZON(IDSEZON,NAZWSEZON) VALUES(".$MAXID.",".$NAZWSEZON.");";
         }
        

?>