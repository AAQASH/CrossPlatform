<?php
/**
 * file.class.php
 * 
 * @package Working with files and folders Class
 * @author Ionut - ionut_gerrard (at) yahoo.com
 * @copyright 2011
 * @version 2.0
 */

// reading constants
define("ARRAY_READ", 1);
define("FULL_READ", 2);

//writing constants
define("LINE_BY_LINE", 1);
define("SINGLE_LINE", 2);
define("ERASE", 1);
define("DONT_ERASE", 2);

class file
{
    
    /**
     * file::validate()
     * 
     * Ensure that the curent file or folder(s) already exists for processing.
     * eg: $f->validate('folder/folder2/folder3/file.txt'); // all folders will be created
     * 
     * @param string $filename
     * @param integer $chmood
     * @return 
     */
    public function validate($filename, $chmood = 0755)
    {
        if ( ! file_exists($filename))
        {
            if (substr_count($filename, '/') > 1)
            {
                $folders = explode('/', $filename);
                unset($folders[count($folders) - 1]);
                $path = '';
                foreach ($folders as $key => $dir)
                {
                    $path .= $dir . '/';
                    $this->make_dir($path, $chmood);
                }
            }
            if (substr_count($filename, '.') > 0)
            {
                $this->make_file($filename);
                return false;
            }
            else
            {
                $this->make_dir($filename, $chmood);
            }
        }
    }
    /**
     * file::read_file()
     * 
     * Read file in diferent methods.
     * eg: echo $f->read_file('animals.txt', FULL_READ);
     * eg2: foreach ($f->read_file('animals.txt', ARRAY_READ) AS $animal) { echo $animal.'<br/>'; }
     * 
     * @param mixed $filename
     * @param integer $mode
     * @return mixed
     */
    public function read_file($filename, $mode = 1)
    {
        if ( ! is_file($filename))
        {
            $error = "On file->read_file(mode, filename): Filename {$filename} doesnt exist on the server.";
            return trigger_error($error, E_USER_ERROR);
        }
        $this->last_file = $filename;
        switch ($mode)
        {
            case 1:
                {
                    $opened_file = fopen($filename, 'r');
                    $txt = array();
                    while ( ! feof($opened_file))
                    {
                        $buffer = fgets($opened_file, 4096);
                        if ($buffer)
                        {
                            $buffer = str_replace(PHP_EOL,'',$buffer);
                            $txt[] = $buffer;
                        }
                    }
                    fclose($opened_file);
                    return $txt;
                }
                break;
            /*case 2:
                return file($filename);
                break;*/
            case 2:
                return file_get_contents($filename);
                break;
            default:
                return file_get_contents($filename);
                break;
        }
    }
    /**
     * file::write_file()
     * 
     * Write content in a file.
     * 
     * eg: $f->write_file('Hi! How are you?', SINGLE_LINE, ERASE);
     * where param3 LINE_BY_LINE -> Go on a new line after the text is printed.
     *       param3 SINGLE_LINE -> all text will be printed on a single line
     *       param4 ERASE -> Will erase the curent file text before printing a new one.
     *       param4 DONT_ERASE -> PRINT TEXT after the curent one
     * 
     * @param mixed $text
     * @param mixed $filename
     * @param integer $mode
     * @param integer $act
     * @return
     */
    public function write_file($text, $filename, $mode = 1, $act = 1)
    {
        if ( ! $text)
            return;
        if ( ! is_file($filename))
        {
            $error = "On file->write_file(content, filename, mode, act): Filename {$filename} doesnt exist on the server.";
            return trigger_error($error, E_USER_ERROR);
        }
        if ($mode == 1)
            $text = $text . PHP_EOL;
        $act = ($act == 2) ? 'a+' : 'w+';
        $opened_file = fopen($filename, $act);
        fwrite($opened_file, $text);
        fclose($opened_file);
    }
    /**
     * file::change_rights()
     * 
     * @param mixed $filename
     * @param integer $permission
     * @return
     */
    public function change_rights($filename, $permission = 0750)
    {
        if ( ! is_file($filename))
        {
            $error = "On file::change_rights(filename, permission): Filename {$filename} doesnt exist on the server.";
            return trigger_error($error, E_USER_ERROR);
        }
        if (strlen($permision) < 4)
        {
            $error = "On file::change_rights(filename, permission): Permission {$permission} is invalid. (0*** FORMAT)";
            return trigger_error($error, E_USER_ERROR);
        }
        chmod($filename, $permission);
    }
    /**
     * file::move_file()
     * 
     * @param mixed $filename
     * @param mixed $folder
     * @return
     */
    public function move_file($filename, $folder)
    {
        if ( ! is_file($filename))
        {
            $error = "On file::move_file(filename, folder): Filename {$filename} doesnt exist on the server.";
            return trigger_error($error, E_USER_ERROR);
        }

        if ($folder[strlen($folder) - 1] != '/')
            $folder .= '/';

        $this->validate($folder);
        $file = $filename;
        if (substr_count($filename, '/') > 0)
        {
            $file_parts = explode('/', $filename);
            $file = $file_parts[count($file_parts) - 1];
        }
        copy($filename, $folder . '/' . $file);
        unlink($filename);
    }
	
	
	function get_dirs($dir, $recursive=0){
		global $dirs;
		if (!isset($dirs)){$dirs = '';}
		if(substr($dir,-1) !== DIRECTORY_SEPARATOR){$dir .= DIRECTORY_SEPARATOR;}
		if ($handle = opendir($dir)){
			while (false !== ($file = readdir($handle))){
				if (filetype($dir.$file) === 'dir' && $file != "." && $file != ".."){
					clearstatcache();
					$dirs .= $file . "\n";
					if($is_recursive == 1){
						self::get_dirs($dir . $file);
					}
				}
			}
			closedir($handle);
		}
		return $dirs;
	}
	
	
    /*
    public function clone_file($newfile,$fileid = -1) 
    { 
    Maybe will be avalaible in the next version.
    } */
    /**
     * file::dir_tree()
     * 
     * @param mixed $dirname
     * @param integer $filesno
     * @return array
     */
    public function dir_tree($dirname, &$filesno = 0)
    {
        $path = array();
        $stack = array();
        $stack[] = $dirname;
        while ($stack)
        {
            $thisdir = array_pop($stack);
            if ($dircont = scandir($thisdir))
            {
                $i = 0;
                while (isset($dircont[$i]))
                {
                    if ($dircont[$i] !== '.' && $dircont[$i] !== '..')
                    {
                        $current_file = "{$thisdir}/{$dircont[$i]}";
                        if (is_file($current_file))
                        {
                            $path[] = "{$thisdir}/{$dircont[$i]}";
                        } elseif (is_dir($current_file))
                        {
                            $stack[] = $current_file;
                        }
                    }
                    $i++;
                }
            }
        }
        $filesno = count($path);
        return $path;
    }
    /**
     * file::rename_file()
     * 
     * @param mixed $filename
     * @param mixed $newfilename
     * @return
     */
    public function rename_file($filename, $newfilename)
    {
        if ( ! is_file($filename))
        {
            $error = "On file::rename_file(filename, newfilename): Filename {$filename} doesnt exist on the server.";
            return trigger_error($error, E_USER_ERROR);
        }
        if ( ! $newfilename || is_file($newfilename))
        {
            $error = "On file::move_file(filename, newfilename): Newfilename {$newfilename} must be defined or already exists on server.";
            return trigger_error($error, E_USER_ERROR);
        }
        copy($filename, $newfilename);
        unlink($filename);
    }
    /**
     * file::delete_file()
     * 
     * @param mixed $filename
     * @return
     */
    public function delete_file($filename)
    {
        if ( ! is_file($filename))
        {
            $error = "On file::delete_file(filename, newfilename): Filename {$filename} doesnt exist on the server.";
            return trigger_error($error, E_USER_ERROR);
        }
        unlink($filename);
    }
    /**
     * file::delete_dir()
     * 
     * @param mixed $dirname
     * @return
     */
    public function delete_dir($dirname)
    {
        $files = glob($dirname . '*', GLOB_MARK);
        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);
            if (substr($file, -1) == '/')
                $this->delete_dir($file);
            else
                unlink($file);
        }
        if (is_dir($dirname))
            rmdir($dirname);
    }
    /**
     * file::make_file()
     * 
     * @param mixed $filename
     * @return bool
     */
    public function make_file($filename)
    {
        if ( ! is_file($filename))
        {
            $file = fopen($filename, 'w');
            fclose($file);
            return true;
        }
        return false;
    }
    /**
     * file::make_dir()
     * 
     * @param mixed $dirname
     * @param integer $perm
     * @return bool
     */
    public function make_dir($dirname, $perm = 0755)
    {
        if ( ! is_dir($dirname))
        {
            mkdir($dirname, $perm);
            return true;
        }
        return false;
    }
}

?>