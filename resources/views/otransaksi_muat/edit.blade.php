@extends('layouts.main')

<style>
    .card {

    }

    .form-control:focus {
        background-color: #b5e5f9 !important;
    }

	.table-scrollable {
		margin: 0;
		padding: 0;
	}

	table {
		table-layout: fixed !important;
	}

	.uppercase {
		text-transform: uppercase;
	}

</style>

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{($tipx=='new')? url('/muat/store?flagz='.$flagz.'&golz='.$golz.'') : url('/muat/update/'.$header->NO_ID.'&flagz='.$flagz.'&golz='.$golz.'' ) }}" method="POST" name ="entri" id="entri" >
  
                        @csrf
                        <div class="tab-content mt-3">
                            <div class="form-group row">
                                <div class="col-md-1" align="right">
                                    <label for="NO_BUKTI" class="form-label">Bukti#</label>
                                </div>
								

                                   <input type="text" class="form-control NO_ID" id="NO_ID" name="NO_ID"
                                    placeholder="Masukkan NO_ID" value="{{$header->NO_ID ?? ''}}" hidden readonly>

									<input name="tipx" class="form-control tipx" id="tipx" value="{{$tipx}}" hidden>
									<input name="flagz" class="form-control flagz" id="flagz" value="{{$flagz}}" hidden>
									<input name="golz" class="form-control golz" id="golz" value="{{$golz}}" hidden>

								
								
                                <div class="col-md-2">
                                    <input type="text" class="form-control NO_BUKTI" id="NO_BUKTI" name="NO_BUKTI"
                                    placeholder="Masukkan Bukti#" value="{{$header->NO_BUKTI}}" readonly>
                                </div>

                                <div class="col-md-1" align="right">
                                    <label for="TGL" class="form-label">Tgl</label>
                                </div>
                                <div class="col-md-2">
								  <input class="form-control date" id="TGL" name="TGL" data-date-format="dd-mm-yyyy" type="text" autocomplete="off" value="{{date('d-m-Y',strtotime($header->TGL))}}">
                                </div>
								
                            </div>

							<div class="form-group row">

								<div class="col-md-1" align="right">
									<label style="color:red">*</label>									
									<label for="NO_BELI" class="form-label">No Beli</label>
								</div>
								<div class="col-md-2 input-group" >
								<input type="text" class="form-control NO_BELI" id="NO_BELI" name="NO_BELI" placeholder="Pilih Beli"value="{{$header->NO_BELI}}" style="text-align: left" readonly >
								<button type="button" class="btn btn-primary" onclick="browseBeli()"><i class="fa fa-search"></i></button>
								</div>
							</div>

                            <div class="form-group row">

								<div class="col-md-1" align="right">
									<!-- <label style="color:red">*</label>									 -->
                                    <label for="NO_PO" class="form-label">No PO</label>
                                </div>
                               	<div class="col-md-2 input-group" >
                                  <input type="text" class="form-control NO_PO" id="NO_PO" name="NO_PO" placeholder="Pilih PO"value="{{$header->NO_PO}}" style="text-align: left" readonly >
        						</div>
                            </div>
							
                            <div class="form-group row">
								<div class="col-md-1" align="right">
                                    <label for="KD_BRG" class="form-label">Barang</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control KD_BRG" id="KD_BRG" name="KD_BRG" placeholder="-" value="{{$header->KD_BRG}}"readonly>
                                </div>
								<div class="col-md-3">
                                    <input type="text" class="form-control NA_BRG" id="NA_BRG" name="NA_BRG" placeholder="-" value="{{$header->NA_BRG}}" readonly>
                                </div>
                            </div>
							


							
                            <div class="form-group row">

								<div class="col-md-1" align="right">
                                    <label for="QTY_BELI" class="form-label"> Qty Beli</label>
                                </div>
								<div class="col-md-2">
									<input type="text" onclick="select()" class="form-control QTY_BELI" id="QTY_BELI" name="QTY_BELI" placeholder="" 
									value="{{ number_format( $header->QTY_BELI, 0, '.', ',') }}" style="text-align: right" >
								</div>
                            </div>
							
							
                            <hr style="margin-top: 30px; margin-buttom: 30px">
							
							<div style="overflow-y:scroll;" class="col-md-12 scrollable" align="right">

								<table id="datatable" class="table table-striped table-border">

									<thead>
										<tr>
										<th width="100px" style="text-align:center">No.</th>
											<th width="200px" style="text-align:center">No Container</th>
											<th width="200px" style="text-align:center">Sopir</th>

											<th width="200px" style="text-align:center">Nopol</th>

											<th width="200px" style="text-align:center">Telp</th>
											<th width="200px" style="text-align:center">Seal</th>  

											<th width="200px" style="text-align:center">T_Cont</th>
											<th width="200px" style="text-align:center">Qty</th>
											<th></th>
																
										</tr>
									<tbody id="detailPod">
			
									<tbody>
									<?php $no=0 ?>
									@foreach ($detail as $detail)		
										<tr>
											<td>
												<input type="hidden" name="NO_ID[]{{$no}}" id="NO_ID" type="text" value="{{$detail->NO_ID}}" 
												class="form-control NO_ID" onkeypress="return tabE(this,event)" readonly>
												
												<input name="REC[]" id="REC{{$no}}" type="text" value="{{$detail->REC}}" class="form-control REC" onkeypress="return tabE(this,event)" readonly style="text-align:center">
											</td>

											<td>
												<input name="NO_CONT[]" id="NO_CONT{{$no}}" type="text" class="form-control NO_CONT" value="{{$detail->NO_CONT}}">
											</td>
											<td>
												<input name="SOPIR[]" id="SOPIR{{$no}}" type="text" class="form-control SOPIR" value="{{$detail->SOPIR}}">
											</td>
											<td>
												<input name="NOPOL[]" id="NOPOL{{$no}}" type="text" class="form-control NOPOL" value="{{$detail->NOPOL}}">
											</td>
											<td>
												<input name="TELP[]" id="TELP{{$no}}" type="text" class="form-control TELP" value="{{$detail->TELP}}">
											</td>	
											<td>
												<input name="SEAL[]" id="SEAL{{$no}}" type="text" class="form-control SEAL" value="{{$detail->SEAL}}">
											</td>									
											<td>
												<input name="T_CONT[]" onclick="select()" onblur="hitung()" value="{{$detail->T_CONT}}" id="T_CONT{{$no}}" type="text" style="text-align: right"  class="form-control T_CONT" >
											</td>								
											<td>
												<input name="QTY[]" onclick="select()" onblur="hitung()" value="{{$detail->QTY}}" id="QTY{{$no}}" type="text" style="text-align: right"  class="form-control QTY" >
											</td> 
											
											<td>
												<button type='button' id='DELETEX{{$no}}'  class='btn btn-sm btn-circle btn-outline-danger btn-delete' onclick=''> <i class='fa fa-fw fa-trash'></i> </button>
											</td> 

										</tr>
									
									<?php $no++; ?>
									@endforeach
									</tbody>

									<tfoot>
										<td></td>
										<td></td>									
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td><input class="form-control TOTAL_QTY  text-primary" style="text-align: right"  id="TOTAL_QTY" name="TOTAL_QTY" value="{{$header->TOTAL_QTY}}" readonly></td>
										<td></td>
										
										<!-- <td><input class="form-control TTOTAL  text-primary" style="text-align: right"  id="TTOTAL" name="TTOTAL" value="{{$header->TOTAL}}" readonly></td> -->
										<td></td>
									</tfoot>
								</table>
							</div>

                            <div class="col-md-2 row">
                               <a type="button" id='PLUSX' onclick="tambah()" class="fas fa-plus fa-sm md-3" style="font-size: 20px" ></a>
					
							</div>	
							
                        </div> 

                        
						   
						<div class="mt-3 col-md-12 form-group row">
							<div class="col-md-4">
								<button type="button" id='TOPX'  onclick="location.href='{{url('/muat/edit/?idx=' .$idx. '&tipx=top&flagz='.$flagz.'&golz='.$golz.'' )}}'" class="btn btn-outline-primary">Top</button>
								<button type="button" id='PREVX' onclick="location.href='{{url('/muat/edit/?idx='.$header->NO_ID.'&tipx=prev&flagz='.$flagz.'&golz='.$golz.'&buktix='.$header->NO_BUKTI )}}'" class="btn btn-outline-primary">Prev</button>
								<button type="button" id='NEXTX' onclick="location.href='{{url('/muat/edit/?idx='.$header->NO_ID.'&tipx=next&flagz='.$flagz.'&golz='.$golz.'&buktix='.$header->NO_BUKTI )}}'" class="btn btn-outline-primary">Next</button>
								<button type="button" id='BOTTOMX' onclick="location.href='{{url('/muat/edit/?idx=' .$idx. '&tipx=bottom&flagz='.$flagz.'&golz='.$golz.'' )}}'" class="btn btn-outline-primary">Bottom</button>
							</div>
							<div class="col-md-5">
								<button type="button" id='NEWX' onclick="location.href='{{url('/muat/edit/?idx=0&tipx=new&flagz='.$flagz.'&golz='.$golz.'' )}}'" class="btn btn-warning">New</button>
								<button type="button" id='EDITX' onclick='hidup()' class="btn btn-secondary">Edit</button>                    
								<button type="button" id='UNDOX' onclick="location.href='{{url('/muat/edit/?idx=' .$idx. '&tipx=undo&flagz='.$flagz.'&golz='.$golz.'' )}}'" class="btn btn-info">Undo</button>  
								<button type="button" id='SAVEX' onclick='simpan()'   class="btn btn-success" class="fa fa-save"></i>Save</button>

							</div>
							<div class="col-md-3">
								<button type="button" id='HAPUSX'  onclick="hapusTrans()" class="btn btn-outline-danger">Hapus</button>
								<button type="button" id='CLOSEX'  onclick="location.href='{{url('/muat?flagz='.$flagz.'&golz='.$golz.'' )}}'" class="btn btn-outline-secondary">Close</button>
							</div>
						</div>
						
						
                    </form>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>


 	<div class="modal fade" id="browsePoModal" tabindex="-1" role="dialog" aria-labelledby="browsePoModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="browsePoModalLabel">Cari Po</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table table-stripped table-bordered" id="table-bpo">
				<thead>
					<tr>
						<th>PO#</th>
						<th>Suplier</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Kota</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>

	<div class="modal fade" id="browseBeliModal" tabindex="-1" role="dialog" aria-labelledby="browseBeliModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="browseBeliModalLabel">Cari Pembelian</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table table-stripped table-bordered" id="table-bbeli">
				<thead>
					<tr>
						<th>No Beli</th>
						<th>No PO</th>
						<th>Barang</th>
						<th>Qty</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>


	<div class="modal fade" id="browseBarangModal" tabindex="-1" role="dialog" aria-labelledby="browseBarangModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="browseBarangModalLabel">Cari Item</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table table-stripped table-bordered" id="table-bbarang">
				<thead>
					<tr>
						<th>Item#</th>
						<th>Nama</th>
						<th>Satuan</th>
						<th>Qty</th>
						<th>Kirim</th>
						<th>Sisa</th>
						<th>Harga</th>	
							
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>


	<div class="modal fade" id="browseBahanModal" tabindex="-1" role="dialog" aria-labelledby="browseBahanModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="browseBahanModalLabel">Cari Item</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table table-stripped table-bordered" id="table-bbahan">
				<thead>
					<tr>
						<th>Item#</th>
						<th>Nama</th>
						<th>Satuan</th>
						<th>Qty</th>
						<th>Kirim</th>
						<th>Sisa</th>
						<th>Harga</th>	
						
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	
	
	

