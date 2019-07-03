<!DOCTYPE html>
<html>

<head>
	<title>Capture Webpage Screenshot</title>
	<!-- include the jquery and jquery ui -->
	<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

	<!-- this script helps us to capture any div -->
	<script src="<?php echo base_url('assets/html2canvas.js') ?>"></script>

	<style>
		.bgimg {
			background-image: url('../assets/background_resi_2.png');
			background-repeat: no-repeat;
			background-size: 100%;

		}

		.invoice-box {
			max-width: 800px;
			margin: auto;
			padding: 30px;
			border: 1px solid #eee;
			box-shadow: 0 0 10px rgba(0, 0, 0, .15);
			font-size: 16px;
			line-height: 24px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			color: #555;
		}

		.invoice-box table {
			width: 100%;
			line-height: inherit;
			text-align: left;
		}

		.invoice-box table td {
			padding: 5px;
			vertical-align: top;
		}

		.invoice-box table tr td:nth-child(2) {
			text-align: right;
		}

		.invoice-box table tr.top table td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.top table td.title {
			font-size: 45px;
			line-height: 45px;
			color: #333;
		}

		.invoice-box table tr.information table td {
			padding-bottom: 40px;
		}

		.invoice-box table tr.heading td {
			background: #eee;
			border-bottom: 1px solid #ddd;
			font-weight: bold;
		}

		.invoice-box table tr.details td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.item td {
			border-bottom: 1px solid #eee;
		}

		.invoice-box table tr.item.last td {
			border-bottom: none;
		}

		.invoice-box table tr.total td:nth-child(2) {
			border-top: 2px solid #eee;
			font-weight: bold;
		}

		@media only screen and (max-width: 600px) {
			.invoice-box table tr.top table td {
				width: 100%;
				display: block;
				text-align: center;
			}

			.invoice-box table tr.information table td {
				width: 100%;
				display: block;
				text-align: center;
			}
		}

		/** RTL **/
		.rtl {
			direction: rtl;
			font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
		}

		.rtl table {
			text-align: right;
		}

		.rtl table tr td:nth-child(2) {
			text-align: left;
		}
	</style>
</head>

<body>
	<!-- <h3 align="center">Theonlytutorials.com - See the tutorial here <a href="">Click Here</a></h3> -->

	<div class="invoice-box bgimg" id="canvas">
		<table cellpadding="0" cellspacing="0">
			<tr class="top">
				<td colspan="2">
					<table>
						<tr>
							<td class="title">
								<img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;">
							</td>

							<td>
								STT No.11-18-621<br>
								Created: 29 Juni 2019<br>
								<!-- Due: February 1, 2015 -->
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr class="information">
				<td colspan="2">
					<table>
						<tr>
							<td>
								Agen LionParcel : Batan Indah <br>
								Alamat<br>
								<!-- Sunnyville, CA 12345 -->
							</td>

							<td>
								<!-- Acme Corp.<br>
                                John Doe<br>
                                john@example.com -->
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr class="heading">
				<td style="color: red;">
					Detail Pengirim
				</td>

				<td>

				</td>
			</tr>

			<tr class="details">
				<td>
					Check
				</td>

				<td>
					1000
				</td>
			</tr>

			<tr class="heading" style="color: red;">
				<td>
					Informasi Product
				</td>

				<td>

				</td>
			</tr>

			<tr>
				<td>
					Jumlah
				</td>
				<!-- <td>
                    product
				</td> -->

				<td>
					Harga
				</td>
			</tr>


			<tr class="total">
				<td></td>

				<td>
					Total Harga: Rp $total
				</td>
			</tr>
		</table>
	</div>
	<!-- <p align="center">Drag the text and place it wherever you want on the picture</p> -->
	<script type="text/javascript">
		//get the div content
		div_content = document.querySelector("#canvas")
		//make it as html5 canvas
		html2canvas(div_content).then(function(canvas) {
			//change the canvas to jpeg image
			data = canvas.toDataURL('image/jpeg');

			//then call a super hero php to save the image
			save_img(data);
		});
		// };

		//to save the canvas image
		function save_img(data) {
			//ajax method.
			$.ajax({
					url: "<?php echo base_url('booking/save_jpg') ?> ",
					method: "POST", //First change type to method here
					data: data
					// Second add quotes on the value.
				},


				function(res) {
					//if the file saved properly, trigger a popup to the user.
					// location.href = document.URL + 'output/' + res + '.jpg';

				});
		}
	</script>
</body>

</html>