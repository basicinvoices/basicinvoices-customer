<?php
namespace BasicInvoices\Customer\Hydrator\Exception;

use BasicInvoices\Customer\Exception;

/**
 * Bad method call exception
 */
class BadMethodCallException extends Exception\BadMethodCallException implements ExceptionInterface
{
}
