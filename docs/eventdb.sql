--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- Data for Name: mst_division; Type: TABLE DATA; Schema: public; Owner: eventdb
--

INSERT INTO mst_division VALUES ('FS-SB', 'Shoes and Bags', 1, NULL);
INSERT INTO mst_division VALUES ('FS-LDS', 'Ladies', 1, NULL);
INSERT INTO mst_division VALUES ('FS-MW', 'Menswear', 1, NULL);
INSERT INTO mst_division VALUES ('FS-BNK', 'Baby and Kids', 1, NULL);
INSERT INTO mst_division VALUES ('FS-ACC', 'Beauty and Acc', 1, NULL);


--
-- Data for Name: mst_template; Type: TABLE DATA; Schema: public; Owner: eventdb
--

INSERT INTO mst_template VALUES ('Y02', 'nike adidas', '
									<img src="http://localhost/ci_event/assets/img/yg_red.png" /><br />
									<p align="left">Bandung, #TGL_SURAT</p>
									<p align="left">
										<table border="0" style="font-size: 13px;">
											<tbody><tr>
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
										</tbody></table>
									</p>
									<p align="left">
										Kepada Yth,<br />
										Bapak / Ibu #TOWARD<br />
										#NAMA_SUPPLIER<br />
										#KOTA - #FAX
									</p>
									
									
									<p align="left">
										Dengan hormat,<br />
										Sehubungan dengan diadakannya pengajuan acara #JML_DISKON untuk produk #NAMA_BRAND
										dalam rangka #ABOUT, maka dengan ini kami menyetujui dengan ketentuan sebagai berikut :<br /></p>
								
', '
									<p align="left">
										Demikian informasi ini kami sampaikan, atas perhatian dan kerjasamanya yang baik
										kami ucapkan terima kasih.
									</p>
									<br />
									<table border="0" style="font-size: 13px;">
										<tbody><tr>
											<td width="30%">Hormat kami</td>
											<td width="30%">Mengetahui,</td>
											<td width="30%">Menyetujui</td>
										</tr>
										<tr><td colspan="3"><br /><br /><br /></td></tr>
										<tr>
											<td>#FIRST_SIGNATURE</td>
											<td>#SECOND_SIGNATURE</td>
											<td>#APPROVED_BY</td>
										</tr>
									</tbody></table>
									<br />
									<p align="left">
										cc. #CC
									</p>
									
								
', '
									<p align="left">
										NB: <br />
										* Acara dapat dihentikan sewaktu waktu jika evaluasi sales tidak menunjukkan hasil yang memuaskan.<br />
										* Surat perpanjangan acara harus kami terima paling lambat H-7 sebelum acara berakhir<br />
										* Apabila surat ini telah diterima dan ditandatangani harap difax kembali ke no. fax. 022-88884422.
									</p>
								
', 1, 'admin', '2015-08-24', NULL, NULL);
INSERT INTO mst_template VALUES ('S01', 'gior morento (s)', '
									<img src="http://localhost/ci_event/assets/img/yg_red.png" /><br />
									<p align="left">Bandung, #TGL_SURAT</p>
									<p align="left">
										<table border="0" style="font-size: 13px;">
											<tbody><tr>
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
										</tbody></table>
									</p>
									<p align="left">
										Kepada Yth,<br />
										Bapak / Ibu #TOWARD<br />
										#NAMA_SUPPLIER<br />
										#KOTA - #FAX
									</p>
									
									
									<p align="left">
										Dengan hormat,<br />
										Membalas surat Bapak / Ibu mengenai pengajuan acara discount #JML_DISKON untuk produk #NAMA_BRAND maka dengan ini kami menyetujui dengan ketentuan sebagai berikut :<br /></p>
								
', '
									<p align="left">
										Demikian informasi ini kami sampaikan, atas perhatian dan kerjasamanya yang baik
										kami ucapkan terima kasih.
									</p>
									<br />
									<table border="0" style="font-size: 13px;">
										<tbody><tr>
											<td width="30%">Hormat kami</td>
											<td width="30%">Mengetahui,</td>
											<td width="30%">Menyetujui</td>
										</tr>
										<tr><td colspan="3"><br /><br /><br /></td></tr>
										<tr>
											<td>#FIRST_SIGNATURE</td>
											<td>#SECOND_SIGNATURE</td>
											<td>#APPROVED_BY</td>
										</tr>
									</tbody></table>
									<br />
									<p align="left">
										cc. #CC
									</p>
									
								
', '
									<p align="left">
										NB: <br />
										* Acara dapat dihentikan sewaktu waktu jika evaluasi sales tidak menunjukkan hasil yang memuaskan.<br />
										* Surat perpanjangan acara harus kami terima paling lambat H-7 sebelum acara berakhir<br />
										* Apabila surat ini telah diterima dan ditandatangani harap difax kembali ke no. fax. 022-88884422.
									</p>
								
', 1, 'admin', '2015-08-24', NULL, NULL);
INSERT INTO mst_template VALUES ('S02', 'mels shoes (s)', '
									<img src="http://localhost/ci_event/assets/img/yg_red.png" /><br />
									<p align="left">Bandung, #TGL_SURAT</p>
									<p align="left">
										<table border="0" style="font-size: 13px;">
											<tbody><tr>
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
												<td>#ACARA_DISKON produk #NAMA_BRAND <br /></td>
											</tr>
										</tbody></table>
									</p>
									<p align="left">
										Kepada Yth,<br />
										Bapak / Ibu #TOWARD<br />
										#NAMA_SUPPLIER<br />
										#KOTA - #FAX
									</p>
									
									
									<p align="left">
										Dengan hormat,<br />
										Membalas surat Bapak / Ibu mengenai pengajuan acara discount #JML_DISKON untuk produk #NAMA_BRAND dengan ini kami menyetujui ketentuan sebagai berikut :<br /></p>
								
', '
									<p align="left">
										Demikian informasi ini kami sampaikan, atas perhatian dan kerjasamanya yang baik
										kami ucapkan terima kasih.
									</p>
									<br />
									<table border="0" style="font-size: 13px;">
										<tbody><tr>
											<td width="30%">Hormat kami</td>
											<td width="30%">Mengetahui,</td>
											<td width="30%">Menyetujui</td>
										</tr>
										<tr><td colspan="3"><br /><br /><br /></td></tr>
										<tr>
											<td>#FIRST_SIGNATURE</td>
											<td>#SECOND_SIGNATURE</td>
											<td>#APPROVED_BY</td>
										</tr>
									</tbody></table>
									<br />
									<p align="left">
										cc. #CC
									</p>
									
								
', '
									<p align="left">
										NB: <br />
										* Acara dapat dihentikan sewaktu waktu jika evaluasi sales tidak menunjukkan hasil yang memuaskan.<br />
										* Surat perpanjangan acara harus kami terima paling lambat H-7 sebelum acara berakhir<br />
										* Apabila surat ini telah diterima dan ditandatangani harap difax kembali ke no. fax. 022-88884422.
									</p>
								
', 1, 'admin', '2015-08-25', NULL, NULL);
INSERT INTO mst_template VALUES ('Y03', 'collete (y)', '
									<img src="http://localhost/ci_event/assets/img/yg_red.png" /><br />
									<p align="left">Bandung, #TGL_SURAT</p>
									<p align="left">
										<table border="0" style="font-size: 13px;">
											<tbody><tr>
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
												<td>#ACARA_DISKON produk #NAMA_BRAND<br /></td>
											</tr>
										</tbody></table>
									</p>
									<p align="left">
										Kepada Yth,<br />
										Bapak / Ibu #TOWARD<br />
										#NAMA_SUPPLIER<br />
										#KOTA - #FAX
									</p>
									
									
									<p align="left">
										Dengan hormat,<br />
										Sehubungan dengan diadakannya acara discount #JML_DISKON untuk produk #NAMA_BRAND maka dengan ini kami menyetujui dengan ketentuan sebagai berikut :<br /></p>
								
', '
									<p>#NOTES <br /></p><p align="left">Demikian informasi ini kami sampaikan, atas perhatian dan kerjasamanya yang baik
										kami ucapkan terima kasih.
									</p>
									<br />
									<table border="0" style="font-size: 13px;">
										<tbody><tr>
											<td width="30%">Hormat kami</td>
											<td width="30%">Mengetahui,</td>
											<td width="30%">Menyetujui</td>
										</tr>
										<tr><td colspan="3"><br /><br /><br /></td></tr>
										<tr>
											<td>#FIRST_SIGNATURE</td>
											<td>#SECOND_SIGNATURE</td>
											<td>#APPROVED_BY</td>
										</tr>
									</tbody></table>
									<br />
									<p align="left">
										cc. #CC
									</p>
									
								
', '
									<p align="left">
										NB: <br />
										* Acara dapat dihentikan sewaktu waktu jika evaluasi sales tidak menunjukkan hasil yang memuaskan.<br />
										* Surat perpanjangan acara harus kami terima paling lambat H-7 sebelum acara berakhir<br />
										* Apabila surat ini telah diterima dan ditandatangani harap difax kembali ke no. fax. 022-88884422.
									</p>
								
', 1, 'admin', '2015-08-25', NULL, NULL);
INSERT INTO mst_template VALUES ('S03', 'eagle (s)', '
									<img src="http://localhost/ci_event/assets/img/yg_red.png" /><br />
									<p align="left">Bandung, #TGL_SURAT</p>
									<p align="left">
										<table border="0" style="font-size: 13px;">
											<tbody><tr>
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
										</tbody></table>
									</p>
									<p align="left">
										Kepada Yth,<br />
										Bapak / Ibu #TOWARD<br />
										#NAMA_SUPPLIER<br />
										#KOTA - #FAX
									</p>
									
									
									<p align="left">
										Dengan hormat,<br />
										Membalas surat Bapak / Ibu mengenai pengajuan acara gelar barang #JML_DISKON untuk produk #NAMA_BRAND
										dalam rangka #ABOUT, kami menyetujui dengan ketentuan sebagai berikut :
									</p>
								
', '
									<p align="left">
										Demikian informasi ini kami sampaikan, atas perhatian dan kerjasamanya yang baik
										kami ucapkan terima kasih.
									</p>
									<br />
									<table border="0" style="font-size: 13px;">
										<tbody><tr>
											<td width="30%">Hormat kami</td>
											<td width="30%">Mengetahui,</td>
											<td width="30%">Menyetujui</td>
										</tr>
										<tr><td colspan="3"><br /><br /><br /></td></tr>
										<tr>
											<td>#FIRST_SIGNATURE</td>
											<td>#SECOND_SIGNATURE</td>
											<td>#APPROVED_BY</td>
										</tr>
									</tbody></table>
									<br />
									<p align="left">
										cc. #CC
									</p>
									
								
', '
									<p align="left">
										NB: <br />
										* Acara dapat dihentikan sewaktu waktu jika evaluasi sales tidak menunjukkan hasil yang memuaskan.<br />
										* Surat perpanjangan acara harus kami terima paling lambat H-7 sebelum acara berakhir<br />
										* Apabila surat ini telah diterima dan ditandatangani harap difax kembali ke no. fax. 022-88884422.
									</p>
								
', 1, 'admin', '2015-08-25', NULL, NULL);
INSERT INTO mst_template VALUES ('S04', 'yongki komaladi ladies (s)', '
									<img src="http://localhost/ci_event/assets/img/yg_red.png" /><br />
									<p align="left">Bandung, #TGL_SURAT</p>
									<p align="left">
										<table border="0" style="font-size: 13px;">
											<tbody><tr>
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
										</tbody></table>
									</p>
									<p align="left">
										Kepada Yth,<br />
										Bapak / Ibu #TOWARD<br />
										#NAMA_SUPPLIER<br />
										#KOTA - #FAX
									</p>
									
									
									<p align="left">
										Dengan hormat,<br />
										Membalas surat Bapak / Ibu mengenai pengajuan acara #JML_DISKON untuk produk #NAMA_BRAND
										dalam rangka, maka dengan ini kami menyetujui dengan ketentuan sebagai berikut :
									</p>
								
', '
									<p align="left">
										Demikian informasi ini kami sampaikan, atas perhatian dan kerjasamanya yang baik
										kami ucapkan terima kasih.
									</p>
									<br />
									<table border="0" style="font-size: 13px;">
										<tbody><tr>
											<td width="30%">Hormat kami</td>
											<td width="30%">Mengetahui,</td>
											<td width="30%">Menyetujui</td>
										</tr>
										<tr><td colspan="3"><br /><br /><br /></td></tr>
										<tr>
											<td>#FIRST_SIGNATURE</td>
											<td>#SECOND_SIGNATURE</td>
											<td>#APPROVED_BY</td>
										</tr>
									</tbody></table>
									<br />
									<p align="left">
										cc. #CC
									</p>
									
								
', '
									<p align="left">
										NB: <br />
										* Acara dapat dihentikan sewaktu waktu jika evaluasi sales tidak menunjukkan hasil yang memuaskan.<br />
										* Surat perpanjangan acara harus kami terima paling lambat H-7 sebelum acara berakhir<br />
										* Apabila surat ini telah diterima dan ditandatangani harap difax kembali ke no. fax. 022-88884422.
									</p>
								
', 1, 'admin', '2015-08-25', NULL, NULL);
INSERT INTO mst_template VALUES ('Y04', 'three rey and clowny (y)', '
									<img src="http://localhost/ci_event/assets/img/yg_red.png" /><br />
									<p align="left">Bandung, #TGL_SURAT</p>
									<p align="left">
										<table border="0" style="font-size: 13px;">
											<tbody><tr>
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
										</tbody></table>
									</p>
									<p align="left">
										Kepada Yth,<br />
										Bapak / Ibu #TOWARD<br />
										#NAMA_SUPPLIER<br />
										#KOTA - #FAX
									</p>
									
									
									<p align="left">
										Dengan hormat,<br />
										Sehubungan dengan diadakannya acara discount #JML_DISKON untuk produk #NAMA_BRAND
										dalam rangka #ABOUT, berikut kami informasikan ketentuan acara tersebut :
									</p>
								
', '
									<p>#NOTES <br /></p><p align="left">Demikian informasi ini kami sampaikan, atas perhatian dan kerjasamanya yang baik
										kami ucapkan terima kasih.
									</p>
									<br />
									<table border="0" style="font-size: 13px;">
										<tbody><tr>
											<td width="30%">Hormat kami</td>
											<td width="30%">Mengetahui,</td>
											<td width="30%">Menyetujui</td>
										</tr>
										<tr><td colspan="3"><br /><br /><br /></td></tr>
										<tr>
											<td>#FIRST_SIGNATURE</td>
											<td>#SECOND_SIGNATURE</td>
											<td>#APPROVED_BY</td>
										</tr>
									</tbody></table>
									<br />
									<p align="left">
										cc. #CC
									</p>
									
								
', '
									<p align="left">
										NB: <br />
										* Acara dapat dihentikan sewaktu waktu jika evaluasi sales tidak menunjukkan hasil yang memuaskan.<br />
										* Surat perpanjangan acara harus kami terima paling lambat H-7 sebelum acara berakhir<br />
										* Apabila surat ini telah diterima dan ditandatangani harap difax kembali ke no. fax. 022-88884422.
									</p>
								
', 1, 'admin', '2015-08-25', NULL, NULL);
INSERT INTO mst_template VALUES ('Y01', 'donatello (y)', '
									<img src="http://localhost/ci_event/assets/img/yg_red.png" /><br />
									<p align="left">Bandung, #TGL_SURAT</p>
									<p align="left">
										<table border="0" style="font-size: 13px;">
											<tbody><tr>
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
										</tbody></table>
									</p>
									<p align="left">
										Kepada Yth,<br />
										Bapak / Ibu #TOWARD<br />
										#NAMA_SUPPLIER<br />
										#KOTA - #FAX
									</p>
									
									
									<p align="left">
										Dengan hormat,<br />
										Sehubungan dengan diadakannya acara discount #JML_DISKON untuk produk #NAMA_BRAND
										dalam rangka #ABOUT, berikut kami informasikan ketentuan acara tersebut :
									</p>
								
', '
									<p align="left">
										Demikian informasi ini kami sampaikan, atas perhatian dan kerjasamanya yang baik
										kami ucapkan terima kasih.
									</p>
									<br />
									<table border="0" style="font-size: 13px;">
										<tbody><tr>
											<td width="30%">Hormat kami</td>
											<td width="30%">Mengetahui,</td>
											<td width="30%">Menyetujui</td>
										</tr>
										<tr><td colspan="3"><br /><br /><br /></td></tr>
										<tr>
											<td>#FIRST_SIGNATURE</td>
											<td>#SECOND_SIGNATURE</td>
											<td>#APPROVED_BY</td>
										</tr>
									</tbody></table>
									<br />
									<p align="left">
										cc. #CC
									</p>
									
								
', '
									<p align="left">
										NB: <br />
										* Acara dapat dihentikan sewaktu waktu jika evaluasi sales tidak menunjukkan hasil yang memuaskan.<br />
										* Surat perpanjangan acara harus kami terima paling lambat H-7 sebelum acara berakhir<br />
										* Apabila surat ini telah diterima dan ditandatangani harap difax kembali ke no. fax. 022-88884422.
									</p>
								
', 1, 'admin', '2015-08-21', NULL, NULL);


--
-- Data for Name: event; Type: TABLE DATA; Schema: public; Owner: eventdb
--

INSERT INTO event VALUES (1, '1783/YDS.P/FS-SB/VI/15', 'Acara discount 20% dan 20%+10%', 'Diskon Lebaran', '-', 'Yohanes / Harry', 'Fashion', 'FS-SB', 1, 'Y04', 'Esther Septiane', 'Susan', NULL, NULL, 'Jika ada acara diskon 20% disurat acara sebelumnya maka pertanggungan yang berlaku untuk periode 27 Juni dan 2 - 5 Juli 2015 adalah pertanggungan yang tertera dalam surat ini', 'Bapak Untara Hartono Somali, Fashion Director<br> Ibu Lucia Lisdawaty, Senior Merchandising Manager', 'admin', '2015-08-25', NULL, NULL, 0, '2015-08-26');


--
-- Data for Name: mst_brand; Type: TABLE DATA; Schema: public; Owner: eventdb
--

INSERT INTO mst_brand VALUES ('A02', 'ALLSPORTS', NULL, NULL, NULL, NULL);
INSERT INTO mst_brand VALUES ('N01', 'NIKE & ADIDAS GAB', NULL, NULL, NULL, NULL);
INSERT INTO mst_brand VALUES ('B01', 'BERTINI & A.ANTONIO', NULL, NULL, NULL, NULL);
INSERT INTO mst_brand VALUES ('A01', 'AIX AGGIO', NULL, NULL, NULL, NULL);
INSERT INTO mst_brand VALUES ('A03', 'AMANDA', NULL, NULL, NULL, NULL);
INSERT INTO mst_brand VALUES ('B02', 'BINGO', NULL, NULL, NULL, NULL);
INSERT INTO mst_brand VALUES ('B03', 'BORSA', NULL, NULL, NULL, NULL);
INSERT INTO mst_brand VALUES ('B04', 'BOSSWAY', NULL, NULL, NULL, NULL);
INSERT INTO mst_brand VALUES ('N02', 'NOCHE', NULL, NULL, NULL, NULL);
INSERT INTO mst_brand VALUES ('G01', 'GINO MARIANI', NULL, NULL, NULL, NULL);
INSERT INTO mst_brand VALUES ('G02', 'GIOR MORENTO', NULL, NULL, NULL, NULL);
INSERT INTO mst_brand VALUES ('L01', 'LES CATINO GROUP', NULL, NULL, NULL, NULL);
INSERT INTO mst_brand VALUES ('G03', 'GUCHI', NULL, NULL, NULL, NULL);
INSERT INTO mst_brand VALUES ('C01', 'Clowny', NULL, NULL, NULL, NULL);
INSERT INTO mst_brand VALUES ('T01', 'Three Rey', NULL, NULL, NULL, NULL);


--
-- Data for Name: mst_tillcode; Type: TABLE DATA; Schema: public; Owner: eventdb
--

INSERT INTO mst_tillcode VALUES ('93038768', 'A. ANTONIO, DISCOUNT 0%', 0, 0, NULL, 'FS-SB', 'B01', 0, 1, NULL, '706300');
INSERT INTO mst_tillcode VALUES ('93038775', 'A. ANTONIO, DISCOUNT 20%', 20, 0, NULL, 'FS-SB', 'B01', 0, 1, NULL, '706481');
INSERT INTO mst_tillcode VALUES ('93038805', 'A. ANTONIO, SPECIAL PRICE', 0, 0, NULL, 'FS-SB', 'B01', 1, 1, NULL, '706490');
INSERT INTO mst_tillcode VALUES ('93010498', 'ADIDAS ,DISCOUNT 0%', 0, 0, NULL, 'FS-SB', 'A02', 0, 1, NULL, '274860');
INSERT INTO mst_tillcode VALUES ('93010504', 'ADIDAS ,DISCOUNT 10%', 10, 0, NULL, 'FS-SB', 'A02', 0, 1, NULL, '274863');
INSERT INTO mst_tillcode VALUES ('93010573', 'ADIDAS ,SP', 0, 0, NULL, 'FS-SB', 'A02', 1, 1, NULL, '274866');
INSERT INTO mst_tillcode VALUES ('93040532', 'ADIDAS GAB, DISC 0%', 0, 0, NULL, 'FS-SB', 'N01', 0, 1, NULL, '728902');
INSERT INTO mst_tillcode VALUES ('93041331', 'ADIDAS GAB, DISC 20% + 10%', 20, 10, NULL, 'FS-SB', 'N01', 0, 1, NULL, '739972');
INSERT INTO mst_tillcode VALUES ('93040594', 'ADIDAS GAB, DISC 70%', 70, 0, NULL, 'FS-SB', 'N01', 0, 1, NULL, '728907');
INSERT INTO mst_tillcode VALUES ('93041263', 'ADIDAS GAB, DISC 80%', 80, 0, NULL, 'FS-SB', 'N01', 0, 1, NULL, '739505');
INSERT INTO mst_tillcode VALUES ('93040549', 'ADIDAS GAB, DISC 20%', 20, 0, NULL, 'FS-SB', 'N01', 0, 1, NULL, '728902');
INSERT INTO mst_tillcode VALUES ('93004060', 'THREE REY DISC 20%', 20, NULL, NULL, 'FS-SB', 'T01', 0, 1, NULL, '161408');
INSERT INTO mst_tillcode VALUES ('93005890', 'THREE REY DISC 20% + 10%', 20, 10, NULL, 'FS-SB', 'T01', 0, 1, NULL, '170289');
INSERT INTO mst_tillcode VALUES ('93013413', 'CLOWNY DISC 20%', 20, 0, NULL, 'FS-SB', 'C01', 0, 1, NULL, '274881');
INSERT INTO mst_tillcode VALUES ('93013420', 'CLOWNY DISC 20% + 10%', 20, 10, NULL, 'FS-SB', 'C01', 0, 1, NULL, '278914');


--
-- Data for Name: event_date; Type: TABLE DATA; Schema: public; Owner: eventdb
--

INSERT INTO event_date VALUES (1, '93004060', '2015-06-27', NULL);
INSERT INTO event_date VALUES (1, '93013413', '2015-06-27', NULL);
INSERT INTO event_date VALUES (1, '93004060', '2015-07-02', '2015-07-05');
INSERT INTO event_date VALUES (1, '93013413', '2015-07-02', '2015-07-05');
INSERT INTO event_date VALUES (1, '93005890', '2015-06-27', NULL);
INSERT INTO event_date VALUES (1, '93005890', '2015-07-04', NULL);
INSERT INTO event_date VALUES (1, '93013420', '2015-06-27', NULL);
INSERT INTO event_date VALUES (1, '93013420', '2015-07-04', NULL);


--
-- Data for Name: mst_category; Type: TABLE DATA; Schema: public; Owner: eventdb
--

INSERT INTO mst_category VALUES ('D2', 'Sepatu Anak', 'FS-SB', 1, NULL);
INSERT INTO mst_category VALUES ('D4', 'Bags', 'FS-SB', 1, NULL);
INSERT INTO mst_category VALUES ('D1', 'Sepatu Wanita', 'FS-SB', 1, NULL);
INSERT INTO mst_category VALUES ('D3', 'Sepatu Pria', 'FS-SB', 1, NULL);


--
-- Data for Name: mst_supplier; Type: TABLE DATA; Schema: public; Owner: eventdb
--

INSERT INTO mst_supplier VALUES ('A524', 'ALPHA OMEGA RETAILINDO, PT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO mst_supplier VALUES ('G142', 'GROOVY MUSTIKA SEJAHTERA, PT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO mst_supplier VALUES ('G282', 'GENERASI ANUGRAH BERKARYA, PT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO mst_supplier VALUES ('J167', 'JULIAR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO mst_supplier VALUES ('K419', 'KANINNA SHOES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO mst_supplier VALUES ('M423', 'MULTI GARMENJAYA, PT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO mst_supplier VALUES ('M567', 'MITRA SUKSES JAYATAMA, PT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO mst_supplier VALUES ('N259', 'NAGA JAYA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO mst_supplier VALUES ('P045', 'PANCADHARMA CENTRABHAKTI, PT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO mst_supplier VALUES ('S185', 'SEASONINDO ANUGRAH SEJAHTERA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO mst_supplier VALUES ('S877', 'SUMBER KREASI CIPTA PRATAMA, PT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO mst_supplier VALUES ('T208', 'TOP TORCH INTERNATIONAL, PT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO mst_supplier VALUES ('A377', 'THREE REY & CLOWNY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);


--
-- Data for Name: event_item; Type: TABLE DATA; Schema: public; Owner: eventdb
--

INSERT INTO event_item VALUES (1, '93004060', 'D1', '', 'A377', 10, 10, 1, 0, 32.5, 28.125, 1, 0);
INSERT INTO event_item VALUES (1, '93013413', 'D1', '', 'A377', 10, 10, 1, 0, 32.5, 28.125, 1, 0);
INSERT INTO event_item VALUES (1, '93005890', 'D1', '', 'A377', 14, 14, 1, 0, 32.5, 25.6900005, 1, 0);
INSERT INTO event_item VALUES (1, '93013420', 'D1', '', 'A377', 14, 14, 1, 0, 32.5, 25.6900005, 1, 0);


--
-- Data for Name: mst_location; Type: TABLE DATA; Schema: public; Owner: eventdb
--

INSERT INTO mst_location VALUES ('atr', 'Atrium', 1, NULL, NULL, NULL, NULL);
INSERT INTO mst_location VALUES ('cntr', 'Counter', 1, NULL, NULL, NULL, NULL);
INSERT INTO mst_location VALUES ('promo', 'Area  Promosi', 1, NULL, NULL, NULL, NULL);


--
-- Data for Name: mst_store; Type: TABLE DATA; Schema: public; Owner: eventdb
--

INSERT INTO mst_store VALUES ('165', 'ATP', 'TOSERBA GRIYA Antapani', 'JL. PURWAKARTA NO 140', 'Bandung', NULL, NULL, 1, NULL);
INSERT INTO mst_store VALUES ('149', 'BGI', 'TOSERBA YOGYA Bogor Indah', NULL, 'Bogor', NULL, NULL, 1, NULL);
INSERT INTO mst_store VALUES ('186', 'BJR', 'TOSERBA YOGYA Banjar', NULL, 'Banjar', NULL, NULL, 1, NULL);
INSERT INTO mst_store VALUES ('202', 'GTK', 'GRIYA TAMAN KOPO', NULL, 'Bandung', NULL, NULL, 1, NULL);
INSERT INTO mst_store VALUES ('157', 'KPM', 'TOSERBA YOGYA Kopo Mas', NULL, 'Bandung', NULL, NULL, 1, NULL);
INSERT INTO mst_store VALUES ('143', 'KPT', 'Yogya Kepatihan', 'Jl Kepatihan', 'Bandung', '123', NULL, 1, NULL);
INSERT INTO mst_store VALUES ('171', 'YRI', 'Yogya Riau Junction', 'Jl Riau', 'Bandung', NULL, NULL, 1, NULL);
INSERT INTO mst_store VALUES ('158', 'MJL', 'TOSERBA GRIYA Majalaya', NULL, 'Majalaya', NULL, NULL, 1, NULL);
INSERT INTO mst_store VALUES ('183', 'YCW', 'Yogya Ciwalk', NULL, 'Bandung', NULL, NULL, 1, NULL);
INSERT INTO mst_store VALUES ('205', 'YPC', 'YOGYA PLAZA CIMAHI', NULL, 'Cimahi', NULL, NULL, 1, NULL);


--
-- Data for Name: event_location; Type: TABLE DATA; Schema: public; Owner: eventdb
--



--
-- Data for Name: event_same_date; Type: TABLE DATA; Schema: public; Owner: eventdb
--



--
-- Data for Name: event_same_location; Type: TABLE DATA; Schema: public; Owner: eventdb
--

INSERT INTO event_same_location VALUES (1, '143', 'cntr');
INSERT INTO event_same_location VALUES (1, '171', 'cntr');
INSERT INTO event_same_location VALUES (1, '183', 'cntr');
INSERT INTO event_same_location VALUES (1, '165', 'cntr');


--
-- Name: event_seq; Type: SEQUENCE SET; Schema: public; Owner: eventdb
--

SELECT pg_catalog.setval('event_seq', 1, false);


--
-- Name: letter_no_a_seq; Type: SEQUENCE SET; Schema: public; Owner: eventdb
--

SELECT pg_catalog.setval('letter_no_a_seq', 1, false);


--
-- Name: letter_no_b_seq; Type: SEQUENCE SET; Schema: public; Owner: eventdb
--

SELECT pg_catalog.setval('letter_no_b_seq', 1, false);


--
-- Name: letter_no_c_seq; Type: SEQUENCE SET; Schema: public; Owner: eventdb
--

SELECT pg_catalog.setval('letter_no_c_seq', 1, false);


--
-- Name: letter_no_d_seq; Type: SEQUENCE SET; Schema: public; Owner: eventdb
--

SELECT pg_catalog.setval('letter_no_d_seq', 1, false);


--
-- Name: letter_no_e_seq; Type: SEQUENCE SET; Schema: public; Owner: eventdb
--

SELECT pg_catalog.setval('letter_no_e_seq', 1, false);


--
-- Data for Name: mst_user; Type: TABLE DATA; Schema: public; Owner: eventdb
--

INSERT INTO mst_user VALUES ('admin', 'a66abb5684c45962d887564f08346e8d', 'YRI', 'FS-MW', 1, 1, '2015-08-21');


--
-- PostgreSQL database dump complete
--

