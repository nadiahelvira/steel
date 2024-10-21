<!-- Main Sidebar Container -->

<style>
    /* General sidebar styling */
    .vertical-menu {
      width: 250px;
      height: 100vh;
      background-color: #343a40;
      position: relative;
    }
	
	.content-box {
	  flex-grow: 1; /* This makes the child content fill the height */
	  background-color: lightgray; /* Just for demonstration */
	  padding: 20px;
	}

    /* Main menu items */
    .vertical-menu a {
      color: white;
      padding: 16px;
      text-decoration: none;
      display: block;
    }

    /*.vertical-menu a:hover {
      background-color: #495057;
      color: white;
    }*/

    /* Mega menu container */
    .mega-menu {
      position: absolute;
      top: 0;
      left: 250px;
      width: 700px;
     
      background-color: white;
      display: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 10px;
      z-index: 9999 !important;
    }

    /* Display mega menu on hover */
    .vertical-menu a:hover + .mega-menu,
    .mega-menu:hover {
      display: block;
    }

    /* Sub-menu styling */
    .mega-menu .row {
      padding: 5px;
    }

    .mega-menu h5 {
      color: #343a40;
    }

    .mega-menu ul {
      list-style: none;
      padding: 0;
    }

    .mega-menu ul li a {
      text-decoration: none;
      color: #343a40;
      padding: 5px 0;
      display: block;
    }

    .mega-menu ul li a:hover {
      color: #007bff;
    }

    .menu-card {
	
      text-align: center;
      padding: 10px;	 
      border-radius: 10px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
      transition: background-color 0.3s ease;
    }

    .menu-card:hover {
      background-color: #f8f9fa;
    }

    .menu-card h6 {
      margin-top: 12px;
	  color:black;
	  
    }

    .menu-card i {
      font-size: 30px;
      margin-bottom: 10px;
    }

    .font-size {
      font-size: large; /* or you can use a specific size like 16px, 1.5em, etc. */
    }

  </style>

  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="overflow-y: visible;">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link" style="text-align: center">
      <img src="{{url('/img/company.jpg')}}" alt="LookmanDjaja Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Wolfie</span>
    </a>

    <!-- Sidebar -->
    <div class="vertical-menu">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        {{-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="test">
        </div> --}}
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>


          
          <li class="nav-header">Operational</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database icon-white"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

<!------- penambahan tampilan baru ------->


      <div class="mega-menu">
      <div class="row d-flex">
        <div class="col-md-3">
           <!-- <div class="menu-card" style="">
                <a href="{{url('sup')}}">
                   <i class="nav-icon far fa-user icon-purple" style="width:100px; height:20px;"></i> 
                  <h6>Vendor</h6>
                </a>
			      </div> -->

            <div class="menu-card" style="">
              <a href="{{url('sup')}}" >
                  <i class="nav-icon far fa-user fa-2xl icon-purple"></i>
                  <!-- <i class="fa-regular fa-user fa-2xl"></i> -->
                  <h6>Vendor</h6>
              </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="menu-card" style="">
              <a href="{{url('cust')}}">
                <i class="nav-icon fas fa-users icon-yellow" style="text-align: center;"></i>
                <h6>Customer</h6>
              </a>
			      </div>
        </div>
		    <div class="col-md-3">
            <div class="menu-card" style="">
              <a href="{{url('pegawai')}}">
                <i class="nav-icon fas fa-layer-group icon-green" style="text-align: center;"></i>
                <h6>Pegawai</h6>
              </a>
			      </div>
        </div>
		    <div class="col-md-3">
            <div class="menu-card" style="">
              <a href="{{url('brg')}}">
                <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                <h6>Barang</h6>
              </a>
			      </div>
        </div>
      </div>
	  <div class="row">
        <div class="col-md-3">
            <div class="menu-card">
              <a href="{{url('grup')}}" >
                <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                <h6>Grup</h6>
              </a>
			      </div>
        </div>

	  
    </div>

