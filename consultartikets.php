<?php
include("conexion.php");


$cliente = 0;
$vendedor = 0;
$fechaini = 0;
$fechafin = 0;


if (isset($_POST['submit'])) 
{
    $fechaini = $_POST['fechaini'].".00:00:00";
    $fechafin = $_POST['fechafin'].".23:59:59";
    $vendedor = $_POST['vendedor'];
    $cliente = $_POST['cliente'];
}


if (isset($_POST['generar_pdf'])) {

    require('fpdf/fpdf.php');
    $idticket = $_POST['idtic'];
    $cliente = $_POST['cliente'];
    $vendedor = $_POST['vendedor'];

    if($vendedor == 'Cristian')
    { 
        $vendedor = $vendedor." Vega Rubio";
    } 

    if($vendedor == 'Gustavo')
    {
        $vendedor = $vendedor." Engquinto Cortes";
    } 


    class PDF extends FPDF
    {
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('img/logo2.png',10,10,28);
        // Arial bold 15
        
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(135);
        // Título
        $this->Cell(50,10,'Aqua Pet Pachuca',0,0,'l');
        $this->Ln(5);

        $this->SetFont('Arial','',8);
        $this->Cell(135);
        $this->Cell(50,10,'Aun Costado de la Central de Autobuses,',0,0,'l');
        $this->Ln(3);

        $this->Cell(135);
        $this->Cell(50,10,utf8_decode('Blvrd Javier Rojo Gómez S/N,'),0,0,'l');
        $this->Ln(3);

        $this->Cell(135);
        $this->Cell(50,10,utf8_decode('Ex-hacienda de Coscotitlán,') ,0,0,'l');
        $this->Ln(3);

        $this->Cell(135);
        $this->Cell(50,10,'42080 Pachuca de Soto, Hgo.',0,0,'l');
        $this->Ln(3);

        $this->Cell(135);
        $this->Cell(50,10,'Tel.: 7711000915, 7715696982',0,0,'l');

        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('"Aqua Pet Pachuca Diseño De Acuarios e Iluminación LED"'),0,0,'C');
    }
    }

    $consulta = "SELECT telefono, correo, DATE_FORMAT(fechaticket, '%d/%m/%Y') as fecha FROM tickets where idticket = '$idticket' ";
    $resultado = $conexion->query($consulta);

    while($row = $resultado->fetch_assoc()){
        $fecha = $row['fecha'];
        $telefono = $row['telefono'];
        $correo = $row['correo'];
    }


    

    // Creación del objeto de la clase heredada
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->setTextColor(255, 255, 255);
    $pdf->SetFont('Times','B',10);
    $pdf->SetFillColor(21, 60, 103);
    $pdf->Cell(95,5,'Datos',1,0,'C', True);
    $pdf->Cell(45,5,utf8_decode('Fécha:'),1,0,'C', True);
    $pdf->Cell(45,5,'No. Ticket:',1,0,'C', True);

    $pdf->Ln();

    $pdf->setTextColor(0, 0, 0);
    $pdf->Cell(14,5,'Nombre: ',0,0,'l');
    $pdf->SetFont('Times','',10);
    $pdf->Cell(81,5,utf8_decode($cliente),0,0,'L');
    $pdf->Cell(45,5,$fecha,1,0,'C');
    $pdf->setTextColor(255, 0, 0);
    $pdf->SetFont('Times','B',10);
    $pdf->Cell(45,5,$idticket,1,0,'C');

    $pdf->Ln();

    $pdf->setTextColor(0, 0, 0);
    $pdf->SetFont('Times','B',10);
    $pdf->Cell(15,5,utf8_decode('Teléfono:'),0,0,'l');
    $pdf->SetFont('Times','',10);
    $pdf->Cell(80,5,$telefono,0,0,'l');
    $pdf->SetFont('Times','B',10);
    $pdf->setTextColor(255, 255, 255);
    $pdf->Cell(90,5,'Vendedor:',1,0,'C', True);
    $pdf->setTextColor(0, 0, 0);

    $pdf->Ln();
    
    $pdf->SetFont('Times','B',10);
    $pdf->Cell(12,5,'e-Mail:',0,0,'l');
    $pdf->SetFont('Times','',10);
    $pdf->Cell(83,5,$correo,0,0,'l');
    $pdf->SetFont('Times','',10);
    $pdf->Cell(90,5,utf8_decode($vendedor),1,0,'C');

    $pdf->Ln(15);

    $pdf->setTextColor(255, 255, 255);
    $pdf->SetFont('Times','B',10);
    $pdf->Cell(25,5,'Cantidad',1,0,'C', True);
    $pdf->Cell(90,5,utf8_decode('Descripción'),1,0,'C', True);
    $pdf->Cell(35,5,'Precio U.',1,0,'C', True);
    $pdf->Cell(35,5,'Importe',1,0,'C', True);
    $pdf->SetFont('Times','',10);
    $pdf->setTextColor(0, 0, 0);
    $pdf->Ln();


    
    $consulta = "SELECT * FROM cat_ventas ven INNER JOIN cat_producto prod ON ven.idproducto = prod.idproducto where ven.idticket = '$idticket'";
    $resultado = $conexion->query($consulta);

    while($row = $resultado->fetch_assoc()){
        $pdf->Cell(25,5,$row['cantidad'],0,0,'C');
        $pdf->Cell(90,5,utf8_decode($row['descripcion']),0,0,'l');
        $pdf->Cell(35,5,$row['preciopublico'],0,0,'C');
        $pdf->Cell(35,5,$row['precioventa'],0,0,'C');
        $pdf->Ln();
    }


    $query= "SELECT sum(precioventa) as total FROM cat_ventas where idticket='$idticket'";
    $resultado = $conexion->query($query);
    while($row=$resultado->fetch_assoc())
    {
        $suma="$".$row['total'];
        $pdf->SetFont('Times','B',12);
        $pdf->SetY(202);
        $pdf->Cell(115,5,'',0,0,'C');
        $pdf->Cell(35,5,'Total',0,0,'R');
        $pdf->SetFont('Times','',10);
        $pdf->Cell(35,5,$suma,1,0,'C');
    }

        $pdf->SetY(209);
        $pdf->SetFont('Times','',8);
        $pdf->Multicell(35,3,utf8_decode('Para dudas o aclaraciones contáctanos en Facebook'),0,'C');
        $pdf->SetY(251);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(35,5,'Escanea',0,0,'C');
    $pdf->Image('img/qr.png' , 10 ,216, 35 , 35,'PNG');

    $pdf->Ln();

    $pdf->SetY(261);
    $pdf->SetFont('Arial','I',6);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Multicell(185,3,utf8_decode('**Para los productos electrónicos de la marca Sunny y Dophin usted cuenta con 6 meses de garantía a parir de la fecha que indica este documento, favor de consultar los términos y condiciones en nuestra página de Facebook oficial.'),0,'L');
    $pdf->Ln();
    $pdf->Multicell(185,3,utf8_decode('**Para los productos electrónicos de la marca Lomas, Aqua Krill, Ocean Aqua y Azul usted cuenta con 3 meses de garantía a parir de la fecha que indica este documento, favor de consultar los términos y condiciones en nuestra página de Facebook oficial.'),0,'L');

    
    $pdf->SetY(47);
    $pdf->Cell(95,20,'',1,0,'l');
    $pdf->SetY(82);
    $pdf->Cell(185,120,'',1,0,'l');

    $nomdes = "Ticket 00".$idticket." ".$cliente.".pdf";
    
    $pdf->Output('D', $nomdes, 'true');

    return header("Location: consultartikets.php");

     }

