<?php

declare(strict_types=1);

namespace Forensic\FeedParser\FeedItems;

use Forensic\FeedParser\Enums\FeedItemTypes;
use Forensic\FeedParser\XPath;
use DOMElement;

class RSSFeedItem extends BaseFeedItem
{
    public function __construct(DOMElement $item, XPath $xpath, array $parser_options)
    {
        $property_selectors = [
            'id' => 'guid',
            'title' => 'title',
            'link' => 'link',
            'textContent' => 'content:encoded || description',
            'content' => 'content:encoded || description',
            'source' => 'source',
            'enclosure' => [
                'type' => 'enclosure/@type',
                'url' => 'enclosure/@url',
                'length' => 'enclosure/@length'
            ],
            //'image' => { 'src' => '', 'link' => '', 'title' => '' }, // to be parsed specially
            'createdAt' => 'pubDate',
            'lastUpdated' => 'lastBuildDate || pubDate',

            'author' => 'author || dc:creator',
            'category' => 'category'
        ];

        parent::__construct(
            new FeedItemTypes(FeedItemTypes::RSS_FEED_ITEM),
            $item,
            $xpath,
            $property_selectors,
            $parser_options
        );
    }
}
