<?php 
namespace App\Handlers;
use Unisharp\Laravelfilemanager\Handlers\ConfigHandler;

class ConfigFileManagerHandler extends ConfigHandler{
	public function userField()
    {
        return auth('admin')->user()->id;
    }
}