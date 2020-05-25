$(document).ready(function() { 

    $("#dodaj").click(function() {

        
        $(".alert-success").html("");
        $(".alert-danger").html("");
        $(".alert").removeClass("alert-success");
        $(".alert").removeClass("alert-danger");
        $(".alert").html('');
        $(".alert").fadeIn();   
        var request;
        var data = $(".dodajWiersze").serialize();

        request = $.ajax({
            url: "./php/php.php",     
            data: data,     
            type: "POST"
        });
        console.log(request);
        request.done(function(response) {
            if(response == "Pomyślnie dodano"){
                $(".alert").addClass("alert-success");
                $(".alert-success").html(response);
                $(".alert-success").fadeOut(6000);            
            }
            else{
                $(".alert").addClass("alert-dannger");
                $(".alert-success").html("Coś poszło nie tak");
                $(".alert-success").fadeOut(6000);     
            }
        });

        request.fail(function(response) {
            $(".alert").addClass("alert-danger");
            $(".alert-danger").html("Coś poszło nie tak");
            $(".alert-danger").fadeOut(5000);       
        });       
    });
    
});