<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php
        echo $this->config['title'];
        if(!empty($content['title'])) {
            echo ' -  '.$content['title'];
        }
        ?></title>

    <!-- jQuery -->
    <script src="/backend/vendor/jquery/jquery.min.js"></script>

    <!-- Custom Fonts -->
    <link href="/backend/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core CSS -->
    <link href="/backend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/frontend/css/app.css" rel="stylesheet">
    <?php
    $css = $this->getCSS();
    if(!empty($css)) {
        echo "<!-- Additional CSS Files -->\n";
        for($i=0; $i<sizeof($css); $i++) {
            echo '    <link href="';
            echo $css[$i];
            echo '" rel="stylesheet">';
            echo "\n";
        }
    }
    ?>

    <link rel="shortcut icon" href="/frontend/img/favicon.ico">
    <link rel="apple-itouch-icon" href="/frontend/img/apple-touch-icon.png">

</head>
<body>

<header>
    <h1><?php echo $this->config['title']; ?></h1>
    <nav>
        <ul>
            <?php
                $navigation = $this->getNavigation('frontend');
                foreach($navigation as $topitem=>$topnav) {
                    if(!empty($topnav['group'])) {
                        if(!$this->userInGroup($topnav['group'])) continue;
                    }
                    echo '<li>';
                    echo '<a href="';
                    echo $this->buildURL($topnav['url'], false);
                    if ($content['nav_main'] == $topitem) {
                        echo '" class="active';
                    }
                    echo '">';
                    echo '<i class="fa fa-fw ' . $topnav['icon'] . '"></i> ';
                    echo $this->lang('nav_' . $topitem, false);
                    if(!empty($topnav['subnav'])) {
                        echo '<span class="fa arrow"></span></a>';
                        echo '<ul class="nav nav-second-level">';
                        foreach($topnav['subnav'] as $subitem=>$subnav) {
                            echo '<li><a href="';
                            echo $this->buildURL($subnav['url'], false);
                            echo '">';
                            echo $this->lang('nav_'.$subitem, false);
                            echo '</a></li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '</a>';
                    }
                    echo "</li>\n";
                }

                 if($this->session->user_id != 0) {
                    echo '<li>( '.$this->session->user_handle." )</li>\n";
                } ?>
        </ul>
    </nav>
</header>

<div class="content">
<?php
if (!empty($_SESSION['flasherror'])) {
    echo '<div class="alert alert-danger alert-dismissible">';
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    echo '<p><strong>' . $this->lang('msg_core_flasherror', false) . '</strong></p>';
    echo '<p>' . $_SESSION['flasherror'] . '<p>';
    echo "</div>\n";

}
if (!empty($_SESSION['flashmessage'])) {
    echo '<div class="alert alert-info alert-dismissible">';
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    echo '<p><strong>' . $this->lang('msg_core_flashnotice', false) . '</strong></p>';
    echo '<p>' . $_SESSION['flashmessage'] . '<p>';
    echo "</div>\n";
}
?>

<?php if (!empty($content['title'])) {
    echo '<h1>' . $content['title'] . '</h1>';
} ?>
