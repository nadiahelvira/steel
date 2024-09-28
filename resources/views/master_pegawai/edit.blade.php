@extends('layouts.main')

<style>
    .card {

    }

    .form-control:focus {
        background-color: #E0FFFF !important;
    }
</style>

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Data Customer </h1>
            </div>
            <!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-body">
  
                    <form action="{{($tipx=='new')? url('/pegawai/store/') : url('/pegawai/update/'.$header->NO_ID ) }}" method="POST" name ="entri" id="entri" >
  
                      @csrf
						
                        <ul class="nav nav-tabs">
                            <li class="nav-item active">
                                <a class="nav-link active" href="#pegawaiInfo" data-toggle="tab">Pegawai Info</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#bankInfo" data-toggle="tab">Bank Info</a>
                            </li> -->
                        </ul>
        
                        <div class="tab-content mt-3">
							<div id="pegawaiInfo" class="tab-pane active">
        
                             <div class="form-group row">
                                <div class="col-md-1">
                                    <label for="KODEP" class="form-label">Kode</label>
                                </div>
 
                                    <input type="text" class="form-control NO_ID" id="NO_ID" name="NO_ID"
                                    placeholder="Masukkan NO_ID" value="{{$header->NO_ID ?? ''}}" hidden readonly>

									<input name="tipx" class="form-control flagz" id="tipx" value="{{$tipx}}" hidden>
		 

								<div class="col-md-2">
                                    <input type="text" class="form-control KODEP" id="KODEP" name="KODEP"
                                    placeholder="Masukkan Kode Customer" value="{{$header->KODEP}}" readonly>
                                </div>                                
                            </div>

							<div class="form-group row">
                                <div class="col-md-1">
                                    <label for="NAMAP" class="form-label">Nama</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control NAMAP" id="NAMAP" name="NAMAP"
                                    placeholder="Masukkan Nama Customer" value="{{$header->NAMAP}}">
                                </div>                                
                            </div>
        
                            <div class="form-group row">
                                <div class="col-md-1">
                                    <label for="ALAMAT" class="form-label">Alamat</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control ALAMAT" id="ALAMAT" name="ALAMAT"
                                    placeholder="Masukkan Alamat" value="{{$header->ALAMAT}}">
                                </div>
							</div>

							<div class="form-group row">
                                <div class="col-md-1">
                                    <label for="KOTA" class="form-label">Kota</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control KOTA" id="KOTA" name="KOTA"
                                    placeholder="Masukkan Kota" value="{{$header->KOTA}}">
                                </div>
                            </div>
        
							<div class="form-group row">
                                <div class="col-md-1">
                                    <label for="TELPON1" class="form-label">Telpon</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control TELPON1" id="TELPON1"name="TELPON1"
                                    placeholder="Masukkan Telpon" value="{{$header->TELPON1}}">
                                </div>
                            </div>

							<div class="form-group row">
                                <div class="col-md-1">
                                    <label for="NO_KTP" class="form-label">No KTP</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control NO_KTP" id="NO_KTP"name="NO_KTP"
                                    placeholder="Masukkan Fax" value="{{$header->NO_KTP}}">
                                </div>
                            </div>
 
							<div class="form-group row">

								<div class="col-md-1">
                                    <label for="TELPON" class="form-label">Telpon</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control TELPON" id="TELPON"name="TELPON"
                                    placeholder="Masukkan Kontak" value="{{$header->TELPON}}">
                                </div>

                                <div class="col-md-1">
                                    <label for="HP" class="form-label">HP</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control HP" id="HP"name="HP"
                                    placeholder="Masukkan HP" value="{{$header->HP}}">
                                </div>
                            </div>
 
							<div class="form-group row">
                                <div class="col-md-1">
                                    <label for="UMAKAN" class="form-label">Uang Makan</label>
                                </div>
								<div class="col-md-2">
									<input type="text" class="form-control UMAKAN" onclick="select()"  id="UMAKAN" name="UMAKAN" placeholder="UMAKAN" value="{{ number_format($header->UMAKAN, 2, '.', ',') }}" style="text-align: right; width:140px" readonly>
								</div> 
                            </div> 

							<div class="form-group row">
                                <div class="col-md-1">
                                    <label for="PERSEN" class="form-label">Persentase</label>
                                </div>
								<div class="col-md-2">
									<input type="text" class="form-control PERSEN" onclick="select()"  id="PERSEN" name="PERSEN" placeholder="PERSEN" value="{{ number_format($header->PERSEN, 2, '.', ',') }}" style="text-align: right; width:140px" readonly>
								</div> 

								<div class="col-md-1">
									<label for="GAJI" class="form-label">Gaji</label>
								</div>
								<div class="col-md-2">
									<input type="text" class="form-control GAJI" onclick="select()"  id="GAJI" name="GAJI" placeholder="GAJI" value="{{ number_format($header->GAJI, 2, '.', ',') }}" style="text-align: right; width:140px" readonly>
								</div>
                            </div> 

							
							<!-- <div id="bankInfo" class="tab-pane">
				
								<div class="form-group row">
									<div class="col-md-1">
										<label for="BANK" class="form-label">Bank</label>
									</div>
									<div class="col-md-2">
										<select name="BANK" id="BANK" class="form-control BANK" style="width: 300px">
											<option value="">--Pilih Bank--</option>
											@foreach($pilihbank as $pilihbankD)
												<option value="{{$pilihbankD->KODE}}" {{ $header->BANK == $pilihbankD->KODE ? 'selected' : '' }}>{{ $pilihbankD->NAMA }}</option>
											@endforeach
										</select>
									</div>                                  
								</div>

								<div class="form-group row">							       
									<div class="col-md-1">
										<label for="BANK_CAB" class="form-label">Cabang</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control BANK_CAB" id="BANK_CAB" name="BANK_CAB" placeholder="Masukkan Cabang" value="{{$header->BANK_CAB}}">
									</div>
								</div>

								<div class="form-group row">							       
									<div class="col-md-1">
										<label for="BANK_KOTA" class="form-label">Kota</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="form-control BANK_KOTA" id="BANK_KOTA" name="BANK_KOTA" placeholder="Masukkan Kota" value="{{$header->BANK_KOTA}}">
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-md-1">
										<label for="BANK_NAMA" class="form-label">A/N</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control BANK_NAMA" id="BANK_NAMA" name="BANK_NAMA" placeholder="Masukkan Nama" value="{{$header->BANK_NAMA}}">
									</div>                                
								</div>
								
								<div class="form-group row">
									<div class="col-md-1">
										<label for="BANK_REK" class="form-label">Rek</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control BANK_REK" id="BANK_REK" name="BANK_REK" placeholder="Masukkan Nomor Rekening" value="{{$header->BANK_REK}}">
									</div>                                
								</div>
								
								<div class="form-group row">
									<div class="col-md-1">
										<label for="LIM" class="form-label">Kredit Limit</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="form-control LIM" onclick="select()"  id="LIM" name="LIM" placeholder="LIM" value="{{ number_format($header->LIM, 2, '.', ',') }}" style="text-align: right; width:140px" readonly>
									</div>                                
								</div>
								
								<div class="form-group row">
									<div class="col-md-1">
										<label for="HARI" class="form-label">Jatuh Tempo (Hari)</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="form-control HARI" onclick="select()" id="HARI" name="HARI" placeholder="Masukkan Jumlah Hari" style="text-align: right; width:140px" value="{{$header->HARI}}">
									</div>                                
								</div>
								
							</div> -->
						</div>
                                
                        </div>
        
						<div class="mt-3 col-md-12 form-group row">
							<div class="col-md-4">
								<button type="button" id='TOPX'  onclick="location.href='{{url('/pegawai/edit/?idx=' .$idx. '&tipx=top')}}'" class="btn btn-outline-primary">Top</button>
								<button type="button" id='PREVX' onclick="location.href='{{url('/pegawai/edit/?idx='.$header->NO_ID.'&tipx=prev&kodex='.$header->KODEP )}}'" class="btn btn-outline-primary">Prev</button>
								<button type="button" id='NEXTX' onclick="location.href='{{url('/pegawai/edit/?idx='.$header->NO_ID.'&tipx=next&kodex='.$header->KODEP )}}'" class="btn btn-outline-primary">Next</button>
								<button type="button" id='BOTTOMX' onclick="location.href='{{url('/pegawai/edit/?idx=' .$idx. '&tipx=bottom')}}'" class="btn btn-outline-primary">Bottom</button>
							</div>
							<div class="col-md-5">
								<button type="button" id='NEWX' onclick="location.href='{{url('/pegawai/edit/?idx=0&tipx=new')}}'" class="btn btn-warning">New</button>
								<button type="button" id='EDITX' onclick='hidup()' class="btn btn-secondary">Edit</button>                    
								<button type="button" id='UNDOX' onclick="location.href='{{url('/pegawai/edit/?idx=' .$idx. '&tipx=undo' )}}'" class="btn btn-info">Undo</button> 
								<button type="button" id='SAVEX' onclick='simpan()'   class="btn btn-success" class="fa fa-save"></i>Save</button>

							</div>
							<div class="col-md-3">
								<button type="button" id='HAPUSX'  onclick="hapusTrans()" class="btn btn-outline-danger">Hapus</button>
								<button type="button" id='CLOSEX'  onclick="location.href='{{url('/pegawai' )}}'" class="btn btn-outline-secondary">Close</button>


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
@endsection

