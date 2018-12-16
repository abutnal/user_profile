<?php
require_once('model.php');
if (isset($_POST['showRecords'])) {
$count = 1;	
$html = "";
$html .= '<thead>';
$html .= '<th>SL</th>';
$html .= '<th>Name</th>';
$html .= '<th>Image</th>';
$html .= '<th style="text-align: center;">Action</th>';
$html .= '</thead>';
$data = $obj->select_all('user_tbl');
foreach ($data as $row) {
$html .= '<tr >';
$html .= '<td>'.$count++.'</td>';
$html .= '<td>'.$row['name'].'</td>';
$html .= '<td><img src="assets/image/'.$row['photo'].'"  class="image" id="'.$row['user_id'].'" user-data="'.$row['user_id'].'" alt="">';
$html .= '</td>';
$html .= '<td align="right"><a href="" data-toggle="modal" id="edit" user-data="'.$row['user_id'].'" data-target="#updateProfileModal" class="btn btn-primary btn-xs">Edit</a>&nbsp&nbsp<a href="" class="btn btn-danger btn-xs">Delete</a></td>';

$html .= '</tr>';
}
echo json_encode($html);
}


if (isset($_POST['showSelectedRecords'])) {
	$where = ['user_id'=>$_POST['user_id']];
	$data = $obj->select_where('user_tbl', $where);
	foreach ($data as $row) {
		$html = '<div class="row"><div class="col-md-12"> <img src="assets/image/'.$row['photo'].'" class="profile-image"></div>     <div class="col-md-12"><b>Name:</b> '.$row['name'].'</div><div class="col-md-12"><b>Phone:</b> '.$row['phone'].'</div><div class="col-md-12"><b>Email:</b> '.$row['email'].'</div><div class="col-md-12"><b>About You:</b> '.$row['aboutyou'].'</div></div>';
	}
	echo json_encode($html);
}

if (isset($_POST['showEditRecords'])) {
	$where = ['user_id'=>$_POST['user_id']];
	$data = $obj->select_where('user_tbl', $where);
	foreach ($data as $row) {
		$name = $row['name'];
		$user_id = $row['user_id'];
		$phone = $row['phone'];
		$email = $row['email'];
		$photo = $row['photo'];
		$aboutyou = $row['aboutyou'];
	}
	$html = '';
	$html .= '<form action="controller.php" method="POST" id="updateProfileForm" enctype="multipart/form-data">';
	$html .= '<div class="modal-body">';
	$html .= '<div class="col-md-12"><div class="form-group">';
	$html .= '<input type="hidden" name="UpdateProfile" value="UpdateProfile" id="UpdateProfile">';
	$html .= '<input type="hidden" name="user_id" value="'.$user_id.'" id="UpdateProfile">';
	$html .= '<input type="text" name="name" id="name" value="'.$name.'" placeholder="Name" class="form-control">';
	$html .= '</div></div>';
	$html .= '<div class="col-md-12"><div class="form-group">';
	$html .= '<input type="text" name="phone" id="phone" value="'.$phone.'" placeholder="Phone" class="form-control">';
	$html .= '</div></div>';
	$html .= '<div class="col-md-12"><div class="form-group">';
	$html .= '<input type="text" name="email" id="email" value="'.$email.'" placeholder="Email" class="form-control">';
	$html .= '</div></div>';
	$html .= '<input type="hidden" name="path" value="'.$photo.'" id="path">';
	$html .= '<div class="col-md-12"><div class="form-group"><img src="assets/image/'.$photo.'" width="50px" height="50px">';
	$html .= '<input type="file" name="photo" id="photo" placeholder="Photo" class="form-control">';
	$html .= '</div></div>';
	$html .= '<div class="col-md-12"><div class="form-group">';
	$html .= '<textarea name="aboutyou" id="aboutyou" placeholder="Describe About you" cols="30" rows="3" class="form-control">'.$aboutyou.'';
	$html .= '</textarea>';
	$html .= '</div></div>';
	$html .= '</div>';
	$html .= '<div class="modal-footer">';
	$html .= '<div class="col-md-12">';
	$html .= '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
	$html .= '<button type="submit" class="btn btn-primary">Save changes</button>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</form>';
	echo json_encode($html);
}


if (isset($_POST['addNewProfile'])) {
	$data = ['name'=>$_POST['name'], 'phone'=>$_POST['phone'], 'email'=>$_POST['email'], 'photo'=>$_FILES['photo']['name'], 'aboutyou'=>$_POST['aboutyou']];
	if($obj->insert('user_tbl', $data)){
		move_uploaded_file($_FILES['photo']['tmp_name'], 'assets/image/'.basename($_FILES['photo']['name']));
		$message = '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Well done!</strong> You successfully added new profile.
</div>';
		echo json_encode($message);
	}
}


if (isset($_POST['UpdateProfile'])) {
	if (empty($_FILES['photo']['name'])) {
		$path = $_POST['path'];
	}
	else{
		$path = $_FILES['photo']['name'];
		move_uploaded_file($_FILES['photo']['tmp_name'], 'assets/image/'.basename($_FILES['photo']['name']));
	}
	$data = ['name'=>$_POST['name'], 'phone'=>$_POST['phone'], 'email'=>$_POST['email'], 'photo'=>$path, 'aboutyou'=>$_POST['aboutyou']];
	$where = ['user_id'=>$_POST['user_id']];
	if($obj->update('user_tbl', $data, $where)){
		$message = '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Well done!</strong> You successfully Updated profile.
</div>';
		echo json_encode($message);
	}
}
