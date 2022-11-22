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
    '' => ['HomeController', 'index', ['action']], /* pas de restriction */
    'chapter/show' => ['ChapterController', 'showWithAction', ['alias', 'id', 'action']],
    /* restriction à un user loggé */
    'incipit' => ['IncipitController', 'incipit'], /* restriction à un user loggé */
    'login' => ['UserController', 'showLoginPage', ['inscrit']], /* pas de restriction */
    'register' => ['UserController', 'showRegisterPage'], /* pas de restriction */
    'logout' => ['UserController', 'logout'], /* pas de restriction - renvoie déjà sur la hp */
    'logoutAlias' => ['AliasController', 'logoutAlias', ['alias', 'action']],
    'deleteUser' => ['UserController', 'delete', ['user_id']],
    /* pas de restriction - renvoie déjà sur la hp */
    'alias' => ['AliasController', 'start',], /* restriction à un user loggé */
    'alias/create' => ['AliasController', 'create',], /* restriction à un user loggé */
    'alias/delete' => ['AliasController', 'deleteAlias', ['alias']],
    '404' => ['LostController', 'lost'],


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
