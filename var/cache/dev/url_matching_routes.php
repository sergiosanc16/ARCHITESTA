<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/verify/email' => [[['_route' => 'app_verify_email', '_controller' => 'App\\Controller\\RegistrationController::verifyUserEmail'], null, null, null, false, false, null]],
        '/testa/timagen' => [[['_route' => 'app_testa_timagen_index', '_controller' => 'App\\Controller\\TestaTimagenController::index'], null, ['GET' => 0], null, false, false, null]],
        '/testa/timagen/new' => [[['_route' => 'app_testa_timagen_new', '_controller' => 'App\\Controller\\TestaTimagenController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/testa/tnotario' => [[['_route' => 'app_testa_tnotario_index', '_controller' => 'App\\Controller\\TestaTnotarioController::index'], null, ['GET' => 0], null, false, false, null]],
        '/testa/tnotario/new' => [[['_route' => 'app_testa_tnotario_new', '_controller' => 'App\\Controller\\TestaTnotarioController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/testa/toficio' => [[['_route' => 'app_testa_toficio_index', '_controller' => 'App\\Controller\\TestaToficioController::index'], null, ['GET' => 0], null, false, false, null]],
        '/testa/toficio/new' => [[['_route' => 'app_testa_toficio_new', '_controller' => 'App\\Controller\\TestaToficioController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/testa/totorgante' => [[['_route' => 'app_testa_totorgante_index', '_controller' => 'App\\Controller\\TestaTotorganteController::index'], null, ['GET' => 0], null, false, false, null]],
        '/testa/totorgante/new' => [[['_route' => 'app_testa_totorgante_new', '_controller' => 'App\\Controller\\TestaTotorganteController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/testa/tparentesco' => [[['_route' => 'app_testa_tparentesco_index', '_controller' => 'App\\Controller\\TestaTparentescoController::index'], null, ['GET' => 0], null, false, false, null]],
        '/testa/tparentesco/new' => [[['_route' => 'app_testa_tparentesco_new', '_controller' => 'App\\Controller\\TestaTparentescoController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/testa/tpoblacion' => [[['_route' => 'app_testa_tpoblacion_index', '_controller' => 'App\\Controller\\TestaTpoblacionController::index'], null, ['GET' => 0], null, false, false, null]],
        '/testa/tpoblacion/new' => [[['_route' => 'app_testa_tpoblacion_new', '_controller' => 'App\\Controller\\TestaTpoblacionController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/testa/ttestamento' => [[['_route' => 'app_testa_ttestamento_index', '_controller' => 'App\\Controller\\TestaTtestamentoController::index'], null, ['GET' => 0], null, false, false, null]],
        '/testa/ttestamento/new' => [[['_route' => 'app_testa_ttestamento_new', '_controller' => 'App\\Controller\\TestaTtestamentoController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/testa/ttestaotorgante' => [[['_route' => 'app_testa_ttestaotorgante_index', '_controller' => 'App\\Controller\\TestaTtestaotorganteController::index'], null, ['GET' => 0], null, false, false, null]],
        '/testa/ttestaotorgante/new' => [[['_route' => 'app_testa_ttestaotorgante_new', '_controller' => 'App\\Controller\\TestaTtestaotorganteController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/user' => [[['_route' => 'app_user_index', '_controller' => 'App\\Controller\\UserController::index'], null, ['GET' => 0], null, false, false, null]],
        '/user/new' => [[['_route' => 'app_user_new', '_controller' => 'App\\Controller\\UserController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/_wdt/styles' => [[['_route' => '_wdt_stylesheet', '_controller' => 'web_profiler.controller.profiler::toolbarStylesheetAction'], null, null, null, false, false, null]],
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\RegistrationController::register'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\RegistrationController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\RegistrationController::logout'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
                .'|/testa/t(?'
                    .'|imagen/([^/]++)(?'
                        .'|(*:231)'
                        .'|/edit(*:244)'
                        .'|(*:252)'
                    .')'
                    .'|notario/([^/]++)(?'
                        .'|(*:280)'
                        .'|/edit(*:293)'
                        .'|(*:301)'
                    .')'
                    .'|o(?'
                        .'|ficio/([^/]++)(?'
                            .'|(*:331)'
                            .'|/edit(*:344)'
                            .'|(*:352)'
                        .')'
                        .'|torgante/([^/]++)(?'
                            .'|(*:381)'
                            .'|/edit(*:394)'
                            .'|(*:402)'
                        .')'
                    .')'
                    .'|p(?'
                        .'|arentesco/([^/]++)(?'
                            .'|(*:437)'
                            .'|/edit(*:450)'
                            .'|(*:458)'
                        .')'
                        .'|oblacion/([^/]++)(?'
                            .'|(*:487)'
                            .'|/edit(*:500)'
                            .'|(*:508)'
                        .')'
                    .')'
                    .'|testa(?'
                        .'|mento/([^/]++)(?'
                            .'|(*:543)'
                            .'|/edit(*:556)'
                            .'|(*:564)'
                        .')'
                        .'|otorgante/([^/]++)(?'
                            .'|(*:594)'
                            .'|/edit(*:607)'
                            .'|(*:615)'
                        .')'
                    .')'
                .')'
                .'|/user/([^/]++)(?'
                    .'|(*:643)'
                    .'|/edit(*:656)'
                    .'|(*:664)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        231 => [[['_route' => 'app_testa_timagen_show', '_controller' => 'App\\Controller\\TestaTimagenController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        244 => [[['_route' => 'app_testa_timagen_edit', '_controller' => 'App\\Controller\\TestaTimagenController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        252 => [[['_route' => 'app_testa_timagen_delete', '_controller' => 'App\\Controller\\TestaTimagenController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        280 => [[['_route' => 'app_testa_tnotario_show', '_controller' => 'App\\Controller\\TestaTnotarioController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        293 => [[['_route' => 'app_testa_tnotario_edit', '_controller' => 'App\\Controller\\TestaTnotarioController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        301 => [[['_route' => 'app_testa_tnotario_delete', '_controller' => 'App\\Controller\\TestaTnotarioController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        331 => [[['_route' => 'app_testa_toficio_show', '_controller' => 'App\\Controller\\TestaToficioController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        344 => [[['_route' => 'app_testa_toficio_edit', '_controller' => 'App\\Controller\\TestaToficioController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        352 => [[['_route' => 'app_testa_toficio_delete', '_controller' => 'App\\Controller\\TestaToficioController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        381 => [[['_route' => 'app_testa_totorgante_show', '_controller' => 'App\\Controller\\TestaTotorganteController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        394 => [[['_route' => 'app_testa_totorgante_edit', '_controller' => 'App\\Controller\\TestaTotorganteController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        402 => [[['_route' => 'app_testa_totorgante_delete', '_controller' => 'App\\Controller\\TestaTotorganteController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        437 => [[['_route' => 'app_testa_tparentesco_show', '_controller' => 'App\\Controller\\TestaTparentescoController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        450 => [[['_route' => 'app_testa_tparentesco_edit', '_controller' => 'App\\Controller\\TestaTparentescoController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        458 => [[['_route' => 'app_testa_tparentesco_delete', '_controller' => 'App\\Controller\\TestaTparentescoController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        487 => [[['_route' => 'app_testa_tpoblacion_show', '_controller' => 'App\\Controller\\TestaTpoblacionController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        500 => [[['_route' => 'app_testa_tpoblacion_edit', '_controller' => 'App\\Controller\\TestaTpoblacionController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        508 => [[['_route' => 'app_testa_tpoblacion_delete', '_controller' => 'App\\Controller\\TestaTpoblacionController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        543 => [[['_route' => 'app_testa_ttestamento_show', '_controller' => 'App\\Controller\\TestaTtestamentoController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        556 => [[['_route' => 'app_testa_ttestamento_edit', '_controller' => 'App\\Controller\\TestaTtestamentoController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        564 => [[['_route' => 'app_testa_ttestamento_delete', '_controller' => 'App\\Controller\\TestaTtestamentoController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        594 => [[['_route' => 'app_testa_ttestaotorgante_show', '_controller' => 'App\\Controller\\TestaTtestaotorganteController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        607 => [[['_route' => 'app_testa_ttestaotorgante_edit', '_controller' => 'App\\Controller\\TestaTtestaotorganteController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        615 => [[['_route' => 'app_testa_ttestaotorgante_delete', '_controller' => 'App\\Controller\\TestaTtestaotorganteController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        643 => [[['_route' => 'app_user_show', '_controller' => 'App\\Controller\\UserController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        656 => [[['_route' => 'app_user_edit', '_controller' => 'App\\Controller\\UserController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        664 => [
            [['_route' => 'app_user_delete', '_controller' => 'App\\Controller\\UserController::delete'], ['id'], ['POST' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
