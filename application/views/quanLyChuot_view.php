<button class="btn btn-success" id="myBtn">Thêm</button>
<div class="_modal" id="myModal">
	<div class="_modal-content" id="formdulieu">
		<h2>Nhập dữ liệu bảng Quản lý Chuột</h2>
		<form action="" method="POST">
			<fieldset class="form-group">
				<label for="formGroupExampleInput">Tên chuột</label>
				<input type="text" name="tenchuot" class="form-control insert">
			</fieldset>
			<fieldset class="form-group">
				<label for="formGroupExampleInput">Hãng sản xuất</label>
				<select data-tablename="hangsx" class="c-select form-control insert" name="id_hangsx">
					<option selected>Lựa chọn hãng sx</option>
					<!-- <?php foreach ($hangsx as $value): ?>
						<option value="<?= $value['id_hangsx'] ?>"><?= $value['hangsx'] ?></option>
					<?php endforeach ?> -->
				</select>
			</fieldset>
			<fieldset class="form-group">
				<label for="formGroupExampleInput">Giá mua vào</label>
				<input type="text" name="giamuavao" class="form-control insert">
			</fieldset>
			<fieldset class="form-group">
				<label for="formGroupExampleInput">Loại Chuột</label>
				<select data-tablename="loaichuot" class="c-select form-control insert" name="id_loaichuot"> 
					<option selected>Lựa chọn Loại Chuột</option>
					<!-- <?php foreach ($loaichuot as $value): ?>
						<option value="<?= $value['id_loaichuot'] ?>"><?= $value['loaichuot'] ?></option>
					<?php endforeach ?> -->
				</select>
			</fieldset>
			<fieldset class="form-group">
				<label for="formGroupExampleInput">Số lượng trong kho</label>
				<input type="text" name="soluongtrongkho" class="form-control insert">
			</fieldset>
			<fieldset class="form-group">
				<label for="formGroupExampleInput">kích Cỡ</label>
				<select data-tablename="kichco" class="c-select form-control insert" name="id_kichco">
					<option selected>Lựa chọn kích Cỡ</option>
					<!-- <?php foreach ($kichco as $value): ?>
						<option value="<?= $value['id_kichco'] ?>"><?= $value['kichco'] ?></option>
					<?php endforeach ?> -->
				</select>
			</fieldset>
			<fieldset class="form-group">
				<label for="formGroupExampleInput">Nhà cung cấp</label>
				<select data-tablename="nhacungcap" class="c-select form-control insert" name="manhacungcap">
					<option selected>Lựa chọn Nhà cung cấp</option>
					<!-- <?php foreach ($nhacungcap as $value): ?>
						<option value="<?= $value['manhacungcap'] ?>"><?= $value['nhacungcap'] ?></option>
					<?php endforeach ?> -->
				</select>
			</fieldset>
			
		</form>
		<fieldset class="form-group">
				<input type="submit" class="btn btn-success" class="form-control" id="xacnhan" value="Xác nhận">
				<input type="submit" hidden class="btn btn-success" class="form-control" id="luu" value="Lưu">
			</fieldset>
	</div>
</div>
<table id="example" class="table" border="0" style="width: 100%">
	<thead>
		<tr>
			<th><b>Tên Chuột</b></i></th>
			<th><b>Hãng Sản Xuất</b></i></th>
			<th><b>Loại Chuột</b></i></th>
			<th><b>Nhà cung cấp</b></i></th>
			<th></th>
			<th hidden=""></th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
<script type="text/javascript" src="<?= base_url() ?>js/quanLyChuot.js"></script>
