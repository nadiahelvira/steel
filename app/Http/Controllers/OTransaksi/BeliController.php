<?php

namespace App\Http\Controllers\OTransaksi;

use App\Http\Controllers\Controller;
// ganti 1

use App\Models\OTransaksi\Beli;
use App\Models\OTransaksi\BeliDetail;
use App\Models\Master\Sup;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use Carbon\Carbon;

include_once base_path() . "/vendor/simitgroup/phpjasperxml/version/1.1/PHPJasperXML.inc.php";
use PHPJasperXML;

// ganti 2
class BeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    var $judul = '';
    var $FLAGZ = '';
	
    function setFlag(Request $request)
    {
        if ( $request->flagz == 'BL' ) {
            $this->judul = "Pembelian";
        }

        $this->FLAGZ = $request->flagz;

    }
		
    public function index(Request $request)
    {


	    $this->setFlag($request);
        // ganti 3
        return view('otransaksi_beli.index')->with(['judul' => $this->judul, 'flagz' => $this->FLAGZ]);
	
		
    }
	
		public function browse(Request $request)
    {
        $golz = $request->GOL;

        $CBG = Auth::user()->CBG;
		
        $beli = DB::SELECT("SELECT distinct PO.NO_BUKTI , PO.KODES, PO.NAMAS, 
		                  PO.ALAMAT, PO.KOTA from beli, belid 
                          WHERE PO.NO_BUKTI = POD.NO_BUKTI AND PO.GOL ='$golz' AND CBG = '$CBG'
                          AND POD.SISA > 0	");
        return response()->json($beli);
    }

    public function browseuang(Request $request)
    {
        //	$beli = DB::table('beli')->select('NO_BUKTI', 'TGL', 'KODES','NAMAS', 'ALAMAT','KOTA', 'PERB','PERBB', 'SISA' )->where('PERB', '<>' ,'PERBB')->where('LNS', '<>',1)->where('GOL', 'Y')->orderBy('KODES', 'ASC')->get();
        $filterkodes = '';
	   
		$CBG = Auth::user()->CBG;

		if($request->KODES)
		{
	
			// $filterkodes = " WHERE SISA <> 0 AND KODES='".$request->KODES."' ";
			$filterkodes = " AND  KODES='".$request->KODES."' ";
		}
		
		$beli = DB::SELECT("SELECT NO_BUKTI, TGL, KODES, 
		            NAMAS, TOTAL, BAYAR, SISA from beli  WHERE SISA <> 0
		            $filterkodes 
                    ORDER BY NO_BUKTI ");
 
        return response()->json($beli);
    }


	public function index_posting(Request $request)
    {
 
        return view('otransaksi_beli.post');
    }
	  
	//SHELVI
	
	public function browse_detail(Request $request)
    {
		$filterbukti = '';
		if($request->NO_PO)
		{
	
			$filterbukti = " WHERE a.NO_BUKTI='".$request->NO_PO."' AND a.KD_BRG = b.KD_BRG ";
		}
		$belid = DB::SELECT("SELECT a.REC, a.KD_BRG, a.NA_BRG, a.SATUAN , a.QTY, a.HARGA, a.KIRIM, a.SISA, 
                                b.SATUAN AS SATUAN_PO, a.QTY AS QTY_PO, '1' AS X
                            from belid a, brg b 
                            $filterbukti ORDER BY NO_BUKTI ");
	

		return response()->json($belid);
	}


    public function browse_detail2(Request $request)
    {
		$filterbukti = '';
		if($request->NO_PO)
		{
	
			$filterbukti = " WHERE NO_BUKTI='".$request->NO_PO."' AND a.KD_BRG = b.KD_BRG ";
		}
		$belid = DB::SELECT("SELECT a.REC, a.KD_BRG, a.NA_BRG, a.SATUAN , a.QTY, a.HARGA, a.KIRIM, a.SISA, 
                                b.SATUAN AS SATUAN_PO, a.QTY AS QTY_PO, '1' AS X 
                            from belid a, brg b
                            $filterbukti ORDER BY NO_BUKTI ");
	

		return response()->json($belid);
	}
    // ganti 4



    public function getBeli(Request $request)
    {
        // ganti 5

       if ($request->session()->has('periode')) {
            $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];
        } else {
            $periode = '';
        }

		$this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $judul = $this->judul;

        $CBG = Auth::user()->CBG;
		
        $beli = DB::SELECT("SELECT * from beli  WHERE PER='$periode' and FLAG ='$this->FLAGZ' 
                            -- AND CBG = '$CBG'
                            ORDER BY NO_BUKTI ");
	  
	   
        // ganti 6

        return Datatables::of($beli)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (Auth::user()->divisi=="programmer" ) 
				{
                    //CEK POSTED di index dan edit

                    // url untuk delete di index
                    $url = "'".url("beli/delete/" . $row->NO_ID . "/?flagz=" . $row->FLAG)."'";
                    // batas

                    $btnEdit =   ($row->POSTED == 1) ? ' onclick= "alert(\'Transaksi ' . $row->NO_BUKTI . ' sudah diposting!\')" href="#" ' : ' href="beli/edit/?idx=' . $row->NO_ID . '&tipx=edit&flagz=' . $row->FLAG . '&judul=' . $this->judul . '"';					
                    $btnDelete = ($row->POSTED == 1) ? ' onclick= "alert(\'Transaksi ' . $row->NO_BUKTI . ' sudah diposting!\')" href="#" ' : ' onclick="deleteRow('.$url.')" ';


                    $btnPrivilege =
                        '
                                <a class="dropdown-item" ' . $btnEdit . '>
                                <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <a class="dropdown-item btn btn-danger" href="beli/cetak/' . $row->NO_ID . '">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                    Print
                                </a> 									
                                <hr></hr>
                                <a class="dropdown-item btn btn-danger" ' . $btnDelete . '>
   
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    Delete
                                </a> 
                        ';
                } else {
                    $btnPrivilege = '';
                }

                $actionBtn =
                    '
                    <div class="dropdown show" style="text-align: center">
                        <a class="btn btn-secondary dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            

                            ' . $btnPrivilege . '
                        </div>
                    </div>
                    ';

                return $actionBtn;
            })
			
	
			->addColumn('cek', function ($row) {
                return
                    '
                    <input type="checkbox" name="cek[]" class="form-control cek" ' . (($row->POSTED == 1) ? "checked" : "") . '  value="' . $row->NO_ID . '" ' . (($row->POSTED == 2) ? "disabled" : "") . '></input> 				
                    ';
            
            })			
			
            ->rawColumns(['action','cek'])
            ->make(true);
    }


//////////////////////////////////////////////////////////////////////////////////

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate(
            $request,
            // GANTI 9

            [
                'TGL'      => 'required'

            ]
        );

        //////     nomer otomatis
		$this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $judul = $this->judul;
		
        $CBG = Auth::user()->CBG;
		
        $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];

        $bulan    = session()->get('periode')['bulan'];
        $tahun    = substr(session()->get('periode')['tahun'], -2);

        $query = DB::table('beli')->select('NO_BUKTI')->where('PER', $periode)->where('FLAG', $this->FLAGZ)->where('CBG', $CBG)
                ->orderByDesc('NO_BUKTI')->limit(1)->get();

        if ($query != '[]') {
            $query = substr($query[0]->NO_BUKTI, -4);
            $query = str_pad($query + 1, 4, 0, STR_PAD_LEFT);
            $no_bukti = $this->FLAGZ . $CBG . $tahun . $bulan . '-' . $query;
        } else {
            $no_bukti = $this->FLAGZ . $CBG . $tahun . $bulan . '-0001';
        }		

        $beli = Beli::create(
            [
                'NO_BUKTI'         => $no_bukti,
                'TGL'              => date('Y-m-d', strtotime($request['TGL'])),
                'PER'              => $periode,
                'FLAG'             => $this->FLAGZ,
                'NOTES'            => ($request['NOTES']==null) ? "" : $request['NOTES'],	
				'KODES'            => ($request['KODES'] == null) ? "" : $request['KODES'],
                'NAMAS'            => ($request['NAMAS'] == null) ? "" : $request['NAMAS'],
                'ALAMAT'           => ($request['ALAMAT'] == null) ? "" : $request['ALAMAT'],
                'KOTA'             => ($request['KOTA'] == null) ? "" : $request['KOTA'],
                'HARI'            => (float) str_replace(',', '', $request['HARI']),			
                'TOTAL_QTY'        => (float) str_replace(',', '', $request['TTOTAL_QTY']),
                'USRNM'            => Auth::user()->username,
                'TG_SMP'           => Carbon::now(),
				'created_by'       => Auth::user()->username,
				'CBG'              => $CBG,
            ]
        );


		$REC        = $request->input('REC');
		$KD_BRG	= $request->input('KD_BRG');
		$NA_BRG	= $request->input('NA_BRG');
		$SATUAN	= $request->input('SATUAN');
		// $QTYC	= $request->input('QTYC');
		// $QTYR	= $request->input('QTYR');
		$QTY	= $request->input('QTY');
		$KET	= $request->input('KET');
        $HARGA      = $request->input('HARGA');		
        $PPNX      = $request->input('PPNX');		
        $DPP      = $request->input('DPP');		
        $TOTAL      = $request->input('TOTAL');

        // Check jika value detail ada/tidak
        if ($REC) {
            foreach ($REC as $key => $value) {
                // Declare new data di Model
                $detail    = new BeliDetail;

                // Insert ke Database
                $detail->NO_BUKTI    = $no_bukti;
                $detail->REC         = $REC[$key];
                $detail->PER         = $periode;
                $detail->FLAG        = $this->FLAGZ;	
				$detail->KD_BRG	     = ($KD_BRG[$key]==null) ? "" :  $KD_BRG[$key];
				$detail->NA_BRG	     = ($NA_BRG[$key]==null) ? "" :  $NA_BRG[$key];
				$detail->SATUAN	     = ($SATUAN[$key]==null) ? "" :  $SATUAN[$key];
				// $detail->QTYC	     = (float) str_replace(',', '', $QTYC[$key]);
				// $detail->QTYR	     = (float) str_replace(',', '', $QTYR[$key]);
				$detail->QTY	     = (float) str_replace(',', '', $QTY[$key]);
				$detail->KET	     = ($KET[$key]==null) ? "" :  $KET[$key];	
                $detail->HARGA       = (float) str_replace(',', '', $HARGA[$key]);
                $detail->PPN       = (float) str_replace(',', '', $PPNX[$key]);
                $detail->DPP       = (float) str_replace(',', '', $DPP[$key]);
                $detail->TOTAL       = (float) str_replace(',', '', $TOTAL[$key]); 					
                $detail->save();
            }
        }	

		$variablell = DB::select('call beliins(?)', array($no_bukti));
        
		$no_buktix = $no_bukti;
        
		$beli = Beli::where('NO_BUKTI', $no_buktix )->first();

        
        DB::SELECT("UPDATE beli, SUP
                    SET beli.NAMAS = SUP.NAMAS, beli.ALAMAT = SUP.ALAMAT, beli.KOTA = SUP.KOTA, beli.PKP=SUP.PKP, beli.HARI = SUP.HARI  WHERE beli.KODES = SUP.KODES 
                    AND beli.NO_BUKTI='$no_buktix';");

        DB::SELECT("UPDATE beli,  belid
                            SET  belid.ID =  beli.NO_ID  WHERE  beli.NO_BUKTI =  belid.NO_BUKTI 
							AND  beli.NO_BUKTI='$no_buktix';");

		
					 
        return redirect('/beli/edit/?idx=' . $beli->NO_ID . '&tipx=edit&flagz=' . $this->FLAGZ . '&judul=' . $this->judul . '');
		
    }

   public function edit( Request $request , Beli $beli)
    {


		$per = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];
		
				
        // $cekperid = DB::SELECT("SELECT POSTED from perid WHERE PERIO='$per'");
        // if ($cekperid[0]->POSTED==1)
        // {
        //     return redirect('/beli')
		// 	       ->with('status', 'Maaf Periode sudah ditutup!')
        //            ->with(['judul' => $judul, 'flagz' => $FLAGZ]);
        // }
		
		$this->setFlag($request);
		
        $tipx = $request->tipx;

		$idx = $request->idx;
		
        $CBG = Auth::user()->CBG;
		
		if ( $idx =='0' && $tipx=='undo'  )
	    {
			$tipx ='top';
			
		   }
		   
		 
		   
		if ($tipx=='search') {
			
		   	
    	   $buktix = $request->buktix;
		   
		   $bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from beli
		                 where PER ='$per' and FLAG ='$this->FLAGZ'
						 and NO_BUKTI = '$buktix' AND CBG = '$CBG'					 
		                 ORDER BY NO_BUKTI ASC  LIMIT 1" );
						 
			
			if(!empty($bingco)) 
			{
				$idx = $bingco[0]->NO_ID;
			  }
			else
			{
				$idx = 0; 
			  }
		
					
		}
		
		if ($tipx=='top') {
			

		   $bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from beli
		                 where PER ='$per' 
						 and FLAG ='$this->FLAGZ' AND CBG = '$CBG'  
		                 ORDER BY NO_BUKTI ASC  LIMIT 1" );
						 
		
			if(!empty($bingco)) 
			{
				$idx = $bingco[0]->NO_ID;
			  }
			else
			{
				$idx = 0; 
			  }
		
					
		}
		
		
		if ($tipx=='prev' ) {
			
    	   $buktix = $request->buktix;
			
		   $bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from beli     
		             where PER ='$per' 
					 and FLAG ='$this->FLAGZ' AND CBG = '$CBG'
                     and NO_BUKTI < 
					 '$buktix' ORDER BY NO_BUKTI DESC LIMIT 1" );
			

			if(!empty($bingco)) 
			{
				$idx = $bingco[0]->NO_ID;
			  }
			else
			{
				$idx = $idx; 
			  }
			  
		}
		
		
		if ($tipx=='next' ) {
			
				
      	   $buktix = $request->buktix;
	   
		   $bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from beli    
		             where PER ='$per'  
					 and FLAG ='$this->FLAGZ' AND CBG = '$CBG'
                     and NO_BUKTI > 
					 '$buktix' ORDER BY NO_BUKTI ASC LIMIT 1" );
					 
			if(!empty($bingco)) 
			{
				$idx = $bingco[0]->NO_ID;
			  }
			else
			{
				$idx = $idx; 
			  }
			  
			
		}

		if ($tipx=='bottom') {
		  
    		$bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from beli
						where PER ='$per'
						and FLAG ='$this->FLAGZ' AND CBG = '$CBG'  
		              ORDER BY NO_BUKTI DESC  LIMIT 1" );
					 
			if(!empty($bingco)) 
			{
				$idx = $bingco[0]->NO_ID;
			  }
			else
			{
				$idx = 0; 
			  }
			  
			
		}

        
		if ( $tipx=='undo' || $tipx=='search' )
	    {
        
			$tipx ='edit';
			
		   }
		
		

       	if ( $idx != 0 ) 
		{
			$beli = Beli::where('NO_ID', $idx )->first();	
	     }
		 else
		 {
				$beli = new Beli;
                $beli->TGL = Carbon::now();
				
				
		 }

        $no_bukti = $beli->NO_BUKTI;
        $beliDetail = DB::table('belid')->where('NO_BUKTI', $no_bukti)->orderBy('REC')->get();
		
		$data = [
            'header'        => $beli,
			'detail'        => $beliDetail

        ];
 
 		$sup = DB::SELECT("SELECT KODES, CONCAT(NAMAS,'-',KOTA) AS NAMAS FROM SUP 
		                 ORDER BY NAMAS ASC" );
		
         
         return view('otransaksi_beli.edit', $data)->with(['sup' => $sup])
		 ->with(['tipx' => $tipx, 'idx' => $idx, 'flagz' => $this->FLAGZ, 'judul'=> $this->judul ]);
			 

    }

  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 18

    public function update(Request $request, Beli $beli)
    {

        $this->validate(
            $request,
            [

                'TGL'      => 'required'
            ]
        );

		$this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $judul = $this->judul;
		
        $variablell = DB::select('call belidel(?)', array($beli['NO_BUKTI']));


        $CBG = Auth::user()->CBG;
		
        $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];


        $beli->update(
            [
                'TGL'              => date('Y-m-d', strtotime($request['TGL'])),
                'NOTES'            => ($request['NOTES']==null) ? "" : $request['NOTES'],
                'KODES'            => ($request['KODES'] == null) ? "" : $request['KODES'],
                'NAMAS'            => ($request['NAMAS'] == null) ? "" : $request['NAMAS'],
                'ALAMAT'           => ($request['ALAMAT'] == null) ? "" : $request['ALAMAT'],
                'KOTA'             => ($request['KOTA'] == null) ? "" : $request['KOTA'],				
                'HARI'             => ($request['HARI'] == null) ? "" : $request['HARI'],				
                'TOTAL_QTY'        => (float) str_replace(',', '', $request['TTOTAL_QTY']),
				'USRNM'            => Auth::user()->username,
                'TG_SMP'           => Carbon::now(),
				'updated_by'       => Auth::user()->username,
                'FLAG'             => $this->FLAGZ,	
                'CBG'              => $CBG,	
            ]
        );

		$no_buktix = $beli->NO_BUKTI;
		
        // Update Detail
        $length = sizeof($request->input('REC'));
        $NO_ID  = $request->input('NO_ID');

        $REC    = $request->input('REC');

        $KD_BRG	= $request->input('KD_BRG');
		$NA_BRG	= $request->input('NA_BRG');
		$SATUAN	= $request->input('SATUAN');
		// $QTYC	= $request->input('QTYC');
		// $QTYR	= $request->input('QTYR');
		$QTY	= $request->input('QTY');
		$KET	= $request->input('KET');	
        $HARGA      = $request->input('HARGA');
        $PPNX      = $request->input('PPNX');
        $DPP      = $request->input('DPP');
        $TOTAL      = $request->input('TOTAL');

        $query = DB::table('belid')->where('NO_BUKTI', $request->NO_BUKTI)->whereNotIn('NO_ID',  $NO_ID)->delete();

        // Update / Insert
        for ($i = 0; $i < $length; $i++) {
            // Insert jika NO_ID baru
            if ($NO_ID[$i] == 'new') {
                $insert = BeliDetail::create(
                    [
                        'NO_BUKTI'   => $request->NO_BUKTI,
                        'REC'        => $REC[$i],
                        'PER'        => $periode,
                        'FLAG'       => $this->FLAGZ,
                        'KD_BRG'     => ($KD_BRG[$i]==null) ? "" :  $KD_BRG[$i],
                        'NA_BRG'     => ($NA_BRG[$i]==null) ? "" : $NA_BRG[$i],	
                        'SATUAN'     => ($SATUAN[$i]==null) ? "" : $SATUAN[$i],
						'KET'     	 => ($KET[$i]==null) ? "" : $KET[$i],
                        // 'QTYC'      => (float) str_replace(',', '', $QTYC[$i]),
                        // 'QTYR'      => (float) str_replace(',', '', $QTYR[$i]),
                        'HARGA'      => (float) str_replace(',', '', $HARGA[$i]),
                        'PPN'      => (float) str_replace(',', '', $PPNX[$i]),
                        'DPP'      => (float) str_replace(',', '', $DPP[$i]),
                        'TOTAL'      => (float) str_replace(',', '', $TOTAL[$i]),
						'QTY'        => (float) str_replace(',', '', $QTY[$i])	
						
                    ]
                );
            } else {
                // Update jika NO_ID sudah ada
                $upsert = BeliDetail::updateOrCreate(
                    [
                        'NO_BUKTI'  => $request->NO_BUKTI,
                        'NO_ID'     => (int) str_replace(',', '', $NO_ID[$i])
                    ],

                    [
                        'REC'        => $REC[$i],

                        'KD_BRG'     => ($KD_BRG[$i]==null) ? "" :  $KD_BRG[$i],
                        'NA_BRG'     => ($NA_BRG[$i]==null) ? "" : $NA_BRG[$i],	
                        'SATUAN'     => ($SATUAN[$i]==null) ? "" : $SATUAN[$i],
						'KET'     	 => ($KET[$i]==null) ? "" : $KET[$i],
                        // 'QTYC'      => (float) str_replace(',', '', $QTYC[$i]),
                        // 'QTYR'      => (float) str_replace(',', '', $QTYR[$i]),
                        'HARGA'      => (float) str_replace(',', '', $HARGA[$i]),
                        'PPN'      => (float) str_replace(',', '', $PPNX[$i]),
                        'DPP'      => (float) str_replace(',', '', $DPP[$i]),
                        'TOTAL'      => (float) str_replace(',', '', $TOTAL[$i]),
						'QTY'        => (float) str_replace(',', '', $QTY[$i]),
                        'FLAG'       => $this->FLAGZ,
                        'PER'        => $periode,					
                    ]
                );
            }
        }

 		$beli = Beli::where('NO_BUKTI', $no_buktix )->first();

        $no_bukti = $beli->NO_BUKTI;

        $variablell = DB::select('call beliins(?)', array($beli['NO_BUKTI']));

        DB::SELECT("UPDATE BELI, SUP
                    SET BELI.NAMAS = SUP.NAMAS, BELI.ALAMAT = SUP.ALAMAT, BELI.KOTA = SUP.KOTA, BELI.PKP=SUP.PKP, BELI.HARI = SUP.HARI  WHERE BELI.KODES = SUP.KODES 
                    AND BELI.NO_BUKTI='$no_buktix';");


        DB::SELECT("UPDATE beli,  belid
                    SET  belid.ID =  beli.NO_ID  WHERE  beli.NO_BUKTI =  belid.NO_BUKTI 
                    AND  beli.NO_BUKTI='$no_bukti';");
					 
        return redirect('/beli/edit/?idx=' . $beli->NO_ID . '&tipx=edit&flagz=' . $this->FLAGZ . '&judul=' . $this->judul . '');	
		
	   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 22

    public function destroy(Request $request, Beli $beli)
    {

		$this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $judul = $this->judul;
		
		$per = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];
        $cekperid = DB::SELECT("SELECT POSTED from perid WHERE PERIO='$per'");
        if ($cekperid[0]->POSTED==1)
        {
            return redirect()->route('beli')
                ->with('status', 'Maaf Periode sudah ditutup!')
                ->with(['judul' => $this->judul, 'flagz' => $this->FLAGZ]);
        }

        $variablell = DB::select('call belidel(?)', array($beli['NO_BUKTI']));
		
        $deleteBeli = Beli::find($beli->NO_ID);

        $deleteBeli->delete();

       return redirect('/beli?flagz='.$FLAGZ)->with(['judul' => $judul, 'flagz' => $FLAGZ ])->with('statusHapus', 'Data '.$beli->NO_BUKTI.' berhasil dihapus');


    }
    
    public function cetak(Beli $beli, Request $request)
    {
        $no_beli = $beli->NO_BUKTI;

        // $kd_brg = strval($request->KD_BRG);
        // $kd_brgx = strval($kd_brg);

        $file     = 'belic';

        $flagz1 = $beli->FLAG;
        $judul ='';
        
        if ( $flagz1 =='BL')
        {
                $judul ='Order Pembelian';
        
        }
        
        if ( $flagz1 =='RB')
        {
                $judul ='Retur Pembelian';    
        }
        
        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));

        $query = DB::SELECT("SELECT beli.NO_BUKTI, beli.TGL, beli.KODES, beli.NAMAS, beli.TOTAL_QTY, beli.NOTES, beli.ALAMAT, 
                                    beli.KOTA, belid.KD_BRG, belid.NA_BRG, belid.SATUAN, belid.QTY,
                                    belid.HARGA AS HARGA, belid.TOTAL, belid.KET,  beli.NETT, beli.USRNM, belid.PPN, belid.DPP
                            FROM beli, belid 
                            WHERE beli.NO_BUKTI='$no_beli' AND beli.NO_BUKTI = belid.NO_BUKTI 
                            ;
		");

                DB::SELECT("UPDATE BELI SET POSTED = 1 WHERE NO_BUKTI='$no_beli';");
                
        $data = [];

        foreach ($query as $key => $value) {
            array_push($data, array(
                'NO_BUKTI' => $query[$key]->NO_BUKTI,
                'TGL'      => $query[$key]->TGL,
                'KODES'    => $query[$key]->KODES,
                'NAMAS'    => $query[$key]->NAMAS,
                'ALAMAT'    => $query[$key]->ALAMAT,
                'KOTA'    => $query[$key]->KOTA,
                'KG'       => $query[$key]->KG,
                'HARGA'    => $query[$key]->HARGA,
                'TOTAL'    => $query[$key]->TOTAL,
                'BAYAR'    => $query[$key]->BAYAR,
                'NOTES'    => $query[$key]->NOTES,
                // 'KD_BRG'    => "`".strval($query[$key]->KD_BRG),
                'KD_BRG'    => $query[$key]->KD_BRG,
                
                'NA_BRG'    => $query[$key]->NA_BRG,
                'NA_BRG'    => $query[$key]->NA_BRG,
                'SATUAN'    => $query[$key]->SATUAN,
                'QTY'    => $query[$key]->QTY,
                'DISK'    => $query[$key]->DISK,
                'NETT'    => $query[$key]->NETT,
                'KET'    => $query[$key]->KET,
                'NO_PO'    => $query[$key]->NO_PO,
                'JUDUL'    => $judul,
                'USRNM'    => $query[$key]->USRNM,
                'KALI'    => $query[$key]->KALI,
                'TPPN'    => $query[$key]->TPPN,
                'TDISK'    => $query[$key]->TDISK,
                'TDPP'    => $query[$key]->TDPP,
                'PPN'    => $query[$key]->PPN,
                'DPP'    => $query[$key]->DPP
            ));
        }
		
        $PHPJasperXML->setData($data);
        ob_end_clean();
        $PHPJasperXML->outpage("I");
       
    }
	
	
	
	 public function posting(Request $request)
    {
      

    }
	
	
	public function getDetailBeli(){

        $no_bukti = $_GET['no_bukti'];
        $result = DB::table('belid')->where('NO_BUKTI', $no_bukti)->get();
        
        return response()->json($result);;
    }
	
	
	
	
	
}
