<?php

$feed_address = 'https://rmcsport.bfmtv.com/rss/info/flux-rss/flux-toutes-les-actualites/';

$content = file_get_contents($feed_address);

$feeds = simplexml_load_string($content);

setlocale(LC_TIME, 'fra_fra');
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>R(ss)F(eed)R(eeder)</title>
</head>
<body>
<div class="container">
    <h1 class="text-center mb-5">R(ss)F(eed)R(eeder)</h1>

    <?php if (!empty($feeds)): ?>
        <?php
        $site = trim($feeds->channel->title);
        $sitelink = trim($feeds->channel->link);
        ?>

        <h1>feed: <a href="<?= $sitelink ?>"><?= $site ?></a></h1>
        <?php
        foreach ($feeds->channel->item as $item): ?>
            <?php
            $description = trim($item->description);
            $trim = trim($item->link);
            ?>
            <div class="media m-4">
                <?php if ($item->enclosure && strpos($item->enclosure['type'], 'image') === 0): ?>
                    <img src="<?= trim($item->enclosure['url']) ?>" class="mr-3" alt="" width="140" height="105">
                <?php endif; ?>
                <div class="media-body">
                    <h5 class="mt-0"><a href="<?= $trim; ?>"><?= trim($item->title); ?></a></h5>
                    <div><span class="small"><?= date('D, d M Y', strtotime($item->pubDate)); ?></span>
                        <?php if ($item->category): ?>
                            / <span class="badge badge-secondary"><?= trim($item->category) ?></span>
                        <?php endif; ?>
                    </div>
                    <?= strlen($description) > 250 ? substr($description, 0, 200) . '...' : $description ?><a
                            href="<?= $trim; ?>"> Read more...</a>
                </div>
            </div>

        <?php
        endforeach;
    endif;
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
</body>
</html>