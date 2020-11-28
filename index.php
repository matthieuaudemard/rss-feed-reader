<?php

$feed_address = 'https://www.clubic.com/feed/news.rss';

$content = file_get_contents($feed_address);

header('Content-Type: application/xml');

echo $content;
