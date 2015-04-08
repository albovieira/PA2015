<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 17/02/2015
 * Time: 14:37
 */

namespace Application\Model;

use Components\Entity\AbstractEntity;
use Components\Service\Authentication;
use Doctrine\ORM\Mapping as ORM;
//use Zend\Authentication\Adapter\DbTable;
use Zend\Authentication\AuthenticationService;

use Components\InputFilter\InputFilter;
use Zend\Validator\Between;
use Zend\Filter\Int;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Validator\StringLength;
use Components\Authentication\Adapter\DoctrineTable;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuarios")
 *
 */

class Usuario extends AbstractEntity
{
    /** @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    public $id;
    /** @ORM\Column(type="string") **/
    public $login;
    /** @ORM\Column(type="string") **/
    public $senha;

    /** @var @ORM\Column(type="string") */
    public $nome;

    /** @ORM\Column(type="string") **/
    public $email;

    /** @ORM\Column(type="integer") **/
    public $perfil;

    /** @ORM\Column(type="integer") **/
    public $status;



    public $messages = array();

    public function __construct($login,$senha,$nome = null, $id = null)
    {
        $this->id = $id;
        $this->login = $login;
        $this->senha = $senha;
        $this->nome = $nome;
    }

    public function getPerfilUsuario($login){
        $adapter = new DoctrineTable($GLOBALS['entityManager']);
        $adapter->setEntityName(__CLASS__);
        return $adapter->getPerfilUsuario($login);
    }

    public function authenticate()
    {

        // cria o adaptador para o mecanismo contra o qual se fará a autenticação
        $adapter = new DoctrineTable($GLOBALS['entityManager']);
        $adapter->setIdentityColumn('login')
            ->setEntityName(__CLASS__)
            ->setCredentialColumn('senha')
            ->setIdentity($this->login)
            ->setCredential($this->senha)
        ;

        // cria o serviço de autenticação e injeta o adaptador nele
        $authentication = new AuthenticationService();
        $authentication->setAdapter($adapter);

        // autentica
        $result = $authentication->authenticate();


        if ($result->isValid())
        {
            // recupera o registro do usuário como um objeto, sem o campo senha
            $usuario = $authentication->getAdapter()->getResultRowObject(null,'senha');
            $authentication->getStorage()->write($usuario);
            return true;
        }
        else
        {
            $this->messages = $result->getMessages();
            return false;
        }
    }


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
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPerfil()
    {
        return $this->perfil;
    }

    /**
     * @param mixed $perfil
     */
    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $inputFilter->addFilter('id', new Int());
            $inputFilter->addValidator('id', new Between(array(
                        'min'      => 0,
                        'max'      => 3600
                    )
                )
            );

            $inputFilter->addFilter('login', new StripTags());
            $inputFilter->addFilter('login', new StringTrim());
            $inputFilter->addValidator('login', new StringLength(array(
                        'encoding' => 'UTF-8',
                        'min'      => 2,
                        'max'      => 30,
                    )
                )
            );

            $inputFilter->addFilter('senha', new StripTags());
            $inputFilter->addFilter('senha', new StringTrim());
            $inputFilter->addValidator('senha', new StringLength(array(
                        'encoding' => 'UTF-8',
                        'min'      => 2,
                        'max'      => 30,
                    )
                )
            );


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function getArrayCopy(){
        return get_object_vars($this);
    }
}