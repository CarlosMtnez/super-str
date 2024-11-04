# SuperStr Documentation

## 🚀 SuperStr: Simple, Flexible String Manipulation for PHP 💥

SuperStr is a simple yet powerful PHP library designed to make string manipulation easy and fun. 😎 It provides a set of simple methods that can be chained together to keep your code clean, with a short syntax.  🌟

Some key features include:
- **Chaining Methods**: Combine methods POO, short and clean syntax.
- **Helper Functions and Static Methods**: Use it the way you prefer, whether through a helper function, static class, or as an instance.
- **Multilingual Support**: Multibyte UTF-8 support, handles special characters and accents. 🌍

Start using SuperStr very easy with composer. 🌬️

## Installation

To install the SuperStr library using Composer, run the following command:

```bash
composer require konexia/super-str
```

## Usage

SuperStr can be used in three different ways:

1. **Using the Helper Function**: `super_str(string $value)`
2. **Using the Static Class**: `SuperStr::set(string $value)`
3. **Using an Instance of SuperStr**: `SuperStr->getInstance(?string $value)`

### Examples of Usages

```php
//1.Function
echo super_str('hello')->toUpper()->append(' WORLD')->get();
// Outputs: HELLO WORLD

//2.Static Class
echo SuperStr::set('hello')->toUpper()->append(' WORLD')->get();
// Outputs: HELLO WORLD

//3.Instance
$myStr = SuperStr->getInstance('hello');
echo $myStr->toUpper()->append(' WORLD')->get();
// Outputs: HELLO WORLD
```

## Methods and Examples

### `slugify(?int $length = null): self`
Converts the string into a URL-friendly slug. Optionally, you can limit the length of the slug.

**Example:**

```php
echo super_str('Hello World!')->slugify()->get();
// Outputs: hello-world
```

**Example with length limit:**

```php
echo super_str('Hello Beautiful World!')->slugify(10)->get();
// Outputs: hello-beau
```

### `prepend(string $prefix): self`
Adds a prefix to the string.

**Example:**

```php
echo super_str('world')->prepend('hello ')->get(); 
// Outputs: hello world
```

### `append(string $suffix): self`
Adds a suffix to the string.

**Example:**

```php
echo super_str('hello')->append(' world')->get(); 
// Outputs: hello world
```

### `toUpper(): self`
Converts the string to uppercase.

**Example:**

```php
echo super_str('hello world')->toUpper()->get(); 
// Outputs: HELLO WORLD
```

### `toLower(): self`
Converts the string to lowercase.

**Example:**

```php
echo super_str('HELLO WORLD')->toLower()->get(); 
// Outputs: hello world
```

### `capitalize(): self`
Capitalizes the first character of the string.

**Example:**

```php
echo super_str('hELLO wORLD')->capitalize()->get(); 
// Outputs: Hello world
```

### `extractBetween(?string $start, ?string $end): ?string`
Extracts a substring between a start and an optional end string.

**Example:**

```php
echo super_str('Hello [world]!')->extractBetween('[', ']'); 
// Outputs: world
```

### `do(callable $callback): self`
Applies a custom function to the string value.

**Example:**

```php
echo super_str('hello')->do( function($value) {
        return strtoupper($value);
    })->get(); 
// Outputs: HELLO
```

### `replace(string $search, string $replace, bool $caseSensitive = true): self`
Replaces occurrences of a substring with another string. Supports case sensitivity.

**Example (Case Sensitive):**

```php
echo super_str('Hello World')->replace('World', 'PHP')->get(); 
// Outputs: Hello PHP
```

**Example (Case Insensitive):**

```php
echo super_str('Hello World')->replace('world', 'PHP', false)->get(); 
// Outputs: Hello PHP
```

### `contains(string $substring): self`
Checks if the string contains a given substring. If not found, skips further chaining.

**Example:**

```php
echo super_str('Hello World')->contains('World')->toUpper()->get(); 
// Outputs: HELLO WORLD
```

### `notContains(string $substring): self`
Checks if the string does not contain a given substring. If found, skips further chaining.

**Example:**

```php
echo super_str('Hello World')->notContains('PHP')->toUpper()->get(); 
// Outputs: HELLO WORLD
```

### `if(callable $callback): self`
Conditionally continues chaining if the given callback returns `true`.

**Example (Condition True):**

```php
echo super_str('Hello')->if( function($value) {
    return $value === 'Hello';
})->append(' World')->get(); 
// Outputs: Hello World
```

**Example (Condition False):**

```php
echo super_str('Hello')->if( function($value) {
    return $value === 'Goodbye';
})->append(' World')->get(); 
// Outputs: Hello
```

### `trim(): self`
Trims whitespace from both ends of the string.

**Example:**

```php
echo super_str('  Hello World  ')->trim()->get();
// Outputs: Hello World
```

### `ltrim(): self`
Trims whitespace from the beginning of the string.

**Example:**

```php
echo super_str('  Hello World')->ltrim()->get();
// Outputs: Hello World
```

### `rtrim(): self`
Trims whitespace from the end of the string.

**Example:**

```php
echo super_str('Hello World  ')->rtrim()->get();
// Outputs: Hello World
```

### `length(): int`
Gets the length of the current string.

**Example:**

```php
echo super_str('Hello World')->length();
// Outputs: 11
```

## Running Tests

To run the tests for this library, use the following command:

```bash
vendor/bin/phpunit tests
```

## Credits

- **Author**: Carlos Martínez <carlos@mtnez.com>
- **Konexia**

## License

This project is licensed under the MIT License.

