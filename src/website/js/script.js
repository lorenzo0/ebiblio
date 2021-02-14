/* INIZIO registrationPage.php*/
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
        case "Cartaceo":
            document.getElementById("cartaceoGroup").style.display = 'block';
            document.getElementById("ebookGroup").style.display = 'none';
            break;
        case "Ebook":
            document.getElementById("cartaceoGroup").style.display = 'none';
            document.getElementById("ebookGroup").style.display = 'block';
            break;
        case "Entrambi":
            document.getElementById("cartaceoGroup").style.display = 'block';
            document.getElementById("ebookGroup").style.display = 'block';
            break;
        case "None" || '':
            document.getElementById("cartaceoGroup").style.display = 'none';
            document.getElementById("ebookGroup").style.display = 'none';
            break;
    }
}


function validateFormLibro(){

    var x = document.getElementById("tipoLibro").value;

    if(x == 'Cartaceo'){
        if(document.getElementById("statoConservazione").value == 'none' ||
            document.getElementById("numeroPagine").value == '' ||
            document.getElementById("numeroScaffale").value == '' )
            alert("Non sono stati inseriti tutti i campi necessari.");
        else
            return true;
    }else if(x == 'Ebook'){
        if(document.getElementById("pdf").files.length == 0)
            alert("Non sono stati inseriti tutti i campi necessari.");
        else
            return true;
    }
    else if(x == 'Entrambi'){
        if(document.getElementById("statoConservazione").value == 'none' ||
            document.getElementById("numeroPagine").value == '' ||
            document.getElementById("numeroScaffale").value == '' ||
            document.getElementById("pdf").files.length == 0)
            alert("Non sono stati inseriti tutti i campi necessari.");
        else
            return true;
    }else if(x == 'None')
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


/* INIZIO gestione visualizzazione detagliLibro.php */

function setVisibleLibroDetails(){
    var x = $_GET['Tipo'];

    switch(x){
        case "Cartaceo":
            document.getElementById("cartaceoGroup").style.display = 'block';
            document.getElementById("ebookGroup").style.display = 'none';
            break;
        case "Ebook":
            document.getElementById("cartaceoGroup").style.display = 'none';
            document.getElementById("ebookGroup").style.display = 'block';
            break;
        case "Entrambi":
            document.getElementById("cartaceoGroup").style.display = 'block';
            document.getElementById("ebookGroup").style.display = 'block';
            break;
    }
}

/* FINE gestione visualizzazione detagliLibro.php */
