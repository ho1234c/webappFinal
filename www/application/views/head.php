<!DOCTYPE html>
				<html>
						<head>
								<meta charset="utf-8"/>
								<meta name="viewport" content="width=device-width, initial-scale=1.0">
								<!-- Bootstrap -->
								
								<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
								<link href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
								<link href="/static/lib/Gallery-master/css/blueimp-gallery.min.css" rel="stylesheet">

								<link href="/static/css/stylesheet.css" rel="stylesheet">
								
						</head>
						<body>
						<?php
							if($this->session->flashdata('message')){
						?>
							<script>
								alert('<?=$this->session->flashdata('message')?>');
							</script>
						<?php
							}
						?>