<!-----------------batas ------------------------>


          <li class="nav-item">
          @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="purchase"))
			      <a href="#" class="nav-link">
              <i class="nav-icon fas fa-hand-holding-heart icon-red"></i>
              <p>
                Transaksi Pembelian
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

<!------- penambahan tampilan baru ------->


<div class="mega-menu">
      <div class="row d-flex">
        <div class="col-md-3">
            <div class="menu-card" style="">
              <a href="{{url('po?flagz=PO&golz=J')}}">
                <i class="nav-icon fas fa-cart-plus icon-yellow"></i> 
                <h6>Purchase Order</h6>
              </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="menu-card" style="">
                <a href="{{url('beli?flagz=BL&golz=J')}}">
                  <i class="nav-icon fas fa-store icon-white"></i>
                  <h6>Pembelian</h6>
                </a>
			      </div>
        </div>
		    <div class="col-md-3">
            <div class="menu-card" style="">
                <a href="{{url('beli?flagz=RB&golz=J')}}">
                  <i class="nav-icon fas fa-store icon-white"></i>
                  <h6>Retur Pembelian</h6>
                </a>
			      </div>
        </div>
		    <div class="col-md-3">
            <div class="menu-card" style="">
              <a href="{{url('muat?flagz=MT&golz=J')}}">
                <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                <h6>Muat</h6>
              </a>
			      </div>
        </div>
      </div>
	    <div class="row">
        <div class="col-md-3">
            <div class="menu-card" style="">
              <a href="{{url('terima?flagz=HP&golz=J')}}" >
                <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                <h6>Terima-A</h6>
              </a>
			      </div>
        </div>
        <div class="col-md-3">
          <div class="menu-card" style="">
			        <a href="{{url('terimab?flagz=HP&golz=J')}}" >
                <i class="nav-icon fas fa-crop icon-orange"></i>
                <h6>Terima-B</h6>
              </a>
			      </div>
        </div>
        <div class="col-md-3">
          <div class="menu-card" style="">
			        <a href="{{url('utbeli?flagz=UM')}}" >
                <i class="nav-icon fas fa-crop icon-orange"></i>
                <h6>UM Pembelian</h6>
              </a>
			    </div>
        </div>
		    <div class="col-md-3">
          <div class="menu-card" style="">
			        <a href="{{url('utbeli?flagz=TH')}}" >
                <i class="nav-icon fas fa-crop icon-orange"></i>
                <h6>T. Hutang</h6>
              </a>
			    </div>
        </div>
      </div>
      
	    <div class="row">
        <div class="col-md-3">
            <div class="menu-card" style="">
              <a href="{{url('hut?flagz=B')}}" >
                <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                <h6>Pembayaran</h6>
                <h6>Hutang</h6>
              </a>
			      </div>
        </div>
      </div>

	  
    </div>

<!----- batas ----->
			
           @endif			 		
          </li>  

          <li class="nav-item">
          @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="sales"))
			      <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cash-register icon-purple"></i>
              <p>
                Transaksi Penjualan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
			
