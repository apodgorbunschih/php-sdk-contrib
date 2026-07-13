<?php

declare(strict_types=1);

namespace OpenFeature\Providers\Flagd\http;

use OpenFeature\interfaces\provider\Reason;

use function is_null;

class FlagdResponseValidator
{
    /**
     * @param mixed[] $response
     */
    public static function isTypeMismatch(?array $response): bool
    {
        return is_null($response);
    }

    /**
     * As of flagd v0.16, a disabled flag resolves successfully with reason=DISABLED
     * and no value/variant, rather than an error response.
     *
     * @param mixed[] $response
     */
    public static function isDisabled(?array $response): bool
    {
        return isset($response['reason']) && $response['reason'] === Reason::DISABLED;
    }

    /**
     * @param mixed[] $response
     */
    public static function isErrorResponse(?array $response): bool
    {
        return !isset($response['value']);
    }
}
