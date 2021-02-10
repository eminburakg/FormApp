<?php


class TodoList {

    private $todolistName;
    private $myTodoList;
    private $db;

    // init
    public function __construct(string $todoListName)
    {
        $this->todolistName = $todoListName;

        $conf = new DbConfig($todoListName);
        $this->db = $conf->getDbFile();//$this->dbPath . $this->dbFile . '.json';
    }

    public function getTodos() : array {
        $this->myTodoList = json_decode(file_get_contents($this->db));
        return $this->myTodoList;
    }

    // create todolist
    private function create(){

    }

    // add
    public function add(){
        $task = $_POST['mytodo'];
        if (!empty($task)){
            $this->myTodoList[] = $task;
            $this->save();
        }
    }

    // delete
    public function delete(int $id){
        $id--;
        unset($this->myTodoList[$id]);
        $this->myTodoList = array_values( $this->myTodoList );
        $this->save();
    }
    // update
    public function update(){
        $task = $_POST['mytodo'];
        $indis=$_POST['indis'];
        if (!empty($task)){
            $this->myTodoList[$indis-1] = $task;
            $this->save();
        }
        /*$id--;
        $this->myTodoList[$id];
        $this->myTodoList = array_values( $this->myTodoList );
        $this->save();*/

    }
    // status change
    public function statusChange(){

    }

    // save file
    public function save(){
        file_put_contents($this->db, json_encode($this->myTodoList));
        header('location:index.php');
    }

}
