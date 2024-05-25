<?php

namespace classes\signup;

require_once "./classes/db.php";

use classes\db\db as db;

class signup extends db {
                        private string $urname;
                        private string $password;
                        private string $uremail;
                        private string $gender;
                        private string $dob;

                        public string $urnameErrMsg , $uremailErrMsg, $genderErrMsg, $dobErrMsg, $passwordErrMsg ; 

                        // Name Validation and Invalid Name functions

                        private function validateUrname($urname): bool  {
                            if(empty($urname)){
                                $this->urnameErrMsg = 'Please enter your Name';
                                return false;
                            }elseif(!preg_match("/^[A-Za-z. ]*$/", $urname)){
                                $this->urnameErrMsg = 'Please enter your valid Name'; 
                                return false;
                            } else {
                                $this->urnameErrMsg = "";
                                return true;
                            }

                        }
                         // Email Validation and Invalid Email functions and email address if already exists function

                        private function validateUremail($uremail): bool {
                            if(empty($uremail)){
                                $this->uremailErrMsg = 'Please enter your Email';
                                return false;
                            }elseif(!filter_var($uremail, FILTER_VALIDATE_EMAIL)){
                                $this->uremailErrMsg = 'Please enter your valid Email';
                                return false;
                            } else {
                                    // Check email address if already exists

                                    $sql = "SELECT email FROM users WHERE email =?";
                                    $stmt = $this->conn->prepare($sql);
                                    $stmt->bind_param("s", $uremail);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows > 0) {
                                    
                                    $this->uremailErrMsg = 'Email already exists';
                                    return false;
                                } else {

                                    $this->uremailErrMsg = "";
                                    return true;
                                }

                            }
                        }

                        // Gender Validation  functions

                        public function validateGender ($gender): bool {
                            if(empty($gender)){
                                $this->genderErrMsg = 'Please select your Gender';
                                return false;
                            } else {
                                $this->genderErrMsg = "";
                                return true;
                            }
                        }

                        // Date of Birth Validation

                        public function validateDob($dob): bool {
                            if(empty($dob)){
                                $this->dobErrMsg = 'Please enter your Date of Birth';
                                return false;
                            } else {
                                $this->dobErrMsg = "";
                                return true;
                            }
                        }

                        // Password Validation and Strong Password functions

                        public function validatePassword ($password): bool {
                            if(empty($password)){
                                $this->passwordErrMsg = 'Please enter your Password';
                                return false;
                            } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&#]{8,}$/", $password)) {
                                $this->passwordErrMsg = 'Please provide a strong Password';
                                return false;
                                } 
                             else {
                                $this->passwordErrMsg = "";
                                return true;
                            }
                        }

                         // Signup function
                         
                         // Signup function with real_escape_string function for MySQL security check  

                        public function signup ($urname, $password, $uremail, $gender, $dob): void {

                            $this->urname = $this->conn->real_escape_string($urname) ;
                            $this->password = $this->conn->real_escape_string($password) ;
                            $this->uremail = $this->conn->real_escape_string($uremail) ;
                            $this->gender = $this->conn->real_escape_string($gender) ;   
                            $this->dob = $this->conn->real_escape_string($dob ) ;
                         
                            $this->validateUrname($urname);
                            $this->validateUremail($uremail);
                            $this->validateGender($gender);
                            $this->validateDob($dob);
                            $this->validatePassword($password);

                            // Log in

                            if($this->validateUrname($urname) && $this->validateUremail($uremail) && $this->validateGender($gender) && $this->validateDob($dob) && $this->validatePassword($password)){

                                // Password Converted for USER Security
                                $this->password = password_hash($password, PASSWORD_DEFAULT);
                    
                                // MySQL Connection
                            
                                $sql = "INSERT INTO users (name, password, email, gender, dob) VALUES ('$this->urname', '$this->password', '$this->uremail', '$this->gender', '$this->dob')";
                                $result = mysqli_query($this->conn, $sql);
                                if($result){
                                            //  toast success position bottom right
                                            
                                            echo "<script>  toastr.success('SignUp Successful'); setTimeout(()=>{location.href='signin.php'}, 2000) </script>";
                                               

                                            
                                    // header("Location:./signin.php");
                                } else {
                                    echo "Error: ". $sql. "<br>". mysqli_error($this->conn);
                                }
                            }

                        }

}

?>