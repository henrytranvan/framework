<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace Spiral\Models;

/**
 * Entity which code follows external behaviour schema.
 */
class SchematicEntity extends AbstractEntity
{
    /** @var array */
    private $schema = [];

    /**
     * @param array $data
     * @param array $schema
     */
    public function __construct(array $data, array $schema)
    {
        $this->schema = $schema;
        parent::__construct($data);
    }

    /**
     * {@inheritdoc}
     */
    protected function isFillable(string $field): bool
    {
        if (!empty($this->schema[ModelSchema::FILLABLE]) && $this->schema[ModelSchema::FILLABLE] === '*') {
            return true;
        }

        if (!empty($this->schema[ModelSchema::FILLABLE])) {
            return in_array($field, $this->schema[ModelSchema::FILLABLE]);
        }

        if (!empty($this->schema[ModelSchema::SECURED]) && $this->schema[ModelSchema::SECURED] === '*') {
            return false;
        }

        return !in_array($field, $this->schema[ModelSchema::SECURED]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getMutator(string $field, string $mutator)
    {
        if (isset($this->schema[ModelSchema::MUTATORS][$mutator][$field])) {
            return $this->schema[ModelSchema::MUTATORS][$mutator][$field];
        }

        return null;
    }
}
