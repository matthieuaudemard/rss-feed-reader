<?php

$feed_address = 'https://www.clubic.com/feed/news.rss';

$content = file_get_contents($feed_address);

$xml = simplexml_load_string($content, null, LIBXML_NOCDATA);

var_dump($xml);
