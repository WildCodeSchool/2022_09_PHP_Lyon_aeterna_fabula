<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    // simple MVC example routes
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],

    // user routes
    '' => ['HomeController', 'index', ['action']],
    'chapter/show' => ['ChapterController', 'showWithAction', ['alias', 'id', 'action']],
    'incipit' => ['IncipitController', 'incipit'],
    'login' => ['UserController', 'showLoginPage', ['inscrit']],
    'register' => ['UserController', 'showRegisterPage'],
    'logout' => ['UserController', 'logout'],
    'logoutAlias' => ['AliasController', 'logoutAlias', ['alias', 'action']],
    'alias' => ['AliasController', 'start',],
    'alias/create' => ['AliasController', 'create',],
    'alias/delete' => ['AliasController', 'deleteAlias', ['alias']],

    // admin routes
    'chapters' => ['ChapterController', 'adminIndex',], /* réservé à l'admin */
    'chapters/admin_show' => ['ChapterController', 'showWithActionForAdmin', ['id']], /* réservé à l'admin */
    'chapters/admin_add' => ['ChapterController', 'adminAdd',], /* réservé à l'admin */
    'chapters/admin_edit' => ['ChapterController', 'adminEdit', ['id']], /* réservé à l'admin */
    'actions' => ['ActionController', 'adminIndexAction',], /* réservé à l'admin */
    'actions/admin_show_action' => ['ActionController', 'adminShowAction', ['id']], /* réservé à l'admin */
    'actions/admin_edit_action' => ['ActionController', 'adminEditAction', ['id']], /* réservé à l'admin */
    'actions/admin_add_action' => ['ActionController', 'adminAddAction',], /* réservé à l'admin */
    'admin/admin_homepage' => ['HomeController', 'indexAdmin',], /*  réservé à l'admin */
];