@endsection

@section('footer-scripts')
<script src="{{ asset('js/autoNumerics/autoNumeric.min.js') }}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="{{asset('foxie_js_css/bootstrap.bundle.min.js')}}"></script>

<script>
	var idrow = 1;
	var baris = 1;

	function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}
	
    $(document).ready(function () {
    idrow=<?=$no?>;
    baris=<?=$no?>;

		$('body').on('keydown', 'input, select', function(e) {
			if (e.key === "Enter") {
				var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
				focusable = form.find('input,select,textarea').filter(':visible');
				next = focusable.eq(focusable.index(this)+1);
				console.log(next);
				if (next.length) {
					next.focus().select();
				} else {
					tambah();
					// var nomer = idrow-1;
					// console.log("NO_CONT"+nomor);
					// document.getElementById("NO_CONT"+nomor).focus();
					// form.submit();
				}
				return false;
			}
		});


		$tipx = $('#tipx').val();
		$searchx = $('#CARI').val();
		
		
        if ( $tipx == 'new' )
		{
			 baru();
             tambah();				 
		}

        if ( $tipx != 'new' )
		{
			 ganti();			
		}    
		
		$("#TOTAL_QTY").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999.99'});
		$("#QTY_BELI").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999.99'});



		jumlahdata = 100;
		for (i = 0; i <= jumlahdata; i++) {
			
			$("#T_CONT" + i.toString()).autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
			$("#QTY" + i.toString()).autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
		}	


		
        $('body').on('click', '.btn-delete', function() {
			var val = $(this).parents("tr").remove();
			baris--;
			nomor();
			
		});

		$('.date').datepicker({  
            dateFormat: 'dd-mm-yy'
		});
		
		
 	
		
//		CHOOSE Po
 		var dTableBPo;
		loadDataBPo = function(){
		
			$.ajax(
			{
				type: 'GET', 		
				url: '{{url('po/browse')}}',
				data: {
					'GOL': "{{$golz}}",
				},

				success: function( response )
				{
					resp = response;
					if(dTableBPo){
						dTableBPo.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBPo.row.add([
							'<a href="javascript:void(0);" onclick="choosePo(\''+resp[i].NO_BUKTI+'\' ,\''+resp[i].KODES+'\',  \''+resp[i].NAMAS+'\', \''+resp[i].ALAMAT+'\',  \''+resp[i].KOTA+'\',  \''+resp[i].PKP+'\')">'+resp[i].NO_BUKTI+'</a>',
							resp[i].KODES,
							resp[i].NAMAS,
							resp[i].ALAMAT,
							resp[i].KOTA,
						]);
					}
					dTableBPo.draw();
				}
			});
		}
		
		dTableBPo = $("#table-bpo").DataTable({
			
		});
		
		browsePo = function(){
			loadDataBPo();
			$("#browsePoModal").modal("show");

		}
		
		choosePo = function( NO_BUKTI,KODES,NAMAS, ALAMAT, KOTA, PKP){

			$("#NO_PO").val(NO_BUKTI);
			$("#KODES").val(KODES);
			$("#NAMAS").val(NAMAS);
			$("#ALAMAT").val(ALAMAT);
			$("#KOTA").val(KOTA);			
			$("#PKP").val(PKP);			
			$("#browsePoModal").modal("hide");
			
			getPod(NO_BUKTI);
		}
		
		$("#NO_PO").keypress(function(e){

			if(e.keyCode == 46){
				 e.preventDefault();
				 browsePo();
			}
		}); 

////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////

	// function getPod(bukti)
	// {
		
	// 	var mulai = (idrow==baris) ? idrow-1 : idrow;

	// 	$.ajax(
	// 		{
	// 			type: 'GET',    
	// 			url: "{{url('po/browse_pod')}}",
	// 			data: {
	// 				nobukti: bukti,
	// 				'GOL': "{{$golz}}",
	// 			},
	// 			success: function( resp )
	// 			{
	// 				var html = '';
	// 				for(i=0; i<resp.length; i++){
	// 					html+=`<tr>
    //                                 <td><input name='REC[]' id='REC${i}' value=${resp[i].REC+1} type='text' class='REC form-control' onkeypress='return tabE(this,event)' readonly></td>
                                    
	// 								<td {{( $golz =='B') ? '' : 'hidden' }} >
	// 				 			    	<input name='KD_BHN[]' id='KD_BHN${i}' value="${resp[i].KD_BHN}" type='text' class='form-control KD_BHN' readonly>
	// 					            </td>
	// 					            <td {{( $golz =='B') ? '' : 'hidden' }} >
	// 					 				<input name='NA_BHN[]' id='NA_BHN${i}' value="${resp[i].NA_BHN}" type='text' class='form-control  NA_BHN' readonly>
	// 					            </td>

	// 								<td {{( $golz =='J' || $golz =='N') ? '' : 'hidden' }} >
	// 									<input name='KD_BRG[]' id='KD_BRG${i}' value="${resp[i].KD_BRG}" type='text' class='form-control KD_BRG' readonly>
	// 					            </td>
	// 					            <td {{( $golz =='J' || $golz =='N') ? '' : 'hidden' }} >
	// 					 			    <input name='NA_BRG[]' id='NA_BRG${i}' value="${resp[i].NA_BRG}" type='text' class='form-control  NA_BRG' readonly>
	// 					            </td>
									
	// 								<td><input name='SATUAN_PO[]' id='SATUAN_PO${i}' value="${resp[i].SATUAN_PO}" type='text' class='form-control  SATUAN_PO' readonly></td>
    //                                 <td>
	// 									<input name='QTY_PO[]' onclick='select()' onblur='hitung()' id='QTY_PO${i}' value="${resp[i].QTY_PO}" type='text' style='text-align: right' class='form-control QTY_PO text-primary' readonly >
	// 								</td>
    //                                 <td>
	// 									<input name='KALI[]' onclick='select()' onblur='hitung()' id='KALI${i}' value="${resp[i].KALI}" type='text' style='text-align: right' class='form-control KALI text-primary'> 
	// 								</td>
	// 								<td><input name='SATUAN[]' id='SATUAN${i}' value="${resp[i].SATUAN}" type='text' class='form-control  SATUAN' readonly></td>
    //                                 <td>
	// 									<input name='QTY[]' onclick='select()' onblur='hitung()' id='QTY${i}' value="${resp[i].QTY}" type='text' style='text-align: right' class='form-control QTY text-primary' readonly >
	// 								</td>
	// 								<td>
	// 									<input name='HARGA[]' onclick='select()' onblur='hitung()' id='HARGA${i}' value="${resp[i].HARGA}" type='text' style='text-align: right' class='form-control HARGA text-primary' >
	// 								</td>
	// 								<td>
	// 									<input name='TOTAL[]' onclick='select()' onblur='hitung()' id='TOTAL${i}' value="${resp[i].TOTAL}" type='text' style='text-align: right' class='form-control TOTAL text-primary' readonly >
	// 								</td>
	// 								<td>
	// 									<input name='PPNX[]' onclick='select()' onblur='hitung()' id='PPNX${i}' value="0" type='text' style='text-align: right' class='form-control PPNX text-primary' readonly >
	// 								</td>
	// 								<td>
	// 									<input name='DPP[]' onclick='select()' onblur='hitung()' id='DPP${i}' value="0" type='text' style='text-align: right' class='form-control DPP text-primary' readonly >
	// 								</td>
	// 								<td><input name='KET[]' id='KET${i}' value="" type='text' class='form-control  KET'></td>
                                    

	// 								<td><button type='button' class='btn btn-sm btn-circle btn-outline-danger btn-delete' onclick=''> <i class='fa fa-fw fa-trash'></i> </button></td>
    //                             </tr>`;
	// 				}
	// 				$('#detailPod').html(html);

	// 				$(".QTY_PO").autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
	// 				$(".QTY_PO").autoNumeric('update');

	// 				$(".QTY").autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
	// 				$(".QTY").autoNumeric('update');
					
	// 				$(".HARGA").autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
	// 				$(".HARGA").autoNumeric('update');
					
	// 				$(".KALI").autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
	// 				$(".KALI").autoNumeric('update');
					
	// 				$(".TOTAL").autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
	// 				$(".TOTAL").autoNumeric('update');
					
	// 				$(".PPNX").autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
	// 				$(".PPNX").autoNumeric('update');
					
	// 				$(".DPP").autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
	// 				$(".DPP").autoNumeric('update');


	// 				idrow=resp.length;
	// 				baris=resp.length;

	// 				nomor();
	// 				hitung();
	// 			}
	// 		});
	// }

//////////////////////////////////////////////////////////////////

//		CHOOSE Beli
		var dTableBBeli;
		loadDataBBeli = function(){
		
			$.ajax(
			{
				type: 'GET', 		
				url: '{{url('beli/browse')}}',
				data: {
					'GOL': "{{$golz}}",
				},

				success: function( response )
				{
					resp = response;
					if(dTableBBeli){
						dTableBBeli.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBBeli.row.add([
							'<a href="javascript:void(0);" onclick="chooseBeli(\''+resp[i].NO_BUKTI+'\', \''+resp[i].NO_PO+'\' ,\''+resp[i].KD_BRG+'\',  \''+resp[i].NA_BRG+'\', \''+resp[i].QTY+'\' )">'+resp[i].NO_BUKTI+'</a>',
							resp[i].NO_PO,
							resp[i].NA_BRG,
							resp[i].QTY,
						]);
					}
					dTableBBeli.draw();
				}
			});
		}
		
		dTableBBeli = $("#table-bbeli").DataTable({
			
		});
		
		browseBeli = function(){
			loadDataBBeli();
			$("#browseBeliModal").modal("show");
		}
		
		chooseBeli = function( NO_BUKTI, NO_PO, KD_BRG, NA_BRG, QTY){

			$("#NO_BELI").val(NO_BUKTI);
			$("#NO_PO").val(NO_PO);
			$("#KD_BRG").val(KD_BRG);
			$("#NA_BRG").val(NA_BRG);
			$("#QTY_BELI").val(QTY);			
			$("#browseBeliModal").modal("hide");
			
			// getPod(NO_PO);
		}
		
		$("#NO_BELI").keypress(function(e){

			if(e.keyCode == 46){
				 e.preventDefault();
				 browseBeli();
			}
		}); 

////////////////////////////////////////////////////////////////////

		//CHOOSE Bahan
		var dTableBBahan;
		var rowidBahan;
		loadDataBBahan = function(){
			$.ajax(
			{
				type: 'GET',    
				url: "{{url('po/browse_detail')}}",
				data: 
				{
                    KD_BHN : $("#KD_BHN"+rowidBahan).val(),
                    NO_PO : $("#NO_PO").val(), 					
				},
				success: function( response )
				{
					resp = response;
					if(dTableBBahan){
						dTableBBahan.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBBahan.row.add([
							'<a href="javascript:void(0);" onclick="chooseBahan(\''+resp[i].KD_BHN+'\',\''+resp[i].NA_BHN+'\', \''+resp[i].SATUAN_PO+'\' , \''+resp[i].QTY_PO+'\', \''+resp[i].KIRIM+'\' , \''+resp[i].SISA+'\' , \''+resp[i].HARGA+'\' , \''+resp[i].SATUAN+'\', \''+resp[i].QTY+'\', \''+resp[i].KALI+'\' )">'+resp[i].KD_BHN+'</a>',
							resp[i].NA_BHN,
							resp[i].SATUAN_PO,
							resp[i].QTY_PO,
							resp[i].KIRIM,
							resp[i].SISA,
							resp[i].HARGA,
							
						]);
					}
					dTableBBahan.draw();
				}
			});
		}
		
		dTableBBahan = $("#table-bbahan").DataTable({
			
		});
		
		browseBahan = function(rid){
			rowidBahan = rid;
			loadDataBBahan();
			$("#browseBahanModal").modal("show");
		}
		
		chooseBahan = function(KD_BHN, NA_BHN, SATUAN_PO, QTY_PO, KIRIM, SISA, HARGA, SATUAN, QTY, KALI ){
			$("#KD_BHN"+rowidBahan).val(KD_BHN);
			$("#NA_BHN"+rowidBahan).val(NA_BHN);
			$("#SATUAN_PO"+rowidBahan).val(SATUAN_PO);
			$("#QTY_PO"+rowidBahan).val(SISA);
			$("#HARGA"+rowidBahan).val(HARGA);
			$("#SATUAN"+rowidBahan).val(SATUAN);
			$("#QTY"+rowidBahan).val(QTY);
			$("#KALI"+rowidBahan).val(KALI);
			hitung();
			
			
			$("#browseBahanModal").modal("hide");
		}
		
		
		$("#KD_BHN0").keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browseBahan(0);
			}
		}); 

