<?php

namespace Konexia\SuperStr;

class SuperStrCore
{
    protected string $value;
    protected bool $skipChaining = false;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Add a prefix to the string.
     *
     * @param string $prefix The prefix to add to the string
     *
     * @return $this
     */
    public function prepend(string $prefix): self
    {
        if ($this->skipChaining) {
            return $this;
        }
        $this->value = $prefix . $this->value;
        return $this; 
    }

    /**
     * Add a suffix to the string.
     *
     * @param string $suffix The suffix to add to the string
     *
     * @return $this
     */
    public function append(string $suffix): self
    {
        if ($this->skipChaining) {
            return $this;
        }
        $this->value .= $suffix;
        return $this; 
    }

    /**
     * Convert the current value to uppercase.
     *
     * @return $this
     */
    public function toUpper(): self
    {
        if ($this->skipChaining) {
            return $this;
        }
        $this->value = strtoupper($this->value);
        return $this; 
    }

    /**
     * Convert the current value to lowercase.
     *
     * @return $this
     */
    public function toLower(): self
    {
        if ($this->skipChaining) {
            return $this;
        }
        $this->value = strtolower($this->value);
        return $this; 
    }

    /**
     * Capitalize the first character of the current value.
     *
     * @return $this
     */
    public function capitalize(): self
    {
        if ($this->skipChaining) {
            return $this;
        }
        $this->value = ucfirst(strtolower($this->value));
        return $this; 
    }

    /**
     * Set the processed string.
     *
     * @return this
     */
    public function set(): self
    {
        return $this;
    }
    
    /**
     * Get the processed string.
     *
     * @return string
     */
    public function get(): string
    {
        return $this->value;
    }

    /**
     * Extract a substring between a start and an optional end string.
     *
     * @param string|null $start The starting string to search for
     * @param string|null $end   The ending string to search for (optional)
     *
     * @return string|null The extracted substring or null if not found
     */
    public function extractBetween(?string $start = null, ?string $end = null): ?string
    {
        $value = $this->value;

        // Find the start position
        if ($start !== null) {
            $startPos = mb_strpos($value, $start);
            if ($startPos === false) {
                return null; // Start string not found
            }
            $startPos += mb_strlen($start);
        } else {
            $startPos = 0;
        }

        // Find the end position
        if ($end !== null) {
            $endPos = mb_strpos($value, $end, $startPos);
            if ($endPos === false) {
                return null; // End string not found
            }
        } else {
            $endPos = mb_strlen($value);
        }

        // Extract the substring
        return mb_substr($value, $startPos, $endPos - $startPos);
    }

    /**
     * Apply an anonymous function to the current string value.
     *
     * @param callable $callback The callback function to apply
     *
     * @return $this
     */
    public function do(callable $callback): self
    {
        if ($this->skipChaining) {
            return $this;
        }
        $this->value = $callback($this->value);
        return $this;
    }

    /**
     * Replace occurrences of a search string with a replacement string.
     *
     * @param string  $search        The string to search for
     * @param string  $replace       The replacement string
     * @param bool    $caseSensitive Whether the search is case sensitive (default: true)
     *
     * @return $this
     */
    public function replace(string $search, string $replace, bool $caseSensitive = true): self
    {
        if ($this->skipChaining) {
            return $this;
        }
        if ($caseSensitive) {
            $this->value = str_replace($search, $replace, $this->value);
        } else {
            $this->value = str_ireplace($search, $replace, $this->value);
        }
        return $this;
    }

    /**
     * Check if the current value contains a given substring.
     *
     * @param string $substring The substring to search for
     *
     * @return $this
     */
    public function contains(string $substring): self
    {
        if (mb_strpos($this->value, $substring) === false) {
            $this->skipChaining = true;
        }
        return $this;
    }

    /**
     * Check if the current value does not contain a given substring.
     *
     * @param string $substring The substring to search for
     *
     * @return $this
     */
    public function notContains(string $substring): self
    {
        if (mb_strpos($this->value, $substring) !== false) {
            $this->skipChaining = true;
        }
        return $this;
    }

    /**
     * Conditionally continue chaining if the given callback returns true.
     *
     * @param callable $callback The callback function to evaluate
     *
     * @return $this
     */
    public function if(callable $callback): self
    {
        if (!$callback($this->value)) {
            $this->skipChaining = true;
        }
        return $this;
    }


    /**
     * Trim whitespace from both ends of the current value.
     *
     * @return $this
     */
    public function trim(): self
    {
        if ($this->skipChaining) {
            return $this;
        }
        $this->value = trim($this->value);
        return $this;
    }

    /**
     * Trim whitespace from the beginning of the current value.
     *
     * @return $this
     */
    public function ltrim(): self
    {
        if ($this->skipChaining) {
            return $this;
        }
        $this->value = ltrim($this->value);
        return $this;
    }

    /**
     * Trim whitespace from the end of the current value.
     *
     * @return $this
     */
    public function rtrim(): self
    {
        if ($this->skipChaining) {
            return $this;
        }
        $this->value = rtrim($this->value);
        return $this;
    }


    /**
     * Get the length of the current string value.
     *
     * @return int The length of the string
     */
    public function length(): int
    {
        return mb_strlen($this->value);
    }


