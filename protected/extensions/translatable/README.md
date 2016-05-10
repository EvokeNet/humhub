Translatable
============

Transparent attribute translation for ActiveRecords.

Features:

 * Maps attributes from a translation table into the main record
 * Provides optional fallback language or fallback columns if no translation is found
 * Automatically loads the application language by default
 * Loads other language(s) on demand

Here's a basic example:

```php
<?php

// Load a record in application default language ...
$car = New Car;
$car->manufacturer_id = 123;

// Set a description, e.g. in english if this is the app language
$car->description = 'English description';

// Save both: the new car record and a related translation record
$car->save();

// Change language
$car->language = 'de';
$car->description = 'German description';

// We could again call save() here, but we only want to save the translation record
$car->saveTranslation();


// Load a record in a specific language
$car = Car::model()->language('de')->findByPk(1);

// Output: 'German description'
echo $car->description;

$car->language = 'en';

// Output: 'English description'
echo $car->description;
```

# Installation

Simply extract the package to your `protected/extensions` directory and rename
it to `translatable`.

# How to use

**1. Move translateable columns into a separate table**

The behavior requires that you move all columns that you want to translate
from the original table into a dedicated translation table. So if you have
a table `books` and want to translate `title` and `abstract`, you need to
modify yourd DB schema a little:


```
    +--------------+        +--------------+        +-------------------+
    |    books     |        |    books     |        | book_translations |
    +--------------+        +--------------+        +-------------------+
    |           id |        |           id |        |                id |
    | publisher_id |  --->  | publisher_id |   +    |           book_id |
    |    author_id |        |    author_id |        |          language |
    |        title |        |   created_at |        |             title |
    |     abstract |        |   updated_at |        |          abstract |
    |   created_at |        +--------------+        +-------------------+
    |   updated_at |
    +--------------+
```

**2. Attach the behavior to your ActiveRecord model**

With the above DB setup you can now attach the behavior to the `Books` ActiveRecord.

```php
<?php
public function behaviors()
{
    return array(
        // IMPORTANT: Always use 'Translatable' as key
        'Translatable' => array(
            'class'                 => 'ext.translatable.Translatable',
            'translationAttributes' => array('title','abstract'),

            // Optional configuration with their defaults
            'translationRelation'   => 'translation',
            'languageColumn'        => 'language',
        ),
    );
}
```

**3. Define a relation from your main record to your translation record**

You also have to create a record for the translation table (e.g. `BookTranslations`)
and define a `HAS_MANY` relationship for it in the `Books` model.

```php
<?php
public function relations()
{
    return array(
        // IMPORTANT: Use the language column as `index`
        'translations' => array(self::HAS_MANY, 'BookTranslations', 'book_id', 'index'=>'language'),
    );
}
```

**4. Create validation rules in your main record**

You will also want to create some rules for these attributes in the `Books` record.

```php
<?php
public function rules()
{
    return array(
        array('publisher_id,author_id,title,abstract', 'required'),
    );
}
```

# Advanced examples

## Use a fallback language

TODO

## Use fallback columns

TODO

## Tabular edit of several languages

TODO

# API

## Properties

 *  `fallbackColumns`: Name of default columns in main table, indexed by attribute name.
    If no translation is found in the translation table, then the value from this column
    in the main table is used. Example: `array('name'=>'defaultName')`.
 *  `languageColumn`: Name of the column which contains the language code in the
    translation table.
 *  `translationAttributes`: Array of translatable attributes that live in the translation
    table. These attributes will be made available as attributes of the main record.
 *  `translationRelation`: Name of the relation that is used for the translation table.

## Methods

 *  `allLanguages($languages=null)`: A named scope that loads all languages specified in
    the `$languages` array. If no languages are supplied, all available language records
    are loaded.
 *  `getLanguage()`: Returns the code of the current model language, e.g. `en` or `en_gb`.
 *  `getFallbackLanguage()`: The current fallback language or `null` if none.
 *  `getTranslationModel($language=null)`: Returns the record from the translation table
    in the current model language or the specified `$language`. If no language was set
    the current application language is used. If there is no translation record for this
    language yet, a new record with the current language set will be returned.
 *  `saveTranslation()` : Save the current translation model. This happens also automatically
    when `save()` is called on the main record.
 *  `setFallbackLanguage($value)` : Set the fallback language of the model. When reading
    a translation attribute without a translation in the current model language, the
    attribut value in the fallback language will be used.
 *  `setLanguage($value)` : Set the language of the model.

> **NOTE**: The `fallbackLanguage` can not be set in the behavior configuration. It's
> meant to be set on loaded models only.

# About

The development of this extension was kindly sponsored by
[herzog kommunikation GmbH](http://www.herzogkommunikation.de), Stuttgart, Germany.

# Changelog

### 1.0.1

*   Change default for `translationRelation` to `translations`.

### 1.0.0

*   Initial release
