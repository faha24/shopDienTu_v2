@extends('admin.layout.main')
@section('content')
@php
$halfVisible = floor($visiblePages / 2);



@endphp
<div class="xp-breadcrumbbar text-center">
  <h4 class="page-title">Product</h4>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-curent="page">Product</li>
  </ol>
</div>


</div>
</div>
<!------top-navbar-end----------->


<!------main-content-start----------->

<div class="main-content">
  <div class="row">
    <div class="col-md-12">
      <div class="table-wrapper">

        <div class="table-title">
          <div class="row">
            <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
               <h2 class="ml-lg-2">Manage Products Trash</h2>
            </div>
            <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
              <a href="{{route('admin/products')}}" class="btn btn-success" data-toggle="modal">
                <i class="material-icons">home</i>
                <span>Manage Products </span>
              </a>
             
            </div>
          </div>
        </div>

        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>

              </th>
              <th>id</th>
              <th>product_name</th>
              <th>price</th>
              <th>cate_name</th>
              <th>View</th>
              <th>product_des</th>
              <th>img</th>
            </tr>
          </thead>



          <tbody class="list">
            @foreach ($products as $product)

            <tr>
              <th></th>
              <th>{{ $product->id }}</th>
              <th>
                {{ $product->product_name }}
                @if ($product->Detail_status == 0)
                <a href="{{ route('detail', $product->id) }}" class="edit" data-toggle="modal">
                  <i class="material-icons" data-toggle="tooltip" title="Variant">loupe</i>
                </a>
                @endif
              </th>
              <th>{{ number_format($product->price, 0, ',', '.') }} đ</th> <!-- Hiển thị giá với định dạng số -->
              <th>{{ $product->category_name }}</th> <!-- Tên danh mục từ bảng categories -->
              <th>{{ $product->View }}</th>
              <th>{{ $product->product_des }}</th>
            
              <!-- <th>{{ $product->stock }}</th> -->
              <th>

                <img style="width: 100px; height:100px;"
                  src="{{file_exists('public/img/products/' . $product->path) &&!empty($product->path)  ? BASE_URL."public/img/products/$product->path" : BASE_URL.'public/img/products/OIP.jpg' }}">
              </th>
            
              <th>
            
                <a href="#deleteEmployeeModal" class="delete" data-toggle="modal" data-id="{{ $product->id }} ">
                  <i class="material-icons" data-toggle="tooltip" title="Delete">undo</i>
                </a>
                <!-- <a href="#deleteEmployeeModal" class="delete" data-toggle="modal" data-id="{{ $product->id }}">
    <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
</a> -->

              </th>
            </tr>



            @endforeach
          </tbody>

        </table>

        <!-- <div class="clearfix">
          <div class="hint-text">showing <b>5</b> out of <b>25</b></div>
          <ul class="pagination">
            <li class="page-item disabled"><a href="#">Previous</a></li>
            <li class="page-item active"><a href="#" class="page-link">1</a></li>
            <li class="page-item "><a href="#" class="page-link">2</a></li>
            <li class="page-item "><a href="#" class="page-link">3</a></li>
            <li class="page-item "><a href="#" class="page-link">4</a></li>
            <li class="page-item "><a href="#" class="page-link">5</a></li>
            <li class="page-item "><a href="#" class="page-link">Next</a></li>
          </ul>
        </div> -->
        <div class="clearfix">
          <div class="hint-text">showing <b>{{ $visiblePages }}</b> out of <b>{{ $totalPages }}</b></div>
          <ul class="pagination">

            @if ($currentPage == 1)
            <li class="page-item disabled">
              <a href="#">Previous</a>
            </li>
            @else
            <li class="page-item">
              <a href="{{route("admin?page=".$currentPage - 1)}}">Previous</a>
            </li>
            @endif


            @if ($currentPage > $halfVisible + 1)
            <li class="page-item"><a href="?page=1" class="page-link">1</a></li>
            <li class="page-item"><span class="page-link">...</span></li>
            @endif


            @for ($i = max(1, $currentPage - $halfVisible); $i <= min($totalPages, $currentPage + $halfVisible); $i++)
              @if ($i==$currentPage)
              <li class="page-item active">
              <a href="{{route("admin?page=$i")}}" class="page-link">{{ $i }}</a>
              </li>
              @else
              <li class="page-item">
                <a href="{{route("admin?page=$i")}}" class="page-link">{{ $i }}</a>
              </li>
              @endif
              @endfor


              @if ($currentPage < $totalPages - $halfVisible)
                <li class="page-item"><span class="page-link">...</span></li>
                <li class="page-item"><a href="?page={{ $totalPages }}" class="page-link">{{ $totalPages }}</a></li>
                @endif

                @if ($currentPage == $totalPages)
                <li class="page-item disabled">
                  <a href="#">Next</a>
                </li>
                @else
                <li class="page-item">
                  <a href="{{route("admin?page=".$currentPage + 1)}}">Next</a>
                </li>
                @endif
          </ul>
        </div>








      </div>
    </div>


   
    <!----edit-modal end--------->


    <!-- Modal Xóa -->
    <div id="deleteEmployeeModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="deleteForm">
            <div class="modal-header">
              <h4 class="modal-title">Lấy lại Bản Ghi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <p>Bạn có chắc chắn muốn lấy lại bản ghi này không?</p>
             
            </div>
            <div class="modal-footer">
              <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
              <a type="button" class="btn btn-danger" id="confirmDelete">lấy lại</a>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="deleteForm">
            <div class="modal-header">
              <h4 class="modal-title">{{$_SESSION['success']}}</h4>

            </div>

            <div class="modal-footer">

              <a type="button" class="btn btn-danger" id="confirmDelete" onclick="hideModal('successModal')">Ok</a>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>



