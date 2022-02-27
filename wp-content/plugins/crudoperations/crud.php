<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Table with Add and Delete Row Feature</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<?php
/*
Plugin Name: Admin table
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: ABC
Version: 1.0
*/
?>
<body>
<?php
function sports_bench_create_db() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    //* Create the custom table
    $table_name = $wpdb->prefix . 'userentry';
    $sql = "CREATE TABLE $table_name (
    id INTEGER NOT NULL AUTO_INCREMENT,
    username TEXT NOT NULL,
    fullname TEXT NOT NULL,
    date DATE,
    email TEXT NOT NULL,
    flag INTEGER NOT NULL,
    PRIMARY KEY (id)
    ) $charset_collate;";
    dbDelta( $sql );
   }
   register_activation_hook( __FILE__, 'sports_bench_create_db' );
  // register_activation_hook( __FILE__, 'selectalldata' );

    
add_action( 'admin_menu', 'admin_menu_page' );

function admin_menu_page(){
	add_menu_page(
		'My Page Title', // page <title>Title</title>
		'admin users', // menu link text
		'manage_options', // capability to access the page
		'data-slug', // page URL slug
		'showdata', // callback function /w content
		'dashicons-star-half', // menu icon
		5 // priority
	);
  add_submenu_page( null,//parent page slug
  'employee_update',//$page_title
  'Employee Update',// $menu_title
  'manage_options',// $capability
  'data_update',// $menu_slug,
  'update_data'// $function
);
add_submenu_page( null,//parent page slug
  'employee_delete',//$page_title
  'Employee Delete',// $menu_title
  'manage_options',// $capability
  'data_delete',// $menu_slug,
  'delete_data'// $function
);
add_submenu_page( null,//parent page slug
  'employee_insert',//$page_title
  'Employee Insert',// $menu_title
  'manage_options',// $capability
  'data_insert',// $menu_slug,
  'insert_data'// $function
);
}
?>

<?php // Add new record ?>
<?php
function insert_data(){
global $wpdb;
if(isset($_POST['btn_submit'])){
  $user = $_POST['username'];
  $fname = $_POST['fullname'];
  $date = $_POST['date'];
  $email = $_POST['email'];
  $tablename = $wpdb->prefix."userentry";
  //if( !username_exists( $user ) && !email_exists( $email )  && $user != '' && $fname != '' && $email != '' ){
     $check_data = $wpdb->get_results("SELECT * FROM ".$tablename." WHERE email='".$email."' ");
     $num=$wpdb->num_rows;
     if($num>=1){
      echo '<script>alert("email already exist")</script>';
     }
     else{
       $insert_sql = "INSERT INTO ".$tablename."(username,fullname,date,email,flag) values('".$user."','".$fname."','".$date."','".$email."','1') ";
       $wpdb->query($insert_sql);
   }
   ?>
   <script type="text/javascript">
window.location = "http://localhost/crud/wp-admin/admin.php?page=data-slug";
</script> 
<?php
}
  ?>
<h1>Add New Record</h1>
	<form name="form" method="post" action="" id="form">	
  <table>
    <tr>
      <td>Username:</td>
      <td><input type='text' name='username'></td>
    </tr>
    <tr>
     <td>Fullname:</td>
     <td><input type='text' name='fullname'></td>
    </tr>
    <tr>
     <td>Date:</td>
     <td><input type='text' name='date'></td>
    </tr>
    <tr>
     <td>Email:</td>
     <td><input type='text' name='email'></td>
    </tr>
    <tr>
     <td>&nbsp;</td>
     <td><input type='submit' name='btn_submit' value='Submit'></td>
    </tr>
 </table>
</form>
 
<?php } ?>

<?php //show all saved record
function showdata()
{ ?>
<div class="container" style="margin-top: 20px;">
  <div class="row">
  <?php
         global $wpdb;
         $tablename = $wpdb->prefix."userentry";
  $entriesList = $wpdb->get_results("SELECT * FROM ".$tablename." WHERE flag=1 order by id asc");
    ?>
       <div class="col-12">
      <table class="table table-bordered">
        <thead>
          <tr>
          <button type="button" class="btn btn-success" style="margin-bottom: 10px;">
          <a href="<?php echo admin_url('admin.php?page=data_insert&id='); ?>" style="color: white;">Add Record</button>
          </tr>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Username</th>
            <th scope="col">Fullname</th>
            <th scope="col">Date</th>
            <th scope="col">E-mail</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <?php
        foreach($entriesList as $entry){
          $id = $entry->id;
          $uname = $entry->username;
          $fname = $entry->fullname;
          $date = $entry->date;
          $email = $entry->email; ?> 
        <tbody>
          <tr>
          <td><?php echo $id;?></td>
            <td><?php echo $uname;?></td>
            <td><?php echo $fname;?></td>
            <td><?php echo $date;?></td>
            <td><?php echo $email;?></td>
            <td>
            <button type="button" class="btn btn-warning" name="btnedit">
            <a href="<?php echo admin_url('admin.php?page=data_update&id=' . $entry->id); ?>" style="color: white;">
              Edit</button></td>
              <td>
            <button type="button" class="btn btn-danger" name="btndelete">
            <a href="<?php echo admin_url('admin.php?page=data_delete&id=' . $entry->id); ?>" style="color: white;">
             Delete</button>
            </td>
          </tr>
          <?php } ?>
          </tbody>
      </table>
    </div>
    
  </div>
</div> 
<?php } ?>




