<?php
function xx($gr,$a,$con){
    $req="select nomM ,AVG(moy) as moyt from matier M, etudiant E  where    E.cin=M.cin and anne='$a' and groupe='{$gr}'   group by nomM    ORDER BY moyt aSC LIMIT 1";
    $res=mysqli_query($con,$req);
    $t=mysqli_fetch_row($res);
    $req="select nomM ,AVG(moy) as moyt from matier M, etudiant E  where    E.cin=M.cin and anne='$a' and groupe='{$gr}' group by nomM    ORDER BY moyt DESC LIMIT 1";
    $res=mysqli_query($con,$req);
    $t1=mysqli_fetch_row($res);
    $z= round($t1[1],2);
    $w=round($t[1],2);
    echo "</table>
    <h2> La matière avec les haut notes  à la groupe $gr :  $t1[0] de moyenne $z </h2><br>
    <h2> La matière avec les basses notes  à la groupe $gr :  $t[0] de moyenne $w  </h2>";
    
}    
$con=mysqli_connect("localhost","root","","projet") or die("errure");
$a=$_POST["a"];
$req="select nom , prenom , moyenne from etudiant where anne='$a'  ORDER BY moyenne DESC LIMIT 10";
$res=mysqli_query($con,$req);
echo" 
    <style>
        tr,th{
            width: 100px;
            height: 30px;
            font-weight: bold;
            font-size: large;
            
            }
            #i{
                width: 5%;
             
            }    
table            
{
    margin: auto;
    width: 70%;
     text-align: center;
;     
}
    </style>
     <table border='3px'>
        <tr>
            <th>N°</th>
            <th>nom</th>
            <th>prenom</th>
            <th>moyenne</th>
        </tr>";    
$i=1;        
while($t=mysqli_fetch_row($res)) {
    echo "<tr>
            <td id='i' >$i</td>
            <td> $t[0] </td>
            <td> $t[1] </td>
            <td> $t[2] </td>
        </tr>";    
    $i=$i+1;    
    
}    
$req="select nomM ,AVG(moy) as moyt from matier M, etudiant E  where    E.cin=M.cin and anne='$a'   group by nomM    ORDER BY moyt aSC LIMIT 1";
$res=mysqli_query($con,$req);
$t=mysqli_fetch_row($res);
$req="select nomM ,AVG(moy) as moyt from matier M, etudiant E  where    E.cin=M.cin and anne='$a' group by nomM    ORDER BY moyt DESC LIMIT 1";
$res=mysqli_query($con,$req);
$t1=mysqli_fetch_row($res);
$z= round($t1[1],2);
$w=round($t[1],2);
echo "</table>
<h2> La matière avec les haut notes  à l'université :  $t1[0] de moyenne $z </h2><br>
<h2> La matière avec les basses notes  à l'université :  $t[0] de moyenne $w  </h2>";

$req = "SELECT DISTINCT groupe FROM etudiant where anne='$a' ORDER BY groupe";
$res = mysqli_query($con, $req);
while ($t1=mysqli_fetch_row($res)){ 
echo "<h1>$t1[0]</h1>";
echo"<h2>liste de note</h2>
     <table border='3px'>
        <tr>
            <th >N°</th>
            <th>cin</th>
            <th>nom</th>
            <th>prenom</th>
            <th>moyenne</th>
        </tr>";
$i=1;
$g=$t1[0];
$req1="select cin ,nom , prenom , moyenne from etudiant  where anne='$a' and groupe='{$g}'  ORDER BY moyenne desc ";
$res1=mysqli_query($con,$req1);
while ($t=mysqli_fetch_row($res1)) {
    echo "<tr>
            <td id='i'>$i</td>
            <td> $t[0] </td>
            <td> $t[1] </td>
            <td> $t[2] </td>
            <td> $t[3] </td>
            </tr>";
        $i=$i+1;
    }
    echo"</table>";
    xx($t1[0],$a,$con);
}
   
?>