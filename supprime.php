<?php
$con = mysqli_connect("localhost", "root", "", "projet") or die("erreur");
if (isset($_POST["s"])) {
    $req = "DELETE FROM etudiant";
    $res = mysqli_query($con, $req);
    if ($res) {
            echo "<script>
    alert('Les données de l université sont supprimées');
   window.location.href = 'enregistrement.html';</script>";
   exit();
    }
}
else {

    $cin = $_POST["q"];
    $req = "DELETE FROM etudiant WHERE cin='$cin'";
    $res = mysqli_query($con, $req);
    if ($res) {
    echo "<script >
    alert('Les données de l étudiant avec le CIN $cin sont supprimées');
   window.location.href = 'enregistrement.html';</script>";
   exit();
    }
}

mysqli_close($con);
?>
