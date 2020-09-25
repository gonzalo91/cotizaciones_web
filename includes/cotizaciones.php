<?php

$description = '';

if(isset($_GET['description']))
    $description = $_GET['description'];

if(isset($_GET['from']))
    $from = $_GET['from'];
else{
    $time = strtotime(date("Y-m-d"));
    $from = date("Y-m-d", strtotime("-1 week", $time));    
}
    

if(isset($_GET['to'])){
    $to = $_GET['to'];    
}else{
    $time = strtotime(date("Y-m-d"));
    $to = date("Y-m-d", strtotime("+1 month", $time));    
}    

$cotizaciones = Cotizaciones::filterByDateAndDescription($from, $to, $description);
$tokenCSRF = Utiles::obtenerTokenCSRF();

?>

<div class="row">
    <div class="col-sm">
        <h1>Cotizaciones</h1>        
    </div>
</div>

<div class="row">
    <div class="col-sm-2">
        <p>
            <a href="<?php echo BASE_URL ?>/?p=nueva_cotizacion" class="btn btn-success">
                <i class="fa fa-plus"></i> Nueva cotización
            </a>
        </p>
    </div>
</div>

<form action="" method="GET">
    <div class="row">    
        
            <div class="col-sm-3">         
                <label for="from">Desde</label>
                <input required type="text" id="from" name="from" value="<?php echo $from; ?>">            
            </div>
            <div class="col-sm-3">
                <label for="to">Hasta</label>
                <input required type="text" id="to" name="to" value="<?php echo $to; ?>">                
            </div>
            <div class="col-sm-5">
                <label for="to">Descripcion</label>
                <br>
                <input class="w-100" type="text" id="description" name="description" value="<?php echo $description; ?>">
                
            </div>
            <div class="col-sm-1">
                <br>
                <button class="btn btn-primary">Buscar</button>                        
            </div>
        
    </div>
</form>    
<hr>
<div class="row">
    <div class="col-sm">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Detalles y características</th>
                        <th>Imprimir</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cotizaciones as $cotizacion) { ?>
                        <tr>
                            <td><?php echo $cotizacion->id ?></td>
                            <td><?php echo htmlentities($cotizacion->razonSocial) ?></td>
                            <td><?php echo htmlentities($cotizacion->descripcion) ?></td>
                            <td><?php echo htmlentities($cotizacion->fecha) ?></td>
                            <td>
                                <a class="btn btn-info" href="<?php echo BASE_URL ?>/?p=detalles_caracteristicas_cotizacion&id=<?php echo $cotizacion->id ?>">
                                    <i class="fa fa-info"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-info" href="<?php echo BASE_URL ?>/?p=imprimir_cotizacion&id=<?php echo $cotizacion->id ?>">
                                    <i class="fa fa-print"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-warning" href="<?php echo BASE_URL ?>/?p=editar_cotizacion&id=<?php echo $cotizacion->id ?>">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="<?php echo BASE_URL ?>/?p=eliminar_cotizacion&id=<?php echo $cotizacion->id ?>&tokenCSRF=<?php echo $tokenCSRF ?>">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(function() {
        var dateFormat = "yy-mm-dd",
            from = $("#from")
            .datepicker({                       
                changeMonth: true,
                numberOfMonths: 2
            })
            .on("change", function() {
                to.datepicker("option", "minDate", getDate(this));
            }),
            
            to = $("#to").datepicker({                
                changeMonth: true,
                numberOfMonths: 2
            })
            .on("change", function() {
                from.datepicker("option", "maxDate", getDate(this));                
            });

            from.datepicker("option", "dateFormat", 'yy-mm-dd');
            to.datepicker( "option", "dateFormat", 'yy-mm-dd' );            
            

            from.datepicker( "setDate", "<?php echo $from; ?>");
            to.datepicker( "setDate", "<?php echo $to; ?>");
            

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }
    });
</script>