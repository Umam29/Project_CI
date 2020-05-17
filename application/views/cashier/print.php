<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Print</title>
</head>
<body onload="window.print()">
	<div style="width: 300px; margin: auto;">
		<br>
		<center>
			<?php echo "Warung Ayu" ?><br>
			<?php echo "Jl. Trisula Suruhwadang, Telp. 082264488800" ?><br><br>
			<table width="100%">
				<tr>
					<td><?php echo $struck_no; ?></td>
					<td align="right"><?php echo $date; ?></td>
				</tr>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td width="50%"></td>
					<td width="3%"></td>
					<td width="10%" align="right"></td>
					<td align="right" width="17%"><?php echo $cashier; ?></td>
				</tr>
				<?php foreach ($cart as $key): ?>
					<tr>
						<td><?php echo $key['name']; ?></td>
						<td></td>
						<td align="right"><?php echo number_format($key['qty']); ?></td>
						<td align="right"><?php echo number_format($key['price'],2,',','.'); ?></td>
					</tr>
				<?php endforeach ?>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td width="76%" align="right">
						Harga Jual
					</td>
					<td width="23%" align="right">
						<?php echo number_format($total,2,',','.'); ?>
					</td>
				</tr>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td width="76%" align="right">
						Total
					</td>
					<td width="23%" align="right">
						<?php echo number_format($total,2,',','.'); ?>
					</td>
				</tr>
				<tr>
					<td width="76%" align="right">
						Bayar
					</td>
					<td width="23%" align="right">
						<?php echo number_format($payfee,2,',','.'); ?>
					</td>
				</tr>
				<tr>
					<td width="76%" align="right">
						Kembalian
					</td>
					<td width="23%" align="right">
						<?php echo number_format($change,2,',','.'); ?>
					</td>
				</tr>
			</table>
			<br>
			Terima Kasih <br>
			<?php echo  "Warung Ayu"; ?>
		</center>
	</div>
</body>
</html>