<form action="./api/edit_news.php" method="post">
  <table style="width:75%;text-align:center">
    <tr>
      <td>編號</td>
      <td style="width:70%">標題</td>
      <td>顯示</td>
      <td>刪除</td>
    </tr>
    <?php
    $total = $News->count();
    $div = 3;
    $pages = ceil($total / $div);
    $now = $_GET['p'] ?? 1;
    $start = ($now - 1) * $div;
    $rows = $News->all(" limit $start,$div");
    foreach ($rows as $idx => $row) {
    ?>
      <tr>
        <td><?= $idx + 1 + $start; ?></td>
        <td><?= $row['title']; ?></td>
        <td>
          <input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?= ($row['sh'] == 1) ? 'checked' : ''; ?>>
        </td>
        <td>
          <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
          <input type="hidden" name="id[]" value="<?= $row['id']; ?>">
        </td>
      </tr>
    <?php }   ?>

  </table>

  <!-- 列表分頁 -->
  <div class="ct">
    <?php
    if ($now - 1 > 0) {
      $prev = $now - 1;
      echo "<a href='back.php?do=news&p=$prev'> < </a>";
    }

    for ($i = 1; $i <= $pages; $i++) {
      $size = ($i == $now) ? 'font-size:22px;' : 'font-size:16px;';
      echo "<a href='back.php?do=news&p=$i' style='{$size}'> $i </a>";
    }

    if ($now + 1 <= $pages) {
      $next = $now + 1;
      echo "<a href='back.php?do=news&p=$next'> > </a>";
    }
    ?>
  </div>
  <div class="ct"><input type="submit" value="修改確定"></div>
</form>