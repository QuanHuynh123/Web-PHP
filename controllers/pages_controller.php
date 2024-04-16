<?php
session_start();
require_once('controllers/base_controller.php');
require_once('models/shortInforProduct.php');
require_once('models/style.php');
// http://localhost:8008/PHP/index.php?controller=pages&action=home
//http://localhost:8008/PHP/index.php
class PagesController extends BaseController
{
  function __construct()
  {
    $this->folder = 'pages';
  }
  
  public function home()
  {   
    if (!isset($_SESSION['user_id'])) {
      header("Location: http://localhost:8008/PHP/index.php?controller=login&action=login");
      exit; // Kết thúc chương trình sau khi chuyển hướng
  }
    $bestSaleProduct = shortInforProduct::getBestSaleProduct();
    $dataBestSaleProduct = array('bestSaleProduct' => $bestSaleProduct);

    $newProduct = shortInforProduct::getNewProduct();
    $dataNewProduct = array('newProduct' => $newProduct);

    $style = style::getStyleProduct(); // Lấy danh sách các style  
    $dataStyle = array('style' => $style);

    $data = array(
        'css_files' => array(
            './assets/css/header.css',
            './assets/css/header.css',
            './assets/css/footer.css',
            './assets/css/content50.css',
            './assets/css/content100.css',
            './assets/icon/themify-icons/themify-icons.css',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css'
            // Thêm các đường dẫn đến các file CSS cần import cho trang home
        ),
        'js_files' => array(
            './assets/JavaScript/header.js',
            // Thêm các đường dẫn đến các file JS cần import cho trang home
        ),
        'dataBestSaleProduct' => $dataBestSaleProduct, // Thêm mảng $dataBestSaleProduct vào mảng $data
        'dataNewProduct' => $dataNewProduct,
        'dataStyle' => $dataStyle // Truyền danh sách tên style vào dữ liệu để sử dụng trong view
    );
     $this->render('home', $data,null);
  }

  public function error()
  {
    $this->render('error', null , null);
  }

}
