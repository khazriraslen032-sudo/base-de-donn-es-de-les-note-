function  valid() {
    x=document.getElementById("c").value
    if (x.length!=8) {
        alert("Erurre")
        return false
    }
}

function motpss() {
    x=document.getElementsByName("q").value
    x1=document.getElementById("s").checked
    if (x=="" && x1==false ) {
        alert("Erurre")
        return false
    }
    return confirm(" Êtes-vous sûr de vouloir supprimer les données  ")


}
function affich() {
    x=document.getElementById("an").value
    document.getElementById("f").src=String(x)+"eme.php"
}

