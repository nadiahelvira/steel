<?php

namespace App\Http\Controllers\OTransaksi;

use App\Http\Controllers\Controller;
// ganti 1

use App\Models\OTransaksi\Terima;
use App\Models\OTransaksi\TerimaDetail;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use Carbon\Carbon;

include_once base_path() . "/vendor/simitgroup/phpjasperxml/version/1.1/PHPJasperXML.inc.php";
use PHPJasperXML;

// ganti 2
class TerimabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    var $judul = '';
    var $FLAGZ = '';
    var $GOLZ = '';
	
    function setFlag(Request $request)
    {
        if ( $request->flagz == 'HP' && $request->golz == 'B' ) {
            $this->judul = "Terima Bahan Baku";
        } else if ( $request->flagz == 'HP' && $request->golz == 'J' ) {
            $this->judul = "Terima Barang B";
        } 
		
        $this->FLAGZ = $request->flagz;
        $this->GOLZ = $request->golz;


    }
		
    public function index(Request $request)
    {


	    $this->setFlag($request);

        // ganti 3
        return view('otransaksi_terimab.index')->with(['judul' => $this->judul, 'flagz' => $this->FLAGZ , 'golz' => $this->GOLZ]);
	
		
    }
	

	public function index_posting(Request $request)
    {
 
        return view('otransaksi_terimab.post');
    }

	
    
	
    // ganti 4



    public function getTerimab(Request $request)
    {
        // ganti 5

       if ($request->session()->has('periode')) {
            $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];
        } else {
            $periode = '';
        }

		$this->setFlag($request);	
        
		$CBG = Auth::user()->CBG;

        $terima = DB::SELECT("SELECT * from terima  WHERE PER='$periode' and FLAG = '$this->FLAGZ' 
                and GOL = '$this->GOLZ' AND CBG='$CBG' ORDER BY NO_BUKTI ");
	  
	   
        // ganti 6

        return Datatables::of($terima)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (Auth::user()->divisi=="programmer" ) 
				{
                    //CEK POSTED di index dan edit

                    $btnEdit =   ($row->POSTED == 1) ? ' onclick= "alert(\'Transaksi ' . $row->NO_BUKTI . ' sudah diposting!\')" href="#" ' : ' href="terimab/edit/?idx=' . $row->NO_ID . '&tipx=edit&flagz=' . $row->FLAG . '&judul=' . $this->judul . '&golz=' . $row->GOL . '"';					


                    $btnPrivilege =
                        '
                                <a class="dropdown-item" ' . $btnEdit . '>
                                <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <a class="dropdown-item btn btn-danger" href="terima/cetak/' . $row->NO_ID . '">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                    Print
                                </a>										
                                <hr></hr>

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


			
			
			
			
///            ->rawColumns(['action'])
 //           ->make(true);
//    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  
    // ganti 15

   
   public function edit( Request $request , Terima $terima)
    {


		$per = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];
		
				
        // $cekperid = DB::SELECT("SELECT POSTED from perid WHERE PERIO='$per'");
        // if ($cekperid[0]->POSTED==1)
        // {
        //     return redirect('/terima')
		// 	       ->with('status', 'Maaf Periode sudah ditutup!')
        //            ->with(['judul' => $judul, 'flagz' => $FLAGZ, 'golz' => $GOLZ]);
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
		   
		   $bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from terima
		                 where PER ='$per' and FLAG ='$this->FLAGZ' and GOL ='$this->GOLZ' 
						 and NO_BUKTI = '$buktix'						 
		                 and CBG = '$CBG' ORDER BY NO_BUKTI ASC  LIMIT 1" );
						 
			
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
			

		   $bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from terima 
		                 where PER ='$per' 
						 and FLAG ='$this->FLAGZ' and GOL ='$this->GOLZ'    
		                 and CBG = '$CBG' ORDER BY NO_BUKTI ASC  LIMIT 1" );
						 
		
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
			
		   $bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from terima     
		             where PER ='$per' 
					 and FLAG ='$this->FLAGZ' and GOL ='$this->GOLZ'  and NO_BUKTI < 
					 '$buktix' and CBG = '$CBG' ORDER BY NO_BUKTI DESC LIMIT 1" );
			

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
	   
		   $bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from terima    
		             where PER ='$per'  
					 and FLAG ='$this->FLAGZ' and GOL ='$this->GOLZ' and NO_BUKTI > 
					 '$buktix' and CBG = '$CBG' ORDER BY NO_BUKTI ASC LIMIT 1" );
					 
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
		  
    		$bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from terima
						where PER ='$per'
						and FLAG ='$this->FLAGZ' and GOL ='$this->GOLZ'   
		                and CBG = '$CBG' ORDER BY NO_BUKTI DESC  LIMIT 1" );
					 
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
			$terima = Terima::where('NO_ID', $idx )->first();	
	     }
		 else
		 {
				$terima = new Terima;
                $terima->TGL = Carbon::now();
				
				
		 }

        $no_bukti = $terima->NO_BUKTI;
        $terimaDetail = DB::table('terimad')->where('NO_BUKTI', $no_bukti)->orderBy('REC')->get();
		
		$data = [
            'header'        => $terima,
			'detail'        => $terimaDetail

        ];
 
         
         return view('otransaksi_terimab.edit', $data)
		 ->with(['tipx' => $tipx, 'idx' => $idx, 'flagz' =>$this->FLAGZ, 'judul' => $this->judul, 'golz' =>$this->GOLZ ]);
      
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 18

    public function update(Request $request, Terima $terima)
    {

        $this->validate(
            $request,
            [

                // ganti 19

 //               'NO_PO'       => 'required',
                'TGL'      => 'required'


            ]
        );

        // ganti 20
        $variablell = DB::select('call terimadel(?)', array($terima['NO_BUKTI']));

		$this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $GOLZ = $this->GOLZ;
        $judul = $this->judul;
		
        $CBG = Auth::user()->CBG;
		
        $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];

        // ganti 20

        $terima->update(
            [
                'TGL'               => date('Y-m-d', strtotime($request['TGL'])),
				'NO_MUAT'             => ($request['NO_MUAT'] == null) ? "" : $request['NO_MUAT'],
				'NO_PO'             => ($request['NO_PO'] == null) ? "" : $request['NO_PO'],
				'NO_BELI'           => ($request['NO_BELI'] == null) ? "" : $request['NO_BELI'],
                'KD_BRG'            => ($request['KD_BRG'] == null) ? "" : $request['KD_BRG'],
                'NA_BRG'            => ($request['NA_BRG'] == null) ? "" : $request['NA_BRG'],
                'NO_CONT'            => ($request['NO_CONT'] == null) ? "" : $request['NO_CONT'],
                'SOPIR'            => ($request['SOPIR'] == null) ? "" : $request['SOPIR'],
                'NOPOL'            => ($request['NOPOL'] == null) ? "" : $request['NOPOL'],
                'SEAL'            => ($request['SEAL'] == null) ? "" : $request['SEAL'],
                'FLAG'              => $FLAGZ,					
                'GOL'               => $GOLZ,			
                'TOTAL_QTYA'         => (float) str_replace(',', '', $request['TOTAL_QTYA']),
                'TOTAL_BENDELA'         => (float) str_replace(',', '', $request['TOTAL_BENDELA']),
                'TOTAL_IKATA'         => (float) str_replace(',', '', $request['TOTAL_IKATA']),
                
                'TOTAL_QTYB'         => (float) str_replace(',', '', $request['TOTAL_QTYB']),
                'TOTAL_BENDELB'         => (float) str_replace(',', '', $request['TOTAL_BENDELB']),
                'TOTAL_IKATB'         => (float) str_replace(',', '', $request['TOTAL_IKATB']),
                
                
                'S01'         => (float) str_replace(',', '', $request['S01']),
                'S02'         => (float) str_replace(',', '', $request['S02']),
                'S03'         => (float) str_replace(',', '', $request['S03']),
                
                'S04'         => (float) str_replace(',', '', $request['S04']),
                'S05'         => (float) str_replace(',', '', $request['S05']),
                'S06'         => (float) str_replace(',', '', $request['S06']),
                
                'S07'         => (float) str_replace(',', '', $request['S07']),
                'S08'         => (float) str_replace(',', '', $request['S08']),
                'S09'         => (float) str_replace(',', '', $request['S09']),
                
                'S10'         => (float) str_replace(',', '', $request['S10']),

                
                
                'QTY_BELI'          => (float) str_replace(',', '', $request['QTY_BELI']),
                'QTY_MUAT'          => (float) str_replace(',', '', $request['QTY_MUAT']),
				'USRNM'             => Auth::user()->username,
                'TG_SMP'            => Carbon::now(),
				'updated_by'        => Auth::user()->username,
                'CBG'               => $CBG,
            ]
        );

		$no_buktix = $terima->NO_BUKTI;
		
        // Update Detail
        $length = sizeof($request->input('REC'));
        $NO_ID  = $request->input('NO_ID');

        $REC    = $request->input('REC');

        $QTYA    = $request->input('QTYA');
        $BENDELA      = $request->input('BENDELA');
		$IKATA      = $request->input('IKATA');
        $QTYB       = $request->input('QTYB');
        $BENDELB       = $request->input('BENDELB');
        $IKATB     = $request->input('IKATB');

        $query = DB::table('terimad')->where('NO_BUKTI', $request->NO_BUKTI)->whereNotIn('NO_ID',  $NO_ID)->delete();

        // Update / Insert
        for ($i = 0; $i < $length; $i++) {
            // Insert jika NO_ID baru
            if ($NO_ID[$i] == 'new') {
                $insert = TerimaDetail::create(
                    [
                        'NO_BUKTI'   => $request->NO_BUKTI,
                        'REC'        => $REC[$i],
                        'PER'        => $periode,
                        'FLAG'       => $this->FLAGZ,
                        'GOL'        => $this->GOLZ,	
                        'QTYA'       => (float) str_replace(',', '', $QTYA[$i]),
                        'BENDELA'    => (float) str_replace(',', '', $BENDELA[$i]),
                        'IKATA'    => (float) str_replace(',', '', $IKATA[$i]),
                        'QTYB'       => (float) str_replace(',', '', $QTYB[$i]),
                        'BENDELB'    => (float) str_replace(',', '', $BENDELB[$i]),
                        'IKATB'    => (float) str_replace(',', '', $IKATB[$i]),
                        
						
                    ]
                );
            } else {
                // Update jika NO_ID sudah ada
                $upsert = TerimaDetail::updateOrCreate(
                    [
                        'NO_BUKTI'  => $request->NO_BUKTI,
                        'NO_ID'     => (int) str_replace(',', '', $NO_ID[$i])
                    ],

                    [
                        'REC'        => $REC[$i],

                        
                        'QTYA'       => (float) str_replace(',', '', $QTYA[$i]),
                        'BENDELA'    => (float) str_replace(',', '', $BENDELA[$i]),
                        'IKATA'    => (float) str_replace(',', '', $IKATA[$i]),

                        'QTYB'       => (float) str_replace(',', '', $QTYB[$i]),
                        'BENDELB'    => (float) str_replace(',', '', $BENDELB[$i]),
                        'IKATB'    => (float) str_replace(',', '', $IKATB[$i]),
                        
                        'FLAG'       => $this->FLAGZ,
                        'GOL'        => $this->GOLZ,						
                    ]
                );
            }
        }


        //  ganti 21
        $variablell = DB::select('call terimains(?)', array($terima['NO_BUKTI']));

 		$terima = Terima::where('NO_BUKTI', $no_buktix )->first();

        $no_bukti = $terima->NO_BUKTI;

        DB::SELECT("UPDATE terima,  terimad
                    SET  terimad.ID =  terima.NO_ID  WHERE  terima.NO_BUKTI =  terimad.NO_BUKTI 
                    AND  terima.NO_BUKTI='$no_bukti';");
					 
        return redirect('/terimab/edit/?idx=' . $terima->NO_ID . '&tipx=edit&flagz=' . $this->FLAGZ . '&judul=' . $this->judul .  '&golz=' . $this->GOLZ . '');	
		
	   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 22


    public function cetak(Terima $terima)
    {
        $no_terima = $terima->NO_BUKTI;

        $file     = 'terimac';
        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));

        $query = DB::SELECT("SELECT terima.NO_BUKTI, terima.TGL, terima.NO_MUAT, terima.NO_BELI, terima.NO_PO, terima.KD_BRG, terima.NA_BRG, 
                                    terima.QTY_BELI, terima.QTY_MUAT,
                                    terimad.NO_CONT, terimad.SOPIR, terimad.NOPOL, terimad.TELP, terimad.SEAL, 
                                    terimad.T_CONT, terimad.QTYA, terimad.BENDELA, terimad.IKATA, terimad.QTYB,
                                    terimad.BENDELB, terimad.IKATB
                            FROM terima, terimad 
                            WHERE terima.NO_BUKTI = terimad.NO_BUKTI AND terima.NO_BUKTI='$no_$terima' 
                            ;
		");

        
        $data = [];

        foreach ($query as $key => $value) {
            array_push($data, array(
                'NO_BUKTI' => $query[$key]->NO_BUKTI,
                'TGL'      => $query[$key]->TGL,
                'NO_MUAT'  => $query[$key]->NO_MUAT,
                'NO_BELI'  => $query[$key]->NO_BELI,
                'NO_PO'    => $query[$key]->NO_PO,
                'KD_BRG'   => $query[$key]->KD_BRG,
                'NA_BRG'   => $query[$key]->NA_BRG,
                'QTY_BELI' => $query[$key]->QTY_BELI,
                'NO_CONT'  => $query[$key]->NO_CONT,
                'SOPIR'    => $query[$key]->SOPIR,
                'NOPOL'    => $query[$key]->NOPOL,
                'TELP'     => $query[$key]->TELP,
                'SEAL'     => $query[$key]->SEAL,
                'T_CONT'   => $query[$key]->T_CONT,
                'QTYA'      => $query[$key]->QTYA,
                'BENDELA'      => $query[$key]->BENDELA,
                'IKATA'      => $query[$key]->IKATA,
                'QTYB'      => $query[$key]->QTYB,
                'BENDELB'      => $query[$key]->BENDELB,
                'IKATB'      => $query[$key]->IKATB,
            ));
        }
		
        $PHPJasperXML->setData($data);
        ob_end_clean();
        $PHPJasperXML->outpage("I");
       
    }
	
	 public function posting(Request $request)
    {
      

    }
	
	
	
	
	
	
	
}