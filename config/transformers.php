<?php

return [
    'default' => [
        \PowerDataHub\Metamorphose\Base\TrimTransformer::class,
    ],
    'sources' => [
        'ga' => [
            'metrics' => [
                'date' => \PowerDataHub\Metamorphose\Base\DateTransformer::class,
                'bounceRate' => \PowerDataHub\Metamorphose\Base\PercentTransformer::class,
                'percentNewSessions' => \PowerDataHub\Metamorphose\Base\PercentTransformer::class,
                'sessions' => \PowerDataHub\Metamorphose\Base\NumericTransformer::class,
                'avgSessionDuration' => \PowerDataHub\Metamorphose\Base\NumericTransformer::class,
                'pageviewsPerSession' => \PowerDataHub\Metamorphose\Base\NumericTransformer::class,
                'adCost' => \PowerDataHub\Metamorphose\Base\NumericTransformer::class,
                'adClicks' => \PowerDataHub\Metamorphose\Base\NumericTransformer::class,
                'impressions' => \PowerDataHub\Metamorphose\Base\NumericTransformer::class,
                'users' => \PowerDataHub\Metamorphose\Base\NumericTransformer::class,
                'CPC' => \PowerDataHub\Metamorphose\Base\NumericTransformer::class,
                'CPM' => \PowerDataHub\Metamorphose\Base\NumericTransformer::class,
                'CTR' => \PowerDataHub\Metamorphose\Base\NumericTransformer::class,
            ],
        ]
    ]
];
