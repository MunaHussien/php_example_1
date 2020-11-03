		<?php
		include 'DBConfig.php';
		 
		$message = '';
		 
		$connection = new mysqli($host_name, $host_user, $host_password, $database_name);
		 
		if ($connection->connect_error)
		{
	     die("Connection failed: " . $connection->connect_error);
		} 
	 
		$json = json_decode(file_get_contents('php://input'), true);  

		 if($json){

		$result= $connection->query("SELECT * FROM users where UserEmail='$json[UserEmail]'");
		if($result->num_rows>0){
				
			$feedback[]=[
              'message'=> 'Email Already Exist' 
             ];   
			}

		else{
			if($json['SignType']=='S'){
		$query = "INSERT INTO users(AcademicNumber, UserName , BranchName , MajorName , UserEmail , UserPassword , UserPhone, SignType) values('$json[AcademicNumber]','$json[UserName]', '$json[BranchName]','$json[MajorName]', '$json[UserEmail]', '$json[UserPassword]', '$json[UserPhone]', '$json[SignType]')";
	}
	else{
	$query = "INSERT INTO users(UserName,BranchName, UserEmail,UserPassword, SignType) values('$json[UserName]', '$json[BranchName]', '$json[UserEmail]', '$json[UserPassword]','$json[SignType]')";	
	}
		 
		$query_result = $connection->query($query);
		 
		if ($query_result === true)
		{
			$result= $connection->query("SELECT * FROM users where UserEmail='$json[UserEmail]' and UserPassword='$json[UserPassword]'");
			 if($result->num_rows>0){
     while($row = mysqli_fetch_array($result))
   {
    $feedback[]=[
    
    'UserId'=> $row["UserId"] ,
    'UserName'=> $row["UserName"]  ,
    'UserEmail' =>  $row["UserEmail"]  ,
    'AcademicNumber'=> $row["AcademicNumber"],
    'BranchName' =>  $row["BranchName"]  ,
    'MajorName'=> $row["MajorName"]  ,
    'UserPassword'=> $row["UserPassword"]  ,
    'UserPhone'=> $row["UserPhone"]  ,
    'UserImage'=> $row["UserImage"] ,
     'SignType'=> $row["SignType"] ,
    'CheckLogin'=> 'Yes' ,
    ];
   
   }
    }     
		}
		 
		else
		{
			$feedback[]=[
		    'message'=> 'check internet connection.' ,
		    ];    
		}
	   }
	  }
		else{
			$feedback[]=[
		    'message'=> 'Try again!' ,
		    ]; 
		}
		 
print(json_encode($feedback,JSON_UNESCAPED_UNICODE));
$connection->close();