<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 23/05/2015
 * Time: 09:51
 */
namespace Application\Filter;

use Zend\InputFilter\InputFilterInterface;

class GenericFilter implements InputFilterInterface{
    function __construct()
    {
        // TODO: Implement __construct() method.
    }

    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.
    }

    static function __set_state($an_array)
    {
        // TODO: Implement __set_state() method.
    }

    /**
     * Add an input to the input filter
     *
     * @param  \Zend\InputFilter\InputInterface|InputFilterInterface|array $input
     * @param  null|string $name Name used to retrieve this input
     * @return InputFilterInterface
     */
    public function add($input, $name = null)
    {
        // TODO: Implement add() method.
    }

    /**
     * Retrieve a named input
     *
     * @param  string $name
     * @return \Zend\InputFilter\InputInterface|InputFilterInterface
     */
    public function get($name)
    {
        // TODO: Implement get() method.
    }

    /**
     * Test if an input or input filter by the given name is attached
     *
     * @param  string $name
     * @return bool
     */
    public function has($name)
    {
        // TODO: Implement has() method.
    }

    /**
     * Remove a named input
     *
     * @param  string $name
     * @return InputFilterInterface
     */
    public function remove($name)
    {
        // TODO: Implement remove() method.
    }

    /**
     * Set data to use when validating and filtering
     *
     * @param  array|Traversable $data
     * @return InputFilterInterface
     */
    public function setData($data)
    {
        // TODO: Implement setData() method.
    }

    /**
     * Is the data set valid?
     *
     * @return bool
     */
    public function isValid()
    {
        // TODO: Implement isValid() method.
    }

    /**
     * Provide a list of one or more elements indicating the complete set to validate
     *
     * When provided, calls to {@link isValid()} will only validate the provided set.
     *
     * If the initial value is {@link VALIDATE_ALL}, the current validation group, if
     * any, should be cleared.
     *
     * Implementations should allow passing a single array value, or multiple arguments,
     * each specifying a single input.
     *
     * @param  mixed $name
     * @return InputFilterInterface
     */
    public function setValidationGroup($name)
    {
        // TODO: Implement setValidationGroup() method.
    }

    /**
     * Return a list of inputs that were invalid.
     *
     * Implementations should return an associative array of name/input pairs
     * that failed validation.
     *
     * @return \Zend\InputFilter\InputInterface[]
     */
    public function getInvalidInput()
    {
        // TODO: Implement getInvalidInput() method.
    }

    /**
     * Return a list of inputs that were valid.
     *
     * Implementations should return an associative array of name/input pairs
     * that passed validation.
     *
     * @return \Zend\InputFilter\InputInterface[]
     */
    public function getValidInput()
    {
        // TODO: Implement getValidInput() method.
    }

    /**
     * Retrieve a value from a named input
     *
     * @param  string $name
     * @return mixed
     */
    public function getValue($name)
    {
        // TODO: Implement getValue() method.
    }

    /**
     * Return a list of filtered values
     *
     * List should be an associative array, with the values filtered. If
     * validation failed, this should raise an exception.
     *
     * @return array
     */
    public function getValues()
    {
        // TODO: Implement getValues() method.
    }

    /**
     * Retrieve a raw (unfiltered) value from a named input
     *
     * @param  string $name
     * @return mixed
     */
    public function getRawValue($name)
    {
        // TODO: Implement getRawValue() method.
    }

    /**
     * Return a list of unfiltered values
     *
     * List should be an associative array of named input/value pairs,
     * with the values unfiltered.
     *
     * @return array
     */
    public function getRawValues()
    {
        // TODO: Implement getRawValues() method.
    }

    /**
     * Return a list of validation failure messages
     *
     * Should return an associative array of named input/message list pairs.
     * Pairs should only be returned for inputs that failed validation.
     *
     * @return array
     */
    public function getMessages()
    {
        // TODO: Implement getMessages() method.
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        // TODO: Implement count() method.
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
    }

    function __get($name)
    {
        // TODO: Implement __get() method.
    }

    function __set($name, $value)
    {
        // TODO: Implement __set() method.
    }

    function __isset($name)
    {
        // TODO: Implement __isset() method.
    }

    function __unset($name)
    {
        // TODO: Implement __unset() method.
    }

    function __sleep()
    {
        // TODO: Implement __sleep() method.
    }

    function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
    }

    function __invoke()
    {
        // TODO: Implement __invoke() method.
    }

    function __clone()
    {
        // TODO: Implement __clone() method.
    }

}