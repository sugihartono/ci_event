
<section id="main-content">
	<section class="wrapper">
		
		<h3><i class="fa fa-angle-right"></i> Data Template</h3>
		
		
		<div class="row mt">
			<div class="col-lg-12" style="padding-left:5px;padding-left:5px">
				<div class="form-panel" style="padding:30px 10px 10px 10px;">
					
					<?php echo $xinha_java; ?>
					
					<form action="<?php echo base_url(); ?>template/do_add_new" id="frm" name="frm" class="form-horizontal style-form" method="post">
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Event Source</label>
							<div class="col-sm-3">
								<select class="form-control" name="cb_source">
									<option value="Y">Yogya</option>
									<option value="S">Supplier</option>
								</select>
							</div>
							
							<label class="col-sm-1 col-sm-1 control-label-right">Name</label>
							<div class="col-sm-6 pad-right">
								<input type="text" class="form-control" id="txt_name" name="txt_name">
								<label id="txt_name-error" for="txt_name" style="color:red"></label>
							</div>
						</div>
						
						<!--------------------------------------------- header surat ----------------------------------------------->
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Header</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="txt_header" id="txt_header" rows="24">
									<img src="<?php echo base_url(); ?>assets/img/yg_red.png" /><br>
									<p align='left'>Bandung, #TGL_SURAT</p>
									<p align='left'>
										<table border='0'>
											<tr>
												<td>Nomor</td>
												<td>:</td>
												<td>#NOMOR_SURAT_ACARA</td>
											</tr>
											<tr>
												<td>Lamp</td>
												<td>:</td>
												<td>#LAMPIRAN</td>
											</tr>
											<tr>
												<td>Hal</td>
												<td>:</td>
												<td>#ACARA_DISKON produk #NAMA_BRAND #ABOUT</td>
											</tr>
										</table>
									</p>
									<p align='left'>
										Kepada Yth,</br>
										Bapak / Ibu #TOWARD</br>
										#NAMA_SUPPLIER</br>
										#KOTA - #FAX
									</p>
									<br>
									
									<p align='left'>
										Dengan hormat,<br>
										Sehubungan dengan diadakannya acara discount #JML_DISKON untuk produk #NAMA_BRAND
										dalam rangka #ABOUT, berikut kami informasikan ketentuan acara tersebut :
									</p>
								</textarea>
								<label id="txt_header-error" for="txt_header" style="color:red"></label>
							</div>
						</div>
						
						<!--------------------------------------------- footer surat ----------------------------------------------->
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Footer</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="txt_footer" id="txt_footer" rows="15">
									<p align='left'>
										Demikian informasi ini kami sampaikan, atas perhatian dan kerjasamanya yang baik
										kami ucapkan terima kasih.
									</p>
									<br>
									<table border='0'>
										<tr>
											<td width="30%">Hormat kami</td>
											<td width="30%">Mengetahui,</td>
											<td width="30%">Menyetujui</td>
										</tr>
										<tr><td colspan="3"><br><br><br></td></tr>
										<tr>
											<td>#FIRST_SIGNATURE</td>
											<td>#SECOND_SIGNATURE</td>
											<td>#APPROVED_BY</td>
										</tr>
									</table>
									<br>
									<p align='left'>
										cc. #CC
									</p>
									
								</textarea>
								<label id="txt_footer-error" for="txt_footer" style="color:red"></label>
							</div>
						</div>
						
						<!--------------------------------------------- notes surat ----------------------------------------------->
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Notes</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="txt_notes" id="txt_notes">
									<p align='left'>
										NB: <br>
										* Acara dapat dihentikan sewaktu waktu jika evaluasi sales tidak menunjukkan hasil yang memuaskan.<br>
										* Surat perpanjangan acara harus kami terima paling lambat H-7 sebelum acara berakhir<br>
										* Apabila surat ini telah diterima dan ditandatangani harap difax kembali ke no. fax. 022-88884422.
									</p>
								</textarea>
								<label id="txt_notes-error" for="txt_notes" style="color:red"></label>
							</div>
						</div>
						
						<div class="divider"></div>
						
						<div class="form-group">
							<div class="col-sm-12">
								<button class="btn btn-theme02" type="submit">
									<i class="fa fa-save"></i> <?php echo SAVE_CAPTION; ?>
								</button>
								<button class="btn btn-success" type="reset">
									<i class="fa fa-rotate-left"></i>
									<?php echo CANCEL_CAPTION; ?>
								</button>
							</div>
						</div>
						
					</form>
						
						
				</div><!-- /content-panel -->
			</div><!-- /col-lg-12 -->			
						
						
						
						
												