<!------- penambahan tampilan baru ------->


    <div class="mega-menu">
      <div class="row d-flex">
        <div class="col-md-3">
            <div class="menu-card" style="">
              <a href="{{url('so?flagz=SO&golz=J')}}">
                <i class="nav-icon fas fa-cart-plus icon-yellow"></i> 
                <h6>Sales Order</h6>
              </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="menu-card" style="">
                <a href="{{url('spm?flagz=SM&golz=J')}}">
                  <i class="nav-icon fas fa-store icon-white"></i>
                  <h6>Surat Muat</h6>
                </a>
			      </div>
        </div>
		    <div class="col-md-3">
            <div class="menu-card" style="">
                <a href="{{url('surats?flagz=JL&golz=J')}}">
                  <i class="nav-icon fas fa-store icon-white"></i>
                  <h6>Surat Jalan </h6>
                </a>
			      </div>
        </div>
		    <div class="col-md-3">
            <div class="menu-card" style="">
              <a href="{{url('suratsb?flagz=JL&golz=J')}}">
                <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                <h6>Surat Jalan-B</h6>
              </a>
			      </div>
        </div>
      </div>
	    <div class="row">
        <div class="col-md-3">
            <div class="menu-card" style="">
              <a href="{{url('jual?flagz=JL&golz=J')}}" >
                <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                <h6>Invoice</h6>
              </a>
			      </div>
        </div>
        <div class="col-md-3">
          <div class="menu-card" style="">
			        <a href="{{url('jual?flagz=AJ&golz=J')}}" >
                <i class="nav-icon fas fa-crop icon-orange"></i>
                <h6>Retur Penjualan</h6>
              </a>
			      </div>
        </div>
        <div class="col-md-3">
          <div class="menu-card" style="">
			        <a href="{{url('utjual?flagz=UM')}}" >
                <i class="nav-icon fas fa-crop icon-orange"></i>
                <h6>UM Penjualan</h6>
              </a>
			    </div>
        </div>
		    <div class="col-md-3">
          <div class="menu-card" style="">
			        <a href="{{url('utjual?flagz=TP')}}" >
                <i class="nav-icon fas fa-crop icon-orange"></i>
                <h6>T. Piutang</h6>
              </a>
			    </div>
        </div>
      </div>
      
	    <div class="row">
        <div class="col-md-3">
            <div class="menu-card" style="">
              <a href="{{url('piu?flagz=B')}}" >
                <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                <h6>Pembayaran</h6>
                <h6>Piutang</h6>
              </a>
			      </div>
        </div>
        <div class="col-md-3">
            <div class="menu-card" style="">
              <a href="{{url('stockb?flagz=KZ')}}" >
                <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                <h6>Koreksi Stock</h6>
                <h6>Barang</h6>
              </a>
			      </div>
        </div>
        <div class="col-md-3">
            <div class="menu-card" style="">
              <a href="{{url('mutasi?flagz=KZ')}}" >
                <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                <h6>Mutasi</h6>
                <h6>Barang</h6>
              </a>
			      </div>
        </div>
      </div>

	  
    </div>

<!----- batas ----->

          @endif			 		
          </li> 

<!-----------Laporan Master---------->          

          <li class="nav-item">          
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-archive icon-yellow"></i>
              <p>
                Laporan Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

<!------- penambahan tampilan baru ------->


          <div class="mega-menu">
            <div class="row d-flex">
              <div class="col-md-3">
                  <div class="menu-card" style="">
                    <a href="{{url('rbrg')}}">
                      <i class="nav-icon fas fa-cart-plus icon-yellow"></i> 
                      <h6>Barang Jadi</h6>
                    </a>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="menu-card" style="">
                      <a href="{{url('rsup')}}">
                        <i class="nav-icon fas fa-store icon-white"></i>
                        <h6>Suplier</h6>
                      </a>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="menu-card" style="">
                      <a href="{{url('rcust')}}">
                        <i class="nav-icon fas fa-store icon-white"></i>
                        <h6>Customer</h6>
                      </a>
                  </div>
              </div>
            </div>

          
          </div>

<!----- batas ----->

          </li> 

<!--------------Laporan Pembelian---------------->          


          <li class="nav-item">          
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-archive icon-yellow"></i>
              <p>
                Laporan Pembelian
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
			
