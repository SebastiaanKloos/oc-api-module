<?php namespace Api\Schema\Directives;

use BackendAuth;
use Illuminate\Contracts\Auth\Authenticatable;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Nuwave\Lighthouse\Support\Contracts\FieldResolver;
use Nuwave\Lighthouse\Support\Contracts\DefinedDirective;

class AuthDirective extends BaseDirective implements DefinedDirective, FieldResolver
{
    /**
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $authFactory;

    /**
     * AuthDirective constructor.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Name of the directive.
     *
     * @return string
     */
    public function name(): string
    {
        return 'auth';
    }

    public static function definition(): string
    {
        return /* @lang GraphQL */ <<<'SDL'
"""
Return the currently authenticated user as the result of a query.
"""
directive @auth(
  """
  Use a particular guard to retreive the user.
  """
  guard: String
) on FIELD_DEFINITION
SDL;
    }

    /**
     * Resolve the field directive.
     *
     * @param  \Nuwave\Lighthouse\Schema\Values\FieldValue  $fieldValue
     * @return \Nuwave\Lighthouse\Schema\Values\FieldValue
     */
    public function resolveField(FieldValue $fieldValue): FieldValue
    {
        return $fieldValue->setResolver(
            function () {
                return BackendAuth::getUser();
            }
        );
    }
}
