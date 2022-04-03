<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar seccion</h1>
        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>
        <form method="POST" class="formulario" action="/">
            <fieldset>
                <legend>Email y Contraseña</legend>
                <label for="mail">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="mail" require>
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" placeholder="Tu contraseña" id="contraseña" require>
            </fieldset>
            <input type="submit" value="Iniciar Seccion" class="boton boton-verde">
        </form>
    </main>