<!------- penambahan tampilan baru ------->


          <div class="mega-menu">
            <div class="row d-flex">
              <div class="col-md-3">
                  <div class="menu-card" style="">
                    <a href="{{url('rpo')}}">
                      <i class="nav-icon fas fa-cart-plus icon-yellow"></i> 
                      <h6>Purchase Order</h6>
                    </a>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="menu-card" style="">
                      <a href="{{url('rbeli')}}">
                        <i class="nav-icon fas fa-store icon-white"></i>
                        <h6>Pembelian</h6>
                      </a>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="menu-card" style="">
                      <a href="{{url('rmuat')}}">
                        <i class="nav-icon fas fa-store icon-white"></i>
                        <h6>Muatan </h6>
                      </a>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="menu-card" style="">
                    <a href="{{url('rterima')}}">
                      <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                      <h6>Terima</h6>
                    </a>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                  <div class="menu-card" style="">
                    <a href="{{url('rhut')}}" >
                      <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                      <h6>Pembayaran</h6>
                      <h6>Hutang</h6>
                    </a>
                  </div>
              </div>
              <div class="col-md-3">
                <div class="menu-card" style="">
                    <a href="{{url('rthut')}}" >
                      <i class="nav-icon fas fa-crop icon-orange"></i>
                      <h6>Transaksi Hutang</h6>
                    </a>
                  </div>
              </div>
              <div class="col-md-3">
                <div class="menu-card" style="">
                    <a href="{{url('rum')}}" >
                      <i class="nav-icon fas fa-crop icon-orange"></i>
                      <h6>UM Pembelian</h6>
                    </a>
                </div>
              </div>
            </div>
          
          </div>

<!----- batas ----->

          </li> 

<!--------------Laporan Penjualan---------------->

          <li class="nav-item">          
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-archive icon-yellow"></i>
              <p>
                Laporan Penjualan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

<!------- penambahan tampilan baru ------->


            <div class="mega-menu">
              <div class="row d-flex">
                <div class="col-md-3">
                    <div class="menu-card" style="">
                      <a href="{{url('rso')}}">
                        <i class="nav-icon fas fa-cart-plus icon-yellow"></i> 
                        <h6>Sales Order</h6>
                      </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="menu-card" style="">
                        <a href="{{url('rsurats')}}">
                          <i class="nav-icon fas fa-store icon-white"></i>
                          <h6>Surat Jalan</h6>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="menu-card" style="">
                        <a href="{{url('rjual')}}">
                          <i class="nav-icon fas fa-store icon-white"></i>
                          <h6>Penjualan</h6>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="menu-card" style="">
                      <a href="{{url('rtpiu')}}">
                        <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                        <h6>Transaksi Piutang</h6>
                      </a>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                    <div class="menu-card" style="">
                      <a href="{{url('ruj')}}" >
                        <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                        <h6>UM Penjualan</h6>
                      </a>
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="menu-card" style="">
                      <a href="{{url('rpiu')}}" >
                        <i class="nav-icon fas fa-crop icon-orange"></i>
                        <h6>Pembayaran</h6>
                        <h6>Piutang</h6>
                      </a>
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="menu-card" style="">
                      <a href="{{url('rstockb')}}" >
                        <i class="nav-icon fas fa-crop icon-orange"></i>
                        <h6>Koreksi Stock</h6>
                      </a>
                  </div>
                </div>
              </div>
            
            </div>

<!----- batas ----->	

          </li>


<!-- ...................................................................................... -->

      @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="accounting"))
        <li class="nav-header">Financial</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-location-arrow icon-blue"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

<!------- penambahan tampilan baru ------->


          <div class="mega-menu">
            <div class="row d-flex">
              <div class="col-md-3">
                  <div class="menu-card" style="">
                    <a href="{{url('account')}}">
                      <i class="nav-icon fas fa-cart-plus icon-yellow"></i> 
                      <h6>Account</h6>
                    </a>
                  </div>
              </div>
            </div>
          
          </div>

<!----- batas ----->	


          @endif			 		
          </li> 

	  
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-university icon-green"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
			
