<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>crud dashboard</title>
	    <!-- Bootstrap CSS -->
        <!-- <link rel="stylesheet" href="http://localhost/my_project/public/css/bootstrap.min.css"> -->
	    <!----css3---->
        <!-- <link rel="stylesheet" href="http://localhost/my_project/public/css/custom.css"> -->
        @include('admin.layout.style')
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		
		
		<!--google fonts -->
	    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	
	
	   <!--google material icon-->
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">
	  <style>
        canvas{
            height: 600px !important;
            /* width: 600px !important; */
        }
    </style>
  </head>
  <body>
  


<div class="wrapper">
     
	  <div class="body-overlay"></div>
	 
	 <!-------sidebar--design------------>
	 
	 <div id="sidebar">
	    <div class="sidebar-header">
		  <a href="{{route('admin')}}" style="color: black;"><h3><img src="" class="img-fluid"/><span>Admin</span></a> </h3>
		</div>
		<ul class="list-unstyled component m-0">
		  <li class="active">
		  <a href="" class="dashboard"><i class="material-icons">dashboard</i>dashboard </a>
		  </li>
		  
		  <li class="dropdown">
		  <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" 
		  class="dropdown-toggle">
		  <i class="material-icons">inventory_2</i>product
		  </a>
		  <ul class="collapse list-unstyled menu" id="homeSubmenu1">
		     <li><a href="{{route('admin/products')}}">product Manage</a></li>
			
		  </ul>
		  </li>
		  
		  
		   <li class="dropdown">
		  <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" 
		  class="dropdown-toggle">
		  <i class="material-icons">category</i>Category
		  </a>
		  <ul class="collapse list-unstyled menu" id="homeSubmenu2">
		  <li><a href="index.php?mode=admin&act=category">Category</a></li>
			
		  </ul>
		  </li>
		  
	
		  
		  
		   <li class="dropdown">
		  <a href="#homeSubmenu4" data-toggle="collapse" aria-expanded="false" 
		  class="dropdown-toggle">
		  <i class="material-icons">fact_check</i>order
		  </a>
		  <ul class="collapse list-unstyled menu" id="homeSubmenu4">
		     <li><a href="index.php?mode=admin&act=oder_manage">order</a></li>
			
		  </ul>
		  </li>
		  
		   <li class="dropdown">
		  <a href="#homeSubmenu5" data-toggle="collapse" aria-expanded="false" 
		  class="dropdown-toggle">
		  <i class="material-icons">person</i>user
		  </a>
		  <ul class="collapse list-unstyled menu" id="homeSubmenu5">
		     <li><a href="index.php?mode=admin&act=user">user</a></li>
			 
		  </ul>
		  </li>
		  
		  <li class="dropdown">
		  <a href="#homeSubmenu6" data-toggle="collapse" aria-expanded="false" 
		  class="dropdown-toggle">
		  <i class="material-icons">comment</i>comment
		  </a>
		  <ul class="collapse list-unstyled menu" id="homeSubmenu6">
		     <li><a href="index.php?mode=admin&act=comment">comment</a></li>
		
		  </ul>
		  </li>
		  
		  
		
		  
		   
		  <li class="">
		  <a href="index.php" class=""><i class="material-icons">home</i>home </a>
		  </li>
		  <li class="">
		  <a href="index.php?act=logout" class=""><i class="material-icons">logout</i>logout </a>
		  </li>
		
		</ul>
	 </div>
	 
<div id="content">
	 <div class="top-navbar">
  <div class="xd-topbar">
    <div class="row">
      <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
        <div class="xp-menubar">
          <span class="material-icons text-white">signal_cellular_alt</span>
        </div>
      </div>
      </div>
<section class="content">
    @yield('content')
</section>
</div>



<!-------complete html----------->






<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="./lib/js/jquery-3.3.1.slim.min.js"></script>
<script src="./lib/js/popper.min.js"></script>
<script src="./lib/js/bootstrap.min.js"></script>
<script src="./lib/js/jquery-3.3.1.min.js"></script>
<script src="./lib/js/Ajax.js"></script>
<script src="./lib/js/setup.js"></script> -->
@include('admin.layout.scrip')


<script type="text/javascript">
   $(document).ready(function() {
      $(".xp-menubar").on('click', function() {
         $("#sidebar").toggleClass('active');
         $("#content").toggleClass('active');
      });

      $('.xp-menubar,.body-overlay').on('click', function() {
         $("#sidebar,.body-overlay").toggleClass('show-nav');
      });

   });


   

   // Tạo một đối tượng để lưu trữ dữ liệu từ các thẻ <th> của mỗi dòng

</script>





</body>

</html>
