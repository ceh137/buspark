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
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'email_verified_at' => 'Email verified at',
            'password' => 'Password',
            
        ],
    ],

    'index-page' => [
        'title' => 'Index Page',

        'actions' => [
            'index' => 'Index Page',
            'create' => 'New Index Page',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'link' => 'Link',
            'text_btn' => 'Text btn',
            'color' => 'Color',
            
        ],
    ],

    'input' => [
        'title' => 'Inputs',

        'actions' => [
            'index' => 'Inputs',
            'create' => 'New Input',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'type' => 'Type',
            'name' => 'Name',
            'label' => 'Label',
            'index_page_id' => 'Index page',
            'needed' => 'Needed',
            
        ],
    ],

    'option' => [
        'title' => 'Options',

        'actions' => [
            'index' => 'Options',
            'create' => 'New Option',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'input_id' => 'Input',
            'value' => 'Value',
            'text' => 'Text',
            
        ],
    ],

    'check-list' => [
        'title' => 'Check Lists',

        'actions' => [
            'index' => 'Check Lists',
            'create' => 'New Check List',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'text_btn' => 'Text btn',
            'color' => 'Color',
            
        ],
    ],

    'check-question' => [
        'title' => 'Check Questions',

        'actions' => [
            'index' => 'Check Questions',
            'create' => 'New Check Question',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'question' => 'Question',
            'instant_answer' => 'Instant answer',
            'type_of_instant_answer' => 'Type of instant answer',
            'check_list_id' => 'Check list',
            
        ],
    ],

    'answer' => [
        'title' => 'Answers',

        'actions' => [
            'index' => 'Answers',
            'create' => 'New Answer',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'text' => 'Text',
            'check_question_id' => 'Check question',
            'is_right_swipe' => 'Is right swipe',
            
        ],
    ],

    'answered-question' => [
        'title' => 'Answered Questions',

        'actions' => [
            'index' => 'Answered Questions',
            'create' => 'New Answered Question',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'question_id' => 'Question',
            'answer_id' => 'Answer',
            'post_by_id' => 'Post by',
            
        ],
    ],

    'input-answer' => [
        'title' => 'Input Answers',

        'actions' => [
            'index' => 'Input Answers',
            'create' => 'New Input Answer',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'input_id' => 'Input',
            'answer' => 'Answer',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];