<!------- penambahan tampilan baru ------->


          <div class="mega-menu">
            <div class="row d-flex">
              <div class="col-md-3">
                  <div class="menu-card" style="">
                    <a href="{{url('kas?flagz=BKM')}}">
                      <i class="nav-icon fas fa-cart-plus icon-yellow"></i> 
                      <h6>Kas Masuk</h6>
                    </a>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="menu-card" style="">
                      <a href="{{url('kas?flagz=BKK')}}">
                        <i class="nav-icon fas fa-store icon-white"></i>
                        <h6>Kas Keluar</h6>
                      </a>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="menu-card" style="">
                      <a href="{{url('bank?flagz=BBM')}}">
                        <i class="nav-icon fas fa-store icon-white"></i>
                        <h6>Bank Masuk</h6>
                      </a>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="menu-card" style="">
                    <a href="{{url('bank?flagz=BBK')}}">
                      <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                      <h6>Bank Keluar</h6>
                    </a>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                  <div class="menu-card" style="">
                    <a href="{{url('memo?flagz=M')}}" >
                      <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                      <h6>Penyesuaian</h6>
                    </a>
                  </div>
              </div>
              <div class="col-md-3">
                <div class="menu-card" style="">
                    <a href="{{url('cbin')}}" >
                      <i class="nav-icon fas fa-crop icon-orange"></i>
                      <h6>Kas - Bank</h6>
                    </a>
                  </div>
              </div>
            </div>
          
          </div>

<!----- batas ----->

          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-print icon-purple"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
			
<!------- penambahan tampilan baru ------->


          <div class="mega-menu">
            <div class="row d-flex">
              <div class="col-md-3">
                  <div class="menu-card" style="">
                    <a href="{{url('rkas')}}">
                      <i class="nav-icon fas fa-cart-plus icon-yellow"></i> 
                      <h6>Journal Kas</h6>
                    </a>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="menu-card" style="">
                      <a href="{{url('rbank')}}">
                        <i class="nav-icon fas fa-store icon-white"></i>
                        <h6>Journal Bank</h6>
                      </a>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="menu-card" style="">
                      <a href="{{url('rmemo')}}">
                        <i class="nav-icon fas fa-store icon-white"></i>
                        <h6>Journal Penyesuaian</h6>
                      </a>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="menu-card" style="">
                    <a href="{{url('rbuku')}}">
                      <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                      <h6>Buku Besar</h6>
                    </a>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                  <div class="menu-card" style="">
                    <a href="{{url('raccount')}}" >
                      <i class="nav-icon fas fa-anchor icon-blue" style="text-align: center;"></i>
                      <h6>Neraca Percobaan</h6>
                    </a>
                  </div>
              </div>
              <div class="col-md-3">
                <div class="menu-card" style="">
                    <a href="{{url('rrl')}}" >
                      <i class="nav-icon fas fa-crop icon-orange"></i>
                      <h6>Laba Rugi</h6>
                    </a>
                  </div>
              </div>
              <div class="col-md-3">
                <div class="menu-card" style="">
                    <a href="{{url('rnera')}}" >
                      <i class="nav-icon fas fa-crop icon-orange"></i>
                      <h6>Neraca</h6>
                    </a>
                </div>
              </div>
            </div>

<!----- batas ----->

          </li> 
          

          <li class="nav-header">Utility</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-plus icon-yellow"></i>
              <p>
                Utillty
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <!-- IF check privilege & divisi -->
              @if (Auth::user()->hasRole('superadmin|operational'))
              <li class="nav-item">
                <a href="{{url('periode')}}" class="nav-link">
                  <i class="nav-icon fas fa-truck icon-blue"></i>
                  <p>Ganti Periode</p>
                </a>
              </li>
              @endif 

              @if (Auth::user()->hasRole('superadmin|operational'))
              <li class="nav-item">
                <a href="{{url('po_selesai/index-posting')}}" class="nav-link">
                  <i class="nav-icon fas fa-bug icon-pink"></i>
                  <p>PO Selesai</p>
                </a>
              </li>
              @endif 

              @if (Auth::user()->hasRole('superadmin|operational'))
              <li class="nav-item">
                <a href="{{url('so_selesai/index-posting')}}" class="nav-link">
                  <i class="nav-icon fas fa-bug icon-white"></i>
                  <p>SO Selesai</p>
                </a>
              </li>
              @endif 
			  
            </ul>
          </li>

          @if (Auth::user()->hasRole('superadmin'))
          <li class="nav-header">User Management</li>
          <li class="nav-item">
            <a href="{{url('/user/manage')}}" class="nav-link">
              <i class="nav-icon fas fa-users icon-orange"></i>
              <p>
                User
              </p>
            </a>
          </li>
          @endif

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