    /**
     * Convert the current string value to a URL-friendly slug.
     *
     * @param int|null $length Optional length to limit the slug
     *
     * @return $this
     */
    public function slugify(?int $length = null): self
    {
        if ($this->skipChaining) {
            return $this;
        }

        // Array of replacements for non-ASCII characters
        $replacements = [
            '<' => '', '>' => '', '-' => ' ', '&' => '', '"' => '', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'Ae', 'Ä' => 'A', 'Å' => 'A', 'Ā' => 'A', 'Ą' => 'A', 'Ă' => 'A', 'Æ' => 'Ae', 'Ç' => 'C', "'" => '', 'Ć' => 'C', 'Č' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C', 'Ď' => 'D', 'Đ' => 'D', 'Ð' => 'D', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ē' => 'E', 'Ę' => 'E', 'Ě' => 'E', 'Ĕ' => 'E', 'Ė' => 'E', 'Ĝ' => 'G', 'Ğ' => 'G', 'Ġ' => 'G', 'Ģ' => 'G', 'Ĥ' => 'H', 'Ħ' => 'H', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ī' => 'I', 'Ĩ' => 'I', 'Ĭ' => 'I', 'Į' => 'I', 'İ' => 'I', 'Ĳ' => 'IJ', 'Ĵ' => 'J', 'Ķ' => 'K', 'Ł' => 'L', 'Ľ' => 'L', 'Ĺ' => 'L', 'Ļ' => 'L', 'Ŀ' => 'L', 'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N', 'Ņ' => 'N', 'Ŋ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'Oe', 'Ö' => 'Oe', 'Ø' => 'O', 'Ō' => 'O', 'Ő' => 'O', 'Ŏ' => 'O', 'Œ' => 'OE', 'Ŕ' => 'R', 'Ř' => 'R', 'Ŗ' => 'R', 'Ś' => 'S', 'Š' => 'S', 'Ş' => 'S', 'Ŝ' => 'S', 'Ș' => 'S', 'Ť' => 'T', 'Ţ' => 'T', 'Ŧ' => 'T', 'Ț' => 'T', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'Ue', 'Ū' => 'U', 'Ü' => 'Ue', 'Ů' => 'U', 'Ű' => 'U', 'Ŭ' => 'U', 'Ũ' => 'U', 'Ų' => 'U', 'Ŵ' => 'W', 'Ý' => 'Y', 'Ŷ' => 'Y', 'Ÿ' => 'Y', 'Ź' => 'Z', 'Ž' => 'Z', 'Ż' => 'Z', 'Þ' => 'T', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'ae', 'ä' => 'ae', 'å' => 'a', 'ā' => 'a', 'ą' => 'a', 'ă' => 'a', 'æ' => 'ae', 'ç' => 'c', 'ć' => 'c', 'č' => 'c', 'ĉ' => 'c', 'ċ' => 'c', 'ď' => 'd', 'đ' => 'd', 'ð' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ē' => 'e', 'ę' => 'e', 'ě' => 'e', 'ĕ' => 'e', 'ė' => 'e', 'ƒ' => 'f', 'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h', 'ħ' => 'h', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ī' => 'i', 'ĩ' => 'i', 'ĭ' => 'i', 'į' => 'i', 'ı' => 'i', 'ĳ' => 'ij', 'ĵ' => 'j', 'ķ' => 'k', 'ĸ' => 'k', 'ł' => 'l', 'ľ' => 'l', 'ĺ' => 'l', 'ļ' => 'l', 'ŀ' => 'l', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŉ' => 'n', 'ŋ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'oe', 'ö' => 'oe', 'ø' => 'o', 'ō' => 'o', 'ő' => 'o', 'ŏ' => 'o', 'œ' => 'oe', 'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'š' => 's', 'ś' => 's', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'ue', 'ū' => 'u', 'ü' => 'ue', 'ů' => 'u', 'ű' => 'u', 'ŭ' => 'u', 'ũ' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ý' => 'y', 'ÿ' => 'y', 'ŷ' => 'y', 'ž' => 'z', 'ż' => 'z', 'ź' => 'z', 'þ' => 't', 'α' => 'a', 'ß' => 'ss', 'ẞ' => 'b', 'ſ' => 'ss', 'ый' => 'iy', 'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', 'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', '.' => '-', '€' => '-eur-', '$' => '-usd-'
        ];

        // Replace non-ASCII characters
        $slug = strtr($this->value, $replacements);

        // Replace non-letter or digit characters with "-"
        $slug = preg_replace('~[^\pL\d]+~u', '-', $slug);

        // Trim any leading/trailing hyphens
        $slug = trim($slug, '-');

        // Remove duplicate hyphens
        $slug = preg_replace('~-+~', '-', $slug);

        // Convert to lowercase
        $slug = mb_strtolower($slug);

        // Limit length if specified
        if ($length !== null && $length > 0) {
            $slug = mb_substr($slug, 0, $length);
            $slug = rtrim($slug, '-'); // Ensure no trailing hyphen after trimming
        }

        // Set the resulting slug as the current value
        $this->value = $slug;

        return $this;
    }



}

?>
