<? namespace BookStack\Custom\Markdown;

use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Environment\ConfigurableEnvironmentInterface;
use League\CommonMark\Parser\Block\AbstractBlockContinueParser;
use League\CommonMark\Parser\Block\BlockStartParserInterface;

// TODO: Actually Write this parser it is just a copy past example to get started

final class MyCustomBlockParser extends AbstractBlockContinueParser
{
    // TODO: implement your continuation parsing methods here

    public static function createBlockStartParser(): BlockStartParserInterface
    {
        return new class implements BlockStartParserInterface
        {
            // TODO: implement the tryStart() method here
        };
    }
}

final class EmojiExtension implements ExtensionInterface
{
    public function register(ConfigurableEnvironmentInterface $environment): void
    {
        $environment
            ->addInlineParser(new EmojiParser(), 20)
            ->addInlineRenderer(Emoji::class, new EmojiRenderer(), 0)
        ;
    }
}