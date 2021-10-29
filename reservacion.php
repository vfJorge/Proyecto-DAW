<?php

if(isset($_GET["suc"])){
    $sucursalN = "Sucursal ". $_GET["suc"];
}
else $sucursalN = "";

?>

<!DOCTYPE html>
<html lang="es" xml:lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="estilo.css"  type="text/css">
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="scripts/cookieMethods.js"></script>

<script type="text/javascript">
  
</script>
<title>Reservaciones</title>
</head>
<body>
<form action="">
    <div class="mb-3 mt-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
    </div>
    <div class="mb-3">
        <label for="telefono" class="form-label">Telefono:</label>
        <input type="text" class="form-control" id="telefono" placeholder="Número" name="telefono">
    </div>
    <div class="mb-3">

        <label for="sucursal" class="form-label">Elija la sucursal:</label>
        <input class="form-control" list="sucursales" name="sucursal" id="sucursal" value="<?php echo $sucursalN;?>" onfocus="this.value=''">
        <datalist id="sucursales">
            <option value="Sucursal 1">
            <option value="Sucursal 2">
            <option value="Sucursal 3">
            <option value="Sucursal 4">
            <option value="Sucursal 5">
            <option value="Sucursal 6">
            <option value="Sucursal 7">
            <option value="Sucursal 8">
            <option value="Sucursal 9">
            <option value="Sucursal 10">
        </datalist>
    </div>
    <div class="form-check mb-3">
        <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
        </label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>