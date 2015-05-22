<?php
namespace Modules\Frontend\Controllers;

use Entity\ApiKey;

class DevController extends BaseController
{
    public function preDispatch()
    {
        parent::preDispatch();

        $api_key = $this->getParam('key');
        if (!ApiKey::authenticate($api_key))
            die('ERROR: API key specified is not valid.');
    }

    public function importAction()
    {
        ini_set('memory_limit', '250M');
        ini_set('display_errors', 0);

        // Tables to export from local DB.
        $tables = array(
            'settings',
            'block',
            'affiliates',
            'rotators',
            'action',
            'role',
            'role_has_action',
            'station',
            'station_streams',
            'podcast',
            'podcast_on_station',
            'podcast_episodes',
            'songs',
            'convention',
            'convention_archives',
        );

        // Compose mysqldump command.
        $db_config = $this->config->db->toArray();

        $destination_path = DF_INCLUDE_TEMP.DIRECTORY_SEPARATOR.'pvl_import.sql';

        $command_flags = array(
            '-h '.$db_config['host'],
            '-u '.$db_config['user'],
            '-p'.$db_config['password'],
            '--no-create-info',
            '--skip-extended-insert',
            '--complete-insert',
            '--single-transaction',
            '--quick',
            $db_config['dbname'],
            implode(' ', $tables),
        );
        $command = 'mysqldump '.implode(' ', $command_flags).' > '.$destination_path;

        // Execute mysqldump.
        exec($command);

        // Stream file out to screen.
        if (file_exists($destination_path))
        {
            $fp = fopen($destination_path, 'r');

            header("Content-Type: application/octet-stream");
            header("Content-Length: " . filesize($destination_path));

            fpassthru($fp);
            fclose($fp);

            @unlink($destination_path);
        }
    }

    public function staticAction()
    {
        $directories = array(
            'affiliates',
            'artists',
            'podcasts',
            'rotators',
            'songs',
            'stations',
            'conventions',
        );

        $static_files = array();

        foreach($directories as $dir)
        {
            $dir_path = DF_INCLUDE_STATIC.DIRECTORY_SEPARATOR.$dir;
            $files_raw = @scandir($dir_path);

            foreach($files_raw as $file)
            {
                $path = $dir_path.DIRECTORY_SEPARATOR.$file;
                if (!is_dir($path))
                    $static_files[$dir][$file] = \PVL\Url::upload($dir.'/'.$file);
            }
        }

        return $this->returnSuccess($static_files);
    }
}