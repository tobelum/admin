<?php
     include_once("adb.php");
     
     /**
	*Variables used in all the functions for Patients
	*@param int adminid Admin ID
	*@param string username username
	*@param string password password
	*/

class admin extends adb{
     function admin(){

     }

     function getAdmin($username='none',$password='none'){
          $strQuery="select adminid from admin where username='$username' & password='$password'";
          return $this->query($strQuery);
     }

      function getUsers(){
          $strQuery="select userid, username, firstname, lastname, email, password, phone, organization from user";
          return $this->query($strQuery);
     }

      function newUser($username='none',$firstname='none',$lastname='none',$email='none',$password='none', $phone='none', $organization="none"){
    
          $strQuery = "insert into user SET username = '$username',firstname = '$firstname',lastname = '$lastname',email = '$email',password = '$password',phone = '$phone',organization = '$organization'";
          echo $strQuery;
          return $this->query ($strQuery);
     }

     function delUser($userid='none'){
          $strQuery = "delete from user where userid='$userid'";
          echo $strQuery;
          return $this->query ($strQuery);
     }


      function getMessages(){
          $strQuery="select messageid, mdate, title, content from message";
          return $this->query($strQuery);
     }

     function delMsg($messageid='none'){
          $strQuery = "delete from message where messageid='$messageid'";
          echo $strQuery;
          return $this->query ($strQuery);
     }

   }