//////////////////////////////////////////////////////////////////////
		
		var dTableBBarang;
		var rowidBarang;
		loadDataBBarang = function(){
			$.ajax(
			{
				type: 'GET',    
				url: "{{url('po/browse_detail2')}}",
				data: 
				{
                    KD_BRG : $("#KD_BRG"+rowidBarang).val(),
                    NO_PO : $("#NO_PO").val(), 					
				},				
				
				success: function( response )
				{
					resp = response;
					if(dTableBBarang){
						dTableBBarang.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBBarang.row.add([
							'<a href="javascript:void(0);" onclick="chooseBarang(\''+resp[i].KD_BRG+'\',\''+resp[i].NA_BRG+'\', \''+resp[i].SATUAN_PO+'\' , \''+resp[i].QTY_PO+'\' , \''+resp[i].KIRIM+'\' , \''+resp[i].SISA+'\' , \''+resp[i].HARGA+'\', \''+resp[i].SATUAN+'\', \''+resp[i].QTY+'\', \''+resp[i].KALI+'\'  )">'+resp[i].KD_BRG+'</a>',
							resp[i].NA_BRG,
							resp[i].SATUAN_PO,
							resp[i].QTY_PO,
							resp[i].KIRIM,
							resp[i].SISA,
							resp[i].HARGA,							
						]);
					}
					dTableBBarang.draw();
				}
			});
		}
		
		dTableBBarang = $("#table-bbarang").DataTable({
			
		});
		
		browseBarang = function(rid){
			rowidBarang = rid;
			loadDataBBarang();
			$("#browseBarangModal").modal("show");
		}
		
		chooseBarang = function(KD_BRG, NA_BRG, SATUAN_PO, QTY_PO, KIRIM, SISA, HARGA, SATUAN, QTY, KALI ){
			$("#KD_BRG"+rowidBarang).val(KD_BRG);
			$("#NA_BRG"+rowidBarang).val(NA_BRG);
			$("#SATUAN_PO"+rowidBarang).val(SATUAN_PO);
			$("#QTY_PO"+rowidBarang).val(SISA);
			$("#HARGA"+rowidBarang).val(HARGA);
			$("#SATUAN"+rowidBarang).val(SATUAN);			
			$("#QTY"+rowidBarang).val(QTY);			
			$("#KALI"+rowidBarang).val(KALI);			
			$("#browseBarangModal").modal("hide");
			hitung();
		}
		
		
		$("#KD_BRG0").keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browseBarang(0);
			}
		}); 

	});


