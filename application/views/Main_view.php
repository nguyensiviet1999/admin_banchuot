<!DOCTYPE html>
<html lang="en"><head>
	<title> Admin Ban Chuot </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">  

	<link rel="stylesheet" href="<?= base_url() ?>vendor/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url() ?>vendor/font-awesome.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/1.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/datatables.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/select2.min.css">
	<script type="text/javascript" src="<?= base_url() ?>vendor/bootstrap.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/datatables.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/select2.min.js"></script>

</head>
<body >
	<div id="base_url" hidden=""><?= base_url() ?></div>
	<?php $this->load->view('Header_view'); ?>
	<div class="row" >
		<div class="col-xl-2" style="background-color: #1076bf4a; margin: 0px; padding: 0px">
			<?php $this->load->view('NavBar_view'); ?>
		</div>
		<div class="col-xl-10" style="padding-left: 2px;">
			<?php if (!empty($view)): ?>
				<?php $this->load->view($view,$data); ?>
			<?php endif ?>
		</div>
	</div>
	<?php $this->load->view('Footer_view'); ?>
</body>
</html>

