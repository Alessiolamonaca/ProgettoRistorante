<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Artisan::command('browser:open {url=http://127.0.0.1:8000/it} {--browser=chrome} {--delay=0} {--wait=0} {--background}', function () {
    $url = str_replace('"', '', (string) $this->argument('url'));
    $browser = strtolower((string) $this->option('browser'));
    $delay = max(0, (int) $this->option('delay'));
    $wait = max(0, (int) $this->option('wait'));

    $browser = in_array($browser, ['edge', 'msedge', 'chrome', 'default'], true)
        ? $browser
        : 'chrome';

    if ($this->option('background')) {
        $php = str_replace('"', '', PHP_BINARY);
        $artisan = str_replace('"', '', base_path('artisan'));

        if (PHP_OS_FAMILY === 'Windows') {
            $command = sprintf(
                'start "" /B "%s" "%s" browser:open "%s" --browser=%s --delay=%d --wait=%d',
                $php,
                $artisan,
                $url,
                $browser,
                $delay,
                $wait
            );

            pclose(popen($command, 'r'));
        } else {
            $command = sprintf(
                '"%s" "%s" browser:open "%s" --browser=%s --delay=%d --wait=%d > /dev/null 2>&1 &',
                $php,
                $artisan,
                addslashes($url),
                $browser,
                $delay,
                $wait
            );

            exec($command);
        }

        $this->info('Apertura browser esterno programmata: '.$url);

        return 0;
    }

    if ($delay > 0) {
        sleep($delay);
    }

    if ($wait > 0) {
        $deadline = time() + $wait;

        while (time() <= $deadline) {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 1,
                    'ignore_errors' => true,
                ],
            ]);

            $handle = @fopen($url, 'r', false, $context);

            if (is_resource($handle)) {
                fclose($handle);
                break;
            }

            sleep(1);
        }
    }

    if (PHP_OS_FAMILY === 'Windows') {
        $command = match ($browser) {
            'chrome' => sprintf('start "" chrome "%s"', $url),
            'edge', 'msedge' => sprintf('start "" msedge "%s"', $url),
            default => sprintf('start "" "%s"', $url),
        };

        pclose(popen($command, 'r'));
    } elseif (PHP_OS_FAMILY === 'Darwin') {
        $command = match ($browser) {
            'chrome' => sprintf('open -a "Google Chrome" "%s"', addslashes($url)),
            'edge', 'msedge' => sprintf('open -a "Microsoft Edge" "%s"', addslashes($url)),
            default => sprintf('open "%s"', addslashes($url)),
        };

        exec($command);
    } else {
        exec(sprintf('xdg-open "%s" > /dev/null 2>&1 &', addslashes($url)));
    }

    $this->info('Browser esterno aperto: '.$url);

    return 0;
})->purpose('Open the local site in an external browser.');
