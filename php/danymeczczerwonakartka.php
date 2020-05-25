<?php 
        $addDate=1;
        //MAXID dla MECZ
        $sql = 'SELECT IDMECZ FROM MECZ WHERE IDMECZ = (SELECT MAX(IDMECZ) FROM ZAWODNIK)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))==false){ 
            include('./mecz.php');              
        }
        //MAXID dla ZAWODNIK
        $sql = 'SELECT IDZAWODNIK FROM ZAWODNIK WHERE IDZAWODNIK = (SELECT MAX(IDZAWODNIK) FROM ZAWODNIK)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))==false){ 
            include('./zawodnik.php');              
        }

         //MAXID dla MECZ z istneijacymi wierszami
         $sql = 'SELECT IDMECZ FROM MECZ WHERE IDMECZ = (SELECT MAX(IDMECZ) FROM MECZ)';
         $query= oci_parse($c, $sql);
         oci_execute($query);
         $row= oci_fetch_row($query);
         $meczMAXID=$row[0];
         //MAXID dla ZAWODNIK istneijacymi wierszami
         $sql = 'SELECT IDZAWODNIK FROM ZAWODNIK WHERE IDZAWODNIK = (SELECT MAX(IDZAWODNIK) FROM ZAWODNIK)';
         $query= oci_parse($c, $sql);
         oci_execute($query);
         $row= oci_fetch_row($query);
         $zawodnikMAXID = $row[0];

         //MAXID dla DANYMECZCZERWONEKARTKI
         $sql = "SELECT IDCZERWONAKARTKA,to_char(DATA, 'dd-mon-yy hh24:mi:ss' ) FROM DANYMECZCZERWONAKARTKA WHERE IDCZERWONAKARTKA  = (SELECT MAX(IDCZERWONAKARTKA) FROM DANYMECZCZERWONAKARTKA)";
         $query= oci_parse($c, $sql);
         oci_execute($query);
         if(($row= oci_fetch_row($query))!=false){  
                 $MAXID=$row[0];
                 $DATA = $row[1];
         }
         else{
                 $MAXID=0;
                 $DATA = date('Y-m-d H:i:s');  
         }
    
         //dodawanie rekrdów
        for($i=0 ; $i<$danymeczczerwonakartkaCounter; $i++){
            $MAXID++;
            //Zmiana daty
            $d=strtotime("+$addDate Days");
            $DATA = date('Y-m-d H:i:s',strtotime($DATA."+ $addDate Days"));
            //Losowanie meczu
            $MECZ_IDMECZ =(rand(1, $meczMAXID));
            //Losowanie zawodnika
          $ZAWODNIK_IDZAWODNIK =(rand(1, $zawodnikMAXID));

 

        $sql ="INSERT INTO DANYMECZCZERWONAKARTKA(IDCZERWONAKARTKA,DATA,MECZ_IDMECZ,ZAWODNIK_IDZAWODNIK) VALUES
         (:IDCZERWONAKARTKA,to_date(:DATA,'yyyy/mm/dd hh24:mi:ss'),:MECZ_IDMECZ,:ZAWODNIK_IDZAWODNIK)";
        $query= oci_parse($c, $sql);    
        oci_bind_by_name($query, ':IDCZERWONAKARTKA',$MAXID);
        oci_bind_by_name($query, ':DATA',$DATA);
        oci_bind_by_name($query, ':MECZ_IDMECZ',$MECZ_IDMECZ);
        oci_bind_by_name($query, ':ZAWODNIK_IDZAWODNIK',$ZAWODNIK_IDZAWODNIK);
        oci_execute($query);
        
        $tablicInsertow[]= "INSERT INTO DANYMECZCZERWONAKARTKA(IDCZERWONAKARTKA,DATA,MECZ_IDMECZ,ZAWODNIK_IDZAWODNIK) VALUES (".$MAXID.",'".$DATA."','".$MECZ_IDMECZ."',".$ZAWODNIK_IDZAWODNIK.");";
         }
   
?>