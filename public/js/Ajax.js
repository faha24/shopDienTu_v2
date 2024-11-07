
function get_pr_edit(id){
    var xhr = new XMLHttpRequest();
    var url = "index.php?mode=admin&act=getdata";
 
 xhr.onreadystatechange = function() {
     if (xhr.readyState === XMLHttpRequest.DONE) {
         if (xhr.status === 200) {
             var products = JSON.parse(xhr.response);
             console.log(products); 
             loadedit(id,products);
            
         } else {
             console.error('Request failed. Status: ' + xhr.status);
         }
     }
 };
 xhr.open("GET", url, true);
 xhr.send();


}

function loadedit(id,data) {

    const tbody = document.querySelector('tbody.list');


    const trElements = tbody.querySelectorAll('tr');

   
     const tableData = data;


    var product = tableData.find(obj => obj.id == id);
    if (product) {
        const formMapping = {
            'id_pr': 'id',
            'product_name': 'product_name',
            'product_price': 'price',
            'product_price': 'price',
            'product_quantity': 'stock',
            'product_des': 'product_des'
        };
    
        for (const [formId, productKey] of Object.entries(formMapping)) {
            const formElement = document.getElementById(formId);
            if (formElement) {
                formElement.value = product[productKey];
            }
        }
    }

    // document.getElementById('pr_name').value = b.product_name;
    // document.getElementById('pr_id').value = b.product_id;
    // document.getElementById('pr_price').value = b.product_quantity ;
    // document.getElementById('pr_quantity').value = b.product_quantity;
    // document.getElementById('pr_des').value = b.product_des;
    const category = document.getElementById('cate_id');
    const option = 'option[value="' + product.category_id + '"]';
    console.log(option);

    const optionToSelect = category.querySelector(option);
    if (optionToSelect) {
       optionToSelect.selected = true;
    } else {
       console.error('Option with value "1" not found.');
    }

    // Thiết lập option có value là '1' là selected


 };
//  function get_pr_vra(){
//     var xhr = new XMLHttpRequest();
//     var url = "index.php?&act=detail";
 
//  xhr.onreadystatechange = function() {
//      if (xhr.readyState === XMLHttpRequest.DONE) {
//          if (xhr.status === 200) {
//              var variant = JSON.parse(xhr.response);
//              console.log(variant); 
           
            
//          } else {
//              console.error('Request failed. Status: ' + xhr.status);
//          }
//      }
//  };
//  xhr.open("GET", url, true);
//  xhr.send();


// }

function loadtest(data = [],value){
    var product_price = document.getElementById('pr_price');

    console.log(value);
    // Tìm phần tử trong mảng có giá trị bằng với giá trị đã cho
    var foundItem = data.find(item => item.color_id === Number(value));
    console.log(foundItem);
    // Nếu tìm thấy phần tử, trả về giá trị price và cập nhật giá sản phẩm
    if (foundItem !== undefined) {
        product_price.innerText = '$' + foundItem.price;
        return foundItem.price;
    } else {
        // Nếu không tìm thấy phần tử, trả về null hoặc giá trị mặc định
        return null;
    }

}
 var selectElement = document.getElementById('colorSelect');
 var coloroption = document.getElementById('coloroption');

 var product_name = document.getElementById('product_name');
        // Thêm sự kiện onchange
//         selectElement.addEventListener('change', function() {
//             // Lấy giá trị của option đã chọn
           
//             var selectedValue = selectElement.value;

//             loadtest(data,selectedValue)
//           //   // In ra giá trị đã chọn để kiểm tra
       
//           console.log(product_name);
//           //   console.log('Đã chọn màu có ID:', selectedValue);
    
//             // Có thể thực hiện các hành động khác dựa trên giá trị đã chọn ở đây
//             // Ví dụ: gửi AJAX request để tải dữ liệu mới, ...
// });
 
