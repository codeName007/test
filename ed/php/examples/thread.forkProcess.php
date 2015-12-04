<?php

declare(ticks = 1);

$a = [
    'mail+0@gmail.com',
    'mail+1@gmail.com',
    'mail+2@gmail.com',
    'mail+3@gmail.com',
    'mail+4@gmail.com',
    'mail+5@gmail.com',
    'mail+6@gmail.com',
    'mail+7@gmail.com',
    'mail+8@gmail.com',
    'mail+9@gmail.com',
];

$max = 3;
$child = 0;

pcntl_signal(SIGCHLD, function ($signo) {
    global $child;
    if ($signo === SIGCLD) {
        while (($pid = pcntl_wait($signo, WNOHANG)) > 0) {
            $signal = pcntl_wexitstatus($signo);
            $child--;
        }
    }
});
foreach ($a as $item) {
    while ($child >= $max) {
        sleep(1);
    }
    $child++;
    $pid = pcntl_fork();
    if ($pid) {
    } else {
        // Child
        sleep(2);
        echo posix_getpid()." - $item \n";
        exit(0);
    }
}
while ($child != 0) {
    sleep(3);
}
