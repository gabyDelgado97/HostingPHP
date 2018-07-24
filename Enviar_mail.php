<?php

//RECOGER LOS DATOS DE LA FACTURA
    $para=$_POST["dest_email"];
    $nombres=$_POST["customer_name"];
    $apellidos=$_POST["customer_second"];
    $asunto="Compra Libro";
    $mensaje="Datos Compra Libro\r\n"
            . "Nombre: ". $_POST["book_name"] ."\r\n"
            . "Autor: ". $_POST["book_autor"] ."\r\n"
            . "Costo: ". $_POST["book_cost"] ."$\r\n";
    $cabeceras = 'From: edissonfernando2012@hotmail.com' . "\r\n" .
            'Reply-To: ' . $_POST["dest_email"] . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    
    
//CODIGO PARA IMPRIMIR EL PDF    
    require 'pdf_js.php';

    class PDF_AutoPrint extends PDF_JavaScript
    {
        function AutoPrint($printer='')
        {
            // Open the print dialog
            if($printer)
            {
                $printer = str_replace('\\', '\\\\', $printer);
                $script = "var pp = getPrintParams();";
                $script .= "pp.interactive = pp.constants.interactionLevel.full;";
                $script .= "pp.printerName = '$printer'";
                $script .= "print(pp);";
            }
            else
                $script = 'print(true);';
            $this->IncludeJS($script);
        }
    }
//CODIGO PARA IMPRIMIR EL PDF


//ENVIAR EL MAIL E IMPRIMIR    
    if(mail($para, $asunto, $mensaje, $cabeceras)) {
        
        $pdf = new PDF_AutoPrint();
        $pdf->AddPage();
        $pdf->Image('img/carrito.png',170,8,33);
        $pdf->SetFont('Arial', 'B', 35);
        $pdf->Cell(190, 30, 'Factura de Venta', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 20);

        $pdf->SetFont('Arial', 'B', 25);
        $pdf->Cell(190, 15, 'Datos del Cliente', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 20);
        $pdf->Cell(100, 15, 'Nombres: '.$nombres.' ', 0, 1, 'L');
        $pdf->Cell(100, 15, 'Apellidos: '.$apellidos.' ', 0, 1, 'L');
        $pdf->Cell(100, 15, 'E-mail: '.$para.' ', 0, 1, 'L');
        $pdf->Cell(100, 15, '', 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 25);
        $pdf->Cell(190, 15, 'Datos del Libro', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 20);
        $pdf->Cell(100, 15, 'Libro: '.$_POST["book_name"].' ', 0, 1, 'L');
        $pdf->Cell(100, 15, 'Autor: '.$_POST["book_autor"].'', 0, 1, 'L');
        $pdf->Cell(100, 15, 'Costo: '.$_POST["book_cost"].' $', 0, 1, 'L');
        
        $pdf->AutoPrint();
        $pdf->Output();
        
        //echo 'email enviado con exito';
    } else {
        echo 'Fallo al enviar el mensaje';
    }
    
?>