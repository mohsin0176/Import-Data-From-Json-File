<?php

include"database.php";

if (isset($_POST['buttomImport'])) 
{
	copy($_FILES['jsonFile']['tmp_name'],'jsonFiles/'.$_FILES['jsonFile']['name']);
	$data=file_get_contents('jsonFiles/'.$_FILES['jsonFile']['name']);
	$products=json_decode($data);
	foreach ($products as $product) 
	{
		$stmt=$con->prepare( "INSERT INTO product (name,price,quantity)VALUES(:name,:price,:quantity)");
		$stmt->bindValue('name',$product->name);
		$stmt->bindValue('price',$product->price);
		$stmt->bindValue('quantity',$product->quantity);
		$stmt->execute();
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Import Json File</title>
</head>
<body>
<form method="POST" enctype="multipart/form-data">
	JSON FILE<input type="file" name="jsonfile">
	<br>
	<input type="submit" value="Import" name="buttomImport">
</form>
</body>
</html>