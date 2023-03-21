<!-- 헤더 include_once('view/header.php') -->
<?php include_once('view/header.php'); ?>

<!-- 섹션 id="list" class="list" -->
<section id="list" class="list">
  <!-- 헤더 -->
  <header class="list__row list__header">
    <h1>과제</h1>
    <form action="." method="get" id="list__header_select" class="list__header_select">
      <input type="hidden" name="action" value="list_assignments">
      <select name="course_id" required>
        <option value="0">모두 보기</option>
        <?php foreach ($courses as $course) : ?>
        <?php if ($course_id == $course['courseID']) { ?>
        <option value="<?= $course['courseID'] ?>" selected>
          <?php } else { ?>
        <option value="<?= $course['courseID'] ?>">
          <?php } ?>
          <?= $course['courseName'] ?>
        </option>
        <?php endforeach; ?>
      </select>

      <button class="add-button bold">이동</button>
    </form>
  </header>
  <!-- 헤더 End -->

  <?php if ($assignments) { ?>
  <?php foreach ($assignments as $assignment) : ?>
  <div class="list__row">
    <div class="list__item">
      <p class="bold">
        <?= $assignment['courseName'] ?>
      </p>
      <p>
        <?= $assignment['Description'] ?>
      </p>
    </div>
    <div class="list__removeItem">
      <form action="." method="post">
        <input type="hidden" name="action" value="delete_assignment">
        <input type="hidden" name="assignment_id" value="<?= $assignment['ID'] ?>">
        <button class="remove-button">❌</button>
      </form>
    </div>
  </div>
  <?php endforeach; ?>

  <?php } else { ?>
  <br>
  <?php if ($course_id) { ?>
  <p>아직 이 과정에 대한 과제가 없습니다.</p>
  <?php } else { ?>
  <p>아직 과제가 없습니다.</p>
  <?php } ?>
  <br>
  <?php } ?>
</section>
<!-- 섹션 id="list" class="list" End -->

<!-- 섹션 id="add" class="add" -->
<section id="add" class="add">
  <h2>과제 추가</h2>
  <form action="." method="post" id="add__form" class="add__form">
    <input type="hidden" name="action" value="add_assignment">
    <div class="add__inputs">
      <label>코스:</label>
      <select name="course_id" required>
        <option value="">선택해 주세요</option>
        <?php foreach ($courses as $course): ?>
        <option value="<?= $course['courseID'] ?>">
          <?= $course['courseName'] ?>
        </option>
        <?php endforeach; ?>
      </select>
      <label>설명:</label>
      <input type="text" name="description" maxlength="120" placeholder="설명" autocomplete="off" required>
    </div>
    <div class="add__addItem">
      <button class="add-button bold">추가</button>
    </div>
  </form>
</section>
<!-- 섹션 id="add" class="add" End -->

<br>
<p>
  <a href=".?action=list_courses">코스 보기/수정</a>
</p>

<!-- 푸터 include_once('view/footer.php') -->
<?php include_once('view/footer.php'); ?>
