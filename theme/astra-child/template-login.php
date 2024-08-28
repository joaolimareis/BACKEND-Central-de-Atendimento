<?php
/*
Template Name: Login Page
*/

if (is_user_logged_in()) {
    wp_redirect(home_url('/pagina-restrita/')); // Substitua "/pagina-restrita/" pela URL da página que deseja redirecionar
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize_text_field($_POST['username']);
    $password = sanitize_text_field($_POST['password']);
    $creds = array(
        'user_login'    => $username,
        'user_password' => $password,
        'remember'      => true,
    );

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        $error = $user->get_error_message();
    } else {
        wp_redirect(home_url('/pagina-restrita/')); // Substitua "/pagina-restrita/" pela URL da página que deseja redirecionar
        exit;
    }
}
get_header();
?>

<div class="login-form-container">
    <h1>Login</h1>
    <?php if ($error) : ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post">
        <p>
            <label for="username">Nome de Usuário</label>
            <input type="text" name="username" id="username" required>
        </p>
        <p>
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" required>
        </p>
        <p>
            <input type="submit" value="Login">
        </p>
    </form>
</div>

<?php get_footer(); ?>
