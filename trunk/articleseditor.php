<?php

    include('global.properties');

    $title = "SAUTO - Редагування статей";
    $mainmenuindex = 5;
    $content_tmpl = 'admin_content';

    if (isset($_GET['articleindex'])) {
        $articleindex = $_GET['articleindex'];
        $maincontent_tmpl = 'onearticleseditor';
    } else {
        $maincontent_tmpl = 'articleseditor';
    }

    include('admin.tmpl');

?>