<?php include_once "db.php";
// 1. 引入共用檔

// 2. 兩個流程判斷 foreach、if else
foreach ($_POST['id'] as $id) {
  if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
    $News->del($id);
  } else {
    $news = $News->find($id);
    $news['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
    $News->save($news);
  }
}

// 
to("../back.php?do=news");
