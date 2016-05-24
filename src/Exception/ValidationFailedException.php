<?php

namespace Hiccup\SuluBlogBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationFailedException extends \RuntimeException implements HttpExceptionInterface
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * List of validation errors.
     *
     * @var ConstraintViolationListInterface
     */
    private $validationErrors = [];

    #----------------------------------------------------------------------------------------------
    # Constructor
    #----------------------------------------------------------------------------------------------

    /**
     * @param ConstraintViolationListInterface $errors
     */
    public function __construct(ConstraintViolationListInterface $errors)
    {
        $message = $this->arrayToString($errors);

        parent::__construct($message);
        $this->validationErrors = $errors;
    }

    #----------------------------------------------------------------------------------------------
    # Public Methods
    #----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function getStatusCode()
    {
        return 400;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders()
    {
        return [];
    }

    #----------------------------------------------------------------------------------------------
    # Private Methods
    #----------------------------------------------------------------------------------------------

    /**
     * Array to string error message.
     *
     * @param ConstraintViolationInterface[]|ConstraintViolationListInterface $errors
     *
     * @return string
     */
    private function arrayToString(ConstraintViolationListInterface $errors)
    {
        if ($errors->count() === 0) {
            return '';
        }

        $message = array();
        foreach ($errors as $value) {
            $message[] = $this->toHumanReadable($value->getPropertyPath()).': '.$value->getMessage();
        }

        return implode(', ', $message);
    }

    /**
     * Convert camelCase into human readable format
     * example: "thisIsCamelCase" into "this is camel case"
     *
     * @param string $word
     * @return string
     */
    private function toHumanReadable($word)
    {
        return strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/', ' $1', $word));
    }
}
