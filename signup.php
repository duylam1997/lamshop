<?php include_once  $_SERVER['DOCUMENT_ROOT'].'/templates/shop/inc/side-bar.php' ?>
		<div id="fh5co-main">
			<div class="fh5co-narrow-content">
				<form action="" method="get" accept-charset="utf-8" id="frmDki">
					<h1>Đăng kí:</h1>
					<label>Tên đăng nhập:</label><br>
					<input type="text" name="dkiname" value="" id="dkiname">
					<br>
					<label>Mật khẩu:</label><br>
					<input type="password" name="dkimatkhau" value="" id="password">
					<br>
					<label>Nhập lại mật khẩu:</label><br>
					<input type="password" name="repassword" value="">
					<br>
					<label>Thành phố:</label><br>
					<select name="city" required title="Vui lòng chọn thành phố">
						<option value="">--Chọn thành phố--</option>
						<option value="1">Đà Nẵng</option>}
						<option value="2">Hồ Chí Minh</option>}
						<option value="3">Hà Nội</option>}
					</select>
					<br>
					<label>Địa chỉ:</label><br>
					<input type="text" name="address" value="">
					<br>
					<label>Số điện thoại:</label><br>
					<input type="text" name="phone" value="">
					<br>
					<input type="submit" name="submit" value="Đăng kí">
					<input type="reset" name="reset" value="Nhập lại">	
				</form>
			</div>
		</div>
	</div>
<?php include_once  $_SERVER['DOCUMENT_ROOT'].'/templates/shop/inc/footer.php' ?>