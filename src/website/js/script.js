function setVisibleForUser(){
    document.getElementById("utilizzatoreGroup").style.display = 'none';
    document.getElementById("volontarioGroup").style.display = 'none';
    document.getElementById("amministratoreGroup").style.display = 'none';

    var x = document.getElementById("tipoUtente").value;

    switch(x){
        case "utilizzatore":
            document.getElementById("biblioteca").style.display = 'none';
            document.getElementById("utilizzatoreGroup").style.display = 'block';
            break;
        case "volontario":
            document.getElementById("volontarioGroup").style.display = 'block';
            document.getElementById("biblioteca").style.display = 'block';
            break;
        case "amministratore":
            document.getElementById("amministratoreGroup").style.display = 'block';
            document.getElementById("biblioteca").style.display = 'block';
            break;
    }

}

function validateForm(){

    var x = document.getElementById("tipoUtente").value;

    if(x == 'utilizzatore'){
        if(document.getElementById("professione").value == '')
            alert("E' necessario inserire una professione");
        else
            return true;
    }else if(x == 'volontario'){
        if(document.getElementById("mezzoDiTrasporto").value == '')
            alert("E' necessario inserire un mezzo di trasporto");
        else
            return true;
    }
    else if(x == 'amministratore'){
        if(document.getElementById("qualifica").value == '')
            alert("E' necessario inserire una qualifica");
        else
            return true;
    }

    return false;

}