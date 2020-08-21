<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => "ID",
            'first_name' => "First name",
            'last_name' => "Last name",
            'email' => "Email",
            'password' => "Password",
            'password_repeat' => "Password Confirmation",
            'activated' => "Activated",
            'forbidden' => "Forbidden",
            'language' => "Language",
                
            //Belongs to many relations
            'roles' => "Roles",
                
        ],
    ],

    'level' => [
        'title' => 'Levels',

        'actions' => [
            'index' => 'Levels',
            'create' => 'New Level',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'title' => "Title",
            
        ],
    ],

    'role' => [
        'title' => 'Roles',

        'actions' => [
            'index' => 'Roles',
            'create' => 'New Role',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'name' => "Name",
            'guard_name' => "Guard name",
            
        ],
    ],

    'grade' => [
        'title' => 'Grades',

        'actions' => [
            'index' => 'Grades',
            'create' => 'New Grade',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'title' => "Title",
            'level_id' => 'Level',
            'courses' => "Courses",
            'enabled' => "Enabled",
            
        ],
    ],

    'course' => [
        'title' => 'Courses',

        'actions' => [
            'index' => 'Courses',
            'create' => 'New Course',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'title' => "Title",
            'competence' => "Competence",
            'slug' => "Slug",
            'enabled' => "Enabled",
            
        ],
    ],

    'subject' => [
        'title' => 'Subjects',

        'actions' => [
            'index' => 'Subjects',
            'create' => 'New Subject',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'title' => "Title",
            'description' => "Description",
            'course_id' => "Course",
            'file' => "File",
            'slug' => "Slug",
            'enabled' => "Enabled",
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];