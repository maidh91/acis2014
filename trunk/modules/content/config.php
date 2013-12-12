<?php
return array (
    'permissionRules' => array(
                        'see_content' => array(//External permission
                                            'See all articles',//Full control name
                                            '9_lang',//table
                                            'lang_id', //Check permisison column
                                            'name'),//Display column at permission interface
                        'new_content' => array(//External permission
                                            'Create new article',//Full control name
                                            '9_lang',//table
                                            'lang_id', //Check permisison column
                                            'name'),//Display column at permission inteface
                        'edit_content' => array(//External permission
                                            'Edit existed articles',//Full control name
                                            '9_lang',//table
                                            'lang_id', //Check permisison column
                                            'name'),//Display column at permission inteface
                        'delete_content' => 'Delete existed articles',


                        'see_category' => array(//External permission
                                            'See all categories',//Full control name
                                            '9_lang',//table
                                            'lang_id', //Check permisison column
                                            'name'),//Display column at permission interface
                        'new_category' => array(//External permission
                                            'Create new category',//Full control name
                                            '9_lang',//table
                                            'lang_id', //Check permisison column
                                            'name'),//Display column at permission inteface
                        'edit_category' => array(//External permission
                                            'Edit existed categories',//Full control name
                                            '9_lang',//table
                                            'lang_id', //Check permisison column
                                            'name'),//Display column at permission inteface
                        'delete_category' => 'Delete existed categories',
                    ),
    'newsNumberRowPerPage'	=>	12,
    'servicesNumberRowPerPage'	=>	8,
);
