
<div class="container">
    <div class="row">
    <div class="col-md-6">
        <h2> Login Here </h2>
        <form action="users/validation.php" method="post">
            <div class="form-group">
                <label>Pasaporte</label>
                <input type="text" name="pasaporte" class="form-control" required>
                </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>

        </form>
    </div>
    <div class="col-md-6">
        <h2> Register Here </h2>
        <form action="users/registration.php" method="post">
            <div class="form-group">
                <label>Pasaporte</label>
                <input type="text" name="pasaporte" class="form-control" required>
                </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control" required>
                </div>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
                </div>
            <div class="form-group">
                <label>Nacionalidad</label>
                <input type="text" name="nacionalidad" class="form-control" required>
                </div>
            <div class="form-group">
                <label>Sexo</label>
                <input type="text" name="sexo" class="form-control" required>
                </div>
            <div class="form-group">
                <label>Edad</label>
                <input type="number" name="nacionalidad" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>

        </form>
    </div>
    </div>