@section('footer-scripts')

<script src="{{ asset('js/autoNumerics/autoNumeric.min.js') }}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="{{asset('foxie_js_css/bootstrap.bundle.min.js')}}"></script>


<script>
    var target;
	var idrow = 1;

	function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

    $(document).ready(function () {

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
		}

        if ( $tipx != 'new' )
		{
			 //mati();	
    		 ganti();
		} 

		$("#LIM").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999.99'});
		// $("#HARI").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999'});
		
    });


	function baru() {
		
		 kosong();
		 hidup();
		 
	}
	
	function ganti() {
		
		// mati();
		hidup();
	
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
	    $("#CLOSEX").attr("disabled", true);
		
		
 		$tipx = $('#tipx').val();
		
        if ( $tipx == 'new' )		
		{	
		  	
			$("#KODEP").attr("readonly", false);	

		   }
		else
		{
	     	$("#KODEP").attr("readonly", true);	

		   }
		   
		
		$("#NAMAP").attr("readonly", false);	
		$("#ALAMAT").attr("readonly", false);			
		$("#KOTA").attr("readonly", false);		
		$("#TELPON1").attr("readonly", false);			
		$("#NO_KTP").attr("readonly", false);	
		$("#HP").attr("readonly", false);			
		$("#AKT").attr("readonly", false);		
		$('#TELPON').attr("readonly", false);

		 $('#UMAKAN').attr("readonly", false);	
		 $('#PERSEN').attr("readonly", false);	
		 $('#GAJI').attr("readonly", false);


		 $('#BANK').attr("readonly", false);	
		 $('#BANK_CAB').attr("readonly", false);	
		 $('#BANK_KOTA').attr("readonly", false);	
		 $('#BANK_NAMA').attr("readonly", false);		
		 $('#BANK_REK').attr("readonly", false);
		 $('#HARI').attr("readonly", false);
		 $('#LIM').attr("readonly", false);
		
		//document.getElementById("KET").disabled = false;
		
	
	
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
		
		$("#KODEP").attr("readonly", true);			
		$("#NAMAP").attr("readonly", true);	
		$("#ALAMAT").attr("readonly", true);			
		$("#KOTA").attr("readonly", true);		
		$("#TELPON1").attr("readonly", true);			
		$("#NO_KTP").attr("readonly", true);	
		$("#HP").attr("readonly", true);			
		$("#AKT").attr("readonly", true);		
		$('#TELPON').attr("readonly", true);

		$('#UMAKAN').attr("readonly", true);	
		$('#PERSEN').attr("readonly", true);	
		$('#GAJI').attr("readonly", true);


		 $('#BANK').attr("readonly", true);	
		 $('#BANK_CAB').attr("readonly", true);	
		 $('#BANK_KOTA').attr("readonly", true);	
		 $('#BANK_NAMA').attr("readonly", true);		
		 $('#BANK_REK').attr("readonly", true);
		 $('#HARI').attr("readonly", true);
		 $('#LIM').attr("readonly", true);	
		
	}


	function kosong() {
				
		 $('#KODEP').val("");	
		 $('#NAMAP').val("");	
		 $('#ALAMAT').val("");	
		 $('#KOTA').val("");		

		 $('#TELPON1').val("");	
		 $('#NO_KTP').val("");	
		 $('#HP').val("");	
		 $('#AKT').val("0");		
		 $('#TELPON').val("");

		 $('#EMAIL').val("");	
		 $('#NPWP').val("");	
		 $('#KET').val("");	


		 $('#BANK').val("");	
		 $('#BANK_CAB').val("");	
		 $('#BANK_KOTA').val("");	
		 $('#BANK_NAMA').val("");		
		 $('#BANK_REK').val("");
		 $('#UMAKAN').val("0");
		 $('#PERSEN').val("0");	
		 $('#GAJI').val("0");	

		 
	}
	
	function hapusTrans() {
		let text = "Hapus Master "+$('#KODEP').val()+"?";
		if (confirm(text) == true) 
		{
			window.location ="{{url('/pegawai/delete/'.$header->NO_ID )}}'";
			//return true;
		} 
		return false;
	}

	function CariBukti() {
		
		var cari = $("#CARI").val();
		var loc = "{{ url('/pegawai/edit/') }}" + '?idx={{ $header->NO_ID}}&tipx=search&kodex=' +encodeURIComponent(cari);
		window.location = loc;
		
	}
	

     var hasilCek;
	function cekCust(kodec) {
		$.ajax({
			type: "GET",
			url: "{{url('pegawai/cekpegawai')}}",
            async: false,
			data: ({ KODEP: kodec, }),
			success: function(data) {
                if (data.length > 0) {
                    $.each(data, function(i, item) {
                        hasilCek=data[i].ADA;
                    });
                }
			},
			error: function() {
				alert('Error cekCust occured');
			}
		});
		return hasilCek;
	}
    
	function simpan() {
        //cekCust($('#KODEP').val());
        //(hasilCek==0) ? document.getElementById("entri").submit() : alert('Customer '+$('#KODEP').val()+' sudah ada!');
        document.getElementById("entri").submit() 
	}
</script>
@endsection

