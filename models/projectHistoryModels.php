<?php
require_once __DIR__ . '/../config/database.php';

use Illuminate\Database\Eloquent\Model;



class ProjectHistoryModel extends Model
{

    protected $table = 'project_history';
    
}