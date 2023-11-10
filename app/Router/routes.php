<?php

return [
    ['GET', '/', ['App\Controllers\NewsController', 'index']],
    ['GET', '/news', ['App\Controllers\NewsController', 'getNewsByParameters']],
];
