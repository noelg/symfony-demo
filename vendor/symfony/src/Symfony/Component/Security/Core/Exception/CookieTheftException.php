<?php

namespace Symfony\Component\Security\Core\Exception;

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This exception is thrown when the RememberMeServices implementation
 * detects that a presented cookie has already been used by someone else.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class CookieTheftException extends AuthenticationException
{
}