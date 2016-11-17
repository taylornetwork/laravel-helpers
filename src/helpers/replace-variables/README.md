# Replace Variables

This is a submodule of [TaylorNetwork\LaravelHelpers][link-laravel-helpers].

It should be installed as a component of [TaylorNetwork\LaravelHelpers][link-laravel-helpers] for it to work properly with Laravel.

## Usage

`replace_variables` accepts 2 parameters

| Parameter # | Description | Type | Default Value |
|:-----------:|:------------|:----:|:---------------:|
| 1 | The string to search in | string | none |
| 2 | An associative array of variables to replace in the string | array | `[ ]` |

`replace_variables` will search for variable names surrounded with `{ }` and replace with values found in the second parameter.

### Examples

``` php
$string = 'This is a {animal}!';

replace_variables($string, [ 'animal' => 'cat' ]);
```

Returns

``` php
'This is a cat!'
```

---

``` php
$variables = [
    'userName' => 'johndoe',
    'firstName' => 'John',
    'lastName' => 'Doe'
];

$string = 'My name is {firstName} {lastName} and my user name is {userName}.';

replace_variables($string, $variables);
```

Returns

``` php
`My name is John Doe and my user name is johndoe.'
```

---

``` php
$variables = [
    'color' => 'purple'
];

$string = 'I like the color {color} and my favorite food is {food}.';

replace_variables($string, $variables);
```

Returns

``` php
'I like the color purple and my favorite food is {food}.'
```

Because no `food` variable was set, it was not replaced.

## Credits

- Main Author: [Sam Taylor][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/taylornetwork
[link-laravel-helpers]: https://github.com/taylornetwork/laravel-helpers