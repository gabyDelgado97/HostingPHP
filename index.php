<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Documento sin título</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <form name="formulario_contacto" method="post" action="Enviar_mail.php">
            
            <h1>Datos Compra Libro</h1>
            <label for="">Nombre: *</label>
            <input type="text" name="book_name">
            
            <label for="">Autor:</label>
            <input type="text" name="book_autor">
            
            <label for="">Costo:</label>
            <input type="text" name="book_cost">
            <br/>
            
            
            <h1>Datos del Cliete</h1>
            <label for="">Nombres: *</label>
            <input type="text" name="customer_name">
            
            <label for="">Apellidos: *</label>
            <input type="text" name="customer_second">
            
            <label for="">Correo: *</label>
            <input type="text" name="dest_email">
            
            <br/>
            
            <input type="submit" value="Enviar">
        </form>
        
        

    </body>
</html>