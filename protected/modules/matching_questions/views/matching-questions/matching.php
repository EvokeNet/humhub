<?php

foreach($questions as $question):
    echo $question->description;
    echo "<br><br>";
    foreach($question->matchingAnswers as $post) {
        echo $post->description;
        echo "<br>";
    }
    echo "<br><br><br>";
endforeach;