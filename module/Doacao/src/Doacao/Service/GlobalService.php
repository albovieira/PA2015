<?php 
namespace Doacao\Service;

class GlobalService{
	/**
	 * Esta função é responsável por retornar um array de um determinado objeto
	 * @param mixed $objectArray
	 * @param String $association
	 * @return multitype:
	 */
	protected function decompoeObjeto($objectArray, $association){
		$associationArray = array();
		foreach($objectArray->__get($association) as $decomposte):
			array_push($associationArray,$decomposte);
		endforeach;
		return $associationArray;
	}
}

?>
