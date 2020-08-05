<?php 

require_once 'db_connect.php';


function showAllUser(){
	$conn = db_conn();
    $selectQuery = 'SELECT * FROM `user` ';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function showUser($id){
	$conn = db_conn();
	$selectQuery = "SELECT * FROM `user` where ID = ?";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}


function searchUser($user_name){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `user` WHERE user_name LIKE '%$user_name%'";

    
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}


function addUser($data){
	$conn = db_conn();
    $selectQuery = "INSERT into user (user_id, user_name, password,email, date_of_birth, gender, address, type)
VALUES (:user_id, :user_name, :password, :email, :date_of_birth, :gender, :address, :type)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
        	':user_id' => $data['user_id'],
        	':user_name' => $data['user_name'],
        	':password' => $data['password'],
        	':email' => $data['email'],
        	':date_of_birth' => $data['date_of_birth'],
        	':gender' => $data['gender'],
        	':address' => $data['address'],
        	':type' => $data['type']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    
    $conn = null;
    return true;
}


function updateUser($id, $data){
    $conn = db_conn();
    $selectQuery = "UPDATE user set user_name = ?, password = ?, email = ?,address = ? where ID = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
        	$data['user_name'], $data['password'], $data['email'], $data['address'], $id
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    
    $conn = null;
    return true;
}

function deleteUser($id){
	$conn = db_conn();
    $selectQuery = "DELETE FROM `user` WHERE `ID` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;

    return true;
}