///////////////////////////////////////		
    



	function cekDetail(){
		var cekBahan = '';
		$(".KD_BHN").each(function() {
			
			let z = $(this).closest('tr');
			var KD_BHNX = z.find('.KD_BHN').val();
			
			if( KD_BHNX =="" )
			{
					cekBahan = '1';
					
			}	
		});
		
		return cekBahan;
	}


 	function simpan() {
		hitung();
		
		var tgl = $('#TGL').val();
		var bulanPer = {{session()->get('periode')['bulan']}};
		var tahunPer = {{session()->get('periode')['tahun']}};
		
        var check = '0';
		
		
		
			// if (cekDetail())
			// {	
			//     check = '1';
			// 	alert("#Bahan ada yang kosong. ")
			// }

			if ( $('#KD_BRG').val()=='' ) 
            {				
			    check = '1';
				alert("Bahan# Harus Diisi.");
			}

			if ( $('#KD_BHN').val()=='' ) 
            {				
			    check = '1';
				alert("Bahan# Harus Diisi.");
			}
			
			// if ( $('#NO_BUKTI').val()=='' ) 
            // {				
			//     check = '1';
			// 	alert("Bukti# Harus Diisi.");
			// }
			
			if ( $('#KODES').val()=='' ) 
            {				
			    check = '1';
				alert("Suplier# Harus Diisi.");
			}
			
			if ( tgl.substring(3,5) != bulanPer ) 
			{
				check = '1';
				alert("Bulan tidak sama dengan Periode");
			}	
			

			if ( tgl.substring(tgl.length-4) != tahunPer )
			{
				check = '1';
				alert("Tahun tidak sama dengan Periode");
		    }	 
			
			if (baris==0)
			{
				check = '1';
				alert("Data detail kosong (Tambahkan 1 baris kosong jika ingin mengosongi detail)");
			}

			if ( check == '0' )
			{
				hitung();	
		      	document.getElementById("entri").submit();  
			}
			
	}
		
    function nomor() {
		var i = 1;
		$(".REC").each(function() {
			$(this).val(i++);
		});
		
	//	hitung();
	
	}

   function hitung() {
		var TOTAL_QTY = 0;

		
		$(".QTY").each(function() {
			
			let z = $(this).closest('tr');
			var QTY_BELI = parseFloat(z.find('.QTY').val().replace(/,/g, ''));


            TOTAL_QTY +=QTY_BELI;			
		
		});

		if(isNaN(TOTAL_QTY)) TOTAL_QTY = 0;

		$('#TOTAL_QTY').val(numberWithCommas(TOTAL_QTY));		
		$("#TOTAL_QTY").autoNumeric('update');

		
	}
	

	
  
	function baru() {
		
		 kosong();
		 hidup();
	
	}
	
	function ganti() {
		
		 mati();
	
	}
	
	function batal() {
		
		// alert($header[0]->NO_BUKTI);
		
		 //$('#NO_BUKTI').val($header[0]->NO_BUKTI);	
		 mati();
	
	}
	
 

	
	
	function hidup() {

		
		$("#TOPX").attr("disabled", true);
	    $("#PREVX").attr("disabled", true);
	    $("#NEXTX").attr("disabled", true);
	    $("#BOTTOMX").attr("disabled", true);

	    $("#NEWX").attr("disabled", true);
	    $("#EDITX").attr("disabled", true);
	    $("#UNDOX").attr("disabled", false);
	    $("#SAVEX").attr("disabled", false);
		
	    $("#HAPUSX").attr("disabled", true);
//	    $("#CLOSEX").attr("disabled", true);

		$("#CARI").attr("readonly", true);	
	    $("#SEARCHX").attr("disabled", true);
		
	    $("#PLUSX").attr("hidden", false)
		   
			$("#NO_BUKTI").attr("readonly", true);		   
			$("#TGL").attr("readonly", false);
			$("#NO_BELI").attr("readonly", true);
			$("#NO_PO").attr("readonly", true);			
			$("#KD_BRG").attr("readonly", true);
			$("#NA_BRG").attr("readonly", true);
			
			$("#QTY_BELI").attr("readonly", true);
			$("#TOTAL_QTY").attr("readonly", true);

		jumlahdata = 100;
		for (i = 0; i <= jumlahdata; i++) {
			$("#REC" + i.toString()).attr("readonly", true);
			$("#NO_CONT" + i.toString()).attr("readonly", false);
			$("#SOPIR" + i.toString()).attr("readonly", false);
			$("#NOPOL" + i.toString()).attr("readonly", false);
			$("#TELP" + i.toString()).attr("readonly", false);
			$("#SEAL" + i.toString()).attr("readonly", false);
			$("#T_CONT" + i.toString()).attr("readonly", false);
			$("#QTY" + i.toString()).attr("readonly", false);

			$("#DELETEX" + i.toString()).attr("hidden", false);

			// $tipx = $('#tipx').val();
		
			
			// if ( $tipx != 'new' )
			// {
			// 	$("#KD_BHN" + i.toString()).attr("readonly", true);	
			// 	$("#KD_BHN" + i.toString()).removeAttr('onblur');
				
			// 	$("#KD_BRG" + i.toString()).attr("readonly", true);	
			// 	$("#KD_BRG" + i.toString()).removeAttr('onblur');
			// }
		}

		
	}


	function mati() {

		
	    $("#TOPX").attr("disabled", false);
	    $("#PREVX").attr("disabled", false);
	    $("#NEXTX").attr("disabled", false);
	    $("#BOTTOMX").attr("disabled", false);


	    $("#NEWX").attr("disabled", false);
	    $("#EDITX").attr("disabled", false);
	    $("#UNDOX").attr("disabled", true);
	    $("#SAVEX").attr("disabled", true);
	    $("#HAPUSX").attr("disabled", false);
	    $("#CLOSEX").attr("disabled", false);

		$("#CARI").attr("readonly", false);	
	    $("#SEARCHX").attr("disabled", false);
		
		
	    $("#PLUSX").attr("hidden", true)
		
	    $(".NO_BUKTI").attr("readonly", true);	
		
		$("#TGL").attr("readonly", true);
		$("#NO_BELI").attr("readonly", true);
		$("#NO_PO").attr("readonly", true);			
		$("#KD_BRG").attr("readonly", true);
		$("#NA_BRG").attr("readonly", true);
		
		$("#QTY_BELI").attr("readonly", true);
		$("#TOTAL_QTY").attr("readonly", true);

		
		jumlahdata = 100;
		for (i = 0; i <= jumlahdata; i++) {
			$("#REC" + i.toString()).attr("readonly", true);
			
			$("#NO_CONT" + i.toString()).attr("readonly", true);
			$("#SOPIR" + i.toString()).attr("readonly", true);
			$("#NOPOL" + i.toString()).attr("readonly", true);
			$("#TELP" + i.toString()).attr("readonly", true);
			$("#SEAL" + i.toString()).attr("readonly", true);
			$("#T_CONT" + i.toString()).attr("readonly", true);
			$("#QTY" + i.toString()).attr("readonly", true);

			$("#DELETEX" + i.toString()).attr("hidden", true);
		}


		
	}


	function kosong() {
				
		 $('#NO_BUKTI').val("+");		
		 $('#NO_BELI').val("");	
		 $('#NO_PO').val("");	
		 $('#KD_BRG').val("");	
		 $('#NA_BRG').val("");	
		 $('#QTY_BELI').val("0.00");	 
	
		 $('#TOTAL_QTY').val("0.00"); 
		 
		 
		var html = '';
		$('#detailx').html(html);	
		
	}
	
	function hapusTrans() {
		let text = "Hapus Transaksi "+$('#NO_BUKTI').val()+"?";
		if (confirm(text) == true) 
		{
			window.location ="{{url('/muat/delete/'.$header->NO_ID .'/?flagz='.$flagz.'&golz=' .$golz.'' )}}";
			//return true;
		} 
		return false;
	}
	

	function CariBukti() {
		
		var flagz = "{{ $flagz }}";
		var golz = "{{ $golz }}";
		var cari = $("#CARI").val();
		var loc = "{{ url('/muat/edit/') }}" + '?idx={{ $header->NO_ID}}&tipx=search&flagz=' + encodeURIComponent(flagz) + '&golz=' + encodeURIComponent(golz) + '&buktix=' +encodeURIComponent(cari);
		window.location = loc;
		
	}


    function tambah() {

        var x = document.getElementById('datatable').insertRow(baris + 1);
 
		html=`<tr>

                <td>
 					<input name='NO_ID[]' id='NO_ID${idrow}' type='hidden' class='form-control NO_ID' value='new' readonly> 
					<input name='REC[]' id='REC${idrow}' type='text' class='REC form-control' onkeypress='return tabE(this,event)' readonly>
	            </td>

                <td>
				    <input name='NO_CONT[]'   id='NO_CONT${idrow}' type='text' class='form-control  NO_CONT'>
                </td>

				<td>
					<input name='SOPIR[]'   id='SOPIR${idrow}' type='text' class='form-control  SOPIR'>
				</td>

				<td>
					<input name='NOPOL[]'   id='NOPOL${idrow}' type='text' class='form-control  NOPOL'>
				</td>

				<td>
					<input name='TELP[]'   id='TELP${idrow}' type='text' class='form-control  TELP'>
				</td>

				<td>
					<input name='SEAL[]'   id='SEAL${idrow}' type='text' class='form-control  SEAL'>
				</td>
				
				<td>
		            <input name='T_CONT[]' onclick ='select()' onblur='hitung()' value='0' id='T_CONT${idrow}' type='text' style='text-align: right' class='form-control T_CONT text-primary' >
                </td>
				
				<td>
		            <input name='QTY[]' onclick ='select()' onblur='hitung()' value='0' id='QTY${idrow}' type='text' style='text-align: right' class='form-control QTY text-primary' >
                </td>
				
                <td>
					<button type='button' id='DELETEX${idrow}'  class='btn btn-sm btn-circle btn-outline-danger btn-delete' onclick=''> <i class='fa fa-fw fa-trash'></i> </button>
                </td>				
         </tr>`;
				
        x.innerHTML = html;
        var html='';
		
		
		
		jumlahdata = 100;
		for (i = 0; i <= jumlahdata; i++) {
			$("#T_CONT" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			
			$("#QTY" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			
		}


        idrow++;
        baris++;
        nomor();
		
		$(".ronly").on('keydown paste', function(e) {
             e.preventDefault();
             e.currentTarget.blur();
         });
     }
</script>

<script src="autonumeric.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
<script src="https://unpkg.com/autonumeric"></script>
@endsection