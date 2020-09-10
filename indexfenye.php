<?php
$mysql_server_name = 'localhost'; //改成自己的mysql数据库服务器

$mysql_username = 'root'; //改成自己的mysql数据库用户名

$mysql_password = 'root'; //改成自己的mysql数据库密码

$mysql_database = 'aerfa'; //改成自己的mysql数据库名

$conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database); //连接数据库

//连接数据库错误提示
if (mysqli_connect_errno($conn)) { 
    die("连接 MySQL 失败: " . mysqli_connect_error()); 
}

mysqli_query($conn,"set names utf8"); //数据库编码格式



$num_rec_per_page=10;   // 每页显示数量
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start_from = ($page-1) * $num_rec_per_page; 
$sql = "SELECT * FROM adminlogs LIMIT $start_from, $num_rec_per_page"; 

$rs_result = mysqli_query ($conn,$sql); // 查询数据
?>

<!DOCTYPE html>
<html>
<head>
	<title>分页</title>
	<style type="text/css">
	a{
		text-decoration: none;
	}
	.tab{
		margin: auto;
	}
	.a{
		margin: auto;
		text-align: auto;
	}
	.tab tr td{
		border: 1px solid #ccc;
		 padding: 14px;
    border-radius: 16px;
	}
	.aa{
		text-align: center;
		margin-top: 30px;
	}

</style>
</head>
<body>
<table class="tab">
	<tr>
	<td>id</td>
	<td>ip</td>
	</tr>
	<?php 
while ($row = mysqli_fetch_assoc($rs_result)) { 
?> 		
            <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['ip']; ?></td>            
            </tr>
<?php 
}; 
?> 

</table>
<div style="width: 100%;">
	<div class="aa">

		<?php 
		$sql = "SELECT * FROM adminlogs"; 
		$rs_result = mysqli_query($conn,$sql); //查询数据

		$total_records = mysqli_num_rows($rs_result);  // 统计总共的记录条数
		
		$total_pages = ceil($total_records / $num_rec_per_page);  // 计算总页数

		echo "<a class='a' href='index.php?page=1'>".'第一页'."</a> "; // 第一页

		for ($i=1; $i<=$total_pages; $i++) { 
		            echo "<a class='a' href='index.php?page=".$i."'>".$i."</a> "; 
		}; 
		echo "<a class='a' href='index.php?page=$total_pages'>".'最后一页'."</a> "; // 最后一页
		?>

	</div>
</div>

</body>
</html>


