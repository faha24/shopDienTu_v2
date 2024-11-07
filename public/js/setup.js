// Lấy giá trị product
// function loadedit(id) {

//     const tbody = document.querySelector('tbody.list');

//     // Lấy tất cả các thẻ <tr> trong <tbody>
//     const trElements = tbody.querySelectorAll('tr');

//     // Tạo một mảng để chứa dữ liệu từ các thẻ <th>
//     const tableData = [];

//     // Lặp qua từng thẻ <tr>
//     trElements.forEach((tr) => {
//        // Lấy tất cả các thẻ <th> trong <tr> hiện tại
//        const thElements = tr.querySelectorAll('th');

//        // Tạo một đối tượng để lưu trữ dữ liệu từ các thẻ <th> của mỗi dòng
//        const rowData = {};

//        // Lặp qua từng thẻ <th> và lấy nội dung
//        thElements.forEach((th, index) => {
//           // Dùng index của mỗi thẻ <th> để biết nội dung tương ứng
//           switch (index) {
//              case 1:
//                 rowData.product_id = th.textContent.trim();
//                 break;
//              case 2:
//                 rowData.product_name = th.textContent.trim();
//                 break;
//              case 3:
//                 rowData.product_price = th.textContent.trim();
//                 break;
//              case 4:
//                 rowData.product_des = th.textContent.trim();
//                 break;
//              case 5:
//                 rowData.product_quantity = th.textContent.trim();
//                 break;
//              case 6:
//                 rowData.category_id = th.textContent.trim();
//                 break;

//              default:
//                 // Thực hiện gì đó nếu cần thiết
//                 break;
//           }
//        });

//        // Thêm đối tượng dữ liệu của dòng hiện tại vào mảng tableData
//        tableData.push(rowData);
//     });

//     var b = tableData.find(obj => obj.product_id == id);


//     document.getElementById('pr_name').value = b.product_name;
//     document.getElementById('pr_id').value = b.product_id;
//     document.getElementById('pr_price').value = b.product_quantity ;
//     document.getElementById('pr_quantity').value = b.product_quantity;
//     document.getElementById('pr_des').value = b.product_des;
//     const category = document.getElementById('cate_id');
//     const option = 'option[value="' + b.category_id + '"]';

//     const optionToSelect = category.querySelector(option);
//     if (optionToSelect) {
//        optionToSelect.selected = true;
//     } else {
//        console.error('Option with value "1" not found.');
//     }

//     // Thiết lập option có value là '1' là selected


//  };


 // Biểu đồ thống kê

 // check all products
 var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'line', // Loại biểu đồ: line, bar, pie, etc.
          data: {
              labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
              datasets: [{
          label: 'Dataset 1',
          data: [65, 59, 80, 81, 56, 55, 40],
          fill: false,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
      },
      {
          label: 'Dataset 2',
          data: [28, 48, 40, 19, 86, 27, 90],
          fill: false,
          borderColor: 'rgb(255, 99, 132)',
          tension: 0.1
      },
      {
          label: 'Dataset 3',
          data: [45, 33, 22, 17, 75, 50, 40],
          fill: false,
          borderColor: 'rgb(54, 162, 235)',
          tension: 0.1
      }],
            
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });

     
