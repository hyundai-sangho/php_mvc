<?php

/**
 * 강의 목록 가져오는 함수
 * @리턴값: $courses
 */
function get_courses()
{
    global $db;

    $query = "SELECT * FROM
              courses
            ORDER BY
              courseID";

    $statement = $db->prepare($query);
    $statement->execute();

    $courses = $statement->fetchAll();
    $statement->closeCursor();

    return $courses;
}

/**
 * 강좌 id에 해당하는 강좌명을 알려주는 함수
 * @입력값 $course_id
 * @리턴값 $course_name
 */
function get_course_name($course_id)
{
    if (!$course_id) {
        return "모든 과정";
    }

    global $db;

    $query= "SELECT * FROM
              courses
            WHERE
              courseID = :course_id";

    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id);
    $statement->execute();

    $course = $statement->fetch();
    $statement->closeCursor();

    $course_name = $course['courseName'];

    return $course_name;
}

/**
 * 강좌 id에 해당하는 강좌를 삭제하는 함수
 * @입력값 $course_id
 * @리턴값 없음
 */
function delete_course($course_id)
{
    global $db;

    $query = "DELETE FROM
              courses
            WHERE
              courseID = :course_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_course($course_name)
{
    global $db;

    $query= "INSERT INTO
              courses (courseName)
            VALUES
              (:courseName)";

    $statement = $db->prepare($query);
    $statement->bindValue(':courseName', $course_name);
    $statement->execute();
    $statement->closeCursor();
}
