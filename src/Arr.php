<?php

namespace PainlessPHP\Array;

use PainlessPHP\Array\Internal\StringHelpers;

class Arr
{
    public static function map(array $array, callable $mapper) : array
    {
        return array_map($mapper, $array);
    }

	public static function mapKeys(array $array, callable $mapper) : array
	{
        return array_combine(
            keys: array_map($mapper, array_keys($array)),
            values: array_values($array)
        );
	}

	public static function mapKeysAndValues(array $array, callable $mapper) : array
	{
        $result = [];
        foreach($array as $key => $value) {
            $result = array_merge($result, $mapper($key, $value));
        }
        return $result;
	}

    /**
     * Get all the nested values at the specified path.
     *
     * @param array $array
     * @param string $path The path to access nested values. Levels are separated by the dot (.) character.
     * Wildcard (*) can be used to collect all values of a nested array.
     * @return array $array Nested values
     *
     */
	public static function getAllNestedValues(array $array, string $path) : array
	{
		return static::mapAllNestedvalues($array, $path, fn($value, $key) => [$key => $value]);
	}

    /**
     * Get all the nested values at the specified path and apply a given mapper function to them.
     *
     * @param array $array
     * @param string $path The path to access nested values. Levels are separated by the dot (.) character.
     * Wildcard (*) can be used to collect all values of a nested array.
     * @return array $array Nested values
     *
     */
	public static function mapAllNestedValues(array $array, string $path, callable $mapper) : array
	{
		return static::mapAllNestedInternal($array, $path, $path, $mapper);
	}

    /**
     * @internal
     */
	private static function mapAllNestedInternal(array $array, string $path, string $pathLeft, callable $cb)
	{
		$parts = explode('.', $pathLeft);
		$currentAccessor = array_splice($parts, 0, 1)[0];
		$nextPath = implode('.', $parts);

		if($currentAccessor === '*') {
			$result = self::mapKeysAndValues($array, function($data, $key) use($path, $nextPath, $cb) {
				$key = StringHelpers::replaceFirst($path, '*', $key);
				return [$key => static::mapAllNestedInternal($data, $key, $nextPath, $cb)];
			});

			$test = [];
			foreach($result as $row) {
				foreach($row as $key => $value) {
					$test[$key] = $value;
				}
			}
			return $test;
		}

		$result = $array[$currentAccessor] ?? [];

		if(! empty($nextPath)) {
			return static::mapAllNestedInternal($result, $path, $nextPath, $cb);
		}

		return $cb($result, $path);
	}
}
