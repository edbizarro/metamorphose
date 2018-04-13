<?php

return [
    'default' => [
        \PowerDataHub\Metamorphose\Transformers\TrimTransformer::class,
    ],
    'sources' => [
        'ga' => [
            'date' => \PowerDataHub\Metamorphose\Transformers\DateTransformer::class,
            'bounceRate' => \PowerDataHub\Metamorphose\Transformers\PercentTransformer::class,
            'percentNewSessions' => \PowerDataHub\Metamorphose\Transformers\PercentTransformer::class,
            'sessions' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
            'avgSessionDuration' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
            'pageviewsPerSession' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
            'adCost' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
            'adClicks' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
            'impressions' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
            'users' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
            'CPC' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
            'CPM' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
            'CTR' => \PowerDataHub\Metamorphose\Transformers\NumericTransformer::class,
        ],
        'facebook-ads' => [],
        'instagram-ads' => [],
        'youtube-ads' => [],
        'twitter-ads' => [],
        'facebook-ads' => [],
    ],
];
