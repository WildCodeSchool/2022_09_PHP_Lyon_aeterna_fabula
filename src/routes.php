<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'chapters' => ['ChapterController', 'adminIndex',],
    'chapter/show' => ['ChapterController', 'showWithAction', ['id']],
    'incipit' => ['IncipitController', 'incipit',],
    'chapters/admin_show' => ['ChapterController', 'showWithActionForAdmin', ['id']],
    'chapters/admin_add' => ['ChapterController', 'adminAdd',],
    'chapters/admin_edit' => ['ChapterController', 'adminEdit', ['id']],
    'actions' => ['ActionController', 'adminIndexAction',],
    'actions/admin_show_action' => ['ActionController', 'adminShowAction', ['id']],
    'actions/admin_edit_action' => ['ActionController', 'adminEditAction', ['id']],
    'actions/admin_add_action' => ['ActionController', 'adminAddAction',],
    'admin/admin_homepage' => ['HomeController', 'indexAdmin',],
];
