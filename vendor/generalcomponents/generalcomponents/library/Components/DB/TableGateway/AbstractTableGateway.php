<?php

namespace Components\DB\TableGateway;

use Components\Model\AbstractModel;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;

abstract class AbstractTableGateway {
    protected $primaryKey;
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll(){
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    //faz um select de acordo com a chave passada
    public function get($key){
        $key = (int) $key;
        $rowset = $this->tableGateway->select(array(
            $this->primaryKey => $key
        ));

        $row = $rowset->current();
        return $row;
    }

    //salva os dados
    public function save(AbstractModel $model){
        $primaryKey = $this->primaryKey;
        $key = $model->$primaryKey;
        $data = $this->getData($model);

        if (!$this->get($key))
        {
            $this->tableGateway->insert($data);
        }
        else
        {
            var_dump($data);
            $this->tableGateway->update($data, array( $this->primaryKey => $key));
        }
    }

    abstract protected function getData(AbstractModel $model);


    //deleta os dados
    public function delete($key){
        var_dump($key);
        $this->tableGateway->delete(array($this->primaryKey => $key));
    }

    public function getSql(){
        return $this->tableGateway->getSql();
    }

    public function getSelect()
    {
        $select = new Select($this->tableGateway->getTable());
        return $select;
    }
}