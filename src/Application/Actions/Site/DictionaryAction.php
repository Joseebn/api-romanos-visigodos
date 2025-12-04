<?php

namespace App\Application\Actions\Site;

class DictionaryAction
{
    protected $dictionary = [];

    public function __construct()
    {
        // Initialize the dictionary with some default values
        $this->dictionary = [
            'hello' => 'A greeting or expression of goodwill.',
            'world' => 'The earth, together with all of its countries and peoples.',
            'php' => 'A popular general-purpose scripting language that is especially suited to web development.'
        ];
    }

    public function addEntry($word, $definition)
    {
        $this->dictionary[$word] = $definition;
    }

    public function getDefinition($word)
    {
        return isset($this->dictionary[$word]) ? $this->dictionary[$word] : null;
    }

    public function removeEntry($word)
    {
        if (isset($this->dictionary[$word])) {
            unset($this->dictionary[$word]);
        }
    }

    public function getAllEntries()
    {
        return $this->dictionary;
    }
}