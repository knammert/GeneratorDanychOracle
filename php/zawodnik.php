<?php 

        //MAXID dla DRUZYNA
        $sql = 'SELECT IDDRUZYNA FROM DRUZYNA WHERE IDDRUZYNA = (SELECT MAX(IDDRUZYNA) FROM DRUZYNA)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))!=false){  
                $druzynaMAXID=$row[0];
        }
        else{
            include('./druzyna.php');
        }
        //MAXID dla POZYCJA
        $sql = 'SELECT IDPOZYCJA FROM POZYCJA WHERE IDPOZYCJA= (SELECT MAX(IDPOZYCJA) FROM POZYCJA)';
        $query= oci_parse($c, $sql);
        oci_execute($query);
        if(($row= oci_fetch_row($query))!=false){  
                $pozycjaMAXID = $row[0];
        }
        else{
            include('./pozycja.php');
         }

         //MAXID dla DRUZYNA z istneijacymi wierszami
         $sql = 'SELECT IDDRUZYNA FROM DRUZYNA WHERE IDDRUZYNA = (SELECT MAX(IDDRUZYNA) FROM DRUZYNA)';
         $query= oci_parse($c, $sql);
         oci_execute($query);
         $row= oci_fetch_row($query);
         $druzynaMAXID=$row[0];
         //MAXID dla POZYCJA istneijacymi wierszami
         $sql = 'SELECT IDPOZYCJA FROM POZYCJA WHERE IDPOZYCJA= (SELECT MAX(IDPOZYCJA) FROM POZYCJA)';
         $query= oci_parse($c, $sql);
         oci_execute($query);
         $row= oci_fetch_row($query);
         $pozycjaMAXID = $row[0];

         //MAXID dla ZAWODNIK
         $sql = 'SELECT IDZAWODNIK,NR_LEGITYMACJI FROM ZAWODNIK WHERE IDZAWODNIK = (SELECT MAX(IDZAWODNIK) FROM ZAWODNIK)';
         $query= oci_parse($c, $sql);
         oci_execute($query);
         if(($row= oci_fetch_row($query))!=false){  
                 $MAXID=$row[0];
                 $nr_legitymacji=$row[1];
         }
         else{
             $nr_legitymacji=10000000;
                 $MAXID=0;
         }
    
         //dodawanie rekrdów
        for($i=0 ; $i<$zawodnikCounter; $i++){
                $MAXID++;
                $nr_legitymacji++;
        //rekord imie
        $plik = file("./ZAWODNIKimie.txt");
        $linia = $plik[rand(0,count($plik)- 1)];
        $imie = $linia;
        //rekord nazwisko
        $plik = file("./ZAWODNIKnazwisko.txt");
        $linia = $plik[rand(0,count($plik)- 1)];
        $nazwisko = $linia;

        $imie=trim($imie);
        $nazwisko=trim($nazwisko);

        //rekord gole
        $gole =(rand(1, 10));
        //rekord asysty
        $asysty =(rand(1, 20));
        //rekord czerwonekartki
        $czerwonekartki =(rand(1, 3));
        //rekord druzyna_iddruzyna
        
        $DRUZYNA_IDDRUZYNA =(rand(1, $druzynaMAXID));
        //rekord pozycja_idpozycja
        $POZYCJA_IDPOZCYJA =(rand(1, $pozycjaMAXID));

        $sql = 'INSERT INTO ZAWODNIK(IDZAWODNIK,NR_LEGITYMACJI,IMIE,NAZWISKO,GOLE,ASYSTY,CZERWONEKARTKI,DRUZYNA_IDDRUZYNA,POZYCJA_IDPOZYCJA) VALUES (:IDZAWODNIK,:NR_LEGITYMACJI,:IMIE,
        :NAZWISKO,:GOLE,:ASYSTY,:CZERWONEKARTKI,:DRUZYNA_IDDRUZYNA,:POZYCJA_IDPOZYCJA)';
        $query= oci_parse($c, $sql);    
        oci_bind_by_name($query, ':IDZAWODNIK',$MAXID);
        oci_bind_by_name($query, ':NR_LEGITYMACJI',$nr_legitymacji);
        oci_bind_by_name($query, ':IMIE',$imie);
        oci_bind_by_name($query, ':NAZWISKO',$nazwisko);
        oci_bind_by_name($query, ':GOLE',$gole);
        oci_bind_by_name($query, ':ASYSTY',$asysty);
        oci_bind_by_name($query, ':CZERWONEKARTKI',$czerwonekartki);
        oci_bind_by_name($query, ':DRUZYNA_IDDRUZYNA',$DRUZYNA_IDDRUZYNA);
        oci_bind_by_name($query, ':POZYCJA_IDPOZYCJA',$POZYCJA_IDPOZCYJA );
        oci_execute($query);
        //dodawanie do pliku txt

        $tablicInsertow[]= "INSERT INTO ZAWODNIK (IDZAWODNIK,NR_LEGITYMACJI,IMIE,NAZWISKO,GOLE,ASYSTY,CZERWONEKARTKI,DRUZYNA_IDDRUZYNA,POZYCJA_IDPOZYCJA) VALUES(".$MAXID.",'".$nr_legitymacji."','".$imie."','".$nazwisko."','".$gole."','".$asysty."','".$czerwonekartki."','".$DRUZYNA_IDDRUZYNA."',".$POZYCJA_IDPOZCYJA.");";
         }
        

        
?>