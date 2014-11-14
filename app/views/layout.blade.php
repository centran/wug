<!DOCTYPE html>
<html lang=”en”>
    <head>
        <meta charset="UTF-8" />
<!--<link type="text/css" rel="stylesheet" href="http://a4tst03x1/wug/public/css/layout.css" />-->
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/crontab.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/jquery.ui.all.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/jquery.ui.button.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/jquery.ui.theme.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/jquery.ui.accordion.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/jquery.ui.autocomplete.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/jquery.ui.base.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/jquery.ui.core.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/jquery.ui.menu.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/jquery.ui.progressbar.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/jquery.ui.resizable.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/jquery.ui.selectable.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/jquery.ui.slider.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/jquery.ui.tabs.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/jquery.ui.tooltip.css">
<link rel="stylesheet" type="text/css" href="http://a4tst03x1/wug/public/css/atooltip.css">
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery-migrate-1.2.1.js"></script>
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.core.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery-ui.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/atooltip.min.jquery.js"></script>
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.widget.js"></script>
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.tabs.js"></script>
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.accordion.js"></script>
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.autocomplete.js"></script>
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.dialog.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.slider.js"></script>
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.button.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.draggable.js"></script>
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.effect-blind.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.effect-slide.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.effect-scale.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.effect-transfer.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.effect-clip.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.effect-fold.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.effect-highligh.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.effect-transfer.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.effect.js"></script>
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.menu.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.mouse.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.position.js"></script>
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.progressbar.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.resizable.js"></script>
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.selectable.js"></script>
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.tooltip.js"></script> 
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/jquery.ui.sortable.js"></script> 
	<title>
            Apartments.com - WUG - Cron managment
        </title>
    </head>
    <body>
        @include("header")
	@include("navigation")
        <div id="content">
            <div class="container">
                @yield("content")
            </div>
        </div>
	<br />
        @include("footer")
<script type="text/javascript" language="javascript" src="http://a4tst03x1/wug/public/scripts/crontab.js"></script>
    </body>
</html>
