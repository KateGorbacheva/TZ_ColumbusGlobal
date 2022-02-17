<?php
$db_host = "localhost";//хост
$db_db = "TZ";//название бд
$db_user = "root";//пользователь
$db_password = "root";//пароль
// Устанавливаем соединение
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_db);
// Проверяем соединение
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
//Проверка загрузки файла
if(isset($_FILES) && $_FILES['filename']['error'] == 0){
$destiation_dir = dirname(__FILE__) .'/'.$_FILES['inputfile']['name'];
move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir );
}
else{
echo 'No File Uploaded'; // Оповещаем пользователя о том, что файл не был загружен
}

$arr = [];
$mask = "!@#$%^&*()_+№%:,' ;\"|=[]{}/`~`";//маска для проверки названия

if(($file = fopen($_FILES['filename']['tmp_name'],'r'))!== false){
  //получение 1000 строк
  while(($data = fgetcsv($file,1000,";")) !== false){
    $arr[] = $data;
    $arr[0][2]='error';
    for($i = 1; $i<count($arr); $i++){
      //проверка названия
      if(($val=strpbrk($arr[$i][1],$mask))==null){
          $var[$i]='';
          $code=$arr[$i][0];
          $title=$arr[$i][1];
          //если совпадает, то обнвляем. Иначе  создаем новое наименование
          $sql = "SELECT * FROM Directory WHERE Код = $code";

          $check =  mysqli_num_rows(mysqli_query($conn, $sql));

          if($check!=0){
            $sql_update = "UPDATE Directory SET Название = '$title' WHERE Код = $code";
            mysqli_query($conn, $sql_update);
          }else{
            $sql_insert = "INSERT INTO Directory (Код,Название) VALUES ('$code','$title')";
            mysqli_query($conn, $sql_insert);
          }

      }else{
         $var[$i]='Недопустимый символ'.' "'.substr($val,0,1).'" '.'в поле Название';
      }
      $arr[$i][2]=$var[$i];
    }

  }
  //запись в файл для выгрузки
  $file_content = "";
  foreach ($arr as $row)
      $file_content .= "$row[0];\t$row[1];\t$row[2];\r\n";

  header("Pragma: public");
  header("Content-Type: text/plain; charset=utf-8");
  header("Content-Disposition: attachment; charset=utf-8; filename=\"Directory.csv\"");

  header("Content-Transfer-Encoding: binary");
  header("Content-Length: " . strlen($file_content));

  echo $file_content;

  fclose($file);
}

$conn->close();

 ?>
