<?php

namespace App\Http\Controllers\Voyager;

use Artisan;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\LogViewer;
use TCG\Voyager\Http\Controllers\VoyagerCompassController as BaseVoyagerCompassController;

class VoyagerCompassController extends BaseVoyagerCompassController
{

    protected $request;

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        set_time_limit(500);
        // Check permission
        //Voyager::canOrFail('browse_compass');

        $message = '';
        $active_tab = '';

        if ($this->request->input('log')) {
            $active_tab = 'logs';
            LogViewer::setFile(base64_decode($this->request->input('log')));
        }

        if ($this->request->input('logs')) {
            $active_tab = 'logs';
        }

        if ($this->request->input('download')) {
            $active_tab = 'logs';

            return $this->download(LogViewer::pathToLogFile(base64_decode($this->request->input('download'))));
        } elseif ($this->request->has('del')) {
            $active_tab = 'logs';
            app('files')->delete(LogViewer::pathToLogFile(base64_decode($this->request->input('del'))));

            return $this->redirect($this->request->url().'?logs=true')->with([
                'message'    => 'Successfully deleted log file: '.base64_decode($this->request->input('del')),
                'alert-type' => 'success',
            ]);
        } elseif ($this->request->has('delall')) {
            $active_tab = 'logs';
            foreach (LogViewer::getFiles(true) as $file) {
                app('files')->delete(LogViewer::pathToLogFile($file));
            }

            return $this->redirect($this->request->url().'?logs=true')->with([
                'message'    => 'Successfully deleted all log files',
                'alert-type' => 'success',
            ]);
        }

        $artisan_output = '';

        if ($request->isMethod('post')) {
            $command = $request->command;
            $args = $request->args;
            $args = (isset($args)) ? ' '.$args : '';

            try {
                $process = new Process('cd '.base_path().' && php artisan '.$command.$args);
                //TODO: VERIFY how to add to add no update it
                $process->setEnv(['PATH'=>'/opt/plesk/php/7.1/bin:/opt/plesk/node/8/bin:/usr/local/bin:/usr/bin:/usr/local/sbin:/usr/sbin']);
                $process->run();

                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }

                $artisan_output = $process->getOutput();

                //$artisan_output = exec('cd ' . base_path() . ' && php artisan ' . $command . $args);
                // Artisan::call($command . $args);
                // $artisan_output = Artisan::output();
            } catch (Exception $e) {
                $artisan_output = $e->getMessage();
            }
            $active_tab = 'commands';
        }

        $logs = LogViewer::all();
        $files = LogViewer::getFiles(true);
        $current_file = LogViewer::getFileName();

        // get the full list of artisan commands and store the output
        $commands = $this->getArtisanCommands();

        return view('voyager::compass.index', compact('logs', 'files', 'current_file', 'active_tab', 'commands', 'artisan_output'))->with($message);
    }

    private function getArtisanCommands()
    {
        Artisan::call('list');

        // Get the output from the previous command
        $artisan_output = Artisan::output();
        $artisan_output = $this->cleanArtisanOutput($artisan_output);
        $commands = $this->getCommandsFromOutput($artisan_output);

        return $commands;
    }

    private function cleanArtisanOutput($output)
    {

        // Add each new line to an array item and strip out any empty items
        $output = array_filter(explode("\n", $output));

        // Get the current index of: "Available commands:"
        $index = array_search('Available commands:', $output);

        // Remove all commands that precede "Available commands:", and remove that
        // Element itself -1 for offset zero and -1 for the previous index (equals -2)
        $output = array_slice($output, $index - 2, count($output));

        return $output;
    }

    private function getCommandsFromOutput($output)
    {
        $commands = [];

        foreach ($output as $output_line) {
            if (empty(trim(substr($output_line, 0, 2)))) {
                $parts = preg_split('/  +/', trim($output_line));
                $command = (object) ['name' => trim(@$parts[0]), 'description' => trim(@$parts[1])];
                array_push($commands, $command);
            }
        }

        return $commands;
    }

    private function redirect($to)
    {
        if (function_exists('redirect')) {
            return redirect($to);
        }

        return app('redirect')->to($to);
    }

    private function download($data)
    {
        if (function_exists('response')) {
            return response()->download($data);
        }

        // For laravel 4.2
        return app('\Illuminate\Support\Facades\Response')->download($data);
    }
}
