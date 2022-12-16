<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="btn-group">
                    <button class="btn btn-primary" type="button" onclick="crear()">Crear Usuario</button>
                    <button class="btn btn-primary" type="button" onclick="modificar()">Modificar Usuario</button>
                    <button class="btn btn-primary" type="button" onclick="eliminar()">Eliminar Usuario</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" id="tabla">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ejemplo</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Ejemplo</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Crear -->
    <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearLabel">Crear Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">Nombre:</div>
                        <div class="col-12"><input type="text" class="form-control" id="nomCrear"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="crearClick()">Crear</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Modificar -->
    <div class="modal fade" id="modalModificar" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearLabel">Modificar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">ID:</div>
                        <div class="col-12"><input type="text" class="form-control" id="idMod"></div>
                    </div>
                    <div class="row">
                        <div class="col-12">Nombre:</div>
                        <div class="col-12"><input type="text" class="form-control" id="nomMod"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="modificarClick()">Modificar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearLabel">Eliminar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">ID:</div>
                        <div class="col-12"><input type="text" class="form-control" id="idEli"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="eliminarClick()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        function crear()
        {
            $("#modalCrear").modal("show");

        }
        function crearClick()
        {
            var data = $("#nomCrear").val();
            var url = "http://localhost/xmlOto/jsonPHP/?tipo=2&nom="+data+"&r="+Math.random();
            $.ajax({url:url,success:function(result){
                load();
                $("#nomCrear").val(" ");
                $("#modalCrear").modal("hide");
            }});
        }

        function modificar()
        {
            $("#modalModificar").modal("show");
        }
        function modificarClick()
        {
            var id = $("#idMod").val();
            var nom= $("#nomMod").val(); 
            var url = "http://localhost/xmlOto/jsonPHP/?tipo=4&nom="+nom+"&id="+id+"&r="+Math.random();
            $.ajax({url:url,success:function(result){
                load();
                $("#idMod").val(" ");
                $("#nomMod").val(" ");
                $("#modalModificar").modal("hide");
            }});

        }

        function eliminar()
        {
            $("#modalEliminar").modal("show");
        }
        function eliminarClick()
        {
            var id = $("#idEli").val();
            var url = "http://localhost/xmlOto/jsonPHP/?tipo=3&id="+id+"&r="+Math.random();
            $.ajax({url:url,success:function(result){
                load();
                $("#idEli").val(" ");
                $("#modalEliminar").modal("hide");
            }});

        }

        function load()
        {
            var url = "http://localhost/xmlOto/jsonPHP/";

            $.ajax({url:url,success:function(result){
                var mihtml="";

                mihtml += '<table class="table table-hover">';
                mihtml += '<thead>';
                mihtml += '<tr>';
                mihtml += '<th>ID</th>';
                mihtml += '<th>Nombre</th>';
                mihtml += '</tr>';
                mihtml += '</thead>';
                mihtml += '<tbody>';
                for(var i=0;i<result.usuarios.length;i++)
                {
                    //console.log(result.usuarios[i].id+" : "+result.usuarios[i].nom);
                    mihtml += '<tr>';
                    mihtml += '<td>'+result.usuarios[i].id+'</td>';
                    mihtml += '<td>'+result.usuarios[i].nom+'</td>';
                    mihtml += '</tr>'; 
                }

                mihtml +='</tbody>';
                mihtml +='</table>';

                $("#tabla").html(mihtml);
            }});
            
            /*$.get(url,function(data,status){
                //console.log(data);
                var obj = JSON.parse(data);
                //console.log(count(obj));
            });*/
        }

        $(document).ready(function (){
            load();
        });
    </script>
</body>
</html>