/* INIZIO registrationPage.php*/
function setVisibleForUser(){
    
    var x = document.getElementById("tipoUtente").value;

    switch(x){
        case "Utilizzatore":
            document.getElementById("utilizzatoreGroup").style.display = 'block';
            document.getElementById("volontarioGroup").style.display = 'none';
            document.getElementById("amministratoreGroup").style.display = 'none';
            break;
        case "Volontario":
            document.getElementById("volontarioGroup").style.display = 'block';
            document.getElementById("utilizzatoreGroup").style.display = 'none';
            document.getElementById("amministratoreGroup").style.display = 'none';
            break;
        case "Amministratore":
            document.getElementById("amministratoreGroup").style.display = 'block';
            document.getElementById("utilizzatoreGroup").style.display = 'none';
            document.getElementById("volontarioGroup").style.display = 'none';
            break;
        case "none":
            document.getElementById("utilizzatoreGroup").style.display = 'none';
            document.getElementById("volontarioGroup").style.display = 'none';
            document.getElementById("amministratoreGroup").style.display = 'none';
            break;
    }

}


function onLoadRegistrazione(){
    document.getElementById("utilizzatoreGroup").style.display = 'none';
    document.getElementById("volontarioGroup").style.display = 'none';
    document.getElementById("amministratoreGroup").style.display = 'none';
}


function validateFormRegistrazione(){

    var x = document.getElementById("tipoUtente").value;

    if(x == 'Utilizzatore'){
        if(document.getElementById("professione").value == '')
            alert("E' necessario inserire una professione");
        else
            return true;
    }else if(x == 'Volontario'){
        if(document.getElementById("mezzoDiTrasporto").value == '')
            alert("E' necessario inserire un mezzo di trasporto");
        else
            return true;
    }
    else if(x == 'Amministratore'){
        if(document.getElementById("qualifica").value == '')
            alert("E' necessario inserire una qualifica");
        else
            return true;
    }else if(x == 'none')
        alert("Non è stato selezionato il tipo di utente!");

    return false;
}
/* FINE registrationPage.php*/


/* INIZIO inserimentoLibro.php*/
function setVisibleForLibro(){
    var x = document.getElementById("tipoLibro").value;

    switch(x){
        case "cartaceo":
            document.getElementById("cartaceoGroup").style.display = 'block';
            document.getElementById("ebookGroup").style.display = 'none';
            break;
        case "ebook":
            document.getElementById("cartaceoGroup").style.display = 'none';
            document.getElementById("ebookGroup").style.display = 'block';
            break;
        case "entrambi":
            document.getElementById("cartaceoGroup").style.display = 'block';
            document.getElementById("ebookGroup").style.display = 'block';
            break;
        case "none":
            document.getElementById("cartaceoGroup").style.display = 'none';
            document.getElementById("ebookGroup").style.display = 'none';
            break;
    }
}


function validateFormLibro(){

    var x = document.getElementById("tipoLibro").value;

    if(x == 'cartaceo'){
        if(document.getElementById("statoConservazione").value == '' ||
            document.getElementById("numeroPagine").value == '' ||
            document.getElementById("numeroScaffale").value == '' )
            alert("Non sono stati inseriti tutti i campi necessari.");
        else
            return true;
    }else if(x == 'ebook'){
        if(document.getElementById("pdf").files.length == 0)
            alert("Non sono stati inseriti tutti i campi necessari.");
        else
            return true;
    }
    else if(x == 'entrambi'){
        if(document.getElementById("statoConservazione").value == '' ||
            document.getElementById("numeroPagine").value == '' ||
            document.getElementById("numeroScaffale").value == '' ||
            document.getElementById("pdf").files.length == 0)
            alert("Non sono stati inseriti tutti i campi necessari.");
        else
            return true;
    }else if(x == 'none')
        alert("Che tipo di libro vuoi inserire? Cartaceo oppure Ebook?");
    
    
    return false;
}

/* FINE inserimentoLibro.php*/

/* INIZIO gestione aggiunta navbar e footer in ogni pagina*/

$(function loadNavFoo(){
  $("#header").load("../utils/navbar.html"); 
  $("#footer").load("../utils/footer.html"); 
});

/* FINE gestione aggiunta navbar e footer in ogni pagina*/
