<?php

/**
 * $course_id에 해당하는 강좌명, 그에 해당하는 과제 설명, 과제 ID를 가져오거나
 * 만약 $course_id가 없다면 모든 강좌명과 그에 해당하는 과제 설명, 과제 ID를 가져오는 함수
 *
 * @입력값 $course_id
 *
 * @리턴값 $assignments
 */
function get_assignments_by_course($course_id)
{
    global $db;

    if ($course_id) {
        $query = "SELECT
                A.ID, A.Description, C.courseName
              FROM
                assignments A
              LEFT JOIN
                courses C
              ON
                A.courseId = C.courseId
              WHERE
                A.courseId = :course_id
              ORDER BY
                A.ID";
    } else {
        $query = "SELECT
                A.ID, A.Description, C.courseName
              FROM
                assignments A
              LEFT JOIN
                courses C
              ON
                A.courseId = C.courseId
              ORDER BY
                C.courseID";
    }

    $statement = $db->prepare($query);
    if ($course_id) {
        $statement->bindValue(':course_id', $course_id);
    }
    $statement->execute();

    $assignments = $statement->fetchAll();
    $statement->closeCursor();

    return $assignments;
}

/**
 * $assignment_id에 해당하는 과제 삭제
 *
 * @입력값 $assignment_id
 *
 * @리턴값 void
 */
function delete_assignment($assignment_id)
{
    global $db;

    $query = "DELETE FROM
              assignments
            WHERE
              ID = :assign_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':assign_id', $assignment_id);
    $statement->execute();
    $statement->closeCursor();
}

/**
 * $assignment_id에 해당하는 과제 추가
 *
 * @입력값 $assignment_id
 *
 * @리턴값 void
 */
function add_assignment($course_id, $description)
{
    global $db;

    $query = "INSERT INTO
              assignments (Description, courseID)
            VALUES
              (:descr, :courseID)";
    $statement = $db->prepare($query);
    $statement->bindValue(':descr', $description);
    $statement->bindValue(':courseID', $course_id);
    $statement->execute();
    $statement->closeCursor();
}
