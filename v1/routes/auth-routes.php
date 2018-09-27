<?php
    global $router;
    
    $router->post('/login', 'Auth.login');
    $router->post('/sign-up', 'Auth.signUp');
    $router->get('/me', 'Auth.me', true)
            ->delete('/me', 'Auth.delete', true)
            ->patch('/me', 'Auth.update', true);
?>
