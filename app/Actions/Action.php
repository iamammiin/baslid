<?php

namespace App\Actions;

class Action
{
    protected function toDBUsageField(array $fields): array
    {
        $result = [];

        foreach ($fields as $key => $value) {
            $result[$this->toLowerCase($key)] = $value;
        }

        return $result;
    }

    protected function toAPIUsageField(array $fields): array
    {
        $result = [];

        foreach ($fields as $key => $value) {
            if (is_array($value)) {
                $result[$this->toCamelCase($key)] = $this->toAPIUsageField($value);
            } else {
                $result[$this->toCamelCase($key)] = $value;
            }
        }

        return $result;
    }

    private function toLowerCase(string $string): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }

    private function toCamelCase(string $string): string
    {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

        $str[0] = strtolower($str[0]);

        return $str;
    }
}
