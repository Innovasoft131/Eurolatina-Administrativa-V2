<?php



$reportePlanchado = ControladorPlanchado::ctrMostrarPlanchado();

?>

<div class="table-responsive">
    <table class="table  table-bordered table-striped   tablas " >
        <thead>
            <tr>
                <th>Pedido</th>
                <th>Cliente</th>
                <th>Modelo</th>
                <th>Color</th>
                <th>Talla</th>
                <th>Cantidad en proceso</th>
                
            </tr>
        </thead>
        <tbody>
             <?php
             foreach ($reportePlanchado as $key => $value) {
                 echo '<tr>
                         <td>'.$value["idPedido"].'</td>
                         <td>'.$value["cliente"].'</td>
                         <td>'.$value["pieza"].'</td>
                         <td>'.$value["color"].'</td>
                         <td>'.$value["talla"].'</td> 
                         <td>'.$value["cantidadInicio"].'</td>   
                        
                    </tr>';
             }
             ?>
        </tbody>
    </table>
</div>