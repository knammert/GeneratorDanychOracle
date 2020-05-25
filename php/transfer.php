<?php

        $addDate =1;
        //MAXID dla DRUZYNA 
        $sql = 'SELECT IDDRUZYNA FROM DRUZYNA WHERE IDDRUZYNA = (SELECT MAX(IDDRUZYNA) FROM DRUZYNA)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))==false){  
            include('./druzyna.php');
        }
        //MAXID dla ZAWODNIK
        $sql = 'SELECT IDZAWODNIK FROM ZAWODNIK WHERE IDZAWODNIK = (SELECT MAX(IDZAWODNIK) FROM ZAWODNIK)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))==false){  
                include('./zawodnik.php');
        }

        //MAXID dla DRUZYNA z istniejącymi wierszami
        $sql = 'SELECT IDDRUZYNA FROM DRUZYNA WHERE IDDRUZYNA = (SELECT MAX(IDDRUZYNA) FROM DRUZYNA)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        $row= oci_fetch_row($query);
        $druzynaMAXID=$row[0];
        //MAXID dla ZAWODNIK z istniejącymi wierszami
        $sql = 'SELECT IDZAWODNIK FROM ZAWODNIK WHERE IDZAWODNIK = (SELECT MAX(IDZAWODNIK) FROM ZAWODNIK)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        $row= oci_fetch_row($query);
        $zawodnikMAXID=$row[0];    

        //MAXID dla TRANSFER
        $sql = "SELECT IDTRANSFER,to_char(DATATRANSFERU, 'dd-mon-yy hh24:mi:ss' ) FROM TRANSFER WHERE IDTRANSFER = (SELECT MAX(IDTRANSFER) FROM TRANSFER)";
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))!=false){  
                $MAXID=$row[0];
                $DATATRANSFERU = $row[1];
        }
        else{
                $MAXID=0;
                $DATATRANSFERU = date('Y-m-d H:i:s');             
        }   


        for($i=0 ; $i<$transferCounter; $i++){
         $MAXID++;
        
         //Zmiana dat
         $d=strtotime("+$addDate Days");
         $DATATRANSFERU = date('Y-m-d H:i:s',strtotime($DATATRANSFERU."+ $addDate Days"));

        //Losowanie kwoty
        $KWOTA =(rand(1000, 10000));
        //Losowanie druzyn
        $DRUZYNA_IDDRUZYNA =(rand(1, $druzynaMAXID));
        $DRUZYNA_IDDRUZYNA1 =(rand(1, $druzynaMAXID));
        while($DRUZYNA_IDDRUZYNA==$DRUZYNA_IDDRUZYNA1){
            $DRUZYNA_IDDRUZYNA1 =(rand(1, $druzynaMAXID));
        }
        //Losowanie zawodnika
        $ZAWODNIK_IDZAWODNIK =(rand(1, $zawodnikMAXID));

        $sql = "INSERT INTO TRANSFER(IDTRANSFER,KWOTA,DRUZYNA_IDDRUZYNA,DRUZYNA_IDDRUZYNA1,ZAWODNIK_IDZAWODNIK,DATATRANSFERU) VALUES 
        (:IDTRANSFER,:KWOTA,:DRUZYNA_IDDRUZYNA,:DRUZYNA_IDDRUZYNA1,:ZAWODNIK_IDZAWODNIK,to_date(:DATATRANSFERU1,'yyyy/mm/dd hh24:mi:ss'))";
        $query= oci_parse($c, $sql);    
        oci_bind_by_name($query, ':IDTRANSFER',$MAXID);
        oci_bind_by_name($query, ':DATATRANSFERU1',$DATATRANSFERU);
        oci_bind_by_name($query, ':KWOTA',$KWOTA);
        oci_bind_by_name($query, ':DRUZYNA_IDDRUZYNA',$DRUZYNA_IDDRUZYNA);
        oci_bind_by_name($query, ':DRUZYNA_IDDRUZYNA1',$DRUZYNA_IDDRUZYNA1);
        oci_bind_by_name($query, ':ZAWODNIK_IDZAWODNIK',$ZAWODNIK_IDZAWODNIK);
        oci_execute($query);

        $tablicInsertow[]= "INSERT INTO TRANSFER(IDTRANSFER,KWOTA,DRUZYNA_IDDRUZYNA,DRUZYNA_IDDRUZYNA1,ZAWODNIK_IDZAWODNIK,DATATRANSFERU) VALUES(".$MAXID.",'".$DATATRANSFERU."','".$KWOTA."','".$DRUZYNA_IDDRUZYNA."','".$DRUZYNA_IDDRUZYNA1."',".$ZAWODNIK_IDZAWODNIK.");";

        }
    
?>