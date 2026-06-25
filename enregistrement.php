<?php
$con=mysqli_connect("localhost","root","","projet") or die("errure");
if (isset($_POST["moy"])) {
    $n=$_POST["n"];
    $p=$_POST["p"];
    $c=$_POST["c"];
    $g=$_POST["g"];
    $m=$_POST["moy"];
    $a=$_POST["a"];
    $req="INSERT INTO etudiant  VALUES ('$c','$n','$p','$g',$m,'$a')";
    $res=mysqli_query($con,$req);
    for ($i=0; $i <$_POST["nb"] ; $i++) { 
        $rs=$_POST["res$i"];
        $nom=$_POST["nom$i"];
        $req="insert into matier (`idm`, `nomM`, `moy`, `cin`) values('','$nom',$rs,'$c')";
        $res=mysqli_query($con,$req);
    }
    echo"
        <script > alert('le donner de etudiant $n est enregister')
            window.location.href = 'enregistrement.html';</script>";
        exit(); 
    }
else if(isset($_POST['c']) ) {

    $c=$_POST['c'];
    $req="select * from etudiant WHERE cin='$c'";
    $res=mysqli_query($con,$req);

    if (mysqli_num_rows($res) > 0) {
      echo "<script>alert('le donner de etudiant $c est déjà enregister');
    window.location.href = 'enregistrement.html';</script>";
        exit();}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         td
         {
            padding:10px ;
         }
                  .d{
            margin-top: 10px;
            float: right;
            margin-right: 5%;
        }
         .d input{
            background-color: black;
            color: rgb(253, 215, 0);
            border: black 4px solid;
            border-radius: 8%;
            width: 100px;
        
         }
 
         #r{
            margin-top: 5px;
            margin-left:53.5%;
         }
         .x{
            color: purple;
            font-size:large;
            font-weight: bold;
         }
         .k{
            font-weight: bold;
            color: purple;
            font-size: large;
            border:none;
         }
         #g{
            width: 180px;
         }
         fieldset{
            border: 2px solid black;
            margin-bottom: 20px;
         }
        #ff tr td input{
            border:none;
        }
</style>
<script>
   function calculer() {

     rs =document.getElementsByClassName("rs");
     coeffs =document.getElementsByName("coff");

     nb =parseFloat(document.getElementById('nb').value);
     j =parseFloat(document.getElementById('j').value);

     or =document.getElementsByName("or");
     ds =document.getElementsByName("ds");
     ex =document.getElementsByName("ex");

     ind =0; 
    for ( i= 0; i < j; i++) {
         d10 =parseFloat(or[i].value);
         d20 =parseFloat(ds[i].value);
         d70 =parseFloat(ex[i].value);
         r=d10*0.1+d20*0.2+d70*0.7;
        rs[ind].value=r
        ind++;
    }
    for ( i = j; i<nb; i++) {
         d20=parseFloat(ds[i].value);
         d80=parseFloat(ex[i].value);
         r=d20*0.2+d80*0.8;
        rs[ind].value=r
        ind++;
    }
     s=0;
     scoeff =0;
    for ( i=0; i< nb; i++) {
        s +=parseFloat(rs[i].value)*parseFloat(coeffs[i].value);
        scoeff +=parseFloat(coeffs[i].value);
    }
    moy =(s/scoeff).toFixed(3);
    document.getElementById("rt").value=moy;
}
function valid(i,w) {
    switch (i) {
        case 1: id='or';
            
            break;
        case 2:id='ds';
            
            break;
        case 3: id='ex';
            
            break;
    
        default:
            break;
    }
    let x=document.getElementsByName(id)[w].value
    if (!(parseFloat(x)<=20 &&(('0'<=x[x.length-1] && '9'>=x[x.length-1]) || x[x.length-1]=='.'))) {
        document.getElementsByName(id)[w].value=x.substring(0,x.length-1)
    }
    
}
</script>
</head>
<body>
    <form action="" method="post">
    <fieldset>
<table id="ff">
<?php
$or='or';
$ex='ex';
$ds='ds';
$con=mysqli_connect("localhost","root","","projet") or die("errure");
$c=$_POST['c'];
$n=$_POST['n'];
$p=$_POST['p'];
$g=$_POST['g'];
$a=$_POST['a'];
echo "
<tr>
    <td class='x'>cin</td>
    <td><input type='text' name='c'  readonly id='c' value='{$c}'></td>
</tr>

<tr>
<td class='x'>nom</td>
<td><input type='text' name='n' readonly value='{$n}'></td>
</tr>

<tr>
<td class='x'>prenom</td>
<td><input type='text' name='p'  readonly value='{$p}'></td>
</tr>

<tr>
<td class='x'>groupe</td>
<td><input type='text' name='g'  readonly value='{$g}'></td>
</tr>

<tr>
<td class='x'>anne</td>
<td><input type='text' name='a'  readonly value='{$a}'></td>
</tr>
";

?>
</table>
</fieldset>
<fieldset>
    
    <table> 
        <tr class="k">
            <td></td>
            <td>devoir 10%</td>
            <td>devoir 20%</td>
            <td>devoir 70%</td>
            <td>resulta total</td>
        </tr>
        
        <?php
        $req="select nomMat , coeff from matieres  where anne='$a' and type='p' ";
        $res=mysqli_query($con,$req);
        $i=0;
        while ($t=mysqli_fetch_row($res)) {
            $size=strlen($t[0]);
            echo "
            <tr>
            <td class='x'>
            <input class='k'  type='text' size='{$size}' readonly name='nom$i' value='{$t[0]}'>
            </td>
            <td><input type='text' required  oninput='valid(1,$i)' name='or'></td>      
            <td><input type='text' required  oninput='valid(2,$i)' name='ds'></td>
            <td><input type='text' required  oninput='valid(3,$i)' name='ex'></td>      
            <td><input type='text' readonly  name='res$i' class='rs'></td>
            </tr>
            <input type='hidden'  name='coff' value='{$t[1]}'>
            ";
            $i++;
        }
        echo "                  
        </table>
        <input type='hidden'  id='j' value='{$i}'>";
        
        ?>
            <table>
                <tr class="k">
                    <td></td>  
                    <td>devoir 20%</td>
                    <td>devoir 80%</td>
                    <td>resulta total</td>
                </tr>
                <?php
$con=mysqli_connect("localhost","root","","projet") or die("errure");
$req="select nomMat ,coeff from matieres  where anne='$a' and type='s' ";
$res=mysqli_query($con,$req);

while ($t=mysqli_fetch_row($res)) {
    
    $size=strlen($t[0]);
    echo "
    <tr>
    <td class='x'>
    <input class='k'  type='text' size='{$size}' readonly name='nom$i' value='{$t[0]}'>
    </td>
    <td><input type='text' oninput='valid(2,$i)' required name='ds'></td>
    <td><input type='text' oninput='valid(3,$i)' required name='ex'></td>
    <td><input type='text' readonly name='res$i' class='rs'></td>
    </tr>
    <input type='hidden'  name='coff' value='{$t[1]}'>
    ";
    $i++;
    
}
?>
<input type="hidden" name="nb" id="nb" value="<?php echo $i; ?>">   
</table>

<div  id="r"  >resulta=<input type="text" name="moy" id="rt" required   ></div><br>
    <div class="d">
        <input type="button" value="calculer" onclick="calculer()">
        <input type="submit" value="enregistrer">
    </div>
</fieldset>


</body>
</html>
    <?php
    $con=mysqli_connect("localhost","root","","projet") or die("errure");

    ?>