?>

<?php 
    include("menu.php");
?>


<!DOCTYPE html>
<html>
<head>
  <title>Aqua Pet | Consultar</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/Logo2.ico" />
    <!-- Bootstrap CSS -->
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="js/jquery-ui.css">
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="bt/css/bootstrap.min.css">

</head>
<body>
    
    <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST"> 
            <div class="form-group">
                <div class="row">
                    
                    <div class="col-3">
                        <label><b>Vendendor</b></label>
                        <select name="vendedor" class="form-control" select style="width:200px">
                            <option value="" selected>Seleccionar Vendedor</option>
                            <option value="Cristian" >Cristian</option>
                            <option value="Gustavo" >Gustavo</option>
                            <option value="Veronica" >Veronica</option>
                            <option value="Mostrador" >Mostrador</option>
                        </select>
                    </div>

                    <div class="col-3">
                        <label><b>Fecha Inicial</b></label>
                        <input type="date" name="fechaini" value="<?php echo date("Y-m-dT00:00");?>" class="form-control"> 
                    </div>

                    <div class="col-3">
                        <label><b>Fecha Final</b></label>
                        <input type="date" name="fechafin" value="<?php echo date("Y-m-dT23:59");?>" class="form-control"> 
                    </div>

                    <div class="col-3">
                        <label><b>Cliente</b></label>
                        <input type="text" name="cliente" value="" class="form-control"> 
                    </div>
                </div>   
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <button name="submit" type="submit" class="btn btn-primary btn pull-right form-control">Buscar</button>
                    </div>
                </div>
            </div>
    </form>

    <div class="form-group">
        
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>id</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Total</th>
                        <th>Fecha venta</th>
                        <th>Detalle</th>
                        <th align="center">Ticket PDF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if($vendedor != null && $fechaini == 0)
                    {
                       $query= "SELECT * FROM tickets where vendedor = '$vendedor'";
                        $resultado = $conexion->query($query);
                        while($row=$resultado->fetch_assoc())
                        {
                    ?>
                        <tr>
                            <td><?php echo $row['idticket'];?></td>
                            <td><?php echo $row['cliente'];?></td>
                            <td><?php echo $row['vendedor'];?></td>
                            <td><?php echo $row['totalventa'];?></td>
                            <td><?php echo $row['fechaticket'];?></td>
                            <td><button type="button" class="btn btn-outline-success editbtn" data-bs-toggle="modal" data-bs-target="#editar">Detalle</button></td>
                            <td align="center"><button align="center" type="button" class="btn btn-outline-danger genpdf" data-bs-toggle="modal" data-bs-target="#generar"><i class="bi bi-box-arrow-down"></i></button></td>
                        </tr>
                    <?php
                        }
                    }
                    
                    if($fechaini != null)
                    {
                        $query= "SELECT * FROM tickets where fechaticket between '$fechaini' and '$fechafin'";
                        $resultado = $conexion->query($query);
                        while($row=$resultado->fetch_assoc())
                        {
                    ?>
                        <tr>
                            <td><?php echo $row['idticket'];?></td>
                            <td><?php echo $row['cliente'];?></td>
                            <td><?php echo $row['vendedor'];?></td>
                            <td><?php echo $row['totalventa'];?></td>
                            <td><?php echo $row['fechaticket'];?></td>
                            <td><button type="button" class="btn btn-outline-success editbtn" data-bs-toggle="modal" data-bs-target="#editar">Detalle</button></td>
                            <td><button type="button" class="btn btn-outline-danger genpdf" data-bs-toggle="modal" data-bs-target="#generar"><i class="bi bi-box-arrow-down"></i></button></td>
                        </tr>
                    <?php
                        }   
                    }
                    else
                    {
                        $query= "SELECT * FROM tickets where to_days(fechaticket) = to_days(NOW())";
                        $resultado = $conexion->query($query);
                        while($row=$resultado->fetch_assoc())
                        {
                    ?>
                        <tr>
                            <td><?php echo $row['idticket'];?></td>
                            <td><?php echo $row['cliente'];?></td>
                            <td><?php echo $row['vendedor'];?></td>
                            <td><?php echo $row['totalventa'];?></td>
                            <td><?php echo $row['fechaticket'];?></td>
                            <td><button type="button" class="btn btn-outline-success editbtn" data-bs-toggle="modal" data-bs-target="#editar">Detalle</button></td>
                            <td><button type="button" class="btn btn-outline-danger genpdf" data-bs-toggle="modal" data-bs-target="#generar"><i class="bi bi-box-arrow-down"></i></button></td>
                        </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
          <form action="editar.php" method="POST">
          
          <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                      <th>id</th>
                        <th>Id Tiket</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Total</th>
                        <th>Fecha venta</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include("conexion.php");
                    if(empty($nombreprod))
                    {
                       
                    }
                        else{
                          $query= "SELECT * FROM tikets";
                        $resultado = $conexion->query($query);
                        while($row=$resultado->fetch_assoc())
                        {
                    ?>
                        <tr>
                            <td><?php echo $row['idticket'];?></td>
                            <td><?php echo $row['cliente'];?></td>
                            <td><?php echo $row['vendedor'];?></td>
                            <td><?php echo $row['totalventa'];?></td>
                            <td><?php echo $row['fechaticket'];?></td>
                            <td><button type="button" class="btn btn-outline-success editbtn" data-bs-toggle="modal" data-bs-target="#editar">Detalle</button></td>
                        </tr>
                    <?php
                        }}
                    ?>

                </tbody>
            </table>

        </form>
      </div>
    </div>
  </div>
</div>

   <!-- Modal -->
<div class="modal fade" id="generar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Generar PDF</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
            <div class="modal-body">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                    <input type="hidden" name="idtic" id="gen_pdf">
                    <input type="hidden" name="cliente" id="nomcli">
                    <input type="hidden" name="vendedor" id="vendedor">
                    <h2>Desea generar PDF?</h2>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" name="generar_pdf" class="btn btn-primary">Si</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
        
        
        <script type="text/javascript">
        
            $(document).ready(function (){
                var items = <?= json_encode($array); ?>
                    
                $("#tag").autocomplete({
                    source: items
                });
            });
        
        </script>

        <script>
            $('.editbtn').on('click',function(){
                
                $tr=$(this).closest('tr');
                var datos = $tr.children("td").map(function(){
                   return $(this).text();
                });
                
                $('#update_id').val(datos[0]);
                $('#modelo').val(datos[1]);
                $('#descripcion').val(datos[2]);
                $('#existencias').val(datos[3]);
                $('#precio').val(datos[4]);
                $('#preciomay').val(datos[5]);
                $('#preciocompra').val(datos[6]);
            });
        </script>

         <script>
            $('.genpdf').on('click',function(){
                
                $tr=$(this).closest('tr');
                var datos = $tr.children("td").map(function(){
                   return $(this).text();
                });
                
                $('#gen_pdf').val(datos[0]);
                $('#nomcli').val(datos[1]);
                $('#vendedor').val(datos[2]);
            });
        </script>
    
    <script src="bt/js/bootstrap.bundle.min.js"></script>
      
    </div>
</body>
</html>