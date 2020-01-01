<?php include_once  $_SERVER['DOCUMENT_ROOT'].'/templates/shop/inc/side-bar.php' ?>
		<div id="fh5co-main">
			<div class="fh5co-narrow-content">
				<h1 style="text-align: center;">Giỏ hàng</h1>
				<table class="table table-striped">
                    <thead>
	                    <tr>
	                        <th> STT </th>
	                        <th> Hình ảnh </th>
	                        <th> Sản phẩm </th>
	                        <th> Số lượng </th>
	                        <th> Giá tiền </th>
	                        <th> Trạng thái </th>
	                    </tr>
                    </thead>
                    <tbody>
                    	<tr>
                    		<td>1</td>
                    		<td><img src="/library/shop/images/636700374319479202_macpro13.jpg" alt=""></td>
                    		<td>Macbook Pro 13 inch 256GB (2017)</td>
                    		<td><input type="number" name="quantity" min="1" max="99" value="" placeholder="1"></td>
                    		<td>200.00</td>
                    		<td>Chưa giao hàng</td>
                    	</tr>
                    	<tr>
                    		<td>2</td>
                    		<td><img src="/library/shop/images/636948957624237933_macbook-pro--touch-bar-2019-dd.jpg" alt=""></td>
                    		<td>Macbook Pro 13 Touch Bar (2019)</td>
                    		<td><input type="number" name="quantity" min="1" max="99" value="" placeholder="1"></td>
                    		<td>750.00</td>
                    		<td>Chưa giao hàng</td>
                    	</tr>
                    	<tr>
                    		<td>3</td>
                    		<td><img src="/library/shop/images/636991283780731763_macbook-air-13-2019-dd.jpg" alt=""></td>
                    		<td>Macbook Air 13 128GB 2018</td>
                    		<td><input type="number" name="quantity" min="1" max="99" value="" placeholder="1"></td>
                    		<td>1050.00</td>
                    		<td>Chưa giao hàng</td>
                    	</tr>
                    </tbody>
                </table>
                <div class="cart">
                	<table>
                		<thead>
                			<tr>
                				<th>Địa điểm</th>
                			</tr>
                			<tr>
                				<td>36 Lý Thái Tổ,Đà Nẵng</td>
                			</tr>
                		</thead>
                		<tbody>
                			<tr>
                				<th>Thông tin đơn hàng</th>
                			</tr>
                			<tr>
                				<td>Tạm tính:</td>
                				<td>2000.00</td>
                			</tr>
                			<tr>
                				<td>Phí giao hàng:</td>
                				<td>2.00</td>
                			</tr>
                			<tr>
                				<td style="padding-right: 15px;"><input type="" name="" value=""></td>
                				<td><button type="">Áp dụng</button></td>
                			</tr>
                			<tr>
                				<th>Tổng cộng:</th>
                				<th>5000.00</th>
                			</tr>
                			<tr>
                				<th><button type="submit">Xác nhận giỏ hàng</button></th>
                			</tr>
                		</tbody>
                	</table>
                </div>
                <div></div>
			</div>
		</div>
	</div>
<?php include_once  $_SERVER['DOCUMENT_ROOT'].'/templates/shop/inc/footer.php' ?>