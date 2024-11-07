@extends('admin.layout.main')
@section('content')
@php
$halfVisible = floor($visiblePages / 2);



@endphp
<div class="xp-breadcrumbbar text-center">
  <h4 class="page-title">Manage Categories</h4>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-curent="page"> Categories</li>
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
              <h2 class="ml-lg-2">Manage Categories</h2>
            </div>
            <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
              <a onclick="reset()" href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                <i class="material-icons">&#xE147;</i>
                <span>Add New Categories</span>
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
              <th>category_name</th>
              <th>product_qty</th>
              <th>category_des</th>
            </tr>
          </thead>



          <tbody class="list">
            @foreach ($categories as $key)
            @if ($key->status == 1)
            <tr>
              <th></th>
              <th>{{ $key->id }}</th>
              <th>{{ $key->category_name }}</th>
              <th>
                {{ $key->total_products }}
                {{ $key->total_products == 0 ? '( có thể xóa)' : '' }}
              </th>
              <th>{{ $key->category_des }}</th>
              <th>
              <a onclick="getData('{{ $key->id }}')" href="#editEmployeeModal" class="edit" data-toggle="modal">
                  <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                </a>
                @if ($key->total_products == 0)
                <a onclick="return confirm('Chắc chắn chưa?')" href="" class="delete" data-toggle="modal">
                  <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                </a>
                @endif
              </th>
            </tr>
            @endif
            @endforeach

          </tbody>

        </table>

      
        <div class="clearfix">
          <div class="hint-text">showing <b>{{ $visiblePages }}</b> out of <b>{{ $totalPages }}</b></div>
          <ul class="pagination">

            @if ($currentPage == 1)
            <li class="page-item disabled">
              <a href="#">Previous</a>
            </li>
            @else
            <li class="page-item">
              <a href="{{route("admin/products?page=".$currentPage - 1)}}">Previous</a>
            </li>
            @endif


            @if ($currentPage > $halfVisible + 1)
            <li class="page-item"><a href="?page=1" class="page-link">1</a></li>
            <li class="page-item"><span class="page-link">...</span></li>
            @endif


            @for ($i = max(1, $currentPage - $halfVisible); $i <= min($totalPages, $currentPage + $halfVisible); $i++)
              @if ($i==$currentPage)
              <li class="page-item active">
              <a href="{{route("admin/products?page=$i")}}" class="page-link">{{ $i }}</a>
              </li>
              @else
              <li class="page-item">
                <a href="{{route("admin/products?page=$i")}}" class="page-link">{{ $i }}</a>
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
                  <a href="{{route("admin/products?page=".$currentPage + 1)}}">Next</a>
                </li>
                @endif
          </ul>
        </div>








      </div>
    </div>


    <!----add-modal start--------->
    <div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Thêm Sản Phẩm</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="index.php?mode=admin&act=add_cate" method="POST" enctype="multipart/form-data">
            <div class="modal-body">

            <div class="form-group">
                <label>tên Danh mục </label>
                <input type="text" class="form-control"  name="category_name">
              </div>
           
              <div class="form-group">
                <label>Mô tả Danh mục</label>
                <textarea class="form-control" name="category_des" ></textarea>
              </div>
             
             

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Add</button>
            </div>
          </form>

        </div>
      </div>
    </div>
    <!----edit-modal end--------->





    <!----edit-modal start--------->
    <div class="modal fade" tabindex="-1" id="editEmployeeModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">sửa Sản Phẩm</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="index.php?mode=admin&act=add_cate" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
            <div class="form-group" hidden>
                <label>id_category</label>
                <input type="text" class="form-control" name="id" id="id_category">
              </div>
              <div class="form-group">
                <label>tên Danh mục </label>
                <input type="text" class="form-control"  name="category_name">
              </div>
           
              <div class="form-group">
                <label>Mô tả Danh mục</label>
                <textarea class="form-control" name="category_des" ></textarea>
              </div>
            
             
             

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">sửa</button>
            </div>
          </form>

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
              <h4 class="modal-title">Xóa Bản Ghi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <p>Bạn có chắc chắn muốn xóa bản ghi này không?</p>
              <p class="text-warning"><small>Hành động này không thể hoàn tác.</small></p>
              <input type="hidden" id="deleteId" name="id">
            </div>
            <div class="modal-footer">
              <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
              <a type="button" class="btn btn-danger" id="confirmDelete">Xóa</a>
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
        const deleteUrl = `{{ route("admin/products/destroy") }}/${productId}/?page={{$currentPage}}`;
        console.log(productId);
        document.getElementById("confirmDelete").setAttribute("href", deleteUrl);
      });
    });
  });

  function getData(id) {
    fetch('http://my_project.test/api/' + id + '/getCate')
      .then(response => {
        if (!response.ok) {
          throw new Error('lỗi');
        }
        return response.json();
      })
      .then(data => {
        console.log(data);
        $('#id_category').val(data.id); // ID danh mục
            $('input[name="category_name"]').val(data.category_name); // Tên danh mục
            $('textarea[name="category_des"]').val(data.category_des); // Mô tả danh mục
       
      })
      .catch(error => {
        console.error('Fetch error:', error);
      });
  }
  function reset (){
    $('#id_category').val('');            // Reset ID danh mục
    $('input[name="category_name"]').val('');  // Reset tên danh mục
    $('textarea[name="category_des"]').val(''); // Reset mô tả danh mục
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