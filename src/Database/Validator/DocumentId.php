<?php

namespace Utopia\Database\Validator;

use Utopia\Database\Database;
use Utopia\Database\Document;
use Utopia\Validator;

class DocumentId extends Validator
{
    /**
     * @var string
     */
    protected $message = 'Document not found.';

    /**
     * @var Database
     */
    protected $database;

    /**
     * @var string
     */
    protected $collection = '';

    /**
     * Structure constructor.
     *
     * @param Database $database
     * @param string $collection
     */
    public function __construct(Database $database, string $collection = '')
    {
        $this->database = $database;
        $this->collection = $collection;
    }

    /**
     * Get Description.
     *
     * Returns validator description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->message;
    }

    /**
     * Is valid.
     *
     * Returns true if valid or false if not.
     *
     * @param $value
     *
     * @return bool
     */
    public function isValid($id): bool
    {
        $document = $this->database->getDocument($this->collection, $id);
        
        if (!$document->getId()) {
            return false;
        }

        if ($document->getCollection() !== $this->collection) {
            return false;
        }

        return true;
    }
    
    /**
     * Is array
     *
     * Function will return true if object is array.
     *
     * @return bool
     */
    public function isArray(): bool
    {
        return false;
    }

    /**
     * Get Type
     *
     * Returns validator type.
     *
     * @return string
     */
    public function getType(): string
    {
        return self::TYPE_STRING;
    }
}