function get_cate_edit(id){
   
    var xhr = new XMLHttpRequest();
    var url = "index.php?mode=admin&act=getdataCate";
 
 xhr.onreadystatechange = function() {
     if (xhr.readyState === XMLHttpRequest.DONE) {
         if (xhr.status === 200) {
             var products = JSON.parse(xhr.response);
             console.log(products); 
             loadeditCate(id,products);
            
         } else {
             console.error('Request failed. Status: ' + xhr.status);
         }
     }
 };
 xhr.open("GET", url, true);
 xhr.send();


}
function loadeditCate(id,data) {

    const tbody = document.querySelector('tbody.list');


    const trElements = tbody.querySelectorAll('tr');

   
     const tableData = data;


    var product = tableData.find(obj => obj.id == id);
    if (product) {
        const formMapping = {
            'id_cate': 'id',
            'cate_name': 'category_name',
            'cate_status': 'status',
            'cate_des': 'category_des'
        };
    //      document.getElementById('cate_name').value = product.cate_name;
    // console.log(product.category_name)
    // document.getElementById('cate_status').value = b.product_quantity ;
    // document.getElementById('cate_des').value = b.product_quantity;
  
    // console.log()
        for (const [formId, productKey] of Object.entries(formMapping)) {
            const formElement = document.getElementById(formId);
            if (formElement) {
                formElement.value = product[productKey];
                console.log(product[productKey])
            }
        }
    }

    // document.getElementById('pr_name').value = b.product_name;
    // document.getElementById('pr_id').value = b.product_id;
    // document.getElementById('pr_price').value = b.product_quantity ;
    // document.getElementById('pr_quantity').value = b.product_quantity;
    // document.getElementById('pr_des').value = b.product_des;
    // const category = document.getElementById('cate_id');
    // const option = 'option[value="' + product.category_id + '"]';


    // const optionToSelect = category.querySelector(option);
    // if (optionToSelect) {
    //    optionToSelect.selected = true;
    // } else {
    //    console.error('Option with value "1" not found.');
    // }

    // Thiết lập option có value là '1' là selected


 };
 function get_oder_edit(id){
   
    var xhr = new XMLHttpRequest();
    var url = "index.php?mode=admin&act=get_data_oder";
 
 xhr.onreadystatechange = function() {
     if (xhr.readyState === XMLHttpRequest.DONE) {
         if (xhr.status === 200) {
             var products = JSON.parse(xhr.response);
             console.log(products); 
             loadeditoder(id,products);
            
         } else {
             console.error('Request failed. Status: ' + xhr.status);
         }
     }
 };
 xhr.open("GET", url, true);
 xhr.send();


}
function loadeditoder(id,data) {

    const tbody = document.querySelector('tbody.list');


    const trElements = tbody.querySelectorAll('tr');

   
     const tableData = data['order'];
     const item = data['item'];
    

    var product = tableData.find(obj => obj.id == id);
    console.log(product);
    if (product) {
        const formMapping = {
            'id_oder': 'id',
           
           
        };
    //      document.getElementById('cate_name').value = product.cate_name;
    // console.log(product.category_name)
    // document.getElementById('cate_status').value = b.product_quantity ;
    // document.getElementById('cate_des').value = b.product_quantity;
  
    // console.log()
        for (const [formId, productKey] of Object.entries(formMapping)) {
            const formElement = document.getElementById(formId);
            if (formElement) {
                formElement.value = product[productKey];
                console.log(product[productKey])
            }
        }
    }

    // document.getElementById('pr_name').value = b.product_name;
    // document.getElementById('pr_id').value = b.product_id;
    // document.getElementById('pr_price').value = b.product_quantity ;
    // document.getElementById('pr_quantity').value = b.product_quantity;
    // document.getElementById('pr_des').value = b.product_des;
    const status = document.getElementById('oder_status');
  
    const option = 'option[value="' + product.status + '"]';
    


    const optionToSelect = status.querySelector(option);
    if (optionToSelect) {
       optionToSelect.selected = true;
    } else {
        console.error(`Option with value "${product.status}" not found.`);
    }
//     const container = document.getElementById('inputContainer');
//     container.innerHTML = '';
//     if(product.status == 0){
  
//     let productCounter = 1;
//     item.forEach(item => {
//         // Kiểm tra nếu id khớp với oder_id của mục hiện tại
//         if (id == item.oder_id) {
//           // Tạo phần tử div.form-group
//           const formGroup = document.createElement('div');
//           formGroup.className = 'form-group';
          
//           // Tạo phần tử <label>
//           const label = document.createElement('label');
//           label.textContent = item.product_name;
          
//           // Tạo thẻ <input>
//           const input = document.createElement('input');
//           input.type = 'text';
//           input.className = 'form-control';
//           input.name = 'id';
//           input.id = `id_oder_${item.id}`; // ID duy nhất cho mỗi input
//           input.value = item.quantity; // Sử dụng giá trị từ dữ liệu (ở đây là quantity)
          
//           // Thêm <label> và <input> vào div.form-group
//           formGroup.appendChild(label);
//           formGroup.appendChild(input);
          
//           // Thêm form-group vào container
//           container.appendChild(formGroup);
//           productCounter++;
//         }});
  


//  };

}