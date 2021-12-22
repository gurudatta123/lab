<?php
class script{

public $con;

public function __construct(){

        $server = "ENDPOINT";
        $user = "MASTER USERNAME";
        $pass = "MASTER PASSWORD";
        $db = "YOUR DATABASE NAME";


        $this->con = mysqli_connect($server,$user,$pass,$db) or die("unable to connect");
}

public function add($name,$price){
        $sql = "insert into books(bookname,price) values('".urlencode($name)."','".urlencode($price)."')";
        $res = mysqli_query($this->con,$sql) or die("Unable to perform operation");
        if($res){
                echo "Data added!";
        }else{
                echo "Operational failure!";
        }

}


public function getdata(){
        $sql = "select * from books";
        $res = mysqli_query($this->con,$sql) or die("unable to fetch");
        $cp = mysqli_fetch_assoc($res);
//var_dump($cp);
        if(count($cp)){
                echo '
                <table>
                        <tr>
                                <th>Book Name</th>
                                <th>Price</th>
                        </tr>
                ';
                while($row = mysqli_fetch_array($res)){

                        echo '<tr>
                                <td>'.urldecode($row['bookname']).'</td>
                                <td>'.urldecode($row['price']).'</td>
                        </tr>';
                }
                echo '
                        </table>
                        ';
        }else{
                echo "No data found!";
        }

}




}
?>


<html>
<head>
        <title>Cloud Computing Lab</title>
</head>
<body>

<form method="post">
<p>Name: <input type="text" name="bname"></p>
<p>Price: <input type="text" name="bprice"></p>
<p><input type="submit" name="sub"></p>
</form>
<?php
$script = new script();
if(isset($_POST['sub'])){
        //$script = new script();
        $script->add($_POST['bname'],$_POST['bprice']);
}
$script->getdata();


?>


</body>
</html>
