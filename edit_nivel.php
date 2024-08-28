<?php
include('db.php');
include('header.php');

$id = $_GET['id'];
$sql = "SELECT * FROM nivelesacademicos WHERE cod_nivel_acad = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$nivel = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];

    $sql = "UPDATE nivelesacademicos SET nombre = :nombre WHERE cod_nivel_acad = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Nivel modificado correctamente</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al modificar nivel</div>";
    }
}
?>

<div class="container">
    <h1>Modificar Nivel</h1>
    <form method="POST">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nivel['nombre']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="niveles.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include('footer.php'); ?>
