<?php require_once 'helpers.php' ?>
<div id="contenedor">
    <aside id="sidebar">
        <div id="login" class="bloqueform">
            <h4> Search posts  </h4>
            <span class="fecha"> Example: 'ops'</span>
            <form action="/index.php" method="get">
                <label>
                    <input type="text" name="search" required>
                </label>
                <input type="submit" value="Search">
            </form>
        </div>
        <?php if(isset($_SESSION['user_data'])): ?>
            <div id="login" class="bloqueform">
                <div id="usuario-logeado" class="bloque">
                    <h6> <strong> Logged as: <?= strtoupper($_SESSION['user_data']['name']) ?> </strong> </h6>
                    <h6> Email: <?= $_SESSION['user_data']['email'] ?> </h6>
                    <h6> Age: <?= $_SESSION['user_data']['age'] ?> </h6>
                    <h6> Registered since: <?= $_SESSION['user_data']['date'] ?> </h6>
                    <a href="/profile.php" class="boton boton-verde"> Profile </a>
                    <a href="/database/logout.php" class="boton boton-rojo"> Logout </a>
                </div>
            </div>
        <?php else: ?>
            <div id="login" class="bloqueform">
                <?php if(isset($_SESSION['login_error'])): ?>
                    <div class="alerta alerta-error">
                        <?= $_SESSION['login_error'] ?>
                    </div>
                <?php endif ?>
                <form action="/database/login.php" method="post">
                    <label>
                        Email <input type="email" name="email" required minlength="5">
                    </label>
                    <label>
                        Password <input type="password" name="password" required minlength="5">
                    </label>
                    <input type="submit" value="Login">
                </form>
            </div>
            <div id="registro" class="bloqueform">
                <h3> Register </h3>
                <?php if(isset($_SESSION['register'])): ?>
                    <div class="alerta alerta-exito">
                        <?= $_SESSION['register']; ?>
                    </div>
                    <?php cleanErrors(); ?>
                <?php elseif(isset($_SESSION['errors']['general'])): ?>
                    <div class="alerta alerta-error">
                        <?= $_SESSION['errors']['general']; ?>
                    </div>
                <?php endif ?>
                <form action="/database/register.php" method="post">
                    <label>
                        Full name <input type="text" name="name" required minlength="5">
                    </label>
                    <?= isset($_SESSION['errors']) ? showError($_SESSION['errors'], 'name') : ''; ?>
                    <label>
                        Age <input type="number" name="age" required min=10 max="108">
                    </label>
                    <?= isset($_SESSION['errors']) ? showError($_SESSION['errors'], 'age') : ''; ?>
                    <label>
                        Email <input type="email" name="email" required minlength="5">
                    </label>
                    <?= isset($_SESSION['errors']) ? showError($_SESSION['errors'], 'email') : ''; ?>
                    <?= isset($_SESSION['errors']) ? showError($_SESSION['errors'], 'email_taken') : ''; ?>
                    <label>
                        Password <input type="password" name="password" required minlength="5">
                    </label>
                    <?= isset($_SESSION['errors']) ? showError($_SESSION['errors'], 'password') : ''; ?>
                    <label>
                        Confirm Password <input type="password" name="password_confirm" required minlength="5">
                    </label>
                    <?= isset($_SESSION['errors']) ? showError($_SESSION['errors'], 'confirm_password') : ''; ?>
                    <input type="submit" name="submit" value="Register">
                </form>
            </div>
        <?php endif ?>
    </aside>
