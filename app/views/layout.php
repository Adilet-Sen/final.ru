<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $this->e($title)?></title>
    <meta name="description" content="Chartist.html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="/assets/css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="/assets/css/app.bundle.css">
    <link id="myskin" rel="stylesheet" media="screen, print" href="/assets/css/skins/skin-master.css">
    <link rel="stylesheet" media="screen, print" href="/assets/css/fa-solid.css">
    <link rel="stylesheet" media="screen, print" href="/assets/css/fa-brands.css">
    <link rel="stylesheet" media="screen, print" href="/assets/css/fa-regular.css">
    </head>

<body class="mod-bg-1 mod-nav-link">

    <?php $this->insert('partials/navbar', ['auth_id' => $auth_id]); ?>

    <main id="js-page-content" role="main" class="page-content mt-3">
        <?= $this->section('content') ?>
    </main>

    <!-- BEGIN Page Footer -->
    <? if (false) : ?>
        <?php $this->insert('partials/footer'); ?>
    <? endif; ?>
</body>

<?php $this->insert('partials/scripts'); ?>

</html>