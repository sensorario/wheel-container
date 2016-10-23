# Container

```php
[
    'logger' => [
        'class' => 'Path\\To\\Logger',
    ],
    'manager' => [
        'class' => 'Path\\To\\Manager',
        'collaborators' => [
            'logger'
        ],
    ],
    'engine' => [
        'class' => 'Path\\To\\Engine',
    ],
];
```
