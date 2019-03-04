# Blockquotes

Blockquotes are mainly used to give emphasis to a quote or citation. You can also use these for some extra text hierarchy and emphasis. 

```php
echo Html::blockquote('This is an example quotation that uses the blockquote tag.');

// OR

echo Html::beginBlockquote();
    echo 'This is an example quotation that uses the blockquote tag.';
echo Html::endBlockquote();
```
