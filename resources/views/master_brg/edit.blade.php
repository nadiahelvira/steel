@extends('layouts.plain')
<style>
    .card {

    }

    .form-control:focus {
        background-color: #E0FFFF !important;
    }

	/* perubahan tab warna di form edit  */
	.nav-item .nav-link.active {
		background-color: red !important; /* Use !important to ensure it overrides */
		color: white !important;
	}
/* query LOADX */

.loader {
      position: fixed;
        top: 50%;
        left: 50%;
      width: 100px;
      aspect-ratio: 1;
      background:
        radial-gradient(farthest-side,#ffa516 90%,#0000) center/16px 16px,
        radial-gradient(farthest-side,green   90%,#0000) bottom/12px 12px;
      background-repeat: no-repeat;
      animation: l17 1s infinite linear;
      position: relative;
    }
    .loader::before {    
      content:"";
      position: absolute;
      width: 8px;
      aspect-ratio: 1;
      inset: auto 0 16px;
      margin: auto;
      background: #ccc;
      border-radius: 50%;
      transform-origin: 50% calc(100% + 10px);
      animation: inherit;
      animation-duration: 0.5s;
    }
    @keyframes l17 { 
      100%{transform: rotate(1turn)}
    }

	/* penutup LOADX */

	/* menghilangkan padding */
	.content-header {
		padding: 0 !important;
	}


</style>

@section('content')
<div class="content-wrapper">

    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{($tipx=='new')? url('/brg/store/') : url('/brg/update/'.$header->NO_ID ) }}" method="POST" name ="entri" id="entri" >
  
                        @csrf
                        {{-- <ul class="nav nav-tabs">
                            <li class="nav-item active">
                                <a class="nav-link active" href="#data" data-toggle="tab">Data</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#dokumen" data-toggle="tab">Nilai</a>
                            </li>
                        </ul> --}}
        
                        <div class="tab-content mt-3">

							<!-- style textbox model baru -->
						<style>
								/* Ensure specificity with class targeting */
								.form-group.special-input-label {
									position: relative;
									margin-left: 5px ;
								}
						
								/* Ensure only bottom border for input */
								.form-group.special-input-label input {
									width: 100%;
									padding: 10px 0;
									border: none !important;
									border-bottom: 2px solid #ccc !important;
									outline: none !important;
									font-size: 16px !important;
									background: transparent !important; /* Remove any background color */
								}
						
								/* Bottom border color change on focus */
								.form-group.special-input-label input:focus {
									border-bottom: 2px solid #007BFF !important; /* Change color on focus */
								}
						
								/* Style the label with a higher specificity */
								.form-group.special-input-label label {
									position: absolute;
									top: 12px;
									color: #888 !important;
									font-size: 16px !important;
									transition: 0.3s ease all;
									pointer-events: none;
								}
						
								/* Move label above input when focused or has content */
								.form-group.special-input-label input:focus + label,
								.form-group.special-input-label input:not(:placeholder-shown) + label {
									top: -10px !important;
									font-size: 12px !important;
									color: #007BFF !important;
								}
							</style>
						<!-- tutupannya -->

                            <div class="form-group row">

                                    <input type="text" class="form-control NO_ID" id="NO_ID" name="NO_ID"
                                    placeholder="Masukkan NO_ID" value="{{$header->NO_ID ?? ''}}" hidden readonly>

									<input name="tipx" class="form-control flagz" id="tipx" value="{{$tipx}}" hidden>
		 							

								<!-- code text box baru -->
								<div class="col-md-2 form-group row special-input-label">

									<input type="text" class="KD_BRG" id="KD_BRG" name="KD_BRG" 
										value="{{$header->KD_BRG}}" placeholder=" " >
									<label for="KD_BRG">Kode</label>
								</div>
								<!-- tutupannya -->

								<div class="col-md-1">
								</div>

								<!-- code text box baru -->
								<div class="col-md-3 form-group row special-input-label">

									<input type="text" class="NA_BRG" id="NA_BRG" name="NA_BRG" 
										value="{{$header->NA_BRG}}" placeholder=" " >
									<label for="NA_BRG">Nama</label>
								</div>
								<!-- tutupannya -->

								<!-- code text box baru -->
								<div class="col-md-2 form-group row special-input-label">

									<input type="text" class="SATUAN" id="SATUAN" name="SATUAN" 
										value="{{$header->SATUAN}}" placeholder=" " >
									<label for="SATUAN">Satuan</label>
								</div>
								<!-- tutupannya -->

                                <div class="col-md-1" align="right">
									<label for="GOL" class="form-label">Golongan</label>
								</div>
								<div class="col-md-1">
									<select id="GOL" class="form-control"  name="GOL">
										<option value="" {{ ($header->GOL == '') ? 'selected' : '' }}>-</option>
										<option value="J" {{ ($header->GOL == 'J') ? 'selected' : '' }}>Barang</option>
										<option value="N" {{ ($header->GOL == 'N') ? 'selected' : '' }}>Non</option>
									</select>
								</div>

								<div class="col-md-1" align="right">
									<label for="PN" class="form-label">PPN</label>
								</div>
								<div class="col-md-1">
									<select id="PN" class="form-control"  name="PN">
										<option value="0" {{ ($header->PN == '0') ? 'selected' : '' }}>0</option>
										<option value="11" {{ ($header->PN == '11') ? 'selected' : '' }}>11</option>
										<option value="12" {{ ($header->PN == '12') ? 'selected' : '' }}>12</option>
									</select>
								</div>	
								
							
								<div class="col-md-1" hidden>
                                    <input type="checkbox" class="form-check-input" id="AKTIF"name="AKTIF"
                                    placeholder="Masukkan Aktif/Tidak" value="1" {{ ($header->AKTIF == 1) ? 'checked' : '' }}>
									<label for="AKTIF">Aktif</label>
                                </div>

                            </div>

							
                            <div class="form-group row">

								<!-- code text box baru -->
								<div class="col-md-2 form-group row special-input-label">

									<input type="text" class="KODES" id="KODES" name="KODES" 
										value="{{$header->KODES}}" placeholder=" " >
									<label for="KODES">Supplier *(Pilih)</label>
								</div>
								<div class="col-md-1 form-group row special-input-label">
									<button type="button" class="btn btn-primary" onclick="browseSuplier()" style="width:40px"><i class="fa fa-search"></i></button>
								</div>
								<!-- tutupannya -->
        
								<div class="col-md-2 form-group row special-input-label">
									<input type="text" class="NAMAS" id="NAMAS" name="NAMAS" 
										value="{{$header->NAMAS}}" placeholder=" " >
									<label for="NAMAS"></label>
								</div>
                            </div>

							<div class="form-group row">

								<div class="col-md-3 form-group row special-input-label">

									<input type="text" onclick="select()" class="form-control DIAMETER" id="DIAMETER" name="DIAMETER" placeholder="Masukkan Diameter" 
										value="{{ number_format( $header->DIAMETER, 0, '.', ',') }}" style="text-align: right" >
									<label for="DIAMETER">Diameter</label>
								</div>

								<div class="col-md-3 form-group row special-input-label">

									<input type="text" onclick="select()" class="form-control TEBAL" id="TEBAL" name="TEBAL" placeholder="Masukkan TEBAL" 
										value="{{ number_format( $header->TEBAL, 0, '.', ',') }}" style="text-align: right" >
									<label for="TEBAL">Tebal</label>
								</div>

								<div class="col-md-3 form-group row special-input-label">

									<input type="text" onclick="select()" class="form-control PANJANG" id="PANJANG" name="PANJANG" placeholder="Masukkan PANJANG" 
										value="{{ number_format( $header->PANJANG, 0, '.', ',') }}" style="text-align: right" >
									<label for="PANJANG">Panjang</label>
								</div>
								
							</div>

							<div class="form-group row">

								<div class="col-md-3 form-group row special-input-label">

									<input type="text" onclick="select()" class="form-control KG" id="KG" name="KG" placeholder="Masukkan KG" 
										value="{{ number_format( $header->KG, 0, '.', ',') }}" style="text-align: right" >
									<label for="KG">Kg</label>
								</div>

								<div class="col-md-3 form-group row special-input-label">

									<input type="text" onclick="select()" class="form-control SMIN" id="SMIN" name="SMIN" placeholder="Masukkan SMIN" 
										value="{{ number_format( $header->SMIN, 0, '.', ',') }}" style="text-align: right" >
									<label for="SMIN">Stok Min.</label>
								</div>

								<div class="col-md-3 form-group row special-input-label">

									<input type="text" onclick="select()" class="form-control SMAX" id="SMAX" name="SMAX" placeholder="Masukkan SMAX" 
										value="{{ number_format( $header->SMAX, 0, '.', ',') }}" style="text-align: right" >
									<label for="SMAX">Stok Max.</label>
								</div>
							</div>

							<div class="form-group row">

								<div class="col-md-3 form-group row special-input-label">

									<input type="text" onclick="select()" class="form-control H_MINA" id="H_MINA" name="H_MINA" placeholder="Masukkan H_MINA" 
										value="{{ number_format( $header->H_MINA, 0, '.', ',') }}" style="text-align: right" >
									<label for="H_MINA">Harga Min. A</label>
								</div>

								<div class="col-md-3 form-group row special-input-label">

									<input type="text" onclick="select()" class="form-control H_MINB" id="H_MINB" name="H_MINB" placeholder="Masukkan H_MINB" 
										value="{{ number_format( $header->H_MINB, 0, '.', ',') }}" style="text-align: right" >
									<label for="H_MINB">Harga Min. B</label>
								</div>

								<div class="col-md-3 form-group row special-input-label">

									<input type="text" onclick="select()" class="form-control H_MINC" id="H_MINC" name="H_MINC" placeholder="Masukkan H_MINC" 
										value="{{ number_format( $header->H_MINC, 0, '.', ',') }}" style="text-align: right" >
									<label for="H_MINC">Harga Min. C</label>
								</div>
							</div>

							<!-- loader tampil di modal  -->
							<div class="loader" style="z-index: 1055;" id='LOADX' ></div>
							

							<div class="form-group row">
								<!-- code text box baru -->
								<div class="col-md-2 form-group row special-input-label">

									<input type="text" class="ACNOA" id="ACNOA" name="ACNOA" 
										value="{{$header->ACNOA}}" placeholder=" " >
									<label for="ACNOA">Acno Debet *(Pilih Acno)</label>
								</div>
								<div class="col-md-1 form-group row special-input-label">
									<button type="button" class="btn btn-primary" onclick="browseAcno()" style="width:40px"><i class="fa fa-search"></i></button>
								</div>
								<!-- tutupannya -->
        
								<div class="col-md-2 form-group row special-input-label">
									<input type="text" class="NACNOA" id="NACNOA" name="NACNOA" 
										value="{{$header->NACNOA}}" placeholder=" " >
									<label for="NACNOA"></label>
								</div>

								<div class="col-md-1">
								</div>

								<!-- code text box baru -->
								<div class="col-md-2 form-group row special-input-label">

									<input type="text" class="ACNOB" id="ACNOB" name="ACNOB" 
										value="{{$header->ACNOB}}" placeholder=" " >
									<label for="ACNOB">Acno Kredit *(Pilih Acno)</label>
								</div>
								<div class="col-md-1 form-group row special-input-label">
									<button type="button" class="btn btn-primary" onclick="browseAcno()" style="width:40px"><i class="fa fa-search"></i></button>
								</div>
								<!-- tutupannya -->
        
								<div class="col-md-2 form-group row special-input-label">
									<input type="text" class="NACNOB" id="NACNOB" name="NACNOB" 
										value="{{$header->NACNOB}}" placeholder=" " >
									<label for="NACNOB"></label>
								</div>
                            </div>
                        </div>

						
        
						<div class="mt-3 col-md-12 form-group row">
							<div class="col-md-4">
								<button type="button" id='TOPX'  onclick="location.href='{{url('/brg/edit/?idx=' .$idx. '&tipx=top')}}'" class="btn btn-outline-primary">Top</button>
								<button type="button" id='PREVX' onclick="location.href='{{url('/brg/edit/?idx='.$header->NO_ID.'&tipx=prev&kodex='.$header->KD_BRG )}}'" class="btn btn-outline-primary">Prev</button>
								<button type="button" id='NEXTX' onclick="location.href='{{url('/brg/edit/?idx='.$header->NO_ID.'&tipx=next&kodex='.$header->KD_BRG )}}'" class="btn btn-outline-primary">Next</button>
								<button type="button" id='BOTTOMX' onclick="location.href='{{url('/brg/edit/?idx=' .$idx. '&tipx=bottom')}}'" class="btn btn-outline-primary">Bottom</button>
							</div>
							<div class="col-md-5">
								<button type="button" id='NEWX' onclick="location.href='{{url('/brg/edit/?idx=0&tipx=new')}}'" class="btn btn-warning">New</button>
								<button type="button" id='EDITX' onclick='hidup()' class="btn btn-secondary">Edit</button>                    
								<button type="button" id='UNDOX' onclick="location.href='{{url('/brg/edit/?idx=' .$idx. '&tipx=undo' )}}'" class="btn btn-info">Undo</button> 
								<button type="button" id='SAVEX' onclick='simpan()' class="btn btn-success" class="fa fa-save"></i>Save</button>

							</div>
							<div class="col-md-3">
								<button type="button" id='HAPUSX' hidden onclick="hapusTrans()" class="btn btn-outline-danger">Hapus</button>
								
								<!-- <button type="button" id='CLOSEX'  onclick="location.href='{{url('/brg' )}}'" class="btn btn-outline-secondary">Close</button> -->

								<!-- tombol close sweet alert -->
								<button type="button" id='CLOSEX' onclick="closeTrans()" class="btn btn-outline-secondary">Close</button></div>
							</div>
						</div>		
		
                    </form>
                </div>
            </div>
            <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


	<div class="modal fade" id="browseSuplierModal" tabindex="-1" role="dialog" aria-labelledby="browseSuplierModalLabel" aria-hidden="true">
	 <div class="modal-dialog mw-100 w-75" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="browseSuplierModalLabel">Cari Suplier</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table table-stripped table-bordered" id="table-bsuplier">
				<thead>
					<tr>
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

	<div class="modal fade" id="browseAcnoModal" tabindex="-1" role="dialog" aria-labelledby="browseAcnoModalLabel" aria-hidden="true">
	 <div class="modal-dialog mw-100 w-75" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="browseAcnoModalLabel">Cari Acno</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table table-stripped table-bordered" id="table-bacno">
				<thead>
					<tr>
						<th>Acno</th>
						<th>Nama</th>
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

	<div class="modal fade" id="browseAcnobModal" tabindex="-1" role="dialog" aria-labelledby="browseAcnobModalLabel" aria-hidden="true">
	 <div class="modal-dialog mw-100 w-75" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="browseAcnobModalLabel">Cari Acnob</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table table-stripped table-bordered" id="table-bacnob">
				<thead>
					<tr>
						<th>Acno</th>
						<th>Nama</th>
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

	<div class="modal fade" id="browseGrupModal" tabindex="-1" role="dialog" aria-labelledby="browseGrupModalLabel" aria-hidden="true">
	 <div class="modal-dialog mw-100 w-75" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="browseGrupModalLabel">Cari Grup</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table table-stripped table-bordered" id="table-bgrup">
				<thead>
					<tr>
						<th>Grup</th>
						<th>Nama</th>
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

	<div class="modal fade" id="browseLokasiModal" tabindex="-1" role="dialog" aria-labelledby="browseLokasiModalLabel" aria-hidden="true">
	 <div class="modal-dialog mw-100 w-75" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="browseLokasiModalLabel">Cari Lokasi</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table table-stripped table-bordered" id="table-blokasi">
				<thead>
					<tr>
						<th>Kode</th>
						<th>Lokasi</th>
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

	<div class="modal fade" id="browseKomisiModal" tabindex="-1" role="dialog" aria-labelledby="browseKomisiModalLabel" aria-hidden="true">
	<div class="modal-dialog mw-100 w-75" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="browseKomisiModalLabel">Cari Komisi</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<table class="table table-stripped table-bordered" id="table-bkomisi">
				<thead>
					<tr>
						<th>Type</th>
						<th>Komisi</th>
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
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="{{asset('foxie_js_css/bootstrap.bundle.min.js')}}"></script>

<!-- tambahan untuk sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- tutupannya -->

<script>

	var idrow = 1;
	var baris = 1;

	function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}


    $(document).ready(function () {

		setTimeout(function(){

		$("#LOADX").hide();

		},500);

		
		$('body').on('keydown', 'input, select', function(e) {
			if (e.key === "Enter") {
				var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
				focusable = form.find('input,select,textarea').filter(':visible');
				next = focusable.eq(focusable.index(this)+1);
				console.log(next);
				if (next.length) {
					next.focus().select();
				} else {
					// tambah();
					// var nomer = idrow-1;
					// console.log("REC"+nomor);
					// document.getElementById("REC"+nomor).focus();
					// form.submit();
				}
				return false;
			}
		});
		
 		$tipx = $('#tipx').val();
				
        if ( $tipx == 'new' )
		{
			 baru();	
             tambah();
			 
			 $("#RING0").val('LOKAL');
			 tambah();
			 $("#RING1").val('1');
			 tambah();
			 $("#RING2").val('2');
			 tambah();
			 $("#RING3").val('3');
			 
		}

        if ( $tipx != 'new' )
		{
			 //mati();	
    		 ganti();
		} 


		$("#KALI").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999.99'});
		$("#ROP").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999.99'});
		$("#HJUAL").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999.99'});
		$("#SMIN").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999.99'});
		$("#SMAX").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999.99'});


		jumlahdata = 100;
		for (i = 0; i <= jumlahdata; i++) {
			$("#HARGA" + i.toString()).autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
			$("#HARGA2" + i.toString()).autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
			$("#HARGA3" + i.toString()).autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
			$("#HARGA4" + i.toString()).autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
			$("#HARGA5" + i.toString()).autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
			$("#HARGA6" + i.toString()).autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
			$("#HARGA7" + i.toString()).autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
		
		}	

		$('body').on('click', '.del', function() {
			var val = $(this).parents("tr").remove();
			baris--;
			nomor();
			
		});

		$('.date').datepicker({  
            dateFormat: 'dd-mm-yy'
		});

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
		
		
		//CHOOSE Supplier
		var dTableBSuplier;
		loadDataBSuplier = function(){
			$.ajax(
			{
				type: 'GET',    
				url: '{{url('sup/browse')}}',

				success: function( response )
				{
			
					resp = response;
					if(dTableBSuplier){
						dTableBSuplier.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBSuplier.row.add([
							'<a href="javascript:void(0);" onclick="chooseSuplier(\''+resp[i].KODES+'\',  \''+resp[i].NAMAS+'\', \''+resp[i].ALAMAT+'\',  \''+resp[i].KOTA+'\')">'+resp[i].KODES+'</a>',
							resp[i].NAMAS,
							resp[i].ALAMAT,
							resp[i].KOTA,
						]);
					}
					dTableBSuplier.draw();
				}
			});
		}
		
		dTableBSuplier = $("#table-bsuplier").DataTable({
			
		});
		
		browseSuplier = function(){
			loadDataBSuplier();
			$("#browseSuplierModal").modal("show");
		}
		
		chooseSuplier = function(KODES,NAMAS, ALAMAT, KOTA){
			$("#KODES").val(KODES);
			$("#NAMAS").val(NAMAS);
			$("#ALAMAT").val(ALAMAT);
			$("#KOTA").val(KOTA);
			$("#browseSuplierModal").modal("hide");
		}
		
		$("#KODES").keypress(function(e){

			if(e.keyCode == 46){
				e.preventDefault();
				browseSuplier();
			}
		}); 
		
		
//////////////////////////////////////////////////////////////////////////////////////////////////


		//CHOOSE Acno
		var dTableBAcno;
		loadDataBAcno = function(){
			$.ajax(
			{
				type: 'GET',    
				url: '{{url('account/browse')}}',

				beforeSend: function(){
					$("#LOADX").show();
				},

				success: function( response )
				{
					$("#LOADX").hide();
			
					resp = response;
					if(dTableBAcno){
						dTableBAcno.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBAcno.row.add([
							'<a href="javascript:void(0);" onclick="chooseAcno(\''+resp[i].ACNO+'\',  \''+resp[i].NAMA+'\' )">'+resp[i].ACNO+'</a>',
							resp[i].NAMA,
						]);
					}
					dTableBAcno.draw();
				}
			});
		}
		
		dTableBAcno = $("#table-bacno").DataTable({
			
		});
		
		browseAcno = function(){
			loadDataBAcno();
			$("#browseAcnoModal").modal("show");
		}
		
		chooseAcno = function(ACNO,NAMA){
			$("#ACNOA").val(ACNO);
			$("#NACNOA").val(NAMA);
			$("#browseAcnoModal").modal("hide");
		}
		
		$("#ACNOA").keypress(function(e){

			if(e.keyCode == 46){
				e.preventDefault();
				browseAcno();
			}
		}); 
		
		
		//////////////////////////////////////////////////////////////////////////////////////////////////

		//////////////////////////////////////////////////////////////////////////////////////////////////


		//CHOOSE Acno
		var dTableBAcnob;
		loadDataBAcnob = function(){
			$.ajax(
			{
				type: 'GET',    
				url: '{{url('account/browse')}}',

				beforeSend: function(){
					$("#LOADX").show();
				},

				success: function( response )
				{
					$("#LOADX").hide();
			
					resp = response;
					if(dTableBAcnob){
						dTableBAcnob.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBAcnob.row.add([
							'<a href="javascript:void(0);" onclick="chooseAcnob(\''+resp[i].ACNO+'\',  \''+resp[i].NAMA+'\' )">'+resp[i].ACNO+'</a>',
							resp[i].NAMA,
						]);
					}
					dTableBAcnob.draw();
				}
			});
		}
		
		dTableBAcnob = $("#table-bacnob").DataTable({
			
		});
		
		browseAcnob = function(){
			loadDataBAcnob();
			$("#browseAcnobModal").modal("show");
		}
		
		chooseAcnob = function(ACNO,NAMA){
			$("#ACNOB").val(ACNO);
			$("#NACNOB").val(NAMA);
			$("#browseAcnobModal").modal("hide");
		}
		
		$("#ACNOB").keypress(function(e){

			if(e.keyCode == 46){
				e.preventDefault();
				browseAcnob();
			}
		}); 
		
		
		//////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////


		//CHOOSE Grup
		var dTableBGrup;
		loadDataBGrup = function(){
			$.ajax(
			{
				type: 'GET',    
				url: '{{url('grup/browse')}}',

				success: function( response )
				{
			
					resp = response;
					if(dTableBGrup){
						dTableBGrup.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBGrup.row.add([
							'<a href="javascript:void(0);" onclick="chooseGrup(\''+resp[i].KODE+'\',  \''+resp[i].NAMA+'\' )">'+resp[i].KODE+'</a>',
							resp[i].NAMA,
						]);
					}
					dTableBGrup.draw();
				}
			});
		}
		
		dTableBGrup = $("#table-bgrup").DataTable({
			
		});
		
		browseGrup = function(){
			loadDataBGrup();
			$("#browseGrupModal").modal("show");
		}
		
		chooseGrup = function(KODE,NAMA){
			$("#KD_GRUP").val(KODE);
			$("#NA_GRUP").val(NAMA);
			$("#browseGrupModal").modal("hide");
		}
		
		$("#KD_GRUP").keypress(function(e){

			if(e.keyCode == 46){
				e.preventDefault();
				browseGrup();
			}
		}); 
		
		
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////


		//CHOOSE Lokasi
		var dTableBLokasi;
		loadDataBLokasi = function(){
			$.ajax(
			{
				type: 'GET',    
				url: '{{url('lokasi/browse')}}',

				success: function( response )
				{
			
					resp = response;
					if(dTableBLokasi){
						dTableBLokasi.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBLokasi.row.add([
							'<a href="javascript:void(0);" onclick="chooseLokasi( \''+resp[i].NAMA+'\' )">'+resp[i].KODE+'</a>',
							resp[i].NAMA,
						]);
					}
					dTableBLokasi.draw();
				}
			});
		}
		
		dTableBLokasi = $("#table-blokasi").DataTable({
			
		});
		
		browseLokasi = function(){
			loadDataBLokasi();
			$("#browseLokasiModal").modal("show");
		}
		
		chooseLokasi = function(NAMA){
			$("#LOKASI").val(NAMA);
			$("#browseLokasiModal").modal("hide");
		}
		
		$("#LOKASI").keypress(function(e){

			if(e.keyCode == 46){
				e.preventDefault();
				browseLokasi();
			}
		}); 
		
		
//////////////////////////////////////////////////////////////////////////////////////////////////
		
//////////////////////////////////////////////////////////////////////////////////////////////////


		//CHOOSE Komisi
		var dTableBKomisi;
		loadDataBKomisi = function(){
			$.ajax(
			{
				type: 'GET',    
				url: '{{url('komisi/browse')}}',

				beforeSend: function(){
					$("#LOADX").show();
				},

				success: function( response )
				{
					$("#LOADX").hide();
			
					resp = response;
					if(dTableBKomisi){
						dTableBKomisi.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBKomisi.row.add([
							'<a href="javascript:void(0);" onclick="chooseKomisi(\''+resp[i].TYPE+'\',  \''+resp[i].KOM+'\' )">'+resp[i].TYPE+'</a>',
							resp[i].KOM,
						]);
					}
					dTableBKomisi.draw();
				}
			});
		}
		
		dTableBKomisi = $("#table-bkomisi").DataTable({
			
		});
		
		browseKomisi = function(){
			loadDataBKomisi();
			$("#browseKomisiModal").modal("show");
		}
		
		chooseKomisi = function(TYPE,KOM){
			$("#TYPE_KOM").val(TYPE);
			$("#KOM").val(KOM);
			$("#browseKomisiModal").modal("hide");
		}
		
		$("#TYPE_KOM").keypress(function(e){

			if(e.keyCode == 46){
				e.preventDefault();
				browseKomisi();
			}
		}); 
		
		
		//////////////////////////////////////////////////////////////////////////////////////////////////


		
    });

	function nomor() {
		var i = 1;
		$(".REC").each(function() {
			$(this).val(i++);
		});
		
	//	hitung();
	
	}

	function hitung() {
		// var TTOTAL_QTY = 0;
		// // var TTOTAL = 0;


		
		// $(".QTY").each(function() {
			
		// 	let z = $(this).closest('tr');
		// 	var QTYX = parseFloat(z.find('.QTY').val().replace(/,/g, ''));
		// 	// var HARGAX = parseFloat(z.find('.HARGA').val().replace(/,/g, ''));
	
	
        //     // var TOTALX  =  ( QTYX * HARGAX );
		// 	// z.find('.TOTAL').val(TOTALX);

		//     // z.find('.HARGA').autoNumeric('update');			
		//     // z.find('.QTY').autoNumeric('update');	
		//     // z.find('.TOTAL').autoNumeric('update');			

        //     TTOTAL_QTY +=QTYX;		
        //     // TTOTAL +=TOTALX;				
		
		// });
		

		
		// if(isNaN(TTOTAL_QTY)) TTOTAL_QTY = 0;

		// $('#TTOTAL_QTY').val(numberWithCommas(TTOTAL_QTY));		
		// $("#TTOTAL_QTY").autoNumeric('update');
		
		// if(isNaN(TTOTAL)) TTOTAL = 0;

		// $('#TTOTAL').val(numberWithCommas(TTOTAL));		
		// $("#TTOTAL").autoNumeric('update');



		
	}

	function baru() {
		
		 kosong();
		 hidup();
		 
	}
	
	function ganti() {
		
		mati();
		// hidup();
	
	}
	
	function batal() {
			
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
	    //$("#CLOSEX").attr("disabled", true);
		
		
 		$tipx = $('#tipx').val();
		
        if ( $tipx == 'new' )		
		{	
		  	
			$("#KD_BRG").attr("readonly", false);	

		   }
		else
		{
	     	$("#KD_BRG").attr("readonly", true);	

		}
		   
		
		$("#NA_BRG").attr("readonly", false);		
		$("#KD_GRUP").attr("readonly", true);			
		$("#NA_GRUP").attr("readonly", true);

		$("#LOKASI").attr("readonly", true);
		$("#KODES").attr("readonly", true);
		$("#NAMAS").attr("readonly", true);
		$("#SATUAN_BELI").attr("readonly", false);
		$("#KALI").attr("readonly", false);
		$("#SATUAN").attr("readonly", false);
		$("#MERK").attr("readonly", false);
		$("#JENIS").attr("readonly", false);
		$("#PANJANG").attr("readonly", false);
		$("#LEBAR").attr("readonly", false);
		$("#DIMENSI").attr("readonly", false);
		$("#VOLUME").attr("readonly", false);
		$("#ROP").attr("readonly", false);
		$("#SMIN").attr("readonly", false);
		$("#SMAX").attr("readonly", false);
		$("#GOL").attr("readonly", false);
		$("#PN").attr("readonly", false);

		jumlahdata = 100;
		for (i = 0; i <= jumlahdata; i++) {
			$("#REC" + i.toString()).attr("readonly", true);
			$("#RING" + i.toString()).attr("readonly", true);
			$("#HARGA" + i.toString()).attr("readonly", false);
			$("#HARGA1" + i.toString()).attr("readonly", false);
			$("#HARGA2" + i.toString()).attr("readonly", false);
			$("#HARGA3" + i.toString()).attr("readonly", false);
			$("#HARGA4" + i.toString()).attr("readonly", false);
			$("#HARGA5" + i.toString()).attr("readonly", false);
			$("#HARGA6" + i.toString()).attr("readonly", false);
			$("#HARGA7" + i.toString()).attr("readonly", false);

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
		
		$("#KD_BRG").attr("readonly", true);			
		$("#NA_BRG").attr("readonly", true);		
		$("#KD_GRUP").attr("readonly", true);			
		$("#NA_GRUP").attr("readonly", true);

		$("#LOKASI").attr("readonly", true);
		$("#SATUAN_BELI").attr("readonly", true);
		$("#KALI").attr("readonly", true);
		$("#SATUAN").attr("readonly", true);
		$("#MERK").attr("readonly", true);
		$("#JENIS").attr("readonly", true);
		$("#PANJANG").attr("readonly", true);
		$("#LEBAR").attr("readonly", true);
		$("#DIMENSI").attr("readonly", true);
		$("#VOLUME").attr("readonly", true);
		$("#ROP").attr("readonly", true);
		$("#SMIN").attr("readonly", true);
		$("#SMAX").attr("readonly", true);
		$("#GOL").attr("readonly", true);
		$("#PN").attr("readonly", true);
		$("#KODES").attr("readonly", true);
		$("#NAMAS").attr("readonly", true);

		jumlahdata = 100;
		for (i = 0; i <= jumlahdata; i++) {
			$("#REC" + i.toString()).attr("readonly", true);
			$("#RING" + i.toString()).attr("readonly", true);
			$("#HARGA" + i.toString()).attr("readonly", true);
			$("#HARGA1" + i.toString()).attr("readonly", true);
			$("#HARGA2" + i.toString()).attr("readonly", true);
			$("#HARGA3" + i.toString()).attr("readonly", true);
			$("#HARGA4" + i.toString()).attr("readonly", true);
			$("#HARGA5" + i.toString()).attr("readonly", true);
			$("#HARGA6" + i.toString()).attr("readonly", true);
			$("#HARGA7" + i.toString()).attr("readonly", true);

		}
		
	}


	function kosong() {
				
		 $('#KD_BRG').val("");	
		 $('#NA_BRG').val("");	
		 $('#GRUP').val("");	
		 $('#DR').val("");
		 $('#SUB').val("");		 
	}
	
	// function hapusTrans() {
	// 	let text = "Hapus Master "+$('#KD_BRG').val()+"?";
	// 	if (confirm(text) == true) 
	// 	{
	// 		window.location ="{{url('/brg/delete/'.$header->NO_ID )}}'";
	// 		//return true;
	// 	} 
	// 	return false;
	// }

	// sweetalert untuk tombol hapus dan close
	
	function hapusTrans() {
		let text = "Hapus Transaksi "+$('#NO_BUKTI').val()+"?";

		var loc ='';
		
		Swal.fire({
			title: 'Are you sure?',
			text: text,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: 'Cancel'
		}).then((result) => {
			if (result.isConfirmed) {
				// Show a success message before redirecting to delete the data
				Swal.fire({
					title: 'Deleted!',
					text: 'Data has been deleted.',
					icon: 'success',
					confirmButtonText: 'OK'
				}).then(() => {
					// Redirect to delete the data after user confirms the success message
	            	loc = "{{ url('/brg/delete/'.$header->NO_ID) }}"  ;

		            // alert(loc);
	            	window.location = loc;
		
				});
			}
		});
	}
	
	function closeTrans() {
		console.log("masuk");
		var loc ='';
		
		Swal.fire({
			title: 'Are you sure?',
			text: 'Do you really want to close this page? Unsaved changes will be lost.',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, close it',
			cancelButtonText: 'No, stay here'
		}).then((result) => {
			if (result.isConfirmed) {
	        	loc = "{{ url('/brg/') }}" ;
				window.location = loc ;
			} else {
				Swal.fire({
					icon: 'info',
					title: 'Cancelled',
					text: 'You stayed on the page'
				});
			}
		});
	}

	// tutupannya

	function CariBukti() {
		
		var cari = $("#CARI").val();
		var loc = "{{ url('/brg/edit/') }}" + '?idx={{ $header->NO_ID}}&tipx=search&kodex=' +encodeURIComponent(cari);
		window.location = loc;
		
	}

    var hasilCek;

	function cekBarang(kdbrg) {
		$.ajax({
			type: "GET",
			url: "{{url('brg/cekbarang')}}",
            async: false,
			data: ({ KD_BRG: kdbrg, }),
			success: function(data) {
                // hasilCek=data;
                if (data.length > 0) {
                    $.each(data, function(i, item) {
                        hasilCek=data[i].ADA;
                    });
                }
			},
			error: function() {
				alert('Error cekBarang occured');
			}
		});
		return hasilCek;
	}

   


	function simpan() {
		
        var hasilCek = '0';

		
			$tipx = $('#tipx').val();
					
			if ( $tipx == 'new' )
			{
				cekBarang($('#KOTA').val());		
			}
		
			if (hasilCek == '0') {
				Swal.fire({
					title: 'Are you sure?',
					text: 'Are you sure you want to save?',
					icon: 'question',
					showCancelButton: true,
					confirmButtonText: 'Yes, save it!',
					cancelButtonText: 'No, cancel',
				}).then((result) => {
					if (result.isConfirmed) {
						document.getElementById("entri").submit();
					} else {
						Swal.fire({
							icon: 'info',
							title: 'Cancelled',
							text: 'Your data was not saved'
						});
					}
				});
			} else {
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'Masih ada kesalahan'
				});
			}

		// tutupannya	
	
			$("#LOADX").hide();
	}


	function tambah() {
	}
</script>
@endsection