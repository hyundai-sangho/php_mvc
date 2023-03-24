<?php

// MySQL DB 연결
require_once 'model/database.php';
// assignments 테이블 관련 DB
require_once 'model/assignments_db.php';
// course 테이블 관련 DB
require_once 'model/course_db.php';

$assignment_id          = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
$description            = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$course_name            = filter_input(INPUT_POST, 'course_name', FILTER_SANITIZE_STRING);
$course_id              = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);

if (!$course_id) {
    $course_id          = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);
}

$action                 = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if (!$action) {
    $action             = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if (!$action) {
        $action = 'list_assignments';
    }
}

switch ($action) {
    case "list_courses":
        $courses = get_courses();
        include_once 'view/course_list.php';

        break;

    case "add_course":
        add_course($course_name);
        header('Location: .?action=list_courses');

        break;

    case "add_assignment":
        if ($course_id && $description) {
            add_assignment($course_id, $description);
            header("Location: .?course_id=$course_id");
        } else {
            $error = "할당 데이터가 잘못되었습니다. 모든 입력란을 확인하고 다시 시도하세요.";

            include_once 'view/error.php';
            exit();
        }
        break;

    case "delete_course":
        if ($course_id) {
            try {
                delete_course($course_id);
            } catch(PDOException $e) {
                $error = "코스에 과제가 있는 경우 코스를 삭제할 수 없습니다.";

                include_once 'view/error.php';
                exit();
            }
            header("Location: .?action=list_courses");
        }
        break;

    case "delete_assignment":
        if ($assignment_id) {
            delete_assignment($assignment_id);
            header("Location: .?course_id=$course_id");
        } else {
            $error = "할당 ID가 없거나 잘못되었습니다.";
            include_once 'view/error.php';
        }
        break;

    default:
        $course_name    = get_course_name($course_id);
        $courses        = get_courses();
        $assignments    = get_assignments_by_course($course_id);

        include_once 'view/assignment_list.php';
}
