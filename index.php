<html>
<head>

</head>
<body>

<?php

include('config.php');
include('todolist.php');

$app = new TodoList(date('Ymd'));//20210209

$todolist = $app->getTodos();
$reqMethod = $_SERVER['REQUEST_METHOD'];

switch ($reqMethod) {
    case 'POST':
        if(!empty($_POST['indis'])){
            $app->update($_POST['indis']);
        }else{
            $app->add();
        }
        break;
    case 'GET':
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $app->delete($_GET['id']);
        }
        break;

}

$todolist = $app->getTodos();
?>
  <?php if(!empty($_GET['indis'])) { ?>
    <form action="index.php" method="post">
        <input type="text"  name="mytodo"/>
        <input type="hidden" value="<?php echo $_GET['indis'] ?>" name="indis"/>
        <input type="submit" value="UPDATE">
    </form>
<?php }else{ ?>
      <form action="index.php" method="post">
          <input type="text"  name="mytodo"/>
          <input type="submit" value="EKLE">
      </form>
<?php  } ?>


<ul>
    <?php
    foreach ($todolist as $k => $v) {
        echo '<li><div style="display:inline-block">' . $v . '</div> 
           <form action="/index.php" style="display:inline-block" >
            <input type="hidden" value="delete" name="action" />
            <input type="hidden" value="' . ($k + 1) . '" name="id" />
            <input name="sil"  type="submit" value="sil" />
            </form>
            
            <a href="index.php?indis=' . ($k + 1) . '">Değiştir</a>
            
            </li>';
    }
    ?>
</ul>
</body>
</html>
