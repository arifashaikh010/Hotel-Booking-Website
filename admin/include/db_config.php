<?php 
    $hname = 'localhost';
    $uname = 'root';
    $pass = '';
    $db = 'hbwebsite';

    $con = mysqli_connect($hname,$uname,$pass,$db);

    if(!$con){
        die("Cannot connect to a database".mysqli_connect_error());
    }

    function filteration($data){
        foreach($data as $key => $value){                          //data is unfiltered
            $data[$key] = trim($value);                            //remove spaces
            $data[$key] = stripslashes($value);                    //remove backsplash
            $data[$key] = htmlspecialchars($value);                //special symbols are converted
            $data[$key] = strip_tags($value);                      //remove html tags if entered
        }
        return $data;                                              //return filtered data
    }

    function select($sql,$values,$datatypes)
    {
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con,$sql)){
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else{
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Select");
            }
        }else{
            //die("Query cannot be prepared - select");
        }
    }
?>