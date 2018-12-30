<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

// Home > Edit Profile
Breadcrumbs::register('gpa', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('GPA Counter', route('gpa'));
});

// Home > Edit Profile
Breadcrumbs::register('profile', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Profile', route('profile'));
});

// Home > News
Breadcrumbs::register('news', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('News', route('news.index'));
});
// Home > News > Create
Breadcrumbs::register('create_news', function ($breadcrumbs) {
    $breadcrumbs->parent('news');
    $breadcrumbs->push('Create', route('news.create'));
});
// Home > News > [Post]
Breadcrumbs::register('post', function ($breadcrumbs, $n) {
    $breadcrumbs->parent('news');
    $breadcrumbs->push($n->title, route('news.show', $n->id));
});
// Home > News > [Post] > Edit
Breadcrumbs::register('post_edit', function ($breadcrumbs, $n) {
    $breadcrumbs->parent('post', $n);
    $breadcrumbs->push('Edit', route('news.edit', $n->id));
});


// Home > Users > [All]
Breadcrumbs::register('users', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('All Users', '/users?role_id=all');
});

// Home > Users > [Students]
Breadcrumbs::register('students', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Students', '/users?role_id=2');
});
// Home > Users > [Teachers]
Breadcrumbs::register('teachers', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Teachers', '/users?role_id=3');
});
// Home >  Users > [Students] > Create
Breadcrumbs::register('create_student', function ($breadcrumbs) {
    $breadcrumbs->parent('students');
    $breadcrumbs->push('Add', '/users/create?role_id=2');
});
// Home >  Users > [Teachers] > Create
Breadcrumbs::register('create_teacher', function ($breadcrumbs) {
    $breadcrumbs->parent('teachers');
    $breadcrumbs->push('Add', '/users/create?role_id=3');
});

// Home >  Users > [Students] > Edit
Breadcrumbs::register('edit_student', function ($breadcrumbs) {
    $breadcrumbs->parent('students');
    $breadcrumbs->push('Edit', '/users/{user}/edit');
});
// Home >  Users > [Teachers] > Edit
Breadcrumbs::register('edit_teacher', function ($breadcrumbs) {
    $breadcrumbs->parent('teachers');
    $breadcrumbs->push('Edit', '/users/{user}/edit');
});
// Home > Groups
Breadcrumbs::register('groups', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Groups', route('groups.index'));
});

// Home > Groups > [Group]
Breadcrumbs::register('group', function ($breadcrumbs, $g) {
    $breadcrumbs->parent('groups');
    $breadcrumbs->push($g->name, route('groups.show', $g));
});

// Home > Courses
Breadcrumbs::register('courses', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Courses', '');
});
// Home > Courses > Create
Breadcrumbs::register('create_course', function ($breadcrumbs) {
    $breadcrumbs->parent('courses');
    $breadcrumbs->push('Create', route('course.create'));
});
// Home > Courses > [Course]
Breadcrumbs::register('course', function ($breadcrumbs, $c) {
    $breadcrumbs->parent('courses');
    $breadcrumbs->push($c->name, route('course.show', $c->id));
});
// Home > Courses > [Course] > Edit
Breadcrumbs::register('course_edit', function ($breadcrumbs, $c) {
    $breadcrumbs->parent('course', $c);
    $breadcrumbs->push('Edit', route('course.edit', $c->id));
});

// Home > Courses > [Course] > [Lesson]
Breadcrumbs::register('lesson', function ($breadcrumbs, $l) {
    $breadcrumbs->parent('course', $l->course);
    $breadcrumbs->push($l->title, route('lesson.show', $l->id));
});
// Home > Courses > [Course] > Create Lesson
Breadcrumbs::register('create_lesson', function ($breadcrumbs, $c) {
    $breadcrumbs->parent('course', $c);
    $breadcrumbs->push('Create Lesson', route('lesson.create'));
});
// Home > Courses > [Course] > [Lesson] > Edit
Breadcrumbs::register('lesson_edit', function ($breadcrumbs, $l) {
    $breadcrumbs->parent('lesson', $l);
    $breadcrumbs->push('Edit', route('lesson.edit', $l->id));
});

// Home > Courses > [Course] > [Lesson] > Marks
Breadcrumbs::register('marks', function ($breadcrumbs, $l) {
    $breadcrumbs->parent('lesson', $l);
    $breadcrumbs->push('Marks', route('marks.index'));
});
// Home > Courses > [Course] > [Lesson] > Attendance
Breadcrumbs::register('attendances', function ($breadcrumbs, $l) {
    $breadcrumbs->parent('lesson', $l);
    $breadcrumbs->push('Attendances', route('attendances.index'));
});
// Home > Courses > [Course] > Marks
Breadcrumbs::register('student_marks', function ($breadcrumbs, $c) {
    $breadcrumbs->parent('course', $c);
    $breadcrumbs->push('Marks', '/marks/'.$c->id);
});
// Home > Courses > [Course] > Attendance
Breadcrumbs::register('student_attendance', function ($breadcrumbs, $c) {
    $breadcrumbs->parent('course', $c);
    $breadcrumbs->push('Attendance', '/marks/'.$c->id);
});
?>
