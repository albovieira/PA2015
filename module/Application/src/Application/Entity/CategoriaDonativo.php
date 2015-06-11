<?php
namespace Application\Entity;

use Components\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tb_categoria_donativo")
 */

class CategoriaDonativo extends AbstractEntity{
	/**
	 * @ORM\Id
	 * @ORM\Column(name="id_categoria",type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="desc_categoria",type="string")
	 */
	private $descricao;

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getDescricao()
	{
		return $this->descricao;
	}

	/**
	 * @param mixed $descricao
	 */
	public function setDescricao($descricao)
	{
		$this->descricao = $descricao;
	}

	public function getInputFilter(){}
}