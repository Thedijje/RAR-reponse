<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RAR-Response</title>
    <link rel="icon" href="<?=base_url('static/images/RAR.png');?>" type="image/png" sizes="16x16">
    <meta name="msapplication-navbutton-color" content="#003f5e">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#003f5e">
    <meta name="theme-color" content="#ff5722" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="shorticon">
	<script src="https://use.fontawesome.com/16a14f5e86.js"></script>
	<script>
		var base_url = '<?=base_url();?>';
		var this_device_id = "<?php //echo $this_device_id;?>";
		var incident_id = "<?php //echo $incident_id;?>";
        </script>
        <link rel="manifest" href="<?=base_url()?>manifest.json">
</head>
<body class="container">
	