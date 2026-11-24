<!DOCTYPE html>
<html lang="es"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#10091c"><title>Acceso | DocTrack</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url('assets/css/doctrack-modern.css'); ?>" rel="stylesheet">
</head><body><main class="login-shell"><section class="login-card">
<div class="brand-mark mb-4"><span class="brand-orb">&lt;/&gt;</span> DOCTRACK</div>
<div class="login-eyebrow">Gestión documental académica</div>
<h1 class="login-title">Todo documento,<br>en su lugar.</h1>
<p class="login-copy mb-4">Accede para entregar, revisar y dar seguimiento a tus documentos académicos.</p>
<?php if (!empty($error)): ?><div class="alert alert-danger" role="alert"><?php echo html_escape($error); ?></div><?php endif; ?>
<?php if (validation_errors()): ?><div class="alert alert-warning" role="alert"><?php echo validation_errors(); ?></div><?php endif; ?>
<form action="<?php echo site_url('Auth/iniciarSesion'); ?>" method="post" autocomplete="on">
<div class="form-group"><label for="username">Correo electrónico</label><input id="username" type="email" class="form-control" name="Usuario" placeholder="nombre@correo.com" autocomplete="username" required></div>
<div class="form-group"><label for="userpassword">Contraseña</label><input id="userpassword" type="password" class="form-control" name="Contraseña" placeholder="Tu contraseña" autocomplete="current-password" required></div>
<button class="btn btn-primary btn-block" type="submit">Iniciar sesión</button></form>
<div class="text-center mt-4"><small>Una plataforma · Tres perfiles · Un flujo claro</small></div>
</section></main></body></html>