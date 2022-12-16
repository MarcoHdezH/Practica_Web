<?php
header("Content-type:text/json");

$serv = "localhost";
$user= "root";
$pass="";
$db="buap1";

$conn = new mysqli($serv,$user,$pass,$db);

function mostrar($conn)
{
    $sql= "select * from usuario order by id";
    $aux=0;
    echo "{";
    $result = $conn->query($sql);
    if($result->num_rows>0)
    {
        echo '"usuarios":[';
        while($row=$result->fetch_assoc())
        {
            $aux++;
            if($aux==1)
            {
                echo"{";
                echo'"id":"'.$row["id"].'",';
                echo '"nom":"'.$row["nom"].'"';
                echo "}"; 

            }
            else
            {
                echo",{";
                    echo'"id":"'.$row["id"].'",';
                    echo'"nom":"'.$row["nom"].'"';
                    echo"}";
            }
        }
        echo ']';
    }
    echo"}";
}

function maximo($conn)
{
    $max = 0;
    $sql = "select max(id) maximo from usuario";

    $result = $conn->query($sql);

    if($result->num_rows>0)
    {
        while($row = $result->fetch_assoc())
        {
            $max = $row["maximo"];
        }
    }
    $max = $max+1;
    return $max;

}

function insertar($conn,$id,$nom)
{
    $sql = "insert into usuario(id,nom) values('".$id."','".$nom."')";
    $result = $conn ->query($sql);
}

function eliminar($conn,$id)
{
    $sql = "delete from usuario where id ='".$id."'";
    $result = $conn->query($sql);
}

function modificar($conn,$id,$nom)
{
    $sql = "update usuario set nom = '" .$nom . "' where id = '" . $id . "'";
    $result = $conn->query($sql);

}

$tipo = isset($_GET["tipo"])?$_GET["tipo"]:"1";

if($tipo==1)
{
    mostrar($conn);
}
else if($tipo==2)
{
    $nom = isset($_GET['nom'])?$_GET['nom']:"";
    if($nom!="")
    {
        insertar($conn,maximo($conn),$nom);
    }
    mostrar($conn);
}
else if($tipo==3)
{
    $id = isset($_GET['id'])?$_GET['id']:"";
    eliminar($conn,$id);
    mostrar($conn);
}
else if($tipo==4)
{
    $id = isset($_GET['id'])?$_GET['id']:"";
    $nom = isset($_GET['nom'])?$_GET['nom']:"";

    if($id != "" || $nom != "")
    {
        modificar($conn,$id,$nom);
    }
    mostrar($conn);
}
?>