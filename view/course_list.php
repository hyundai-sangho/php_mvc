<!-- 헤더 include_once('view/header.php') -->
<?php include_once('view/header.php'); ?>

<?php if ($courses) { ?>

<section id="list" class="list">

  <header class="list__row list__header">
    <h1>Course List</h1>
  </header>

  <?php foreach ($courses as $course): ?>
  <div class="list__row">
    <div class="list__item">
      <p class="bold">
        <?= $course['courseName'] ?>
      </p>
    </div>
    <div class="list__removeItem">
      <form action="." method="post">
        <input type="hidden" name="action" value="delete_course">
        <input type="hidden" name="course_id" value="<?= $course['courseID'] ?>">
        <button class="remove-button">❌</button>
      </form>
    </div>
  </div>
  <?php endforeach; ?>

</section>

<?php } else { ?>
<p>아직 과정이 없습니다.</p>
<?php } ?>

<section id="add" class="add">
  <h2>코스 추가</h2>
  <form action="." method="post" id="add__form" class="add_form">
    <input type="hidden" name="action" value="add_course">
    <div class="add__inputs">
      <label>코스 과정명:</label>
      <input type="text" name="course_name" maxlength="50" placeholder="코스 과정명" autofocus autocomplete="off" required>
    </div>
    <div class="add__addItem">
      <button class="add-button bold">추가</button>
    </div>
  </form>
</section>

<br>
<p><a href=".">보기 &amp; 과제 추가</a></a></p>


<!-- 푸터 include_once('view/footer.php') -->
<?php include_once('view/footer.php'); ?>
