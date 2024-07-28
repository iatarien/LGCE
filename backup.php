<?php 

$DbName = "lgce";
$servername = "localhost";
$username = "root";
$password = "1989";

try {
  $connect = new PDO("mysql:host=$servername;dbname=lgce", $username, $password
  , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
  $connect->exec("SET CHARACTER SET UTF8");
  // set the PDO error mode to exception
  $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


$get_all_table_query = "SHOW TABLES";
$statement = $connect->prepare($get_all_table_query);
$statement->execute();
$result = $statement->fetchAll();

$prep = "Tables_in_".$DbName;
foreach ($result as $res){
    $tables[] =  $res[$prep];
}

$output = '';
foreach($tables as $table)
{
    $show_table_query = "SHOW CREATE TABLE " . $table . "";
    $statement = $connect->prepare($show_table_query);
    $statement->execute();
    $show_table_result = $statement->fetchAll();

    foreach($show_table_result as $show_table_row)
    {
        $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
    }
    $select_query = "SELECT * FROM " . $table . "";
    $statement = $connect->prepare($select_query);
    $statement->execute();
    $total_row = $statement->rowCount();

    for($count=0; $count<$total_row; $count++)
    {
        $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
        $table_column_array = array_keys($single_result);
        $table_value_array = array_values($single_result);
        $output .= "\nINSERT INTO $table (";
        $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
        $output .= '"' . implode('","', $table_value_array) . '");';
    }
}

$file_name = "D:/MySql_backup/" .date('Y-m-d') . '.sql';
$file_handle = fopen($file_name, 'w+');
fwrite($file_handle, $output);
fclose($file_handle);
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . basename($file_name));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file_name));
//ob_clean();
//flush();
// readfile($file_name);
// unlink($file_name);
?>