@if(isset($_SESSION['success']))
<script>
  window.onload = function() {
    showModal('successModal');
    console.log(123);
  }
</script>
@php
unset($_SESSION['success'])
@endphp
@endif
@if(isset($_SESSION['errors_add']))
<script>
  window.onload = function() {
    $(document).ready(function() {
      $("#addEmployeeModal").modal();
    });

  }
</script>
@php
unset($_SESSION['errors_add'])
@endphp
@endif
@if(isset($_SESSION['errors_edit']))
<script>
  window.onload = function() {
    id = <?php echo json_encode($_SESSION['errors_edit_id']) ?>
    $(document).ready(function() {
      $("#editEmployeeModal").modal();
    });
getData(id);
  }
</script>
@php
unset($_SESSION['errors_edit']);
unset($_SESSION['errors_edit_id'])
@endphp
@endif

<footer class="footer">
  <div class="container-fluid">
    <div class="footer-in">
      <p class="mb-0">&copy 2021 Vishweb Design . All Rights Reserved.</p>
    </div>
  </div>
</footer>
<script>
  function hideModal(id) {
    var modal = document.getElementById(id);
    modal.style.display = "none"; // Ẩn modal
    modal.classList.remove('in');
  }

  function showModal(id) {
    var modal = document.getElementById(id);
    modal.style.display = "block"; // Hiện modal
    // Thiết lập để backdrop hoạt động
    modal.classList.add('in');
    var modalBody = modal.querySelector('.modalAdd');
    modalBody.style.maxHeight = "400px"; // Chiều cao tối đa của modal-body
    modalBody.style.overflowY = "auto"; // Cho phép cuộn
  }

  document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".delete").forEach(button => {
      button.addEventListener("click", function(e) {
        e.preventDefault();
        const productId = this.getAttribute("data-id");
        const deleteUrl = `{{ route('admin/products/rollback') }}/${productId}`;
        console.log(productId);
        document.getElementById("confirmDelete").setAttribute("href", deleteUrl);
      });
    });
  });

  function getData(id) {
    fetch('http://my_project.test/api/' + id + '/getPr')
      .then(response => {
        if (!response.ok) {
          throw new Error('lỗi');
        }
        return response.json();
      })
      .then(data => {
        console.log(data);
        $('#id_pr').val(data.id);
        $('#product_name').val(data.product_name);
        $('#product_price').val(data.price);
        $('#product_des').val(data.product_des);
        $('#product_quantity').val(data.stock);
        const categoryDropdown = $('#cate_id');
        const categoryId = data.category_id;
        setSelectedCategory(categoryId);
      })
      .catch(error => {
        console.error('Fetch error:', error);
      });
  }

  function setSelectedCategory(categoryId) {
    const options = document.querySelectorAll('select[name="category_id"] option');
    console.log(options);
    options.forEach(option => {
      if (option.value == categoryId) {
        option.selected = true;
      }
    });
  }
</script>
@endsection



</div>