<?php
//echo "employee delete";
function delete_data(){
    echo "employee delete";
    if(isset($_GET['id'])){
        global $wpdb;
       //$table_name=$wpdb->prefix.'userentry';
        $i=$_GET['id'];
        $execut= $wpdb->query( $wpdb->prepare( "UPDATE wp_userentry SET flag = -1 WHERE ID = $i") );
        $wpdb->query($execut);
		?>
		<script type="text/javascript">
        window.location = "http://localhost/crud/wp-admin/admin.php?page=data-slug";
        </script>  
		<?php
       // $wpdb->delete(
        //    $table_name,
          //  array('id'=>$i)
       // );
    }
    ?>
<!--     <meta http-equiv="refresh" content="0; url=http://localhost/wordpressmyplugin/wordpress/wp-admin/admin.php?page=Employee_Listing" />
 -->    <?php
  //  wp_redirect( admin_url('admin.php?page=page=data-slug'),301 );
   //exit;
    //header("location:http://localhost/wordpressmyplugin/wordpress/wp-admin/admin.php?page=Employee_Listing");
}
?>

<?php //Edit record
//echo "update page";
function update_data(){
 // $location=get_site_url() .'/wp-admin/admin.php?page=data-slug';
//wp_redirect( $location, 301);
//exit;
    //echo "update page in";
    $i=$_GET['id'];
    global $wpdb;
    $table_name = $wpdb->prefix . 'userentry';
    $employees = $wpdb->get_results("SELECT id,username,fullname,date,email from $table_name where id=$i");
   // echo $employees[0]->id;
    ?>
  <form name="updform" method="post" action="" >	
  <table cellspacing=5px cellpadding=5px>
    <h1>Update Data</h1>
  <tr>
      <td>Id</td>
      <td><input type='text' name='txt_id' value="<?= $employees[0]->id; ?>"></td>
    </tr>
    <tr>
      <td>Username:</td>
      <td><input type='text' name='updusername' value="<?= $employees[0]->username; ?>"></td>
    </tr>
    <tr>
     <td>Fullname:</td>
     <td><input type='text' name='updfullname' value="<?= $employees[0]->fullname; ?>"></td>
    </tr>
    <tr>
     <td>Date:</td>
     <td><input type='text' name='upddate' value="<?= $employees[0]->date; ?>"></td>
    </tr>
    <tr>
     <td>Email:</td>
     <td><input type='text' name='updemail' value="<?= $employees[0]->email; ?>"></td>
    </tr>
    <tr>
     <td>&nbsp;</td>
     <td><input type='submit' name='btn-update' value='Update'>
     </td>
	</tr>
     </td>
    </tr>
 </table>
</form>
    <?php
}
if(isset($_POST['btn-update']))
{
    global $wpdb;
    $table_name=$wpdb->prefix.'userentry';
    $id=$_POST['txt_id'];
    $username=$_POST['updusername'];
    $fullname=$_POST['updfullname'];
    $dt=$_POST['upddate'];
    $mail=$_POST['updemail'];
    $chk_data = $wpdb->get_results("SELECT email FROM wp_userentry WHERE email='".$mail."' ");
     $no=$wpdb->num_rows;
     if($no>=1){
      echo '<script>alert("email already exist")</script>';
     }
     else{
    $wpdb->update (
        $table_name,
        array(
            'username'=>$username,
            'fullname'=>$fullname,
            'date'=>$dt,
            'email'=> $mail,
        ),
        array(
            'id'=>$id,
        )
    );
	  
 }
  ?>
<script type="text/javascript">
window.location = "http://localhost/crud/wp-admin/admin.php?page=data-slug";
</script>  
 <?php }
?>
  </body>
  </html>
  