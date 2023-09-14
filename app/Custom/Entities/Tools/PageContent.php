<?php

namespace BookStack\Custom\Entities\Tools;

use BookStack\Entities\Tools\PageContent as OriginalPageContent;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\TaskList\TaskListExtension;
use BookStack\Entities\Tools\Markdown\CustomStrikeThroughExtension;
use League\CommonMark\Environment;
use League\CommonMark\CommonMarkConverter;
use BookStack\Entities\Tools\Markdown\CustomListItemRenderer;
use BookStack\Facades\Theme;
use BookStack\Theming\ThemeEvents;
//use App\Custom\Markdown\MusicPlaylistExtension;

/*
* Must:
*  Find (6  matches): "use BookStack\Entities\Tools\PageContent;"
*  Replace: "use BookStack\Custom\Entities\Tools\PageContent;"
*/

class PageContent extends OriginalPageContent {
	 /**
     * Convert the given Markdown content to a HTML string.
     */
    protected function markdownToHtml(string $markdown): string
    {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new TableExtension());
        $environment->addExtension(new TaskListExtension());
        $environment->addExtension(new CustomStrikeThroughExtension());
        //$environment->addExtension(new MusicPlaylistExtension());
        $environment = Theme::dispatch(ThemeEvents::COMMONMARK_ENVIRONMENT_CONFIGURE, $environment) ?? $environment;
        $converter = new CommonMarkConverter([], $environment);

        $environment->addBlockRenderer(ListItem::class, new CustomListItemRenderer(), 10);

        return $converter->convertToHtml($markdown);
    }
}