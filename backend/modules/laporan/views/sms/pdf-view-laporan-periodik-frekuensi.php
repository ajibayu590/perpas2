<?php

// echo $sql;
?>

<div class="panel panel-default panel-body" style="font-family: times new roman; border:0px; margin:40px; margin-top:0px;" >

	<center style="text-align: center; font-weight: bold;">
		<p style="text-align: center; font-size: 14px">
			<?= yii::t('app','Laporan Frekuensi')?> <?= $LaporanPeriode ?><br> <?= yii::t('app','Pengiriman SMS Otomatis')?> <?= $LaporanPeriode2 ?>  <br> <?= yii::t('app','Berdasarkan')?> <?= $Berdasarkan ?>
			
		</p>
	</center>

	<center style="text-align: center; font-size: 11px;">	
		<table width="100%" border="1" class="table table-bordered" style="text-align: center; border-collapse: collapse; border: 1px solid black; font-size: 13px; font-family: times new roman;">
					<tr class="success">
						<td style="font-weight: bold;">
							No.
						</td>
						<td style="font-weight: bold;">
							<?php //if ($kriterias == 'data_entry'){ echo "Periode"; }
							//else{ echo "Periode Pendaftaran";} ?>
							<?= yii::t('app','Tanggal Pengiriman')?>
						</td>
						<td style="font-weight: bold;">
							<?= yii::t('app','Jumlah Anggota')?>
						</td>
						<td style="font-weight: bold;">
							<?= yii::t('app','Jumlah Koleksi')?>
						</td>
						<td style="font-weight: bold;">
							<?= yii::t('app','Jumlah Pesan Terkirim')?>
						</td>
						<td style="font-weight: bold;">
							<?= yii::t('app','Jumlah Pesan Gagal Terkirim')?>
						</td>
					</tr>
					<?php $i = 1; ?>
					<?php $JumlahAnggota = 0; ?>
					<?php $JumlahKoleksi = 0; ?>
					<?php $JumlahSukses = 0; ?>
					<?php $JumlahGagal = 0; ?>
					<?php foreach ($TableLaporan as $TableLaporan): ?>
						<tr>
							<td>
								<?= $i ?>
							</td>
							<td>
								<?= $TableLaporan['Periode'] ?>
							</td>
							<td>
								<?= $TableLaporan['jum_anggota'] ?>
							</td>
							<td>
								<?= $TableLaporan['jumlah_koleksi'] ?>
							</td>
							<td>
								<?= $TableLaporan['sukses_send'] ?>
							</td>
							<td>
								<?= $TableLaporan['gagal_send'] ?>
							</td>
						</tr>
						<?php $JumlahAnggota = $JumlahAnggota + $TableLaporan['jum_anggota']  ?>
						<?php $JumlahKoleksi = $JumlahKoleksi + $TableLaporan['jumlah_koleksi']  ?>
						<?php $JumlahSukses = $JumlahSukses + $TableLaporan['sukses_send']  ?>
						<?php $JumlahGagal = $JumlahGagal + $TableLaporan['gagal_send']  ?>
						<?php $i++ ?>
					<?php endforeach ?>
					<tr>
						<td colspan='2' style="font-weight: bold;">
							Total
						</td>
						<td style="font-weight: bold;">
							<?= $JumlahAnggota  ?>
						</td>
						<td style="font-weight: bold;">
							<?= $JumlahKoleksi  ?>
						</td>
						<td style="font-weight: bold;">
							<?= $JumlahSukses  ?>
						</td>
						<td style="font-weight: bold;">
							<?= $JumlahGagal  ?>
						</td>
					</tr>

				</table>

<!-- <?php print_r($TableLaporan); ?> -->


	</center>
</div>