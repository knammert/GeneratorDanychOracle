<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./javascript.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 
   <title>Document</title>
    
</head>
<body>
    <div class="container-fluid d-flex mt-2 ">
    <form class="dodajWiersze" method="POST" action=""> 
    <div class="form-group">    
        <label for="tabela">Wybierz Tabelę:</label>
            <select class="form-control" name="tabela" id="tabela" >
	            <option type value="danymeczasysty">danymeczasysty</option>
	            <option value="danymeczczerwonakartka">danymeczczerwonakartka</option>
                <option value="danymeczgole">danymeczgole</option>
                <option value="druzyna">druzyna</option>
                <option value="druzyny_sezony">druzyny_sezony</option>
                <option value="kolejka">kolejka</option>
                <option value="mecz">mecz</option>
                <option value="pozycja">pozycja</option>
                <option value="sezon">sezon</option>
                <option value="transfer">transfer</option>
                <option value="zawodnicy_sezony">zawodnicy_sezony</option>
                <option value="zawodnik">zawodnik</option>
            </select>
        <div>
        <div class="form-group">
            <label for="counter">Ilość wierszy:</label>
            <input class="form-control" type="text" name="counter" id="counter" >
            </div>
            <div class="form-group">
         <input id="dodaj" class="btn btn-primary" type="button" name="dodaj" value="Dodaj">  
    </div>
    </form>
    <h2>
    <div class="alert"></div>
    <h2>
    </div>
</body>
</html>