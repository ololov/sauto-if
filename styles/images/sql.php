<?

define('_page_items', 6);
define('_news_count', 5);

FUNCTION db_connect()
{
  $mysqli = new mysqli('localhost', 'galychpl_web', '9731', 'galychpl_boda');
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    RETURN false;
  }
  $mysqli->query('SET NAMES "utf8"');
  RETURN $mysqli;
}

FUNCTION db_result_to_array($rl)
{
   $res_array = ARRAY();
   $num_results = $rl->num_rows;
   FOR ($count=0; $count < $num_results; $count++) {
     $res_array[$count] = $rl->fetch_row();
   }
   RETURN $res_array;
}

function get_products($page)
{
    $mysqli = db_connect();
    if ($mysqli == false) {
      echo '<p class="error">database connect error</p>';
      exit;
    }
    $limit = 'limit '.(($page-1) * _page_items).', '._page_items.' ';
    $where = '';
    $query='select id, title, category_id, descr, img, price, adate, icount from products '.$where.' order by title '.$limit;
    $rl = $mysqli->query($query);
    if ($rl == false) {
      echo '<p class="error">sql error #2</p>';
      exit;
    }
    $result = db_result_to_array($rl);
    RETURN $result; 
    $mysqli->close();
}

function get_newroducts()
{
    $mysqli = db_connect();
    if ($mysqli == false) {
      echo '<p class="error">database connect error</p>';
      exit;
    }
    $limit = 'limit '._news_count;
    $where = '';
    $query='select id, title, category_id, descr, img, price, adate, icount from products '.$where.' order by title '.$limit;
    $rl = $mysqli->query($query);
    if ($rl == false) {
      echo '<p class="error">sql error #2</p>';
      exit;
    }
    $result = db_result_to_array($rl);
    RETURN $result; 
    $mysqli->close();
}

function get_allproducts()
{
    $mysqli = db_connect();
    if ($mysqli == false) {
      echo '<p class="error">database connect error</p>';
      exit;
    }
    $query='select id, title, category_id, descr, img, price, adate, icount from products order by title';
    $rl = $mysqli->query($query);
    if ($rl == false) {
      echo '<p class="error">sql error #2</p>';
      exit;
    }
    $result = db_result_to_array($rl);
    RETURN $result; 
    $mysqli->close();
}

function get_productscount()
{
    $mysqli = db_connect();
    if ($mysqli == false) {
        echo '<p class="error">database connect error</p>';
        exit;
    }
    $query='select id from products';
    $rl = $mysqli->query($query);
    if ($rl == false) {
        echo '<p class="error">sql error</p>';
        exit;
    }
    $result = $rl->num_rows;
    RETURN $result;
    $mysqli->close();
}

function get_product($id)
{
    $mysqli = db_connect();
    if ($mysqli == false) {
      echo '<p class="error">database connect error</p>';
      exit;
    }
    $query='SELECT products.id, products.title, products.category_id, products.descr, products.img, products.price, products.adate, products.icount
    FROM products
    WHERE products.id ='.$id;
    $rl = $mysqli->query($query);
    if ($rl == false) {
        echo '<p class="error">sql error #3</p>';
        exit;
    }
    $result = db_result_to_array($rl);
    RETURN $result; 
    $mysqli->close();
}


?>