# neon-diff
PHP library to compare Neon file against a template

## Installation

```
composer require thefuntasty/neon-diff
```

## Usage

```
vendor/bin/neon-diff [template] [neon]
```

where `[neon]` is any NEON file and `[template]` is a template Neon file includes schema and regexps to compare with.

### Template
```
key1: value1 # Exact match
key2: '~^[a-zA-Z0-9_\-]+$~' # Regular expression match, must start and end with `~` character 
key3: '~^(value3|value4)$~' # Another example of regular expression match
key4: yes # Boolean support 
```
