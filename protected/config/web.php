<?php

return [

     // ...
	 'modules' => [
		// ...
    
	    'gii' => [
	        'class' => 'yii\gii\Module',
	        'allowedIPs' => ['127.0.0.1',  '::1', '192.168.1.*'],
	    ],
		
		'matching_questions' => [
            'class' => 'app\modules\matching_questions\MatchingQuestions',
        ],
		
		// ...
	]

];
